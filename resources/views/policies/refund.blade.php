@extends('layouts.app')

@section('content')
<div class="bg-kerala-earth pt-32 pb-24">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="bg-white rounded-3xl p-10 md:p-16 shadow-sm border border-gray-100">
            <h1 class="text-4xl font-heading font-bold text-kerala-dark mb-8">Cancellation & Refund Policy</h1>
            <p class="text-sm text-gray-500 mb-8">Last updated: {{ date('F j, Y') }}</p>

            <div class="prose prose-lg text-gray-600 max-w-none">
                <p>Thank you for shopping at Prakriti Kerala.</p>
                <p>If, for any reason, You are not completely satisfied with a purchase We invite You to review our policy on refunds and returns.</p>

                <h3 class="text-2xl font-semibold text-kerala-dark mt-8 mb-4">Order Cancellation Rights</h3>
                <p>You are entitled to cancel Your Order within 24 hours without giving any reason for doing so.</p>
                <p>The deadline for cancelling an Order is 24 hours from the time you placed the order, provided the order has not already been dispatched.</p>
                <p>In order to exercise Your right of cancellation, You must inform Us of your decision by means of a clear statement. You can inform us of your decision by:</p>
                <ul class="list-disc pl-6 space-y-2 mb-6">
                    <li>By email: prakritifoodsekm@gmail.com</li>
                    <li>By phone number: +91 85909 31210</li>
                </ul>
                <p>We will reimburse You no later than 14 days from the day on which We receive your cancellation request. We will use the same means of payment as You used for the Order, and You will not incur any fees for such reimbursement.</p>

                <h3 class="text-2xl font-semibold text-kerala-dark mt-8 mb-4">Conditions for Returns</h3>
                <p>In order for the Goods to be eligible for a return, please make sure that:</p>
                <ul class="list-disc pl-6 space-y-2 mb-6">
                    <li>The Goods were purchased in the last 7 days</li>
                    <li>The Goods are in the original packaging</li>
                    <li>The Goods have not been opened or used (due to hygiene and safety reasons for food products)</li>
                </ul>
                <p>The following Goods cannot be returned:</p>
                <ul class="list-disc pl-6 space-y-2 mb-6">
                    <li>The supply of Goods made to Your specifications or clearly personalized.</li>
                    <li>The supply of Goods which according to their nature are not suitable to be returned, deteriorate rapidly or where the date of expiry is over.</li>
                </ul>

                <h3 class="text-2xl font-semibold text-kerala-dark mt-8 mb-4">Returning Goods</h3>
                <p>You are responsible for the cost and risk of returning the Goods to Us. You should send the Goods at the following address:</p>
                <address class="not-italic pl-6 border-l-4 border-kerala-spice my-4 text-gray-700">
                    Thachavallath house,<br>
                    Elookkara, Muppathadam PO,<br>
                    Aluva, Ernakulam,<br>
                    Keralam, Pin- 683110
                </address>

                <h3 class="text-2xl font-semibold text-kerala-dark mt-8 mb-4">Contact Us</h3>
                <p>If you have any questions about our Returns and Refunds Policy, please contact us:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>By email: prakritifoodsekm@gmail.com</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
