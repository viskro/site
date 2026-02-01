<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PackController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/{product}', [ProductController::class, 'show'])->name('show');
    Route::get('/{product}/quick-view', [ProductController::class, 'quickView'])->name('quick-view');
});

// Routes des packs
Route::prefix('packs')->name('packs.')->group(function () {
    Route::get('/', [PackController::class, 'index'])->name('index');
    Route::get('/{pack}', [PackController::class, 'show'])->name('show');
    Route::post('/{pack}/add-to-cart', [PackController::class, 'addToCart'])->name('add-to-cart');
});


// Routes du panier
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{productId}', [CartController::class, 'add'])->name('add')->where('productId', '[0-9]+');
    Route::patch('/update/{cartId}', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{cartId}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
    Route::get('/count', [CartController::class, 'count'])->name('count');
});

// Routes du checkout
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/process', [CheckoutController::class, 'store'])->name('process');
    Route::get('/payment', [CheckoutController::class, 'payment'])->name('payment');
    Route::post('/create-payment-intent', [CheckoutController::class, 'createPaymentIntent'])->name('create-payment-intent');
    Route::post('/confirm-payment', [CheckoutController::class, 'confirmPayment'])->name('confirm-payment');
    Route::get('/success/{order}', [CheckoutController::class, 'success'])->name('success');
});

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/privacy', function () {
    return view('pages-legales.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('pages-legales.terms');
})->name('terms');

// Pages légales FR additionnelles
Route::get('/mentions-legales', function () {
    return view('pages-legales.mentions');
})->name('mentions');

Route::get('/cgv', function () {
    return view('pages-legales.cgv');
})->name('cgv');

Route::get('/cookies', function () {
    return view('pages-legales.cookies');
})->name('cookies');

Route::get('/livraison-retours', function () {
    return view('pages-legales.livraison-retours');
})->name('livraison-retours');

// Route pour changer la langue
Route::post('/locale/set', [LocaleController::class, 'setLocale'])->name('locale.set');
