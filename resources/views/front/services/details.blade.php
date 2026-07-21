@extends('front.layouts.app')

@section('title', $service->meta_title ?: $service->title)
@section('meta_description', $service->meta_description ?: strip_tags($service->short_description))
@section('content')

    <!-- Hero -->
    <!-- Start Hero Section -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::img($service->banner_image, 'assets/front/img/hero/h2_hero.avif') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>{{ $service->title }}</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('front.services.index') }}">Services</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ $service->title }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Service Details Section -->
    <section class="services container-fluid service overflow-hidden py-5">
        <div class="container pt-5 pb-3">
            <div class="row g-5 align-items-start">
                <div class="col-lg-8">
                    <!-- Service showcased inside a browser frame -->
                    <div class="laptop-mockup service-showcase wow fadeInUp" data-wow-delay="0.1s"
                        style="margin-top:0;">
                        <div class="laptop-screen">
                            <div class="laptop-browser-bar">
                                <span class="dot dot-red"></span>
                                <span class="dot dot-yellow"></span>
                                <span class="dot dot-green"></span>
                                <span class="laptop-url">{{ config('constants.BRAND_NAME') }}/services/{{ $service->slug }}</span>
                            </div>
                            <div class="laptop-screen-glass" style="min-height:0;">
                                <div class="laptop-shine"></div>
                                <img src="{{ \App\Helper::img($service->featured_image) }}" alt="{{ $service->title }}">
                            </div>
                        </div>
                        <div class="laptop-base">
                            <span class="laptop-notch"></span>
                        </div>
                        <div class="laptop-shadow"></div>

                        <div class="service-showcase-icon">
                            <i class="{{ $service->icon ?: 'fas fa-cog' }}"></i>
                        </div>
                        @if ($service->is_featured)
                            <span class="service-showcase-badge"><i class="fas fa-star me-1"></i>Featured Service</span>
                        @endif
                    </div>

                    <div class="service-description mt-5 wow fadeInUp" data-wow-delay="0.15s">
                        {!! $service->description ?: $service->short_description !!}
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="service-sidebar wow fadeInRight" data-wow-delay="0.2s">
                        <div class="service-sidebar-accent"></div>

                        <div class="service-sidebar-icon">
                            <i class="{{ $service->icon ?: 'fas fa-cog' }}"></i>
                        </div>

                        <h4 class="mb-1" style="color:#073965;">{{ $service->title }}</h4>
                        <p class="text-muted small mb-4">Service Overview</p>

                        <div class="service-stat-row">
                            @if ($service->rating)
                                <div class="service-stat">
                                    <div class="service-stat-value">
                                        <i class="fas fa-star" style="color:#ff8a3d;"></i> {{ number_format($service->rating, 1) }}
                                    </div>
                                    <div class="service-stat-label">{{ $service->review_count }} reviews</div>
                                </div>
                            @endif
                            <div class="service-stat">
                                <div class="service-stat-value"><i class="fas fa-eye"></i> {{ $service->views }}</div>
                                <div class="service-stat-label">views</div>
                            </div>
                        </div>

                        @if ($service->technologies->isNotEmpty())
                            <h6 class="mt-4 mb-3" style="color:#073965;">Technologies Used</h6>
                            <div class="d-flex flex-wrap gap-2 mb-2">
                                @foreach ($service->technologies as $tech)
                                    <span class="badge rounded-pill px-3 py-2"
                                        style="background:#fff;color:#073965;border:1px solid #e3e8f0;">{{ $tech->name }}</span>
                                @endforeach
                            </div>
                        @endif

                        <a href="{{ route('front.contact.index') }}" class="btn btn-main w-100 text-center mt-4">Get a
                            Free Quote</a>
                        <a href="tel:{{ config('constants.CONTACT.country_code') }}{{ config('constants.CONTACT.phones.0.number') }}"
                            class="service-sidebar-call mt-3">
                            <i class="fas fa-phone-alt"></i>
                            {{ config('constants.CONTACT.country_code') }}-{{ config('constants.CONTACT.phones.0.number') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Service Details Section -->

    <!-- Start Service Features Section -->
    <section class="services_included container-fluid service overflow-hidden py-5 bg-grey">
        @if ($service->features->isNotEmpty())
                <div class="section-title st-center mt-5">
                    <h3>Service Features</h3>
                    <p>A closer look at everything included with {{ $service->title }} — explore each capability in
                        detail.</p>
                </div>

                <div class="child-service-mockup wow fadeInUp" data-wow-delay="0.1s">
                    <div class="laptop-screen">
                        <div class="laptop-browser-bar">
                            <span class="dot dot-red"></span>
                            <span class="dot dot-yellow"></span>
                            <span class="dot dot-green"></span>
                            <span class="laptop-url">{{ config('constants.BRAND_NAME') }}/services/{{ $service->slug }}#features</span>
                        </div>
                        <div class="laptop-screen-glass" style="min-height:0;">
                            <div class="laptop-shine"></div>
                            <div class="child-services-carousel owl-carousel">
                                @foreach ($service->features as $feature)
                                    <div class="child-service-slide">
                                        <div class="child-service-slide-img">
                                            <img src="{{ \App\Helper::img($feature->image) }}"
                                                alt="{{ $feature->image_alt ?: $feature->title }}">
                                        </div>
                                        <div class="child-service-slide-body">
                                            <span class="child-service-icon"><i
                                                    class="{{ $feature->icon ?: 'fas fa-check' }}"></i></span>
                                            <h4>{{ $feature->title }}
                                                @if ($feature->is_highlighted)
                                                    <span class="badge bg-warning text-dark ms-1">Popular</span>
                                                @endif
                                            </h4>
                                            <p>{{ $feature->short_description }}</p>
                                        </div>
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
            @endif
    </section>
    <!-- End Service Features Section -->

    <!-- Start Problem & Solution Section -->
    <section class="problem-solution-area container-fluid service overflow-hidden py-5">
        <div class="container py-3">
            <div class="section-title st-center">
                <h3>Problem &amp; Solution</h3>
                <p>The real challenges businesses face with {{ $service->title }} — and exactly how we solve them.</p>
            </div>

            <div class="row g-5 align-items-start">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <span class="ps-frame-label ps-frame-label--problem"><i class="fas fa-exclamation-triangle me-2"></i>The
                        Problem</span>
                    <div class="laptop-mockup ps-mockup">
                        <div class="laptop-screen">
                            <div class="laptop-browser-bar">
                                <span class="dot dot-red"></span>
                                <span class="dot dot-yellow"></span>
                                <span class="dot dot-green"></span>
                                <span class="laptop-url">{{ config('constants.BRAND_NAME') }}/problem</span>
                            </div>
                            <div class="laptop-screen-glass" style="min-height:0;">
                                <div class="laptop-shine"></div>
                                <div class="problem-carousel owl-carousel">
                                    @foreach ($problems as $problem)
                                        <div class="ps-slide">
                                            <div class="ps-slide-img">
                                                <img src="{{ \App\Helper::img($problem->image) }}" alt="{{ $problem->title }}">
                                            </div>
                                            <div class="ps-slide-body">
                                                <h5>{{ $problem->title }}</h5>
                                                <p>{{ $problem->description }}</p>
                                            </div>
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

                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                    <span class="ps-frame-label ps-frame-label--solution"><i class="fas fa-check-circle me-2"></i>Our
                        Solution</span>
                    <div class="laptop-mockup ps-mockup">
                        <div class="laptop-screen">
                            <div class="laptop-browser-bar">
                                <span class="dot dot-red"></span>
                                <span class="dot dot-yellow"></span>
                                <span class="dot dot-green"></span>
                                <span class="laptop-url">{{ config('constants.BRAND_NAME') }}/solution</span>
                            </div>
                            <div class="laptop-screen-glass" style="min-height:0;">
                                <div class="laptop-shine"></div>
                                <div class="solution-carousel owl-carousel">
                                    @foreach ($solutions as $solution)
                                        <div class="ps-slide ps-slide--solution">
                                            <div class="ps-slide-icon">
                                                <i class="{{ $solution->icon ?: 'fas fa-check' }}"></i>
                                            </div>
                                            <div class="ps-slide-body">
                                                <h5>{{ $solution->title }}</h5>
                                                <p>{{ $solution->description }}</p>
                                            </div>
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
            </div>
        </div>
    </section>
    <!-- End Problem & Solution Section -->

    <!-- Start Roadmap Section -->
         <section class="roadmap-area section-padding" id="roadmap">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="heading">
                    <h5>Our Development Process</h5>
                    <div class="space-10"></div>
                    <h1>From Vision to Digital Success</h1>
                    <p class="mt-3">
                        At {{ config('constants.BUSINESS.name') }}, every successful project follows a proven development process.
                        We combine strategic planning, creative design, modern technologies, and continuous
                        support to deliver secure, scalable, and high-performing digital solutions that
                        help businesses grow with confidence.
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
                    <span class="laptop-url">{{ config('constants.BRAND_NAME') }}/process</span>
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
    <!-- End Roadmap Section -->

 <!-- Testimonials -->
    <!-- Start Testimonials Section -->
    <section class="testimonials">

        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        <h3>Industries</h3>
                        <p>Avocent deditum long</p>
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

                            <!-- Testimonial 1 -->
                            <div class="testimonial">
                                <div class="testimonial-img">
                                    <img src="{{ asset('assets/front/img/testimonial/Homepage_testi.avif') }}"
                                        alt="John Anderson">
                                </div>
                                <blockquote>
                                    <p>
                                        Their team delivered our website ahead of schedule with
                                        exceptional quality. Communication was excellent and
                                        the final product exceeded our expectations.
                                    </p>
                                    <footer>
                                        <strong>John Anderson</strong><br>
                                        <cite>CEO, Tech Solutions</cite>
                                    </footer>
                                </blockquote>
                            </div>

                            <!-- Testimonial 2 -->
                            <div class="testimonial">
                                <div class="testimonial-img">
                                    <img src="{{ asset('assets/front/img/testimonial/1.avif') }}" alt="Sarah Williams">
                                </div>
                                <blockquote>
                                    <p>
                                        Professional developers with deep technical knowledge.
                                        They successfully developed our ERP system and continue
                                        to provide outstanding support.
                                    </p>
                                    <footer>
                                        <strong>Sarah Williams</strong><br>
                                        <cite>Operations Manager</cite>
                                    </footer>
                                </blockquote>
                            </div>

                            <!-- Testimonial 3 -->
                            <div class="testimonial">
                                <div class="testimonial-img">
                                    <img src="{{ asset('assets/front/img/testimonial/Homepage_testi.avif') }}"
                                        alt="Michael Brown">
                                </div>
                                <blockquote>
                                    <p>
                                        We highly recommend them for custom software development.
                                        Our online sales increased significantly after launching
                                        the new platform.
                                    </p>
                                    <footer>
                                        <strong>Michael Brown</strong><br>
                                        <cite>Founder, Ecommerce Hub</cite>
                                    </footer>
                                </blockquote>
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
    <!-- End Testimonials Section -->



    <!-- CTA -->
    <!-- Start CTA Section -->
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
                            {{ config('constants.BUSINESS.name') }} delivers custom websites, business software, eCommerce platforms, and innovative
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

    <!-- Start FAQ & Contact Section -->
    <section id="faq-section" class="faq-section">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        <h3>Industries</h3>
                        <p>Avocent deditum long</p>
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

                                    <div class="faq-item">
                                        <div class="faq-title">
                                            <h5>How long does a website or software project take?</h5>
                                            <span class="faq-icon">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                        </div>

                                        <div class="faq-content">
                                            <p>
                                                Project timelines depend on complexity. A business website
                                                generally takes 2–4 weeks, while custom software or enterprise
                                                applications may take several weeks to a few months.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <div class="faq-title">
                                            <h5>Do you provide website redesign services?</h5>
                                            <span class="faq-icon">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                        </div>

                                        <div class="faq-content">
                                            <p>
                                                Yes. We redesign outdated websites with a modern UI,
                                                better performance, improved SEO, enhanced security,
                                                and a fully responsive design.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <div class="faq-title">
                                            <h5>Which technologies do you specialize in?</h5>
                                            <span class="faq-icon">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                        </div>

                                        <div class="faq-content">
                                            <p>
                                                We work with Laravel, PHP, React, Node.js, Java, Spring Boot,
                                                MySQL, PostgreSQL, WordPress, Shopify, REST APIs,
                                                AWS, Azure and modern frontend technologies.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <div class="faq-title">
                                            <h5>Will my website be mobile-friendly?</h5>
                                            <span class="faq-icon">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                        </div>

                                        <div class="faq-content">
                                            <p>
                                                Absolutely. Every website we build is fully responsive
                                                and optimized for desktops, tablets and smartphones.
                                            </p>
                                        </div>
                                    </div>

                                    <div class="faq-item">
                                        <div class="faq-title">
                                            <h5>Do you provide maintenance after project delivery?</h5>
                                            <span class="faq-icon">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                        </div>

                                        <div class="faq-content">
                                            <p>
                                                Yes. We provide maintenance, security updates,
                                                bug fixes, performance optimization and technical
                                                support after deployment.
                                            </p>
                                        </div>
                                    </div>

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

                                 @include('front.common.contact-form')
                            </div>
                            <div class="tablet-home-btn"></div>
                        </div>
                        <div class="tablet-shadow"></div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- End FAQ & Contact Section -->

@endsection
