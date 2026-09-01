<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShopSetting;
use App\Services\CartService;
use App\Services\DeliveryService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;

class CheckoutPage extends Component
{
    // Customer Details
    public string $name = '';
    public string $phone = '';
    public string $email = '';
    public string $address = '';
    public string $city = 'Kochi';
    public string $state = 'Kerala';
    public string $postal_code = '';

    // Geolocation / Distance Calculation
    public ?float $customer_latitude = null;
    public ?float $customer_longitude = null;
    public ?string $location_status = null;

    // Payment & Summary
    public string $payment_method = 'cod';
    public array $cart = [];
    public float $subtotal = 0.0;
    public float $shipping_fee = 0.0;
    public ?float $distance_km = null;
    public bool $is_free_delivery = false;
    public string $shipping_label = 'Standard Delivery';
    public float $grand_total = 0.0;

    // Settings
    public bool $enable_cod = true;
    public bool $enable_free_delivery = true;
    public float $free_delivery_radius_km = 3.0;

    protected $rules = [
        'name' => 'required|string|min:2|max:255',
        'phone' => 'required|string|min:10|max:15',
        'email' => 'nullable|email|max:255',
        'address' => 'required|string|min:5|max:500',
        'city' => 'required|string|max:100',
        'state' => 'required|string|max:100',
        'postal_code' => 'required|string|min:6|max:10',
        'payment_method' => 'required|in:cod,razorpay',
    ];

    public function mount()
    {
        $this->cart = CartService::getCart();

        if (empty($this->cart)) {
            return redirect()->route('cart');
        }

        $settings = ShopSetting::getSettings();
        $this->enable_cod = $settings->enable_cod;
        $this->enable_free_delivery = $settings->enable_free_delivery;
        $this->free_delivery_radius_km = $settings->free_delivery_radius_km;
        $this->payment_method = $this->enable_cod ? 'cod' : 'razorpay';

        $this->calculateTotals();
    }

    public function setCoordinates(?float $lat, ?float $lng)
    {
        $this->customer_latitude = $lat;
        $this->customer_longitude = $lng;
        $this->location_status = 'Coordinates detected';
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->subtotal = CartService::getTotal();

        // Calculate total cart weight if weights are present
        $totalWeightKg = 0.0;
        foreach ($this->cart as $item) {
            $rawWeight = $item['weight'] ?? '';
            $weightInKg = $this->parseWeightToKg($rawWeight);
            $totalWeightKg += ($weightInKg * ($item['quantity'] ?? 1));
        }

        $estimate = DeliveryService::calculateFee(
            $this->customer_latitude,
            $this->customer_longitude,
            $totalWeightKg > 0 ? $totalWeightKg : null
        );

        $this->shipping_fee = $estimate['fee'];
        $this->is_free_delivery = $estimate['is_free'];
        $this->distance_km = $estimate['distance'];
        $this->shipping_label = $estimate['label'];

        $this->grand_total = $this->subtotal + $this->shipping_fee;
    }

    private function parseWeightToKg(string $weightString): float
    {
        $weightString = strtolower(trim($weightString));
        if (Str::endsWith($weightString, 'kg')) {
            return (float) rtrim($weightString, 'kg');
        }
        if (Str::endsWith($weightString, 'g')) {
            return ((float) rtrim($weightString, 'g')) / 1000;
        }
        return 0.0;
    }

    public function placeOrder()
    {
        $this->validate();

        $this->cart = CartService::getCart();
        if (empty($this->cart)) {
            $this->addError('cart', 'Your cart is empty.');
            return;
        }

        $this->calculateTotals();

        $order = DB::transaction(function () {
            // Find or create customer
            $customer = Customer::updateOrCreate(
                ['phone' => $this->phone],
                [
                    'name' => $this->name,
                    'email' => $this->email ?: null,
                    'address' => $this->address . ', ' . $this->city . ', ' . $this->state . ' - ' . $this->postal_code,
                ]
            );

            // Create order
            $order = Order::create([
                'customer_id' => $customer->id,
                'status' => 'pending',
                'payment_method' => $this->payment_method,
                'payment_status' => 'pending',
                'shipping_fee' => $this->shipping_fee,
                'discount' => 0.0,
                'total_amount' => $this->grand_total,
            ]);

            // Create order items
            foreach ($this->cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $item['variant_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'total_price' => $item['price'] * $item['quantity'],
                ]);
            }

            return $order;
        });

        // Clear cart session
        CartService::clear();
        $this->dispatch('cart-updated');

        // Redirect to Order Success Page
        return redirect()->route('order.success', ['order' => $order->id]);
    }

    public function render()
    {
        return view('livewire.checkout-page')->layout('layouts.app');
    }
}
