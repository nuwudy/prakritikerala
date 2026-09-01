<div class="bg-gray-50 min-h-screen py-12 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex mb-6 text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/" class="hover:text-emerald-600">Home</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <a href="/cart" class="hover:text-emerald-600">Cart</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="text-gray-900 font-semibold">Checkout</span>
                    </div>
                </li>
            </ol>
        </nav>

        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl mb-8">Checkout</h1>

        <form wire:submit.prevent="placeOrder">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
                
                <!-- Left: Customer Details, Address, Location, Payment Method -->
                <div class="lg:col-span-7 space-y-8">
                    
                    <!-- 1. Contact Information -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                            <span class="flex items-center justify-center w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 text-sm font-bold">1</span>
                            Contact Information
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1">Full Name *</label>
                                <input type="text" id="name" wire:model.blur="name" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none" placeholder="e.g. Rahul Nair">
                                @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1">Phone Number (Required for Delivery) *</label>
                                <input type="tel" id="phone" wire:model.blur="phone" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none" placeholder="e.g. 9876543210">
                                @error('phone') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1">Email Address (Optional for Order Updates)</label>
                                <input type="email" id="email" wire:model.blur="email" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none" placeholder="name@example.com">
                                @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- 2. Shipping Address & Geolocation for Free Delivery -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                <span class="flex items-center justify-center w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 text-sm font-bold">2</span>
                                Delivery Address
                            </h2>

                            <!-- Geolocation Trigger Button -->
                            <button type="button" 
                                    onclick="detectCustomerLocation()" 
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-lg hover:bg-emerald-100 border border-emerald-200 transition-colors">
                                <svg class="w-4 h-4 text-emerald-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Check for Free Delivery (< {{ $free_delivery_radius_km }}km)
                            </button>
                        </div>

                        <!-- Location status badge -->
                        @if($distance_km !== null)
                            <div class="mb-4 p-3 rounded-xl {{ $is_free_delivery ? 'bg-emerald-50 border border-emerald-200 text-emerald-800' : 'bg-blue-50 border border-blue-200 text-blue-800' }} flex items-start gap-2.5">
                                <span class="text-lg">{{ $is_free_delivery ? '🎉' : '📍' }}</span>
                                <div class="text-xs">
                                    @if($is_free_delivery)
                                        <p class="font-bold text-emerald-900">You are within the Free Delivery Zone! ({{ $distance_km }} km from warehouse)</p>
                                        <p class="text-emerald-700 mt-0.5">Shipping fee is ₹0.00 for this order.</p>
                                    @else
                                        <p class="font-semibold text-blue-900">Delivery Distance: {{ $distance_km }} km</p>
                                        <p class="text-blue-700 mt-0.5">Standard delivery rates apply.</p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="space-y-4">
                            <div>
                                <label for="address" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1">House / Flat / Street Address *</label>
                                <textarea id="address" wire:model.blur="address" rows="2" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none" placeholder="Door No., Street Name, Landmark..."></textarea>
                                @error('address') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div>
                                    <label for="city" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1">City / Town *</label>
                                    <input type="text" id="city" wire:model.blur="city" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none">
                                    @error('city') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="state" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1">State *</label>
                                    <input type="text" id="state" wire:model.blur="state" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none">
                                    @error('state') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="postal_code" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-1">Pincode *</label>
                                    <input type="text" id="postal_code" wire:model.blur="postal_code" class="w-full px-3.5 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:bg-white focus:outline-none" placeholder="682001">
                                    @error('postal_code') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Payment Method -->
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                            <span class="flex items-center justify-center w-7 h-7 rounded-full bg-emerald-100 text-emerald-700 text-sm font-bold">3</span>
                            Payment Method
                        </h2>

                        <div class="space-y-3">
                            <!-- Cash on Delivery (COD) -->
                            @if($enable_cod)
                                <label class="relative flex items-start p-4 cursor-pointer rounded-xl border {{ $payment_method === 'cod' ? 'border-emerald-600 bg-emerald-50/40 ring-2 ring-emerald-500/20' : 'border-gray-200 hover:border-gray-300' }} transition-all">
                                    <input type="radio" name="payment_method" value="cod" wire:model.live="payment_method" class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 mt-0.5">
                                    <div class="ml-3 flex-1">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm font-semibold text-gray-900 flex items-center gap-2">
                                                💵 Cash on Delivery (COD)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">RECOMMENDED</span>
                                            </span>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">Pay with cash or UPI directly to our delivery agent at your doorstep.</p>
                                    </div>
                                </label>
                            @endif

                            <!-- Online Payment (Razorpay / UPI / Cards) -->
                            <label class="relative flex items-start p-4 cursor-pointer rounded-xl border {{ $payment_method === 'razorpay' ? 'border-emerald-600 bg-emerald-50/40 ring-2 ring-emerald-500/20' : 'border-gray-200 hover:border-gray-300' }} transition-all">
                                <input type="radio" name="payment_method" value="razorpay" wire:model.live="payment_method" class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 mt-0.5">
                                <div class="ml-3 flex-1">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-semibold text-gray-900 flex items-center gap-2">
                                            💳 Online Payment (Razorpay / UPI / Cards)
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Pay securely via Google Pay, PhonePe, Paytm, Credit/Debit Cards, or Net Banking.</p>
                                </div>
                            </label>
                        </div>
                        @error('payment_method') <span class="text-xs text-red-500 mt-2 block">{{ $message }}</span> @enderror
                    </div>

                </div>

                <!-- Right: Order Summary & Action -->
                <div class="mt-10 lg:mt-0 lg:col-span-5 lg:sticky lg:top-24">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>

                        <!-- Items List -->
                        <ul role="list" class="divide-y divide-gray-100 max-h-72 overflow-y-auto mb-4 pr-1">
                            @foreach($cart as $variantId => $item)
                                <li class="py-3 flex items-center gap-3">
                                    <img src="{{ $item['image'] ?: 'https://placehold.co/100x100/e2e8f0/475569?text=No+Image' }}" alt="{{ $item['name'] }}" class="w-14 h-14 rounded-lg object-cover bg-gray-50 border border-gray-100 flex-shrink-0">
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-medium text-gray-900 truncate">{{ $item['name'] }}</h4>
                                        <p class="text-xs text-gray-500">Qty: {{ $item['quantity'] }} &bull; {{ $item['weight'] }}</p>
                                    </div>
                                    <div class="text-sm font-semibold text-gray-900">
                                        ₹{{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Totals Breakdown -->
                        <div class="border-t border-gray-100 pt-4 space-y-3">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium text-gray-900">₹{{ number_format($subtotal, 2) }}</span>
                            </div>

                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-600 flex items-center gap-1">
                                    Shipping
                                    @if($is_free_delivery)
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">FREE ZONE</span>
                                    @endif
                                </span>
                                @if($is_free_delivery)
                                    <span class="font-bold text-emerald-600 uppercase">FREE</span>
                                @else
                                    <span class="font-medium text-gray-900">₹{{ number_format($shipping_fee, 2) }}</span>
                                @endif
                            </div>

                            @if($distance_km !== null)
                                <div class="text-xs text-gray-400 text-right">
                                    {{ $shipping_label }}
                                </div>
                            @endif

                            <div class="border-t border-gray-100 pt-3 flex items-center justify-between">
                                <span class="text-base font-bold text-gray-900">Grand Total</span>
                                <span class="text-xl font-extrabold text-emerald-600">₹{{ number_format($grand_total, 2) }}</span>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button type="submit" 
                                    wire:loading.attr="disabled"
                                    class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-md hover:shadow-lg transition-all focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 flex items-center justify-center gap-2">
                                <span wire:loading.remove>
                                    @if($payment_method === 'cod')
                                        Place Order (Cash on Delivery)
                                    @else
                                        Proceed to Online Payment
                                    @endif
                                </span>
                                <span wire:loading class="flex items-center gap-2">
                                    <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path></svg>
                                    Processing Order...
                                </span>
                            </button>

                            <p class="text-[11px] text-center text-gray-400 mt-3 flex items-center justify-center gap-1">
                                <svg class="w-3.5 h-3.5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                100% Authentic & Fresh Kerala Produce Guaranteed
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- Client-side Geolocation helper script -->
    <script>
        function detectCustomerLocation() {
            if (!navigator.geolocation) {
                alert("Geolocation is not supported by your browser.");
                return;
            }

            navigator.geolocation.getCurrentPosition(
                function (position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    @this.setCoordinates(lat, lng);
                },
                function (error) {
                    let msg = "Unable to retrieve your location.";
                    if (error.code === error.PERMISSION_DENIED) {
                        msg = "Location access was denied. Please allow location permissions in your browser to check for free delivery eligibility.";
                    }
                    alert(msg);
                },
                { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
            );
        }
    </script>
</div>
