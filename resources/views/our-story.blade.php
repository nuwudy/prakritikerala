@extends('layouts.app')

@section('content')
    <!-- Hero / Banner Section -->
    <section class="relative h-[60vh] flex items-center justify-center overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/story_banner_1787067848106.jpg') }}" alt="Kerala Spice Farm" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-kerala-dark/60 mix-blend-multiply"></div>
        </div>
        
        <div class="container mx-auto px-6 relative z-10 text-center text-white mt-16">
            <h1 class="text-5xl md:text-6xl font-heading font-extrabold leading-tight mb-4 drop-shadow-lg">
                Our Journey Back to <span class="text-kerala-spice">Nature</span>.
            </h1>
            <p class="text-xl text-gray-200 max-w-2xl mx-auto drop-shadow-md">
                Discover the roots of Prakriti Kerala and our commitment to preserving the authentic flavors of tradition.
            </p>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-24 bg-kerala-earth">
        <div class="container mx-auto px-6 max-w-4xl">
            
            <!-- Introduction -->
            <div class="bg-white rounded-3xl p-10 md:p-16 shadow-xl mb-16 relative overflow-hidden">
                <!-- Decorative accent -->
                <div class="absolute top-0 left-0 w-2 h-full bg-kerala-green"></div>
                
                <h2 class="text-3xl font-heading font-bold text-kerala-dark mb-6">The Genesis of Prakriti Kerala</h2>
                <div class="prose prose-lg text-gray-600">
                    <p class="mb-6">
                        Prakriti Kerala was born out of a profound longing for the tastes of our childhood—the rich, unadulterated flavors that once defined every meal in a traditional Kerala home. As the world moved towards mass production and artificial additives, we realized that the true essence of our culinary heritage was slowly fading away.
                    </p>
                    <p>
                        We set out on a mission to bridge the gap between the lush, fertile lands of Kerala and kitchens around the world. Our goal is simple yet uncompromising: to provide 100% natural, preservative-free ingredients that let you experience nature's original taste.
                    </p>
                </div>
            </div>

            <!-- The Farm to Table Philosophy -->
            <div class="flex flex-col md:flex-row gap-12 items-center mb-24">
                <div class="md:w-1/2">
                    <h3 class="text-2xl font-heading font-bold text-kerala-green mb-4">Direct from Local Farmers</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        We don't rely on middlemen or large industrial farms. Instead, we have cultivated deep relationships with local farmers across Kerala who still practice sustainable, generation-old agricultural methods.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        By sourcing directly from these small-scale cultivators, we ensure that they receive fair compensation for their hard work, while you receive the freshest, highest-quality spices and oils possible.
                    </p>
                </div>
                <div class="md:w-1/2">
                    <div class="bg-kerala-spice/10 p-8 rounded-3xl border border-kerala-spice/20 relative">
                        <svg class="absolute top-4 left-4 w-12 h-12 text-kerala-spice/20" fill="currentColor" viewBox="0 0 32 32" aria-hidden="true"><path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" /></svg>
                        <p class="text-xl font-medium italic text-kerala-dark relative z-10 pt-4">
                            "Every spice we offer is a testament to the soil it grew in and the hands that nurtured it. We don't just sell ingredients; we share a piece of Kerala's soul."
                        </p>
                        <p class="mt-4 text-sm font-semibold text-kerala-spice uppercase tracking-wider">— The Founders</p>
                    </div>
                </div>
            </div>

            <!-- Our Promise -->
            <div class="text-center">
                <h3 class="text-3xl font-heading font-bold text-kerala-dark mb-10">Our Promise to You</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 transition hover:shadow-lg">
                        <div class="w-16 h-16 mx-auto bg-green-50 text-kerala-green rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-semibold mb-3">100% Natural</h4>
                        <p class="text-gray-500 text-sm">Absolutely no artificial colors, flavors, or preservatives. Just pure, unadulterated goodness.</p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 transition hover:shadow-lg">
                        <div class="w-16 h-16 mx-auto bg-orange-50 text-kerala-spice rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-semibold mb-3">Ethically Sourced</h4>
                        <p class="text-gray-500 text-sm">Supporting local farming communities through fair trade and sustainable agricultural practices.</p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 transition hover:shadow-lg">
                        <div class="w-16 h-16 mx-auto bg-gray-50 text-gray-800 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-semibold mb-3">Premium Quality</h4>
                        <p class="text-gray-500 text-sm">Carefully selected, cold-pressed, and hand-ground to ensure maximum flavor and health benefits.</p>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
@endsection
