<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::active()
            ->where('product_type', 'sound-tag')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('products.index', compact('products'));
    }

    public function show(Product $product): View
    {
        // Vérifier que le produit est actif
        if (!$product->is_active) {
            abort(404);
        }

        // Produits similaires (même catégorie, excluant le produit actuel)
        $relatedProducts = Product::active()
            ->inStock()
            ->where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function quickView(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }

        return response()->json([
            'product' => $product,
            'html' => view('components.product.quick-view-modal', compact('product'))->render()
        ]);
    }
}
