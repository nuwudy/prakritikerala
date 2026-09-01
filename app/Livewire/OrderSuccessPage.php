<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderSuccessPage extends Component
{
    public Order $order;

    public function mount(Order $order)
    {
        $this->order = $order->load(['customer', 'items.productVariant.product']);
    }

    public function render()
    {
        return view('livewire.order-success-page')->layout('layouts.app');
    }
}
