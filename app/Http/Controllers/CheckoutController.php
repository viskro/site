<?php

namespace App\Http\Controllers;

use App\Mail\SuccessOrderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\PaymentIntent;
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

        Session::put('checkout_data', $orderData);

        return response()->json([
            'success' => true,
            'redirect' => route('checkout.payment')
        ]);
    }

    public function payment()
    {
        $checkoutData = Session::get('checkout_data');
        $cartItems = $this->getCartItems();

        if (!$checkoutData || $cartItems->isEmpty()) {
            return redirect()->route('checkout.index')->with('error', 'Informations de commande manquantes.');
        }

        $summary = $this->getOrderSummary($cartItems);

        return view('checkout.payment', compact('checkoutData', 'cartItems', 'summary'));
    }

    public function createPaymentIntent(Request $request)
    {
        try {
            $stripeSecret = config('services.stripe.secret');
            if (empty($stripeSecret)) {
                Log::warning('Clé API Stripe manquante');
                return response()->json(['error' => 'Paiement indisponible pour le moment'], 503);
            }
            Stripe::setApiKey($stripeSecret);

            Log::info('Début création PaymentIntent');

            $checkoutData = Session::get('checkout_data');
            $cartItems = $this->getCartItems();

            if (!$checkoutData || $cartItems->isEmpty()) {
                Log::warning('Données manquantes pour PaymentIntent');
                return response()->json(['error' => 'Données de commande manquantes'], 400);
            }

            $summary = $this->getOrderSummary($cartItems);
            Log::info('Résumé de commande calculé', [
                'subtotal' => $summary['subtotal'],
                'total' => $summary['total'],
                'items_count' => $summary['items_count'],
            ]);

            // Créer la description avec les noms des produits
            $productNames = $cartItems->map(function ($item) {
                $description = $item['quantity'] . 'x ' . $item['product']['name'];

                // Si c'est un pack, ajouter les sound tags sélectionnés
                if ($item['product_type'] === 'pack' && isset($item['selected_tags_details'])) {
                    $selectedTags = collect($item['selected_tags_details'])->pluck('name')->join(', ');
                    $description .= ' (' . $selectedTags . ')';
                }

                return $description;
            })->join(', ');

            Log::info('Description des produits créée', ['product_names' => $productNames]);

            // Créer le PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => round($summary['total'] * 100), // Montant en centimes
                'currency' => 'eur',
                'metadata' => [
                    'customer_email' => $checkoutData['customer']['email'],
                    'customer_name' => $checkoutData['customer']['first_name'] . ' ' . $checkoutData['customer']['last_name'],
                    'items_count' => $cartItems->sum('quantity'),
                ],
                'description' => 'Commande Sound Tags - ' . $productNames,
            ]);

            Log::info('PaymentIntent créé avec succès', [
                'payment_intent_id' => $paymentIntent->id,
                'amount' => $paymentIntent->amount,
                'currency' => $paymentIntent->currency
            ]);

            // Stocker le PaymentIntent ID en session
            Session::put('payment_intent_id', $paymentIntent->id);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur création PaymentIntent: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la création du paiement: ' . $e->getMessage()], 500);
        }
    }

    public function confirmPayment(Request $request)
    {
        try {
            $stripeSecret = config('services.stripe.secret');
            if (empty($stripeSecret)) {
                Log::warning('Clé API Stripe manquante');
                return response()->json(['error' => 'Paiement indisponible pour le moment'], 503);
            }
            Stripe::setApiKey($stripeSecret);

            $paymentIntentId = Session::get('payment_intent_id');
            $checkoutData = Session::get('checkout_data');
            $cartItems = $this->getCartItems();

            if (!$paymentIntentId || !$checkoutData || $cartItems->isEmpty()) {
                return response()->json(['error' => 'Données manquantes'], 400);
            }

            // Récupérer le PaymentIntent depuis Stripe
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

            if ($paymentIntent->status === 'succeeded') {
                // Créer la commande
                $order = $this->createOrder($paymentIntent, $checkoutData, $cartItems);

                // Réduire les stocks
                $this->updateStock($cartItems);

                // Vider le panier et nettoyer la session
                Session::forget(['cart', 'checkout_data', 'payment_intent_id']);

                return response()->json([
                    'success' => true,
                    'redirect' => route('checkout.success', ['order' => $order->order_number])
                ]);
            }

            return response()->json(['error' => 'Paiement non confirmé'], 400);
        } catch (\Exception $e) {
            Log::error('Erreur confirmation paiement: ' . $e->getMessage());
            return response()->json(['error' => 'Erreur lors de la confirmation'], 500);
        }
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

    private function createOrder($paymentIntent, $checkoutData, $cartItems)
    {
        $summary = $this->getOrderSummary($cartItems);

        return Order::create([
            'order_number' => $this->generateOrderNumber(),
            'stripe_payment_intent_id' => $paymentIntent->id,
            'amount' => $summary['total'],
            'currency' => 'eur',
            'status' => 'completed',
            'customer_email' => $checkoutData['customer']['email'],
            'customer_data' => json_encode($checkoutData['customer']),
            'shipping_address' => json_encode($checkoutData['shipping_address']),
            'billing_address' => json_encode($checkoutData['billing_address']),
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
