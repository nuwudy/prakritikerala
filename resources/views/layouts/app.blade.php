<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prakriti Kerala – The Gateway to Authenticity</title>
    <meta name="description" content="Authentic, preservative‑free traditional Kerala foods. Experience nature's original taste.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;500;700;800&display=swap" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Open Graph / Social Share -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og_title', 'Prakriti Kerala – The Gateway to Authenticity')">
    <meta property="og:description" content="@yield('og_description', 'Authentic, preservative‑free traditional Kerala foods. Experience nature\'s original taste.')">
    <meta property="og:image" content="@yield('og_image', asset('images/social-share.jpg'))">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'Prakriti Kerala – The Gateway to Authenticity')">
    <meta name="twitter:description" content="@yield('og_description', 'Authentic, preservative‑free traditional Kerala foods. Experience nature\'s original taste.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/social-share.jpg'))">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        kerala: {
                            green: '#2C5530',
                            spice: '#D66A12',
                            earth: '#F4F1EA',
                            dark: '#1C211D',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-kerala-earth text-kerala-dark font-sans antialiased overflow-x-hidden">

    <!-- Header / Nav -->
    <header class="fixed w-full top-0 z-50 transition-all duration-300 bg-white/70 backdrop-blur-md shadow-sm">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ asset('images/logo.svg') }}" alt="Prakriti Kerala Logo" class="h-10 md:h-12 w-auto">
                <!-- If you want to keep text alongside the logo, uncomment the span below -->
                <!-- <span class="ml-2 text-2xl font-heading font-bold text-kerala-green tracking-tight hidden sm:block">Prakriti Kerala</span> -->
                <span class="sr-only">Prakriti Kerala</span>
            </a>
            <nav class="hidden md:flex space-x-8">
                <a href="{{ url('/') }}" class="text-kerala-dark font-medium hover:text-kerala-spice transition">Home</a>
                <a href="{{ url('/shop') }}" class="text-kerala-dark font-medium hover:text-kerala-spice transition">Shop</a>
                <a href="{{ route('our-story') }}" class="text-kerala-dark font-medium hover:text-kerala-spice transition">Our Story</a>
                <a href="{{ route('contact') }}" class="text-kerala-dark font-medium hover:text-kerala-spice transition">Contact</a>
            </nav>
            <div class="flex items-center space-x-4">
                <a href="{{ url('/cart') }}" class="relative text-gray-700 hover:text-kerala-spice transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    @php $cartCount = \App\Services\CartService::getCount(); @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full border-2 border-white">{{ $cartCount }}</span>
                    @endif
                </a>
                <a href="{{ url('/shop') }}" class="bg-kerala-spice text-white px-5 py-2 rounded-full font-medium hover:bg-orange-700 transition transform hover:scale-105 shadow-md hidden sm:inline-block">
                    Shop Now
                </a>
                
                <!-- Hamburger Button (Mobile Only) -->
                <button id="mobile-menu-btn" class="md:hidden text-kerala-dark hover:text-kerala-spice focus:outline-none">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path id="menu-icon-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white/95 backdrop-blur-md border-t border-gray-100 shadow-lg absolute w-full left-0 top-full transition-all duration-300 origin-top">
            <div class="px-6 py-4 space-y-4 flex flex-col">
                <a href="{{ url('/') }}" class="text-kerala-dark font-medium hover:text-kerala-spice transition block text-lg">Home</a>
                <a href="{{ url('/shop') }}" class="text-kerala-dark font-medium hover:text-kerala-spice transition block text-lg">Shop</a>
                <a href="{{ route('our-story') }}" class="text-kerala-dark font-medium hover:text-kerala-spice transition block text-lg">Our Story</a>
                <a href="{{ route('contact') }}" class="text-kerala-dark font-medium hover:text-kerala-spice transition block text-lg">Contact</a>
                <a href="{{ url('/shop') }}" class="bg-kerala-spice text-white px-5 py-3 rounded-full font-medium text-center hover:bg-orange-700 transition block mt-4 sm:hidden">
                    Shop Now
                </a>
            </div>
        </div>
    </header>

    <main class="pt-20 md:pt-24">
        @yield('content')
        @isset($slot)
            {{ $slot }}
        @endisset
    </main>

    <!-- Footer -->
    <footer class="bg-kerala-dark text-gray-300 py-16 border-t border-gray-800">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-8 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <a href="{{ url('/') }}" class="inline-block mb-6 bg-white/95 px-4 py-2 rounded-2xl shadow-sm hover:bg-white transition duration-300">
                        <img src="{{ asset('images/logo.svg') }}" alt="Prakriti Kerala Logo" class="h-10 md:h-12 w-auto">
                        <span class="sr-only">Prakriti Kerala</span>
                    </a>
                    <p class="text-gray-400 mb-6 max-w-md text-sm">
                        Bringing the essence of Kerala's vibrant nature and rich spice heritage directly to your home. The Gateway to Authenticity.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-kerala-spice transition">
                            <span class="sr-only">Facebook</span>
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-kerala-spice transition">
                            <span class="sr-only">Instagram</span>
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4 text-base uppercase tracking-wider">Shop</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ url('/shop') }}" class="hover:text-kerala-spice transition">All Products</a></li>
                        <li><a href="#" class="hover:text-kerala-spice transition">Spices</a></li>
                        <li><a href="#" class="hover:text-kerala-spice transition">Oils</a></li>
                        <li><a href="#" class="hover:text-kerala-spice transition">Grains & Pulses</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4 text-base uppercase tracking-wider">Information</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('our-story') }}" class="hover:text-kerala-spice transition">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-kerala-spice transition">Contact</a></li>
                        <li><a href="{{ route('shipping') }}" class="hover:text-kerala-spice transition">Shipping & Delivery</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4 text-base uppercase tracking-wider">Legal</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('terms') }}" class="hover:text-kerala-spice transition">Terms & Conditions</a></li>
                        <li><a href="{{ route('privacy') }}" class="hover:text-kerala-spice transition">Privacy Policy</a></li>
                        <li><a href="{{ route('refund') }}" class="hover:text-kerala-spice transition">Cancellation & Refund</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
                <p>&copy; {{ date('Y') }} Prakriti Kerala. All rights reserved.</p>
                <div class="mt-4 md:mt-0 flex space-x-4">
                    <a href="{{ url('/admin') }}" class="hover:text-white transition">Admin Login</a>
                    <span>|</span>
                    <p>Designed with tradition in mind.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Header scroll and mobile menu script -->
    <script>
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('py-2', 'bg-white/90');
                header.classList.remove('py-4', 'bg-white/70');
            } else {
                header.classList.add('py-4', 'bg-white/70');
                header.classList.remove('py-2', 'bg-white/90');
            }
        });

        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIconPath = document.getElementById('menu-icon-path');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            
            // Switch icon between hamburger and X
            if (mobileMenu.classList.contains('hidden')) {
                menuIconPath.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
            } else {
                menuIconPath.setAttribute('d', 'M6 18L18 6M6 6l12 12');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
