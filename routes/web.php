<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = \App\Models\Category::all();

    $pickedForYouProducts = \App\Models\Product::active()
        ->whereNotNull('picked_for_you_order')
        ->orderBy('picked_for_you_order', 'asc')
        ->take(12)
        ->get();

    $trendingProducts = \App\Models\Product::active()->inRandomOrder()->take(12)->get();
    $latestProducts = \App\Models\Product::active()->latest()->take(12)->get();
    return view('home', compact('categories', 'pickedForYouProducts', 'trendingProducts', 'latestProducts'));
});

Route::get('/shop', \App\Livewire\ShopPage::class)->name('shop');
Route::get('/product/{slug}', \App\Livewire\ProductDetailsPage::class)->name('product.show');
Route::get('/cart', \App\Livewire\CartPage::class)->name('cart');
Route::get('/checkout', \App\Livewire\CheckoutPage::class)->name('checkout');
Route::get('/order-success/{order}', \App\Livewire\OrderSuccessPage::class)->name('order.success');
Route::view('/our-story', 'our-story')->name('our-story');
Route::view('/contact', 'contact')->name('contact');

// Legal Policies
Route::view('/terms-and-conditions', 'policies.terms')->name('terms');
Route::view('/privacy-policy', 'policies.privacy')->name('privacy');
Route::view('/cancellation-and-refund-policy', 'policies.refund')->name('refund');
Route::view('/shipping-and-delivery-policy', 'policies.shipping')->name('shipping');
