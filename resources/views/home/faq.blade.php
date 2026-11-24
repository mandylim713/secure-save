@extends('layouts.base')

@inject('content', 'App\Http\Controllers\FrontController')
@section('title', 'Frequently Asked Questions')

@section('content')

<div class="content-wrapper">
    <div class="breadcrumb-wrap bg-f br-1" style="margin-top:-140px;">
        <div class="container">
            <div class="breadcrumb-title">
                <br><br>
                <h2>Frequently Asked Questions</h2>
                <ul class="breadcrumb-menu list-style">
                    <li><a href="/">Home</a></li>
                    <li>FAQ</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="faq-wrap pt-100 pb-75">
        <div class="container">
            <div class="row gx-5">
                <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1">
                    <div class="section-title style1 text-center mb-40">
                        <span>FAQ</span>
                        <h2>Frequently Asked Questions</h2>
                        <p>Everything you need to know about our mortgage solutions, personal banking, and secure digital services.</p>
                    </div>

                    <div class="accordion" id="faqAccordion">
                        <!-- Category: About Us & Lending -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What is {{ $settings->site_name }}?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    {{ $settings->site_name }} is a dedicated financial institution providing comprehensive home lending, personal and business banking, and modern digital finance services. Our goal is to innovate, simplify, and humanize lending and banking for individuals and families.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    What types of mortgage loans do you offer?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We offer a comprehensive selection of mortgage products including Fixed-Rate Mortgages, Adjustable-Rate Mortgages (ARM), Home Refinancing, FHA Loans, VA Loans, and Jumbo Loans. Our loan specialists work closely with you to find the structure that best fits your financial situation.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    How do I apply for a mortgage or personal loan?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Applying is quick and completely paperless through our online portal. Simply register or sign in to your {{ $settings->site_name }} account, navigate to the Loans section, and submit your application with required documentation. Our underwriting team reviews applications promptly.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    How secure is my online account and financial data?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Your security is our highest priority. We use bank-grade 256-bit SSL encryption, multi-factor authentication (2FA), automated intrusion detection, and strict compliance controls to ensure your funds and personal information remain completely protected.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Are there any hidden fees or unexpected charges?
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    No. We adhere to clear, transparent pricing policies. All mortgage loan terms, annual percentage rates (APR), closing fees, and account maintenance schedules are provided upfront in full detail with zero hidden charges.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    How do electronic wire and domestic transfers work?
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Our digital banking platform allows you to perform domestic ACH transfers, instant internal transfers, and international wire transfers directly from your dashboard with real-time tracking and transaction history confirmation.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    How can I contact customer support?
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can contact our support team 24/7 via email at <a href="mailto:{{ $settings->contact_email }}">{{ $settings->contact_email }}</a>, or by submitting an inquiry directly through our <a href="/contact">Support Center</a>.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
