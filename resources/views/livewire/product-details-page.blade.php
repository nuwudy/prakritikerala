<div class="bg-white min-h-screen py-12 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex mb-8 text-sm text-gray-500 font-medium">
            <a href="/" class="hover:text-emerald-600">Home</a>
            <span class="mx-2">/</span>
            <a href="/shop" class="hover:text-emerald-600">Shop</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">{{ $product->name }}</span>
        </nav>

        <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
            
            <!-- Image & Media Section -->
            <div class="lg:max-w-lg lg:self-end" x-data="{ activeImage: '{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/800x1000/e2e8f0/475569?text=No+Image' }}' }">
                <!-- Main Image -->
                <div class="aspect-[4/5] rounded-2xl overflow-hidden bg-gray-100 shadow-sm border border-gray-100 mb-4">
                    <img x-bind:src="activeImage" alt="{{ $product->name }}" class="w-full h-full object-cover object-center transition-all duration-300">
                </div>
                
                <!-- Gallery Thumbnails -->
                @if($product->images && count($product->images) > 0)
                <div class="grid grid-cols-4 gap-4">
                    <!-- Primary image thumbnail -->
                    @if($product->image)
                    <button @click="activeImage = '{{ asset('storage/'.$product->image) }}'" type="button" class="aspect-square rounded-lg overflow-hidden bg-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald-500 ring-offset-1">
                        <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-full object-cover" alt="Thumbnail">
                    </button>
                    @endif
                    
                    <!-- Additional Gallery images -->
                    @foreach($product->images as $galleryImage)
                    <button @click="activeImage = '{{ asset('storage/'.$galleryImage) }}'" type="button" class="aspect-square rounded-lg overflow-hidden bg-gray-100 focus:outline-none focus:ring-2 focus:ring-emerald-500 ring-offset-1">
                        <img src="{{ asset('storage/'.$galleryImage) }}" class="w-full h-full object-cover" alt="Thumbnail">
                    </button>
                    @endforeach
                </div>
                @endif
                
                <!-- Video Section -->
                @if($product->video_url)
                <div class="mt-8">
                    <h3 class="text-sm font-bold text-gray-900 mb-3 uppercase tracking-wider">Product Video</h3>
                    <div class="aspect-video rounded-xl overflow-hidden shadow-sm bg-black">
                        @if(\Illuminate\Support\Str::contains($product->video_url, ['youtube.com', 'youtu.be']))
                            @php
                                $videoId = '';
                                if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $product->video_url, $match)){
                                    $videoId = $match[1];
                                }
                            @endphp
                            <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        @elseif(\Illuminate\Support\Str::contains($product->video_url, ['vimeo.com']))
                            @php
                                $videoId = substr(parse_url($product->video_url, PHP_URL_PATH), 1);
                            @endphp
                            <iframe class="w-full h-full" src="https://player.vimeo.com/video/{{ $videoId }}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                        @else
                            <video class="w-full h-full object-cover" controls>
                                <source src="{{ $product->video_url }}" type="video/mp4">
                            </video>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <!-- Product Info Section -->
            <div class="mt-10 px-4 sm:px-0 lg:mt-0">
                <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">{{ $product->name }}</h1>
                <p class="mt-2 text-sm text-gray-500 uppercase tracking-wider font-semibold">{{ $product->category->name ?? 'Uncategorized' }}</p>

                <div class="mt-6">
                    <h2 class="sr-only">Product information</h2>
                    <p class="text-3xl text-gray-900 font-bold">
                        ₹{{ $selectedVariant ? number_format($selectedVariant->price, 2) : '0.00' }}
                    </p>
                </div>

                <!-- Description -->
                <div class="mt-6">
                    <h3 class="sr-only">Description</h3>
                    <div class="text-base text-gray-700 space-y-6">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>

                <div class="mt-10">
                    <!-- Variant Selector -->
                    @if($product->variants->count() > 0)
                        <div class="mb-8">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium text-gray-900">Size / Weight</h3>
                            </div>

                            <div class="mt-4 grid grid-cols-3 gap-3 sm:grid-cols-4">
                                @foreach($product->variants as $variant)
                                    <button 
                                        wire:click="selectVariant({{ $variant->id }})"
                                        type="button" 
                                        class="flex items-center justify-center px-4 py-3 border rounded-lg text-sm font-semibold uppercase sm:flex-1 transition-all
                                        {{ $selectedVariantId == $variant->id 
                                            ? 'border-emerald-600 text-emerald-600 bg-emerald-50 ring-2 ring-emerald-600 ring-offset-2' 
                                            : 'border-gray-200 text-gray-900 bg-white hover:bg-gray-50' 
                                        }}
                                        focus:outline-none"
                                    >
                                        {{ $variant->weight }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="flex items-center space-x-4">
                        <!-- Quantity -->
                        <div class="w-32">
                            <label for="quantity" class="sr-only">Quantity</label>
                            <div class="flex items-center border border-gray-300 rounded-lg bg-white overflow-hidden">
                                <button wire:click="decrementQuantity" class="px-4 py-3 text-gray-600 hover:text-emerald-600 hover:bg-gray-100 transition-colors focus:outline-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                </button>
                                <div class="flex-1 text-center font-semibold text-gray-900">
                                    {{ $quantity }}
                                </div>
                                <button wire:click="incrementQuantity" class="px-4 py-3 text-gray-600 hover:text-emerald-600 hover:bg-gray-100 transition-colors focus:outline-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Add to Cart -->
                        <button 
                            wire:click="addToCart"
                            wire:loading.attr="disabled"
                            class="flex-1 bg-emerald-600 border border-transparent rounded-lg py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors shadow-sm disabled:opacity-75 disabled:cursor-not-allowed"
                        >
                            <span wire:loading.remove wire:target="addToCart">Add to Cart</span>
                            <span wire:loading wire:target="addToCart" class="flex items-center space-x-2">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>Adding...</span>
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Features/Guarantees -->
                <div class="mt-10 border-t border-gray-200 pt-8 grid grid-cols-2 gap-4">
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-5 h-5 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        100% Authentic Kerala spices
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-5 h-5 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        No artificial preservatives
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-5 h-5 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Sourced directly from farmers
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <svg class="w-5 h-5 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Fast & secure delivery
                    </div>
                </div>

            </div>
        </div>
        </div>

        <!-- Customer Reviews Section -->
        <div class="mt-16 pt-10 border-t border-gray-200">
            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 mb-8">Customer Reviews</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-x-8 gap-y-10">
                <!-- Review List -->
                <div class="lg:col-span-7">
                    @if($product->approvedReviews->count() > 0)
                        <div class="space-y-8">
                            @foreach($product->approvedReviews as $review)
                                <div class="bg-gray-50 rounded-xl p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="font-bold text-gray-900">{{ $review->reviewer_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $review->created_at->format('M d, Y') }}</div>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="h-5 w-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <p class="text-gray-700">{{ $review->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 italic">No reviews yet. Be the first to review this product!</p>
                    @endif
                </div>

                <!-- Write a Review Form -->
                <div class="lg:col-span-5">
                    <div class="bg-emerald-50 rounded-2xl p-6 sm:p-8">
                        <h3 class="text-lg font-bold text-emerald-900 mb-6">Write a Review</h3>

                        @if (session()->has('review_message'))
                            <div class="mb-6 p-4 rounded-md bg-emerald-100 text-emerald-700 text-sm font-medium">
                                {{ session('review_message') }}
                            </div>
                        @endif

                        <form wire:submit.prevent="submitReview" class="space-y-4">
                            <div>
                                <label for="reviewerName" class="block text-sm font-medium text-gray-700">Your Name</label>
                                <input type="text" wire:model="reviewerName" id="reviewerName" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                                @error('reviewerName') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                                <select wire:model="rating" id="rating" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm">
                                    <option value="5">5 Stars - Excellent</option>
                                    <option value="4">4 Stars - Good</option>
                                    <option value="3">3 Stars - Average</option>
                                    <option value="2">2 Stars - Poor</option>
                                    <option value="1">1 Star - Terrible</option>
                                </select>
                                @error('rating') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="reviewComment" class="block text-sm font-medium text-gray-700">Review</label>
                                <textarea wire:model="reviewComment" id="reviewComment" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"></textarea>
                                @error('reviewComment') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <button type="submit" class="w-full bg-emerald-600 border border-transparent rounded-lg py-3 px-4 flex items-center justify-center text-sm font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors shadow-sm">
                                Submit Review
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
