<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class CartComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('cartCount', $this->getCartCount());
    }

    /**
     * Get the current cart count.
     */
    private function getCartCount(): int
    {
        $cart = Session::get('cart', []);
        return array_sum(array_column($cart, 'quantity'));
    }
}