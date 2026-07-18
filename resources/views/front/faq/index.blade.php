@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.faq.title'))
@section('meta_description', config('constants.PAGE_SEO.faq.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.faq.meta_keywords'))
@section('content')

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('faq.png', 'assets/front/img/hero/h2_hero.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Frequently Asked Questions</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">FAQ</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Client Testimonials Section -->
   <!-- Testimonials -->
    @php
        $faqTestimonialsSection = $page?->sections->firstWhere('slug', 'testimonials-section');
        $faqTestimonialsContent = $faqTestimonialsSection ? $sectionContents[$faqTestimonialsSection->id] ?? [] : [];
    @endphp
    @if ($testimonials->isNotEmpty())
    <section class="testimonials">

        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        @include('front.partials._section_heading', [
                            'content' => $faqTestimonialsContent,
                            'defaultTitle' => \App\Helper::sectionTitle('faq', 'testimonials', 'title', 'What Our Clients Say'),
                            'defaultSubtitle' => \App\Helper::sectionTitle('faq', 'testimonials', 'subtitle'),
                        ])
                    </div>
                </div>
            </div>

            <div class="testi-mockup wow fadeInUp" data-wow-delay="0.1s">
                <div class="laptop-screen">
                    <div class="laptop-browser-bar">
                        <span class="dot dot-red"></span>
                        <span class="dot dot-yellow"></span>
                        <span class="dot dot-green"></span>
                        <span class="laptop-url">{{ config('constants.BRAND_NAME') }}/reviews</span>
                    </div>
                    <div class="laptop-screen-glass testi-glass">
                        <div class="laptop-shine"></div>
                        <div class="testimonials-carousel owl-carousel owl-theme">

                            @foreach ($testimonials as $testimonial)
                                <div class="testimonial">
                                    <div class="testimonial-img">
                                        <img src="{{ \App\Helper::img($testimonial->photo) }}" alt="{{ $testimonial->name }}">
                                    </div>
                                    <blockquote>
                                        <p>
                                            {{ $testimonial->message }}
                                        </p>
                                        <footer>
                                            <strong>{{ $testimonial->name }}</strong><br>
                                            <cite>{{ $testimonial->designation }}{{ $testimonial->company ? ', ' . $testimonial->company : '' }}</cite>
                                        </footer>
                                    </blockquote>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="laptop-base">
                    <span class="laptop-notch"></span>
                </div>
                <div class="laptop-shadow"></div>
            </div>

        </div>

    </section>
    @endif
    <!-- End Client Testimonials Section -->



    <!-- Start CTA Section -->
    <!-- CTA -->
    @php
        $faqCtaSection = $page?->sections->firstWhere('slug', 'cta-section');
        $faqCtaContent = $faqCtaSection ? $sectionContents[$faqCtaSection->id] ?? [] : [];
    @endphp
    <section class="call-2-acction" data-stellar-background-ratio="0.4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-title st-center">
                        @include('front.partials._section_heading', [
                            'content' => $faqCtaContent,
                            'defaultTitle' => \App\Helper::sectionTitle('faq', 'cta', 'title', "LET'S BUILD SOMETHING EXCEPTIONAL"),
                            'defaultSubtitle' => \App\Helper::sectionTitle('faq', 'cta', 'subtitle'),
                        ])
                    </div>

                    <div class="c2a">

                        <p>
                            @if (!empty($faqCtaContent['cta_paragraph']))
                                {!! $faqCtaContent['cta_paragraph'] !!}
                            @else
                                Whether you're launching a startup, modernizing your business, or scaling your digital presence,
                                {{ config('constants.BUSINESS.name') }} delivers custom websites, business software, eCommerce platforms, and innovative
                                technology solutions tailored to your goals. Partner with our experienced team to build secure,
                                scalable, and high-performing digital products that create lasting business value.
                            @endif
                        </p>

                        <a href="{{ $faqCtaContent['btn_links'] ?? route('front.contact.index') }}" class="btn btn-main btn-lg">
                            {{ $faqCtaContent['btn_text'] ?? 'Start Your Project' }}
                        </a>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End CTA Section -->

    <!-- Start FAQ Section -->
    @php
        $faqFaqSection = $page?->sections->firstWhere('slug', 'faq-section');
        $faqFaqContent = $faqFaqSection ? $sectionContents[$faqFaqSection->id] ?? [] : [];
    @endphp
    <section id="faq-section" class="faq-section">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        @include('front.partials._section_heading', [
                            'content' => $faqFaqContent,
                            'defaultTitle' => \App\Helper::sectionTitle('faq', 'faq', 'title', 'Frequently Asked Questions'),
                            'defaultSubtitle' => \App\Helper::sectionTitle('faq', 'faq', 'subtitle'),
                        ])
                    </div>
                </div>
            </div>

            <div class="faq-contact-grid">

                <!-- LEFT: FAQ app tablet -->
                <div class="faq-tablet-col wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="app-tablet">
                        <div class="tablet-frame app-tablet-frame">
                            <div class="tablet-cam"></div>
                            <div class="tablet-screen app-tablet-screen">
                                <div class="tablet-statusbar">
                                    <span class="phone-brand">{{ config('constants.BRAND_NAME') }}</span>
                                </div>

                                <div class="app-screen-header">
                                    <h4>FAQs</h4>
                                    <p>Quick answers to common questions</p>
                                </div>

                                <div class="faq-wrapper app-faq-list">

                                    @forelse ($category->activeFaqs ?? [] as $faq)
                                        <div class="faq-item @if ($loop->first) active @endif">
                                            <div class="faq-title">
                                                <h5>{{ $faq->question }}</h5>
                                                <span class="faq-icon">
                                                    <i class="fa fa-{{ $loop->first ? 'minus' : 'plus' }}"></i>
                                                </span>
                                            </div>

                                            <div class="faq-content" @if ($loop->first) style="display:block;" @endif>
                                                <p>
                                                    {{ $faq->answer }}
                                                </p>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="faq-item active">
                                            <div class="faq-title">
                                                <h5>What services does your company provide?</h5>
                                                <span class="faq-icon">
                                                    <i class="fa fa-minus"></i>
                                                </span>
                                            </div>

                                            <div class="faq-content" style="display:block;">
                                                <p>
                                                    We provide website development, custom software development,
                                                    eCommerce solutions, mobile applications, UI/UX design,
                                                    cloud solutions, API integration, ERP/CRM systems, and
                                                    ongoing maintenance & support.
                                                </p>
                                            </div>
                                        </div>
                                    @endforelse

                                </div>
                            </div>
                            <div class="tablet-home-btn"></div>
                        </div>
                        <div class="tablet-shadow"></div>
                    </div>
                </div>

                <!-- RIGHT: Contact form tablet -->
                <div class="contact-tablet-col wow fadeInRight" data-wow-delay="0.2s">
                    <div class="app-tablet">
                        <div class="tablet-frame app-tablet-frame">
                            <div class="tablet-cam"></div>
                            <div class="tablet-screen app-tablet-screen">
                                <div class="tablet-statusbar">
                                    <span class="phone-brand">{{ config('constants.BRAND_NAME') }}</span>
                                </div>

                                <div class="app-screen-header">
                                    <h4>Get In Touch</h4>
                                    <p>We'd love to hear about your project</p>
                                </div>

                                <form id="homeContactForm" class="app-contact-form" novalidate>

                                    <div class="app-form-group">
                                        <label for="hc-name">Full Name</label>
                                        <input type="text" id="hc-name" name="name" required
                                            placeholder="John Doe">
                                        <span class="app-form-error">Please enter your name.</span>
                                    </div>

                                    <div class="app-form-group">
                                        <label for="hc-email">Email Address</label>
                                        <input type="email" id="hc-email" name="email" required
                                            placeholder="john@example.com">
                                        <span class="app-form-error">Please enter a valid email.</span>
                                    </div>

                                    <div class="app-form-group">
                                        <label for="hc-phone">Phone Number</label>
                                        <input type="tel" id="hc-phone" name="phone"
                                            placeholder="+91 12345 67890">
                                        <span class="app-form-error">Please enter a valid phone number.</span>
                                    </div>

                                    <div class="app-form-group">
                                        <label for="hc-message">Message</label>
                                        <textarea id="hc-message" name="message" rows="4" required placeholder="Tell us about your project..."></textarea>
                                        <span class="app-form-error">Please enter a message.</span>
                                    </div>

                                    <button type="submit" class="app-form-submit">
                                        <span class="app-form-submit-text">Send Message</span>
                                        <span class="app-form-submit-loader"></span>
                                    </button>

                                    <div class="app-form-success">
                                        <i class="fa fa-check-circle"></i>
                                        <p>Thanks! Your message has been noted.</p>
                                    </div>

                                </form>
                            </div>
                            <div class="tablet-home-btn"></div>
                        </div>
                        <div class="tablet-shadow"></div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- End FAQ Section -->


@endsection
