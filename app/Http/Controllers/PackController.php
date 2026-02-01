<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PackController extends Controller
{
    public function index()
    {
        $packs = Product::where('product_type', 'pack')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $soundTags = Product::where('product_type', 'sound-tag')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('packs.index', compact('packs', 'soundTags'));
    }

    public function show(Product $pack)
    {
        if ($pack->product_type !== 'pack') {
            abort(404);
        }

        $soundTags = Product::where('product_type', 'sound-tag')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('packs.show', compact('pack', 'soundTags'));
    }

    public function addToCart(Request $request, Product $pack)
    {
        if ($pack->product_type !== 'pack' || !$pack->is_configurable) {
            return response()->json([
                'success' => false,
                'message' => 'Ce produit n\'est pas un pack configurable.'
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'selected_tags' => 'required|array|size:' . $pack->pack_size,
            'selected_tags.*' => 'required|integer|exists:products,id',
            'quantity' => 'integer|min:1|max:10'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Veuillez sélectionner exactement ' . $pack->pack_size . ' sound tags.',
                'errors' => $validator->errors()
            ], 422);
        }

        $selectedTagIds = $request->selected_tags;
        // Stabiliser l'ordre pour un hash déterministe (même sélection, même cart_id)
        sort($selectedTagIds);
        $quantity = $request->integer('quantity', 1);

        // Obtenir les IDs uniques des tags sélectionnés
        $uniqueTagIds = array_unique($selectedTagIds);

        // Compter combien de fois chaque tag est sélectionné
        $tagCounts = array_count_values($selectedTagIds);

        // Vérifier que tous les tags sélectionnés existent et sont disponibles
        $selectedTags = Product::whereIn('id', $uniqueTagIds)
            ->where('product_type', 'sound-tag')
            ->where('is_active', true)
            ->get()
            ->keyBy('id');

        // Vérifier si tous les tags uniques existent
        if ($selectedTags->count() !== count($uniqueTagIds)) {
            $missingIds = array_diff($uniqueTagIds, $selectedTags->keys()->toArray());
            return response()->json([
                'success' => false,
                'message' => 'Certains sound tags sélectionnés ne sont plus disponibles (IDs: ' . implode(', ', $missingIds) . ').'
            ], 400);
        }

        // Stock illimité: suppression des vérifications de stock individuels

        $cart = Session::get('cart', []);

        // Créer un identifiant unique pour ce pack configuré
        $packCartId = $pack->id . '_' . md5(json_encode($selectedTagIds));

        // Si ce pack exact existe déjà dans le panier
        if (isset($cart[$packCartId])) {
            $newQuantity = $cart[$packCartId]['quantity'] + $quantity;

            // Stock illimité: pas de re-vérification de stock

            $cart[$packCartId]['quantity'] = $newQuantity;
        } else {
            // Ajouter le nouveau pack configuré
            $cart[$packCartId] = [
                'id' => $pack->id,
                'cart_id' => $packCartId,
                'name' => $pack->name,
                'slug' => $pack->slug,
                'price' => floatval($pack->price),
                'original_price' => $pack->original_price ? floatval($pack->original_price) : null,
                'image' => $pack->image,
                'quantity' => $quantity,
                // Stock retiré (illimité)
                'product_type' => 'pack',
                'pack_size' => $pack->pack_size,
                'selected_tags' => $selectedTagIds,
                'selected_tags_details' => $selectedTags->map(function ($tag) use ($tagCounts) {
                    return [
                        'id' => $tag->id,
                        'name' => $tag->name,
                        'image' => $tag->image,
                        'audio_file' => $tag->audio_file,
                        'count' => $tagCounts[$tag->id] ?? 1, // Ajouter la quantité de ce tag
                    ];
                })->toArray(),
            ];
        }

        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => $pack->name . ' avec vos sound tags a été ajouté au panier !',
            'cartCount' => $this->getCartCount(),
            'cartTotal' => $this->getCartTotal()
        ]);
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
