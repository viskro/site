<?php

namespace App\Http\Controllers;

use App\Mail\SuccessOrderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

use App\Models\Product;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // Initialisation Stripe déplacée dans les méthodes qui en ont besoin
    }

    public function index()
    {
        $cartItems = $this->getCartItems();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $summary = $this->getOrderSummary($cartItems);

        return view('checkout.index', compact('cartItems', 'summary'));
    }

    public function store(Request $request)
    {
        $cartItems = $this->getCartItems();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Votre panier est vide.'
            ], 400);
        }

        // Validation des données
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:100',
            'shipping_postal_code' => 'required|string|max:10',
            'shipping_country' => 'required|string|max:100',
            'billing_same_as_shipping' => 'boolean',
            'billing_address' => 'exclude_if:billing_same_as_shipping,true|string|max:255',
            'billing_city' => 'exclude_if:billing_same_as_shipping,true|string|max:100',
            'billing_postal_code' => 'exclude_if:billing_same_as_shipping,true|string|max:10',
            'billing_country' => 'exclude_if:billing_same_as_shipping,true|string|max:100',
            'terms_accepted' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Veuillez corriger les erreurs : ' . $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        $summary = $this->getOrderSummary($cartItems);

        // Stocker les informations de commande en session
        $orderData = [
            'customer' => [
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
            ],
            'shipping_address' => [
                'address' => $request->shipping_address,
                'city' => $request->shipping_city,
                'postal_code' => $request->shipping_postal_code,
                'country' => $request->shipping_country,
            ],
            'billing_address' => $request->billing_same_as_shipping ? [
                'address' => $request->shipping_address,
                'city' => $request->shipping_city,
                'postal_code' => $request->shipping_postal_code,
                'country' => $request->shipping_country,
            ] : [
                'address' => $request->billing_address,
                'city' => $request->billing_city,
                'postal_code' => $request->billing_postal_code,
                'country' => $request->billing_country,
            ],
            'items' => $cartItems->toArray(),
            'summary' => $summary,
        ];

        // Créer directement la commande sans passer par l'étape de paiement
        $order = $this->createOrderDirect($orderData, $cartItems);
        
        // Réduire les stocks
        $this->updateStock($cartItems);
        
        // Vider le panier et nettoyer la session
        Session::forget(['cart', 'checkout_data']);
        
        return response()->json([
            'success' => true,
            'redirect' => route('checkout.success', ['order' => $order->order_number])
        ]);
    }







    public function success($orderNumber)
    {
        try {
            $order = Order::where('order_number', $orderNumber)->first();

            if (!$order) {
                Log::warning('Tentative d\'accès à une commande inexistante', [
                    'order_number' => $orderNumber,
                    'user_ip' => request()->ip()
                ]);
                return redirect()->route('home')->with('error', 'Commande non trouvée.');
            }

            // Envoi de l'email de confirmation
            Mail::queue(new SuccessOrderMail($order));

            Log::info('Email de confirmation de commande envoyé avec succès', [
                'order_number' => $order->order_number,
                'customer_email' => $order->customer_email
            ]);

            return view('checkout.success', compact('order'));
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'affichage de la page de succès', [
                'order_number' => $orderNumber,
                'error_message' => $e->getMessage(),
                'error_trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('home')->with('error', 'Une erreur est survenue lors de l\'affichage de votre commande.');
        }
    }

    // Méthodes utilitaires
    private function getCartItems()
    {
        $cart = Session::get('cart', []);
        $items = [];

        foreach ($cart as $item) {
            $product = Product::find($item['id']);
            if ($product && $product->canBePurchased()) {
                $items[] = array_merge($item, [
                    'product' => $product,
                    'subtotal' => $item['price'] * $item['quantity'],
                    'image_url' => $product->image_url,
                ]);
            }
        }

        return collect($items);
    }

    private function getOrderSummary($cartItems)
    {
        $subtotal = $cartItems->sum('subtotal');
        $shippingCost = 0;
        $taxRate = 0.20;
        $taxAmount = ($subtotal + $shippingCost) * $taxRate / (1 + $taxRate);
        $total = $subtotal + $shippingCost;

        return [
            'subtotal' => $subtotal,
            'shipping_cost' => $shippingCost,
            'tax_amount' => $taxAmount,
            'total' => $total,
            'items_count' => $cartItems->sum('quantity'),
        ];
    }

    private function createOrderDirect($orderData, $cartItems)
    {
        $summary = $this->getOrderSummary($cartItems);

        return Order::create([
            'order_number' => $this->generateOrderNumber(),
            'stripe_payment_intent_id' => null, // Pas de Stripe dans ce cas
            'amount' => $summary['total'],
            'currency' => 'eur',
            'status' => 'completed',
            'customer_email' => $orderData['customer']['email'],
            'customer_data' => json_encode($orderData['customer']),
            'shipping_address' => json_encode($orderData['shipping_address']),
            'billing_address' => json_encode($orderData['billing_address']),
            'cart_data' => json_encode($cartItems->toArray()),
            'summary_data' => json_encode($summary),
        ]);
    }

    private function generateOrderNumber(): string
    {
        // Générer un numéro de commande unique
        $prefix = 'ST'; // Sound Tags
        $timestamp = now()->format('Ymd');
        $random = strtoupper(substr(uniqid(), -6));

        return $prefix . $timestamp . $random;
    }

    private function updateStock($cartItems)
    {
        // Stock illimité: pas de décrémentation
    }
}
