<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\CartService;

class CartPage extends Component
{
    public $cart = [];
    public $total = 0;

    public function mount()
    {
        $this->updateCartData();
    }

    public function updateCartData()
    {
        $this->cart = CartService::getCart();
        $this->total = CartService::getTotal();
    }

    public function incrementQuantity($variantId)
    {
        $cart = CartService::getCart();
        if (isset($cart[$variantId])) {
            CartService::updateQuantity($variantId, $cart[$variantId]['quantity'] + 1);
            $this->updateCartData();
            $this->dispatch('cart-updated');
        }
    }

    public function decrementQuantity($variantId)
    {
        $cart = CartService::getCart();
        if (isset($cart[$variantId]) && $cart[$variantId]['quantity'] > 1) {
            CartService::updateQuantity($variantId, $cart[$variantId]['quantity'] - 1);
            $this->updateCartData();
            $this->dispatch('cart-updated');
        }
    }

    public function removeItem($variantId)
    {
        CartService::remove($variantId);
        $this->updateCartData();
        $this->dispatch('cart-updated');
    }

    public function clearCart()
    {
        CartService::clear();
        $this->updateCartData();
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        return view('livewire.cart-page')->layout('layouts.app');
    }
}
