@extends('layouts.app')

@section('content')
<div class="bg-kerala-earth pt-32 pb-24">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="bg-white rounded-3xl p-10 md:p-16 shadow-sm border border-gray-100">
            <h1 class="text-4xl font-heading font-bold text-kerala-dark mb-8">Shipping & Delivery Policy</h1>
            <p class="text-sm text-gray-500 mb-8">Last updated: {{ date('F j, Y') }}</p>

            <div class="prose prose-lg text-gray-600 max-w-none">
                <p>This Shipping & Delivery Policy is part of our Terms and Conditions ("Terms") and should be therefore read alongside our main Terms.</p>
                <p>Please carefully review our Shipping & Delivery Policy when purchasing our products. This policy will apply to any order you place with us.</p>

                <h3 class="text-2xl font-semibold text-kerala-dark mt-8 mb-4">What are my shipping & delivery options?</h3>
                <p>We offer various shipping options. In some cases a third-party supplier may be managing our inventory and will be responsible for shipping your products.</p>
                
                <h4 class="text-xl font-semibold text-kerala-dark mt-6 mb-3">Standard Shipping</h4>
                <p>We offer standard shipping across India. Standard shipping generally takes 3-7 business days depending on your location.</p>
                <p>Shipping fees are calculated at checkout based on the weight of the items and your destination address.</p>

                <h3 class="text-2xl font-semibold text-kerala-dark mt-8 mb-4">Do you deliver internationally?</h3>
                <p>We currently do not offer international shipping. We ship only within India.</p>

                <h3 class="text-2xl font-semibold text-kerala-dark mt-8 mb-4">Are there other shipping restrictions?</h3>
                <ul class="list-disc pl-6 space-y-2 mb-6">
                    <li>Orders are not shipped or delivered on Sundays or local public holidays.</li>
                    <li>If we are experiencing a high volume of orders, shipments may be delayed by a few days. Please allow additional days in transit for delivery.</li>
                    <li>If there will be a significant delay in shipment of your order, we will contact you via email or telephone.</li>
                </ul>

                <h3 class="text-2xl font-semibold text-kerala-dark mt-8 mb-4">What happens if my order is delayed?</h3>
                <p>If delivery is delayed for any reason we will let you know as soon as possible and will advise you of a revised estimated date for delivery.</p>

                <h3 class="text-2xl font-semibold text-kerala-dark mt-8 mb-4">Contact Us</h3>
                <p>If you have any further questions or comments, you may contact us by:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Email: prakritifoodsekm@gmail.com</li>
                    <li>Phone: +91 85909 31210</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
