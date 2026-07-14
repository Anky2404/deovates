@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.testimonials.title'))
@section('meta_description', config('constants.PAGE_SEO.testimonials.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.testimonials.meta_keywords'))
@section('content')

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('testimonials.png', 'assets/front/img/hero/h2_hero.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Client Testimonials</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Testimonials</li>
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
    <section class="testimonials">

        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        <h3>{{ \App\Helper::sectionTitle('testimonials', 'listing', 'title', 'What Our Clients Say') }}</h3>
                        <p>{{ \App\Helper::sectionTitle('testimonials', 'listing', 'subtitle') }}</p>
                    </div>
                </div>
            </div>

            <div class="testi-mockup wow fadeInUp" data-wow-delay="0.1s">
                <div class="laptop-screen">
                    <div class="laptop-browser-bar">
                        <span class="dot dot-red"></span>
                        <span class="dot dot-yellow"></span>
                        <span class="dot dot-green"></span>
                        <span class="laptop-url">deovate.world/reviews</span>
                    </div>
                    <div class="laptop-screen-glass testi-glass">
                        <div class="laptop-shine"></div>
                        <div class="testimonials-carousel owl-carousel owl-theme">

                            @forelse ($testimonials as $testimonial)
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
                            @empty
                                <p class="text-center text-muted">Client testimonials will be shown here shortly.</p>
                            @endforelse

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
    <!-- End Client Testimonials Section -->



    <!-- Start CTA Section -->
    <!-- CTA -->
    <section class="call-2-acction" data-stellar-background-ratio="0.4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-title st-center">
                        <h3>{{ \App\Helper::sectionTitle('testimonials', 'cta', 'title', "LET'S BUILD SOMETHING EXCEPTIONAL") }}</h3>

                        <p>
                            {{ \App\Helper::sectionTitle('testimonials', 'cta', 'subtitle') }}
                        </p>
                    </div>

                    <div class="c2a">

                        <p>
                            Whether you're launching a startup, modernizing your business, or scaling your digital presence,
                            Deovate World delivers custom websites, business software, eCommerce platforms, and innovative
                            technology solutions tailored to your goals. Partner with our experienced team to build secure,
                            scalable, and high-performing digital products that create lasting business value.
                        </p>

                        <a href="{{ route('front.contact.index') }}" class="btn btn-main btn-lg">
                            Start Your Project
                        </a>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End CTA Section -->

    <!-- Start FAQ Section -->
    <section id="faq-section" class="faq-section">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        <h3>{{ \App\Helper::sectionTitle('testimonials', 'faq', 'title', 'Frequently Asked Questions') }}</h3>
                        <p>{{ \App\Helper::sectionTitle('testimonials', 'faq', 'subtitle') }}</p>
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
                                    <span class="phone-brand">Deovate</span>
                                </div>

                                <div class="app-screen-header">
                                    <h4>FAQs</h4>
                                    <p>Quick answers to common questions</p>
                                </div>

                                <div class="faq-wrapper app-faq-list">

                                    @forelse ($category->faqs ?? [] as $faq)
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
                                        <p class="text-center text-muted">FAQs will be listed here shortly.</p>
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
                                    <span class="phone-brand">Deovate</span>
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
