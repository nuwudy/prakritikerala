<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use App\Models\ProductVariant;
use App\Models\Product;

class CartService
{
    protected const SESSION_KEY = 'shop_cart';

    public static function getCart()
    {
        return Session::get(self::SESSION_KEY, []);
    }

    public static function add(ProductVariant $variant, $quantity = 1)
    {
        $cart = self::getCart();
        $key = $variant->id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $quantity;
        } else {
            $cart[$key] = [
                'variant_id' => $variant->id,
                'product_id' => $variant->product_id,
                'name' => $variant->product->name,
                'weight' => $variant->weight,
                'price' => $variant->price,
                'image' => $variant->product->image,
                'quantity' => $quantity,
            ];
        }

        Session::put(self::SESSION_KEY, $cart);
    }

    public static function updateQuantity($variantId, $quantity)
    {
        $cart = self::getCart();
        
        if (isset($cart[$variantId])) {
            if ($quantity <= 0) {
                unset($cart[$variantId]);
            } else {
                $cart[$variantId]['quantity'] = $quantity;
            }
            Session::put(self::SESSION_KEY, $cart);
        }
    }

    public static function remove($variantId)
    {
        $cart = self::getCart();
        if (isset($cart[$variantId])) {
            unset($cart[$variantId]);
            Session::put(self::SESSION_KEY, $cart);
        }
    }

    public static function clear()
    {
        Session::forget(self::SESSION_KEY);
    }

    public static function getTotal()
    {
        $cart = self::getCart();
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public static function getCount()
    {
        $cart = self::getCart();
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }
}
