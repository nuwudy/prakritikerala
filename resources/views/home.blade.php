@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero_background_1787066715757.jpg') }}" alt="Kerala Backwaters" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-kerala-dark/80 via-kerala-dark/60 to-transparent"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10 text-white">
            <div class="max-w-2xl">
                <span class="inline-block py-1 px-3 rounded-full bg-kerala-green/80 border border-green-400/30 backdrop-blur-sm text-sm font-medium tracking-wider uppercase mb-6 shadow-lg">100% Natural & Authentic</span>
                <h1 class="text-5xl md:text-7xl font-heading font-extrabold leading-tight mb-6 drop-shadow-lg">
                    Bring the Pure Taste of Kerala to Your <span class="text-kerala-spice">Kitchen</span>.
                </h1>
                <p class="text-lg md:text-xl text-gray-200 mb-10 leading-relaxed max-w-lg drop-shadow-md">
                    100% natural, preservative-free spices, flours, and pickles crafted the authentic Kerala way.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ url('/shop') }}" class="px-8 py-4 bg-kerala-spice text-white text-lg font-medium rounded-full shadow-lg hover:shadow-xl hover:-translate-y-1 transition transform duration-300 text-center">
                        Explore Collection
                    </a>
                    <a href="{{ route('our-story') }}" class="px-8 py-4 bg-white/10 backdrop-blur-md border border-white/30 text-white text-lg font-medium rounded-full shadow-lg hover:bg-white/20 transition duration-300 text-center">
                        Our Story
                    </a>
                </div>
            </div>
        </div>
    </section>

    @if($categories->isNotEmpty())
    <!-- Shop by Category Section -->
    <section id="categories" class="py-16 bg-white border-b border-gray-100">
        <div class="container mx-auto px-6">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-heading font-bold text-kerala-dark">Shop by Category</h2>
            </div>
            <div class="flex flex-wrap justify-center gap-8 md:gap-12">
                @foreach($categories as $category)
                <a href="{{ route('shop', ['category' => $category->slug]) }}" class="group flex flex-col items-center">
                    <div class="w-24 h-24 md:w-32 md:h-32 rounded-full overflow-hidden mb-4 border-4 border-white shadow-lg group-hover:shadow-xl group-hover:border-kerala-green transition duration-300">
                        @if($category->image)
                        <img src="{{ Str::startsWith($category->image, 'category-images/') ? Storage::url($category->image) : asset('images/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        @else
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center text-kerala-green">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </div>
                        @endif
                    </div>
                    <span class="text-gray-800 font-medium group-hover:text-kerala-green transition duration-300">{{ $category->name }}</span>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if($pickedForYouProducts->isNotEmpty())
    <!-- Picked For You Section -->
    <section id="picked" class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-4xl font-heading font-bold text-kerala-green mb-4">Picked For You</h2>
                <p class="text-gray-600">A curated selection of our finest authentic products.</p>
            </div>

            <div class="swiper picked-swiper !pb-12 px-2">
                <div class="swiper-wrapper">
                @foreach($pickedForYouProducts as $product)
                <div class="swiper-slide h-auto">
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition duration-500 transform hover:-translate-y-2 group flex flex-col h-full border border-gray-100">
                    <a href="{{ route('product.show', $product->slug) }}" class="relative h-64 overflow-hidden bg-gray-100 block">
                        <img src="{{ $product->mainImage ? $product->mainImage->url : 'https://placehold.co/400x500/e2e8f0/475569?text=No+Image' }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                    </a>
                    <div class="p-6 flex flex-col flex-grow relative">
                        <a href="{{ route('product.show', $product->slug) }}" class="block mb-2 hover:text-kerala-green transition-colors">
                            <h3 class="text-xl font-heading font-semibold text-kerala-dark">{{ $product->name }}</h3>
                        </a>
                        <p class="text-gray-500 text-sm mb-6 flex-grow">{{ Str::limit(strip_tags($product->description), 80) }}</p>
                        
                        <div class="flex items-center justify-between mt-auto pt-4">
                            <span class="text-xs font-semibold text-kerala-green bg-green-50 px-3 py-1 rounded-full">Top Pick</span>
                            <a href="{{ route('product.show', $product->slug) }}" class="inline-flex items-center justify-center h-8 w-8 bg-kerala-spice text-white rounded-full hover:bg-orange-700 transition transform hover:rotate-12 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                </div>
                @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next !text-kerala-green after:!text-xl"></div>
                <div class="swiper-button-prev !text-kerala-green after:!text-xl"></div>
            </div>

            <div class="text-center mt-16">
                <a href="{{ url('/shop') }}" class="inline-flex items-center font-medium text-kerala-green hover:text-kerala-spice transition duration-300">
                    View All Products
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Trending Now Section -->
    <section id="trending" class="py-24 bg-kerala-earth">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-4xl font-heading font-bold text-kerala-green mb-4">Trending Now</h2>
                <p class="text-gray-600">Discover our most popular premium spices and oils, loved by our community.</p>
            </div>

            <div class="swiper trending-swiper !pb-12 px-2">
                <div class="swiper-wrapper">
                @forelse($trendingProducts as $product)
                <div class="swiper-slide h-auto">
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition duration-500 transform hover:-translate-y-2 group flex flex-col h-full border border-gray-100">
                    <a href="{{ route('product.show', $product->slug) }}" class="relative h-72 overflow-hidden bg-gray-100 block">
                        <img src="{{ $product->mainImage ? $product->mainImage->url : 'https://placehold.co/400x500/e2e8f0/475569?text=No+Image' }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-sm text-kerala-spice">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                    </a>
                    <div class="p-8 flex flex-col flex-grow relative">
                        <a href="{{ route('product.show', $product->slug) }}" class="block mb-2 hover:text-kerala-green transition-colors">
                            <h3 class="text-2xl font-heading font-semibold text-kerala-dark">{{ $product->name }}</h3>
                        </a>
                        <p class="text-gray-500 text-sm mb-6 flex-grow">{{ Str::limit(strip_tags($product->description), 80) }}</p>
                        
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-sm font-semibold text-kerala-green bg-green-50 px-3 py-1 rounded-full">Premium Quality</span>
                            <a href="{{ route('product.show', $product->slug) }}" class="inline-flex items-center justify-center h-10 w-10 bg-kerala-spice text-white rounded-full hover:bg-orange-700 transition transform hover:rotate-12 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                </div>
                @empty
                <div class="swiper-slide w-full text-center py-12">
                    <p class="text-xl text-gray-500">No products available at the moment.</p>
                </div>
                @endforelse
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next !text-kerala-green after:!text-xl"></div>
                <div class="swiper-button-prev !text-kerala-green after:!text-xl"></div>
            </div>
            
            <div class="text-center mt-16">
                <a href="{{ url('/shop') }}" class="inline-flex items-center font-medium text-kerala-green hover:text-kerala-spice transition duration-300">
                    View All Products
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Latest Arrivals Section -->
    <section id="latest" class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-4xl font-heading font-bold text-kerala-green mb-4">Latest Arrivals</h2>
                <p class="text-gray-600">Explore the newest additions to our authentic Kerala collection.</p>
            </div>

            <div class="swiper latest-swiper !pb-12 px-2">
                <div class="swiper-wrapper">
                @forelse($latestProducts as $product)
                <div class="swiper-slide h-auto">
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition duration-500 transform hover:-translate-y-2 group flex flex-col h-full border border-gray-100">
                    <a href="{{ route('product.show', $product->slug) }}" class="relative h-72 overflow-hidden bg-gray-100 block">
                        <img src="{{ $product->mainImage ? $product->mainImage->url : 'https://placehold.co/400x500/e2e8f0/475569?text=No+Image' }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm p-2 rounded-full shadow-sm text-kerala-spice">
                            <span class="text-xs font-bold uppercase tracking-wider">New</span>
                        </div>
                    </a>
                    <div class="p-8 flex flex-col flex-grow relative">
                        <a href="{{ route('product.show', $product->slug) }}" class="block mb-2 hover:text-kerala-green transition-colors">
                            <h3 class="text-2xl font-heading font-semibold text-kerala-dark">{{ $product->name }}</h3>
                        </a>
                        <p class="text-gray-500 text-sm mb-6 flex-grow">{{ Str::limit(strip_tags($product->description), 80) }}</p>
                        
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-sm font-semibold text-kerala-green bg-green-50 px-3 py-1 rounded-full">Fresh Stock</span>
                            <a href="{{ route('product.show', $product->slug) }}" class="inline-flex items-center justify-center h-10 w-10 bg-kerala-spice text-white rounded-full hover:bg-orange-700 transition transform hover:rotate-12 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                </div>
                @empty
                <div class="swiper-slide w-full text-center py-12">
                    <p class="text-xl text-gray-500">No new arrivals at the moment.</p>
                </div>
                @endforelse
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next !text-kerala-green after:!text-xl"></div>
                <div class="swiper-button-prev !text-kerala-green after:!text-xl"></div>
            </div>
            
            <div class="text-center mt-16">
                <a href="{{ url('/shop') }}" class="inline-flex items-center font-medium text-kerala-green hover:text-kerala-spice transition duration-300">
                    View All Products
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Value Proposition / Story -->
    <section class="py-24 bg-white relative overflow-hidden">
        <!-- Decorative element -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-kerala-green/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-kerala-spice/5 rounded-full blur-3xl"></div>
        
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-1/2">
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('images/hero_background_1787066715757.jpg') }}" alt="Kerala Tradition" class="w-full h-auto object-cover scale-105">
                        <div class="absolute inset-0 bg-kerala-green/20 mix-blend-multiply"></div>
                    </div>
                </div>
                <div class="lg:w-1/2">
                    <h2 class="text-4xl font-heading font-bold text-kerala-green mb-6">Rooted in Tradition. <br> Crafted by Nature.</h2>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        At Prakriti Kerala, we believe that the best flavours come directly from nature. Our journey began with a simple mission: to bring the authentic, untouched taste of Kerala's rich agricultural heritage to homes everywhere.
                    </p>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Every spice, every drop of oil, and every grain is sourced from local farmers who practice sustainable and traditional farming methods. No preservatives, no artificial colours—just pure authenticity.
                    </p>
                    
                    <ul class="space-y-4 mb-10">
                        <li class="flex items-center text-gray-700">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 text-kerala-green flex items-center justify-center mr-3">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            </span>
                            100% Organic & Natural
                        </li>
                        <li class="flex items-center text-gray-700">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 text-kerala-green flex items-center justify-center mr-3">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            </span>
                            Direct from Local Kerala Farms
                        </li>
                        <li class="flex items-center text-gray-700">
                            <span class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 text-kerala-green flex items-center justify-center mr-3">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            </span>
                            Preservative-free Guarantee
                        </li>
                    </ul>
                    
                    <a href="{{ route('our-story') }}" class="inline-block px-8 py-4 bg-kerala-green text-white text-lg font-medium rounded-full shadow-lg hover:bg-green-800 transition transform hover:-translate-y-1">
                        Read Our Story
                    </a>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
    <script>
        function initSwipers() {
            const commonOptions = {
                slidesPerView: 1,
                spaceBetween: 20,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                grabCursor: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                }
            };

            new Swiper('.picked-swiper', {
                ...commonOptions,
                breakpoints: {
                    640: { slidesPerView: 2, spaceBetween: 20 },
                    1024: { slidesPerView: 3, spaceBetween: 30 },
                    1280: { slidesPerView: 4, spaceBetween: 40 },
                }
            });

            const options3Cols = {
                ...commonOptions,
                breakpoints: {
                    640: { slidesPerView: 2, spaceBetween: 20 },
                    1024: { slidesPerView: 3, spaceBetween: 40 },
                }
            };

            new Swiper('.trending-swiper', options3Cols);
            new Swiper('.latest-swiper', options3Cols);
        }

        document.addEventListener('DOMContentLoaded', initSwipers);
        document.addEventListener('livewire:navigated', initSwipers);
    </script>
    <style>
        .swiper-pagination-bullet-active {
            background: #2C5530 !important; /* kerala-green */
        }
    </style>
    @endpush
@endsection
