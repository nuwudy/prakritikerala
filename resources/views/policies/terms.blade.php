@extends('layouts.app')

@section('content')
<div class="bg-kerala-earth pt-32 pb-24">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="bg-white rounded-3xl p-10 md:p-16 shadow-sm border border-gray-100">
            <h1 class="text-4xl font-heading font-bold text-kerala-dark mb-8">Terms & Conditions</h1>
            <p class="text-sm text-gray-500 mb-8">Last updated: {{ date('F j, Y') }}</p>

            <div class="prose prose-lg text-gray-600 max-w-none">
                <p>Please read these terms and conditions carefully before using Our Service.</p>

                <h3 class="text-2xl font-semibold text-kerala-dark mt-8 mb-4">Interpretation and Definitions</h3>
                <h4 class="text-xl font-semibold text-kerala-dark mt-6 mb-3">Interpretation</h4>
                <p>The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>

                <h4 class="text-xl font-semibold text-kerala-dark mt-6 mb-3">Definitions</h4>
                <p>For the purposes of these Terms and Conditions:</p>
                <ul class="list-disc pl-6 space-y-2 mb-6">
                    <li><strong>Company</strong> (referred to as either "the Company", "We", "Us" or "Our" in this Agreement) refers to Prakriti Kerala.</li>
                    <li><strong>Country</strong> refers to: India</li>
                    <li><strong>Device</strong> means any device that can access the Service such as a computer, a cellphone or a digital tablet.</li>
                    <li><strong>Service</strong> refers to the Website.</li>
                    <li><strong>Website</strong> refers to Prakriti Kerala, accessible from http://prakritikerala.com</li>
                    <li><strong>You</strong> means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</li>
                </ul>

                <h3 class="text-2xl font-semibold text-kerala-dark mt-8 mb-4">Acknowledgment</h3>
                <p>These are the Terms and Conditions governing the use of this Service and the agreement that operates between You and the Company. These Terms and Conditions set out the rights and obligations of all users regarding the use of the Service.</p>
                <p>Your access to and use of the Service is conditioned on Your acceptance of and compliance with these Terms and Conditions. These Terms and Conditions apply to all visitors, users and others who access or use the Service.</p>

                <h3 class="text-2xl font-semibold text-kerala-dark mt-8 mb-4">User Accounts</h3>
                <p>When You create an account with Us, You must provide Us information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of Your account on Our Service.</p>

                <h3 class="text-2xl font-semibold text-kerala-dark mt-8 mb-4">Contact Us</h3>
                <p>If you have any questions about these Terms and Conditions, You can contact us:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>By email: prakritifoodsekm@gmail.com</li>
                    <li>By visiting this page on our website: <a href="{{ route('contact') }}" class="text-kerala-spice hover:underline">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
