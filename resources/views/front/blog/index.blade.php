@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.blog.title'))
@section('meta_description', config('constants.PAGE_SEO.blog.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.blog.meta_keywords'))
@section('content')

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('blog.png', 'assets/front/img/hero/h2_hero.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Our Blog</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Blog</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Insights & Ideas Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="section-title st-center">
                <h3>{{ \App\Helper::sectionTitle('blog', 'listing', 'title', 'Insights & Ideas') }}</h3>
                <p>{{ \App\Helper::sectionTitle('blog', 'listing', 'subtitle') }}</p>
            </div>

            @if ($blogs->isEmpty())
                <p class="text-center text-muted">Blog posts will be listed here shortly.</p>
            @else
                <div class="row g-4">
                    @foreach ($blogs as $blog)
                        <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="office-item h-100">
                                <div class="office-img">
                                    <img src="{{ !empty($blog->featured_image) && \Illuminate\Support\Facades\Storage::disk('public')->exists($blog->featured_image) ? asset('storage/' . $blog->featured_image) : asset('assets/front/img/default-img.png') }}"
                                        alt="{{ $blog->title }}">
                                    <div class="office-icon"><i class="fas fa-pen-nib"></i></div>
                                </div>
                                <div class="office-content">
                                    <div class="content-card-meta">
                                        @if ($blog->category)
                                            <span>{{ $blog->category->name }}</span>
                                        @endif
                                        <span><i class="far fa-clock me-1"></i>{{ $blog->reading_time }} min read</span>
                                    </div>
                                    <h4>
                                        <a href="{{ route('front.blog.details', $blog->slug) }}" class="text-decoration-none"
                                            style="color:inherit;">{{ $blog->title }}</a>
                                    </h4>
                                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($blog->excerpt), 90) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    <!-- End Insights & Ideas Section -->

<!-- Start Our Development Process Section -->
<section class="roadmap-area section-padding" id="roadmap">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="heading">
                        <h5>Our Development Process</h5>
                        <div class="space-10"></div>
                        <h1>{{ \App\Helper::sectionTitle('blog', 'roadmap', 'title', 'From Vision to Digital Success') }}</h1>
                        <p class="mt-3">
                            {{ \App\Helper::sectionTitle('blog', 'roadmap', 'subtitle') }}
                        </p>
                    </div>
                    <div class="space-60 d-none d-sm-block"></div>
                </div>
            </div>

            <div class="process-flow">

                <!-- Step 1 -->
                <div class="process-step wow fadeInLeft" data-wow-delay="0.1s" data-slide-target="0">
                    <div class="process-chevron process-chevron--1">
                        <span class="process-num">01</span>
                        <span class="process-icon"><i class="fas fa-search"></i></span>
                        <span class="process-title">Discovery</span>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="process-step wow fadeInLeft" data-wow-delay="0.3s" data-slide-target="1">
                    <div class="process-chevron process-chevron--2">
                        <span class="process-num">02</span>
                        <span class="process-icon"><i class="fas fa-paint-brush"></i></span>
                        <span class="process-title">Planning</span>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="process-step wow fadeInLeft" data-wow-delay="0.5s" data-slide-target="2">
                    <div class="process-chevron process-chevron--3">
                        <span class="process-num">03</span>
                        <span class="process-icon"><i class="fas fa-code"></i></span>
                        <span class="process-title">Development</span>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="process-step wow fadeInLeft" data-wow-delay="0.7s" data-slide-target="3">
                    <div class="process-chevron process-chevron--4">
                        <span class="process-num">04</span>
                        <span class="process-icon"><i class="fas fa-rocket"></i></span>
                        <span class="process-title">Launch</span>
                    </div>
                </div>

            </div>

            <!-- Laptop-frame slider showing each step's detail -->
            <div class="laptop-mockup wow fadeInUp" data-wow-delay="0.2s">
                <div class="laptop-screen">
                    <div class="laptop-browser-bar">
                        <span class="dot dot-red"></span>
                        <span class="dot dot-yellow"></span>
                        <span class="dot dot-green"></span>
                        <span class="laptop-url">deovate.world/process</span>
                    </div>
                    <div class="laptop-screen-glass">
                        <div class="laptop-shine"></div>
                        <div class="laptop-slides owl-carousel">

                            <div class="laptop-slide">
                                <span class="process-num">01</span>
                                <span class="process-icon"><i class="fas fa-search"></i></span>
                                <h5>Project Discovery & Consultation</h5>
                                <p>
                                    We begin by understanding your business objectives, target audience, and project
                                    requirements. Through detailed consultation and market research, we create a clear
                                    strategy that aligns technology with your long-term business goals.
                                </p>
                            </div>

                            <div class="laptop-slide">
                                <span class="process-num">02</span>
                                <span class="process-icon"><i class="fas fa-paint-brush"></i></span>
                                <h5>Planning & UI/UX Design</h5>
                                <p>
                                    Our designers and solution architects create intuitive user experiences,
                                    interactive prototypes, and scalable system architecture that provide
                                    the perfect foundation for successful digital products.
                                </p>
                            </div>

                            <div class="laptop-slide">
                                <span class="process-num">03</span>
                                <span class="process-icon"><i class="fas fa-code"></i></span>
                                <h5>Development & Quality Assurance</h5>
                                <p>
                                    Using modern technologies and clean coding standards, our developers build
                                    secure, responsive, and scalable solutions. Every feature is thoroughly tested
                                    to ensure performance, reliability, and security before launch.
                                </p>
                            </div>

                            <div class="laptop-slide">
                                <span class="process-num">04</span>
                                <span class="process-icon"><i class="fas fa-rocket"></i></span>
                                <h5>Launch, Growth & Continuous Support</h5>
                                <p>
                                    After successful deployment, we continue supporting your business with
                                    maintenance, performance optimization, security updates, feature
                                    enhancements, and technical assistance to ensure sustainable digital
                                    growth.
                                </p>
                            </div>

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
    <!-- End Our Development Process Section -->

    <!-- Start Testimonials Section -->
    <!-- Testimonials -->
    <section class="testimonials">

        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        <h3>{{ \App\Helper::sectionTitle('blog', 'testimonials', 'title', 'What Our Clients Say') }}</h3>
                        <p>{{ \App\Helper::sectionTitle('blog', 'testimonials', 'subtitle') }}</p>
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
    <!-- End Testimonials Section -->



    <!-- Start CTA Section -->
    <!-- CTA -->
    <section class="call-2-acction" data-stellar-background-ratio="0.4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-title st-center">
                        <h3>LET'S BUILD SOMETHING EXCEPTIONAL</h3>

                        <p>
                            Transform Your Vision into Powerful Digital Solutions
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
                        <h3>{{ \App\Helper::sectionTitle('blog', 'faq', 'title', 'Frequently Asked Questions') }}</h3>
                        <p>{{ \App\Helper::sectionTitle('blog', 'faq', 'subtitle') }}</p>
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
