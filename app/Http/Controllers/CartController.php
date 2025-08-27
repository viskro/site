<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = $this->getCartItems();
        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request, int $productId)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'integer|min:1|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Quantité invalide.',
                'errors' => $validator->errors()
            ], 422);
        }

        $product = Product::find($productId);

        if (!$product || !$product->canBePurchased()) {
            return response()->json([
                'success' => false,
                'message' => 'Ce produit n\'est pas disponible.'
            ], 404);
        }

        $quantity = $request->integer('quantity', 1);

        // Stock illimité: pas de vérification de stock

        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $newQuantity = $cart[$productId]['quantity'] + $quantity;

            // Stock illimité: pas de vérification de stock

            $cart[$productId]['quantity'] = $newQuantity;
        } else {
            // Utiliser une clé cart_id uniforme (id simple pour produits unitaires)
            $cartId = (string) $product->id;
            $cart[$cartId] = [
                'id' => $product->id,
                'cart_id' => $cartId,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => floatval($product->price),
                'original_price' => $product->original_price ? floatval($product->original_price) : null,
                'image' => $product->image,
                'quantity' => $quantity,
                // Stock retiré (illimité)
                'product_type' => $product->product_type ?? 'sound-tag',
            ];
        }

        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => $product->name . ' a été ajouté au panier !',
            'cartCount' => $this->getCartCount(),
            'cartTotal' => $this->getCartTotal()
        ]);
    }

    public function update(Request $request, $cartId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Session::get('cart', []);

        if (!isset($cart[$cartId])) {
            return response()->json([
                'success' => false,
                'message' => 'Produit non trouvé dans le panier.'
            ], 404);
        }

        $product = Product::find($cart[$cartId]['id']);
        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produit non trouvé.'
            ], 404);
        }

        $quantity = $request->integer('quantity');

        // Stock illimité: pas de vérification de stock

        $cart[$cartId]['quantity'] = $quantity;
        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'cartCount' => $this->getCartCount(),
            'cartTotal' => $this->getCartTotal(),
            'itemTotal' => number_format($cart[$cartId]['price'] * $quantity, 2)
        ]);
    }

    public function remove($cartId)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$cartId])) {
            unset($cart[$cartId]);
            Session::put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Produit supprimé du panier.',
            'cartCount' => $this->getCartCount(),
            'cartTotal' => $this->getCartTotal()
        ]);
    }

    public function clear()
    {
        Session::forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Panier vidé.'
        ]);
    }

    public function count()
    {
        return response()->json([
            'count' => $this->getCartCount()
        ]);
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
                    'product_url' => route('products.show', $product),
                ]);
            }
        }


        return collect($items);
    }

    private function getCartCount(): int
    {
        $cart = Session::get('cart', []);
        return array_sum(array_column($cart, 'quantity'));
    }

    private function getCartTotal(): float
    {
        $cart = Session::get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return $total;
    }
}
