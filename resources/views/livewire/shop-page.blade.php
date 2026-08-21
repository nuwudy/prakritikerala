<div class="bg-gray-50 min-h-screen py-12 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-10 text-center md:text-left">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">Our Collection</h1>
            <p class="mt-4 text-lg text-gray-500 max-w-2xl">Discover nature's finest. Authentic Ayurvedic products crafted with care and tradition.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Sidebar Filters -->
            <div class="w-full lg:w-1/4 flex-shrink-0">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-24">
                    
                    <!-- Search -->
                    <div class="mb-8">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <div class="relative">
                            <input wire:model.live.debounce.300ms="search" type="text" id="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm transition duration-150 ease-in-out" placeholder="Search products...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="mb-8">
                        <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase mb-4">Categories</h3>
                        <div class="space-y-3">
                            <button wire:click="$set('category', null)" class="block w-full text-left text-sm transition-colors {{ is_null($category) ? 'text-emerald-600 font-semibold' : 'text-gray-600 hover:text-emerald-500' }}">
                                All Products
                            </button>
                            @foreach($categories as $cat)
                                <button wire:click="filterByCategory('{{ $cat->slug }}')" class="block w-full text-left text-sm transition-colors {{ $category === $cat->slug ? 'text-emerald-600 font-semibold' : 'text-gray-600 hover:text-emerald-500' }}">
                                    {{ $cat->name }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 tracking-wider uppercase mb-4">Price Range (₹)</h3>
                        <div class="flex items-center space-x-3">
                            <div>
                                <input wire:model.live.debounce.500ms="minPrice" type="number" min="0" placeholder="Min" class="block w-full text-sm border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                            </div>
                            <span class="text-gray-400">-</span>
                            <div>
                                <input wire:model.live.debounce.500ms="maxPrice" type="number" min="0" placeholder="Max" class="block w-full text-sm border-gray-300 rounded-lg shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
                            </div>
                        </div>
                    </div>

                    <!-- Reset Filters button -->
                    @if($search || $category || $minPrice || $maxPrice)
                        <div class="mt-6 pt-6 border-t border-gray-100">
                            <button wire:click="resetFilters" class="w-full text-center text-sm text-red-500 hover:text-red-700 font-medium transition-colors">
                                Clear All Filters
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Grid -->
            <div class="w-full lg:w-3/4">
                
                <!-- Loading State indicator -->
                <div wire:loading.delay class="w-full mb-6">
                    <div class="flex items-center justify-center space-x-2 text-emerald-600">
                        <svg class="animate-spin h-5 w-5 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-sm font-medium">Updating results...</span>
                    </div>
                </div>

                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            @php
                                $defaultVariant = $product->variants->where('is_default', true)->first() ?? $product->variants->first();
                                $price = $defaultVariant ? $defaultVariant->price : null;
                                $imageUrl = $product->mainImage ? $product->mainImage->url : 'https://placehold.co/400x500/e2e8f0/475569?text=No+Image';
                            @endphp

                            <div wire:key="product-{{ $product->id }}" class="group relative bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden flex flex-col h-full">
                                
                                <a href="/product/{{ $product->slug }}" class="block relative aspect-[4/5] overflow-hidden bg-gray-100">
                                    <img src="{{ $imageUrl }}" alt="{{ $product->name }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500 ease-in-out">
                                    
                                    <!-- Badge -->
                                    @if($product->created_at->diffInDays(now()) < 30)
                                        <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-emerald-700 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                            NEW
                                        </div>
                                    @endif
                                </a>

                                <div class="p-5 flex flex-col flex-grow">
                                    <div class="mb-2">
                                        <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">{{ $product->category->name ?? 'Uncategorized' }}</span>
                                    </div>
                                    <a href="/product/{{ $product->slug }}" class="block mb-2">
                                        <h3 class="text-lg font-semibold text-gray-900 group-hover:text-emerald-600 transition-colors line-clamp-2">{{ $product->name }}</h3>
                                    </a>
                                    
                                    <div class="mt-auto pt-4 flex items-center justify-between">
                                        <p class="text-xl font-bold text-gray-900">
                                            @if(!is_null($price))
                                                ₹{{ number_format($price, 2) }}
                                            @else
                                                <span class="text-sm text-gray-500 font-normal">Pricing unavailable</span>
                                            @endif
                                        </p>
                                        
                                        <a href="/product/{{ $product->slug }}" class="inline-flex items-center justify-center w-10 h-10 bg-gray-50 text-gray-600 rounded-full hover:bg-emerald-600 hover:text-white transition-colors duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="text-center py-24 bg-white rounded-2xl border border-gray-100 shadow-sm">
                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900">No products found</h3>
                        <p class="mt-2 text-sm text-gray-500">We couldn't find anything matching your current filters.</p>
                        <button wire:click="resetFilters" class="mt-6 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors">
                            Clear all filters
                        </button>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
