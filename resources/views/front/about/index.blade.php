@extends('front.layouts.app')

@section('title', $data['page_header']['meta_title'] ?? $data['page_header']['title'] ?? config('constants.PAGE_SEO.about.title'))
@section('meta_description', $data['page_header']['meta_description'] ?? config('constants.PAGE_SEO.about.meta_description'))
@section('meta_keywords', $data['page_header']['meta_keywords'] ?? config('constants.PAGE_SEO.about.meta_keywords'))
@section('content')

    @php
        $iconMap = [
            'icon-lightbulb' => 'fas fa-lightbulb',
            'icon-target' => 'fas fa-bullseye',
            'icon-shield' => 'fas fa-shield-alt',
            'icon-trophy' => 'fas fa-trophy',
            'icon-profile-male' => 'fas fa-user',
            'icon-clipboard' => 'fas fa-clipboard-list',
            'icon-speedometer' => 'fas fa-tachometer-alt',
            'icon-globe' => 'fas fa-globe',
            'icon-heart' => 'fas fa-heart',
            'icon-lock' => 'fas fa-lock',
            'icon-briefcase' => 'fas fa-briefcase',
            'icon-presentation' => 'fas fa-chalkboard-teacher',
            'icon-refresh' => 'fas fa-sync-alt',
            'icon-clock' => 'fas fa-clock',
            'icon-flag' => 'fas fa-flag',
            'icon-wallet' => 'fas fa-wallet',
            'icon-linegraph' => 'fas fa-chart-line',
            'icon-camera' => 'fas fa-camera',
            'icon-map-pin' => 'fas fa-map-marker-alt',
            'icon-bike' => 'fas fa-biking',
            'icon-tools' => 'fas fa-tools',
            'icon-gears' => 'fas fa-cogs',
        ];
        $icon = fn($key) => $iconMap[$key] ?? 'fas fa-star';
    @endphp

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('about.png', 'assets/front/img/hero/about.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>{{ $data['page_header']['title'] ?? 'About Us' }}</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">About</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Who We Are Section -->
    <!-- Who We Are -->
    <section class="py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="position-relative" style="max-width:470px;">
                        <img src="{{ asset('assets/front/img/about.png') }}" class="about-img" alt="Inside {{ config('constants.BUSINESS.name') }}">

                        @php($stat = $data['growth_numbers']['items'][0] ?? null)
                        @if ($stat)
                            <div class="d-flex align-items-center gap-3 p-3 rounded-4"
                                style="position:absolute; left:-24px; bottom:-24px; background:#fff; box-shadow:0 18px 40px rgba(11,28,57,.18); max-width:260px;">
                                <div class="simple-process-number flex-shrink-0"
                                    style="width:54px;height:54px;font-size:18px;margin:0;">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <div>
                                    <div class="h4 mb-0" style="color:#f85603;font-weight:700;">{{ $stat['count'] }}+</div>
                                    <div class="small text-muted">{{ $stat['label'] }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="section-title st-start">
                        <h3>{{ $data['who_we_are']['title'] }}</h3>
                        <p>{{ $data['who_we_are']['subtitle'] }}</p>
                    </div>
                    <div class="fs-6">{!! $data['who_we_are']['description'] !!}</div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Who We Are Section -->

    <!-- Start Vision & Mission Section -->
    <!-- Vision & Mission -->
    <section class="vm-area py-5" style="background-image:url('{{ asset('assets/front/img/funfact.png') }}');">
        <div class="vm-overlay"></div>
        <div class="container py-5 position-relative">
            <div class="section-title st-center st-light">
                <h3>{{ $data['vision_mission']['title'] }}</h3>
                <p>{{ $data['vision_mission']['subtitle']['subtitle'] }}</p>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach (['vision', 'mission'] as $key)
                    @php($item = $data['vision_mission'][$key])
                    <div class="col-md-6 col-lg-5 wow fadeInUp" data-wow-delay="{{ $loop->iteration * 0.15 }}s">
                        <div class="vm-glass-card h-100">
                            <div class="vm-glass-shine"></div>
                            <div class="text-center py-4 position-relative">
                                <div class="simple-process-number mx-auto"><i class="{{ $icon($item['icon']) }}"></i>
                                </div>
                                <h4>{{ $item['title'] }}</h4>
                                <p>{{ $item['text'] }}</p>
                                <div class="mt-3">
                                    <span class="h3" style="color:#ff8a3d;font-weight:700;">{{ $item['stat_number'] }}</span>
                                    <div class="small text-uppercase" style="color:rgba(255,255,255,.75);">{{ $item['stat_label'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Vision & Mission Section -->

    <!-- Start Growth Numbers Section -->
    <!-- Growth Numbers -->
    <section class="counter container-fluid service overflow-hidden py-5" id="counter">
        <div class="container-fluid counter-facts py-5">
            <div class="container py-1">
                <div class="section-title st-center">
                    <h3>{{ $data['growth_numbers']['title'] }}</h3>
                    <p>{{ $data['growth_numbers']['subtitle'] }}</p>
                </div>
                <div class="row g-4">
                    @foreach ($data['growth_numbers']['items'] as $item)
                        <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp"
                            data-wow-delay="{{ 0.1 * $loop->iteration }}s">
                            <div class="counter">
                                <div class="counter-icon"><i class="{{ $icon($item['icon']) }}"></i></div>
                                <div class="counter-content">
                                    <h3>{{ $item['label'] }}</h3>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="counter-value" data-toggle="counter-up">{{ $item['count'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Growth Numbers Section -->

    <!-- Start Core Values Section -->
    <!-- Core Values -->
    <section class="py-5">
        <div class="container py-5">
            <div class="section-title st-center">
                <h3>{{ $data['core_values']['title'] }}</h3>
                <p>{{ $data['core_values']['subtitle'] }}</p>
            </div>
            <div class="row g-4">
                @foreach ($data['core_values']['items'] as $item)
                    <div class="col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="office-item icon-only h-100">
                            <div class="office-img"><i class="{{ $icon($item['icon']) }}"></i></div>
                            <div class="office-content text-center">
                                <h4>{{ $item['title'] }}</h4>
                                <p>{{ $item['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Core Values Section -->

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

    <!-- Start Founder Section -->
    <!-- Founder -->
    <section class="py-5" style="background:#f5f8fd;">
        <div class="container py-5">
            <div class="section-title st-center">
                <h3>{{ $data['founder']['section_title'] }}</h3>
                <p>{{ $data['founder']['subtitle'] }}</p>
            </div>
            <div class="row g-5 align-items-center justify-content-center">
                <div class="col-lg-3 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="phone-mockup">
                        <div class="phone-frame">
                            <div class="phone-notch"></div>
                            <div class="phone-screen">
                                <div class="phone-statusbar">
                                    <span class="phone-brand">{{ config('constants.BRAND_NAME') }}</span>
                                </div>
                                <div class="founder-phone-photo">
                                    <img src="{{ asset('assets/front/img/team-1.jpg') }}"
                                        alt="{{ $data['founder']['name'] }}">
                                </div>
                                <div class="founder-phone-info">
                                    <h4>{{ $data['founder']['name'] }}</h4>
                                    <p>{{ $data['founder']['role'] }}</p>
                                    <div class="founder-phone-social">
                                        @foreach ($data['founder']['social'] as $social)
                                            <a href="{{ $social['link'] }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <i class="fab fa-{{ $social['icon'] }}"></i>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="phone-home-indicator"></div>
                        </div>
                        <div class="phone-shadow"></div>
                    </div>
                </div>

                <div class="col-lg-9 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="app-tablet">
                        <div class="tablet-frame app-tablet-frame">
                            <div class="tablet-cam"></div>
                            <div class="tablet-screen app-tablet-screen">
                                <div class="tablet-statusbar">
                                    <span class="phone-brand">{{ config('constants.BRAND_NAME') }}</span>
                                </div>

                                <div class="app-screen-header">
                                    <h4>Founder &amp; Leadership</h4>
                                    <p>The vision, strategy, and technology leadership behind the company</p>
                                </div>

                                <div class="founder-tablet-body">
                                     <p></p></p>
                                    @foreach ($data['founder']['bio'] as $para)
                                       <span>{{ $para }}</span>
                                    @endforeach
                                    </p>

                                    @foreach ($data['founder']['expertise'] as $skill)
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-1">
                                                <span style="color:#073965;font-weight:600;">{{ $skill['label'] }}</span>
                                                <span class="text-muted">{{ $skill['percent'] }}%</span>
                                            </div>
                                            <div class="rounded-pill overflow-hidden" style="background:#e3e8f0;height:8px;">
                                                <div class="rounded-pill h-100"
                                                    style="width:{{ $skill['percent'] }}%;background:linear-gradient(90deg,#073965,#f85603);">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Founder Section -->

    <!-- Start Office & Culture Section -->
    <!-- Office & Culture -->
    <section class="vm-area py-5" style="background-image:url('{{ asset('assets/front/img/funfact.png') }}');">
        <div class="vm-overlay"></div>
        <div class="container py-5 position-relative">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="office-culture-slide-frame mx-auto">
                        <div class="office-culture-slider owl-carousel">
                            <div><img src="{{ asset('assets/front/img/why-2.png') }}" alt="{{ config('constants.BRAND_NAME') }} team culture"></div>
                            <div><img src="{{ asset('assets/front/img/why-4.png') }}" alt="{{ config('constants.BRAND_NAME') }} office"></div>
                            <div><img src="{{ asset('assets/front/img/why-3.png') }}" alt="{{ config('constants.BRAND_NAME') }} at work"></div>
                            <div><img src="{{ asset('assets/front/img/why-1.png') }}" alt="{{ config('constants.BRAND_NAME') }} strategy"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="vm-glass-card p-4 p-lg-5">
                        <div class="vm-glass-shine"></div>
                        <div class="position-relative">
                            <div class="section-title st-start st-light mb-4">
                                <h3>{{ $data['office_culture']['title'] }}</h3>
                                <p>{{ $data['office_culture']['subtitle'] }}</p>
                            </div>
                            @foreach ($data['office_culture']['content'] as $para)
                                <p style="color:rgba(255,255,255,.78);">{{ $para }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Office & Culture Section -->

    <!-- Process -->
    {{-- <section class="py-5" style="background:#f5f8fd;">
        <div class="container py-5">
            <div class="section-title st-center">
                <h3>{{ $data['process']['title'] }}</h3>
                <p>{{ $data['process']['subtitle'] }}</p>
            </div>
            <div class="row g-4">
                @foreach ($data['process']['steps'] as $step)
                    <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="{{ 0.1 * $loop->iteration }}s">
                        <div class="simple-process-item">
                            <div class="simple-process-number">{{ $step['step'] }}</div>
                            <h4>{{ $step['title'] }}</h4>
                            <p>{{ $step['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section> --}}

    <!-- Start Key Advantages Section -->
    <!-- Key Advantages -->
    <section class="py-5">
        <div class="container py-5">
            <div class="section-title st-center">
                <h3>{{ $data['advantages']['title'] }}</h3>
                <p>{{ $data['advantages']['subtitle'] }}</p>
            </div>
            <div class="row g-4">
                @foreach ($data['advantages']['items'] as $item)
                    <div class="col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="office-item icon-only h-100">
                            <div class="office-img"><i class="{{ $icon($item['icon']) }}"></i></div>
                            <div class="office-content text-center">
                                <h4>{{ $item['title'] }}</h4>
                                <p>{{ $item['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Key Advantages Section -->

    <!-- Start Testimonials Section -->
    <!-- Testimonials -->
    @if ($testimonials->isNotEmpty())
        <section class="testimonials">

            <div class="container">

                <div class="row">
                    <div class="col-12">
                        <div class="section-title st-center">
                            <h3>What Our Clients Say</h3>
                            <p>Trusted by businesses we've helped grow</p>
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
                                            <p>{{ $testimonial->message }}</p>
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

 <!-- Start FAQ Section -->
 <section id="faq-section" class="faq-section">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        <h3>Frequently Asked Questions</h3>
                        <p>Quick answers to common questions</p>
                    </div>
                </div>
            </div>

            <div class="faq-contact-grid">

                @if ($category && $category->faqs->isNotEmpty())
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
                                    @foreach ($category->faqs as $faq)
                                        <div class="faq-item @if ($loop->first) active @endif">
                                            <div class="faq-title">
                                                <h5>{{ $faq->question }}</h5>
                                                <span class="faq-icon">
                                                    <i class="fa {{ $loop->first ? 'fa-minus' : 'fa-plus' }}"></i>
                                                </span>
                                            </div>

                                            <div class="faq-content" @if ($loop->first) style="display:block;" @endif>
                                                <p>{{ $faq->answer }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tablet-home-btn"></div>
                        </div>
                        <div class="tablet-shadow"></div>
                    </div>
                </div>
                @endif

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
                                        <input type="text" id="hc-name" name="name" required placeholder="John Doe">
                                        <span class="app-form-error">Please enter your name.</span>
                                    </div>

                                    <div class="app-form-group">
                                        <label for="hc-email">Email Address</label>
                                        <input type="email" id="hc-email" name="email" required placeholder="john@example.com">
                                        <span class="app-form-error">Please enter a valid email.</span>
                                    </div>

                                    <div class="app-form-group">
                                        <label for="hc-phone">Phone Number</label>
                                        <input type="tel" id="hc-phone" name="phone" placeholder="+91 12345 67890">
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
