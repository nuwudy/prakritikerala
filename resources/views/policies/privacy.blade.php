@extends('layouts.app')

@section('content')
<div class="bg-kerala-earth pt-32 pb-24">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="bg-white rounded-3xl p-10 md:p-16 shadow-sm border border-gray-100">
            <h1 class="text-4xl font-heading font-bold text-kerala-dark mb-8">Privacy Policy</h1>
            <p class="text-sm text-gray-500 mb-8">Last updated: {{ date('F j, Y') }}</p>

            <div class="prose prose-lg text-gray-600 max-w-none">
                <p>This Privacy Policy describes Our policies and procedures on the collection, use and disclosure of Your information when You use the Service and tells You about Your privacy rights and how the law protects You.</p>
                <p>We use Your Personal data to provide and improve the Service. By using the Service, You agree to the collection and use of information in accordance with this Privacy Policy.</p>

                <h3 class="text-2xl font-semibold text-kerala-dark mt-8 mb-4">Types of Data Collected</h3>
                <h4 class="text-xl font-semibold text-kerala-dark mt-6 mb-3">Personal Data</h4>
                <p>While using Our Service, We may ask You to provide Us with certain personally identifiable information that can be used to contact or identify You. Personally identifiable information may include, but is not limited to:</p>
                <ul class="list-disc pl-6 space-y-2 mb-6">
                    <li>Email address</li>
                    <li>First name and last name</li>
                    <li>Phone number</li>
                    <li>Address, State, Province, ZIP/Postal code, City</li>
                    <li>Usage Data</li>
                </ul>

                <h3 class="text-2xl font-semibold text-kerala-dark mt-8 mb-4">Use of Your Personal Data</h3>
                <p>The Company may use Personal Data for the following purposes:</p>
                <ul class="list-disc pl-6 space-y-2 mb-6">
                    <li><strong>To provide and maintain our Service</strong>, including to monitor the usage of our Service.</li>
                    <li><strong>To manage Your Account:</strong> to manage Your registration as a user of the Service.</li>
                    <li><strong>For the performance of a contract:</strong> the development, compliance and undertaking of the purchase contract for the products, items or services You have purchased or of any other contract with Us through the Service.</li>
                    <li><strong>To contact You:</strong> To contact You by email, telephone calls, SMS, or other equivalent forms of electronic communication.</li>
                </ul>

                <h3 class="text-2xl font-semibold text-kerala-dark mt-8 mb-4">Security of Your Personal Data</h3>
                <p>The security of Your Personal Data is important to Us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While We strive to use commercially acceptable means to protect Your Personal Data, We cannot guarantee its absolute security.</p>

                <h3 class="text-2xl font-semibold text-kerala-dark mt-8 mb-4">Contact Us</h3>
                <p>If you have any questions about this Privacy Policy, You can contact us:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>By email: prakritifoodsekm@gmail.com</li>
                    <li>By visiting this page on our website: <a href="{{ route('contact') }}" class="text-kerala-spice hover:underline">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
