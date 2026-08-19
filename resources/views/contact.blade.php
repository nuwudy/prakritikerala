@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="bg-kerala-green pt-32 pb-16">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-heading font-extrabold text-white mb-4">Get in Touch</h1>
            <p class="text-green-100 text-lg max-w-2xl mx-auto">We'd love to hear from you. Reach out with any questions, wholesale inquiries, or just to say hello.</p>
        </div>
    </div>

    <!-- Contact Content -->
    <section class="py-20 bg-kerala-earth">
        <div class="container mx-auto px-6 max-w-5xl">
            <div class="flex flex-col md:flex-row gap-12">
                
                <!-- Contact Information -->
                <div class="md:w-1/3">
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 h-full">
                        <h3 class="text-2xl font-heading font-bold text-kerala-dark mb-8">Contact Info</h3>
                        
                        <div class="space-y-8">
                            <!-- WhatsApp / Phone -->
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-green-50 w-12 h-12 rounded-full flex items-center justify-center text-kerala-green mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-kerala-dark mb-1">Phone & WhatsApp</h4>
                                    <a href="tel:+918590931210" class="block text-gray-600 hover:text-kerala-spice transition">+91 85909 31210</a>
                                    <a href="tel:+917012741268" class="block text-gray-600 hover:text-kerala-spice transition">+91 70127 41268</a>
                                </div>
                            </div>
                            
                            <!-- Email -->
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-orange-50 w-12 h-12 rounded-full flex items-center justify-center text-kerala-spice mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-kerala-dark mb-1">Email</h4>
                                    <a href="mailto:prakritifoodsekm@gmail.com" class="text-gray-600 hover:text-kerala-spice transition">prakritifoodsekm@gmail.com</a>
                                </div>
                            </div>
                            
                            <!-- Address -->
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-gray-50 w-12 h-12 rounded-full flex items-center justify-center text-gray-700 mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-kerala-dark mb-1">Address</h4>
                                    <p class="text-gray-600 leading-relaxed">
                                        Thachavallath house, <br>
                                        Elookkara, Muppathadam PO, <br>
                                        Aluva, Ernakulam, <br>
                                        Keralam, Pin- 683110
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="md:w-2/3">
                    <div class="bg-white rounded-3xl p-8 md:p-12 shadow-sm border border-gray-100 h-full">
                        <h3 class="text-2xl font-heading font-bold text-kerala-dark mb-6">Send us a Message</h3>
                        <form action="#" method="POST">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                    <input type="text" id="name" name="name" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-kerala-green focus:border-transparent outline-none transition bg-gray-50 focus:bg-white" placeholder="John Doe">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                    <input type="email" id="email" name="email" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-kerala-green focus:border-transparent outline-none transition bg-gray-50 focus:bg-white" placeholder="john@example.com">
                                </div>
                            </div>
                            <div class="mb-6">
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                                <input type="text" id="subject" name="subject" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-kerala-green focus:border-transparent outline-none transition bg-gray-50 focus:bg-white" placeholder="How can we help you?">
                            </div>
                            <div class="mb-6">
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                                <textarea id="message" name="message" rows="5" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-kerala-green focus:border-transparent outline-none transition bg-gray-50 focus:bg-white resize-none" placeholder="Your message here..."></textarea>
                            </div>
                            <button type="button" class="w-full sm:w-auto px-8 py-4 bg-kerala-green text-white font-medium rounded-full hover:bg-green-800 transition transform hover:-translate-y-1 shadow-lg">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
