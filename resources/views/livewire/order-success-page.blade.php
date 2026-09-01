<div class="bg-gray-50 min-h-screen py-12 font-sans">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Confirmation Card -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 sm:p-12 text-center">
            
            <!-- Success Icon -->
            <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            </div>

            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 mb-3">
                Order Placed Successfully
            </span>

            <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                Thank You for Your Order!
            </h1>
            <p class="text-sm text-gray-500 mt-2">
                We've received your order <span class="font-bold text-gray-800">#{{ $order->id }}</span> and are preparing it with care.
            </p>

            <!-- Order Details Box -->
            <div class="mt-8 bg-gray-50 rounded-2xl p-6 text-left border border-gray-100 space-y-4">
                <div class="grid grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="text-gray-400 block uppercase font-semibold">Payment Method</span>
                        <span class="font-bold text-gray-800 text-sm">
                            {{ $order->payment_method === 'cod' ? '💵 Cash on Delivery (COD)' : '💳 Online Payment' }}
                        </span>
                    </div>
                    <div>
                        <span class="text-gray-400 block uppercase font-semibold">Payment Status</span>
                        <span class="font-bold text-amber-600 uppercase text-sm">
                            {{ $order->payment_status }}
                        </span>
                    </div>
                    <div>
                        <span class="text-gray-400 block uppercase font-semibold">Customer</span>
                        <span class="font-medium text-gray-800">{{ $order->customer->name }} ({{ $order->customer->phone }})</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block uppercase font-semibold">Delivery Address</span>
                        <span class="font-medium text-gray-800">{{ $order->customer->address }}</span>
                    </div>
                </div>

                <div class="border-t border-gray-200 pt-4">
                    <h3 class="text-xs font-bold uppercase text-gray-400 mb-3">Items in this order</h3>
                    <ul class="divide-y divide-gray-200 text-sm">
                        @foreach($order->items as $item)
                            <li class="py-2.5 flex items-center justify-between">
                                <div>
                                    <span class="font-medium text-gray-900">{{ $item->productVariant->product->name ?? 'Product' }}</span>
                                    <span class="text-xs text-gray-500 block">{{ $item->productVariant->weight ?? '' }} &times; {{ $item->quantity }}</span>
                                </div>
                                <span class="font-semibold text-gray-900">₹{{ number_format($item->total_price, 2) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="border-t border-gray-200 pt-3 space-y-1.5 text-xs">
                    <div class="flex justify-between text-gray-600">
                        <span>Shipping Fee:</span>
                        <span>{{ $order->shipping_fee > 0 ? '₹' . number_format($order->shipping_fee, 2) : 'FREE' }}</span>
                    </div>
                    <div class="flex justify-between text-sm font-bold text-gray-900 pt-2 border-t border-gray-200">
                        <span>Total Amount:</span>
                        <span class="text-emerald-600 text-base">₹{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center">
                <a href="/shop" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl text-white bg-emerald-600 hover:bg-emerald-700 shadow-sm transition-colors">
                    Continue Shopping
                </a>
                <a href="/" class="inline-flex items-center justify-center px-6 py-3 border border-gray-200 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                    Return to Homepage
                </a>
            </div>

        </div>
    </div>
</div>
