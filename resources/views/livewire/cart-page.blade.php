<div class="bg-gray-50 min-h-screen py-12 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl mb-8">Shopping Cart</h1>

        @if(count($cart) > 0)
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
                
                <!-- Cart Items -->
                <div class="lg:col-span-8">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <ul role="list" class="divide-y divide-gray-200">
                            @foreach($cart as $variantId => $item)
                                <li class="flex py-6 px-4 sm:px-6">
                                    <div class="flex-shrink-0 w-24 h-24 border border-gray-200 rounded-md overflow-hidden bg-gray-100">
                                        <img src="{{ $item['image'] ? asset('storage/'.$item['image']) : 'https://placehold.co/200x200/e2e8f0/475569?text=No+Image' }}" alt="{{ $item['name'] }}" class="w-full h-full object-center object-cover">
                                    </div>

                                    <div class="ml-4 flex-1 flex flex-col justify-between">
                                        <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                            <div>
                                                <div class="flex justify-between">
                                                    <h3 class="text-sm">
                                                        <a href="/product/{{ \Illuminate\Support\Str::slug($item['name']) }}" class="font-medium text-gray-700 hover:text-emerald-600">
                                                            {{ $item['name'] }}
                                                        </a>
                                                    </h3>
                                                </div>
                                                <p class="mt-1 text-sm font-semibold text-gray-900">₹{{ number_format($item['price'], 2) }}</p>
                                                <p class="mt-1 text-sm text-gray-500">Weight: {{ $item['weight'] }}</p>
                                            </div>

                                            <div class="mt-4 sm:mt-0 sm:pr-9">
                                                <label for="quantity-{{ $variantId }}" class="sr-only">Quantity</label>
                                                <div class="flex items-center border border-gray-300 rounded-md overflow-hidden w-28">
                                                    <button wire:click="decrementQuantity({{ $variantId }})" class="px-3 py-1 bg-gray-50 text-gray-600 hover:bg-gray-100 transition-colors focus:outline-none focus:bg-gray-200">
                                                        &minus;
                                                    </button>
                                                    <div class="flex-1 text-center text-sm font-medium text-gray-900">
                                                        {{ $item['quantity'] }}
                                                    </div>
                                                    <button wire:click="incrementQuantity({{ $variantId }})" class="px-3 py-1 bg-gray-50 text-gray-600 hover:bg-gray-100 transition-colors focus:outline-none focus:bg-gray-200">
                                                        &plus;
                                                    </button>
                                                </div>

                                                <div class="absolute top-0 right-0 sm:right-2 sm:top-auto sm:mt-0">
                                                    <button wire:click="removeItem({{ $variantId }})" type="button" class="-m-2 p-2 inline-flex text-gray-400 hover:text-red-500">
                                                        <span class="sr-only">Remove</span>
                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="mt-16 bg-white rounded-2xl shadow-sm border border-gray-100 px-4 py-6 sm:p-6 lg:p-8 lg:col-span-4 lg:mt-0 lg:sticky lg:top-24">
                    <h2 class="text-lg font-medium text-gray-900">Order summary</h2>

                    <dl class="mt-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm text-gray-600">Subtotal</dt>
                            <dd class="text-sm font-medium text-gray-900">₹{{ number_format($total, 2) }}</dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <dt class="flex items-center text-sm text-gray-600">
                                <span>Shipping estimate</span>
                            </dt>
                            <dd class="text-sm font-medium text-gray-900">Calculated at checkout</dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <dt class="text-base font-medium text-gray-900">Order total</dt>
                            <dd class="text-base font-bold text-emerald-600">₹{{ number_format($total, 2) }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6">
                        <button type="button" class="w-full bg-emerald-600 border border-transparent rounded-lg shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-emerald-500">
                            Proceed to Checkout
                        </button>
                        <p class="mt-3 text-xs text-center text-gray-500 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            Secure Checkout (Razorpay Integration Coming Soon)
                        </p>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 py-16 px-4 text-center sm:px-6 lg:px-8">
                <svg class="mx-auto h-24 w-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <h3 class="mt-4 text-xl font-medium text-gray-900">Your cart is empty</h3>
                <p class="mt-2 text-base text-gray-500">Looks like you haven't added anything to your cart yet.</p>
                <div class="mt-6">
                    <a href="/shop" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-emerald-600 hover:bg-emerald-700">
                        Continue Shopping
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
