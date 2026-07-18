@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.home.title'))
@section('meta_description', config('constants.PAGE_SEO.home.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.home.meta_keywords'))
@section('content')
    <!-- Start Hero Slider Section -->
    <section>
        <div class="slider-area">
            <div class="slider-active">

                <!-- Slider 1 -->
                <div class="single-slider hero-overly slider-height d-flex align-items-center"
                    data-background="{{ asset('assets/front/img/hero/h1_hero.png') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="hero__caption">

                                    <div class="hero-text1">
                                        <span data-animation="fadeInUp" data-delay=".3s">
                                            Trusted Web Design, SEO & Digital Marketing Agency
                                        </span>
                                    </div>

                                    <h1 data-animation="fadeInUp" data-delay=".5s">
                                        {{ config('constants.BRAND_NAME') }}
                                    </h1>

                                    <div class="stock-text" data-animation="fadeInUp" data-delay=".8s"
                                        style="animation-delay: 0.8s;">
                                        <h2>World</h2>
                                        <h2>World</h2>
                                    </div>

                                    <div class="hero-text2 mt-110" data-animation="fadeInUp" data-delay=".9s">
                                        <span>
                                            <a href="#">Explore Our Services</a>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slider 2 -->
                <div class="single-slider hero-overly slider-height d-flex align-items-center"
                    data-background="{{ asset('assets/front/img/hero/h2_hero.png') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="hero__caption">

                                    <div class="hero-text1">
                                        <span data-animation="fadeInUp" data-delay=".3s">
                                            Custom Websites, Branding & Performance Marketing
                                        </span>
                                    </div>

                                    <h1 data-animation="fadeInUp" data-delay=".5s">
                                        Digital Innovation
                                    </h1>

                                    <div class="stock-text" data-animation="fadeInUp" data-delay=".8s">
                                        <h2> Agency</h2>
                                        <h2> Agency</h2>
                                    </div>

                                    <div class="hero-text2 mt-110" data-animation="fadeInUp" data-delay=".9s">
                                        <span>
                                            <a href="#">Start Your Project</a>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slider 2 -->
                <div class="single-slider hero-overly slider-height d-flex align-items-center"
                    data-background="{{ asset('assets/front/img/hero/h3_hero.png') }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-11">
                                <div class="hero__caption">

                                    <div class="hero-text1">
                                        <span data-animation="fadeInUp" data-delay=".3s">
                                            Custom Websites, Branding & Performance Marketing
                                        </span>
                                    </div>

                                    <h1 data-animation="fadeInUp" data-delay=".5s">
                                        Custom Software
                                    </h1>

                                    <div class="stock-text" data-animation="fadeInUp" data-delay=".8s">
                                        <h2> Solutions</h2>
                                        <h2> Solutions</h2>
                                    </div>

                                    <div class="hero-text2 mt-110" data-animation="fadeInUp" data-delay=".9s">
                                        <span>
                                            <a href="#">Start Your Project</a>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @php
        $aboutSection = $homePage?->sections->firstWhere('slug', 'about-section');
        $aboutContent = $aboutSection ? $sectionContents[$aboutSection->id] ?? [] : [];
        $aboutListItems = $aboutContent['group_data']['section_lists'] ?? [];
    @endphp
    <section class="about" id="about_section">
        <div class="container">

            <div class="row">
                <div class="col-md-12">

                    <div class="section-title st-center">

                        @if (!empty($aboutContent['section_label']))
                            <span class="sub-title d-block fw-semibold"
                                style="color:#ff5f13;">{{ $aboutContent['section_label'] }}</span>
                        @endif

                        <h3>{{ $aboutContent['section_title'] ?? \App\Helper::sectionTitle('home', 'about', 'title', 'WELCOME TO DEOVATE WORLD') }}
                        </h3>

                        <p>
                            {{ $aboutContent['section_subtitle'] ?? \App\Helper::sectionTitle('home', 'about', 'subtitle') }}
                        </p>

                    </div>

                    <div class="row align-items-center mb90">

                        <div class="col-lg-6 col-md-6">

                            <div class="about-text">
                                @if (!empty($aboutContent['section_paragraph']))
                                    {!! $aboutContent['section_paragraph'] !!}
                                @else
                                    <p>
                                        At <strong>{{ config('constants.BUSINESS.name') }}</strong>, we build powerful
                                        digital
                                        solutions that help businesses establish a strong online
                                        presence, improve customer engagement, and achieve
                                        sustainable growth. From custom websites and enterprise
                                        software to eCommerce platforms and SEO-driven digital
                                        strategies, every solution is carefully designed to deliver
                                        performance, security, scalability, and measurable business
                                        results.
                                    </p>
                                @endif
                            </div>

                            @if (!empty($aboutListItems))
                                <div class="row mt-4">

                                    <div class="col-sm-6">
                                        <ul class="about-list">
                                            @foreach ($aboutListItems as $item)
                                                @if (!empty($item['left_list']))
                                                    <li>
                                                        <i class="fa fa-check-circle"></i>
                                                        {{ $item['left_list'] }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="col-sm-6">
                                        <ul class="about-list">
                                            @foreach ($aboutListItems as $item)
                                                @if (!empty($item['right_list']))
                                                    <li>
                                                        <i class="fa fa-check-circle"></i>
                                                        {{ $item['right_list'] }}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>
                            @endif

                            <div class="mt-4">

                                <a href="{{ $aboutContent['btn_links'] ?? '#' }}" class="btn btn-main">
                                    {{ $aboutContent['btn_text'] ?? "Let's Build Together" }}
                                </a>

                            </div>

                        </div>

                        <div class="col-lg-6 col-md-6 text-center">

                            <img src="{{ !empty($aboutContent['right_image']) ? asset('storage/' . $aboutContent['right_image']) : asset('assets/front/img/about.png') }}"
                                alt="{{ $aboutContent['section_title'] ?? 'Professional Web Development Company' }}"
                                class="img-responsive about-img">

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>


    <!-- Counter Facts Start -->
    <!-- Start Counter Facts Section -->
    @php
        $counterSection = $homePage?->sections->firstWhere('slug', 'counter-facts-section');
        $counterContent = $counterSection ? $sectionContents[$counterSection->id] ?? [] : [];
        $counterItems = $counterContent['group_data']['counter_items'] ?? [];

        if (empty($counterItems)) {
            $counterItems = [
                [
                    'counter_icon' => 'fas fa-laptop',
                    'counter_title' => 'Projects Delivered',
                    'counter_value' => '50',
                    'counter_suffix' => '+',
                ],
                [
                    'counter_icon' => 'fas fa-users',
                    'counter_title' => 'Happy Clients',
                    'counter_value' => '35',
                    'counter_suffix' => '+',
                ],
                [
                    'counter_icon' => 'fas fa-code',
                    'counter_title' => 'Technologies Used',
                    'counter_value' => '15',
                    'counter_suffix' => '+',
                ],
                [
                    'counter_icon' => 'fas fa-server',
                    'counter_title' => 'Technical Support',
                    'counter_value' => '24',
                    'counter_suffix' => '/7',
                ],
            ];
        }
    @endphp
    <section class="counter container-fluid service overflow-hidden pt-5" id="counter">
        <div class="container-fluid counter-facts py-5">
            <div class="container py-1">
                <div class="row mb-30">
                    <div class="col-12">
                        <div class="section-title st-center">

                            @if (!empty($counterContent['section_label']))
                                <span class="sub-title d-block fw-semibold"
                                    style="color:#ff5f13;">{{ $counterContent['section_label'] }}</span>
                            @endif

                            <h3>{{ $counterContent['section_title'] ?? \App\Helper::sectionTitle('home', 'achievements_counter', 'title', 'OUR ACHIEVEMENTS') }}
                            </h3>

                            <p>
                                {{ $counterContent['section_subtitle'] ?? \App\Helper::sectionTitle('home', 'achievements_counter', 'subtitle') }}
                            </p>

                        </div>

                    </div>
                </div>

                <div class="row g-4">

                    @foreach ($counterItems as $item)
                        <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp"
                            data-wow-delay="{{ 0.1 + $loop->index * 0.2 }}s">

                            <div class="counter">

                                <div class="counter-icon">
                                    <i class="{{ $item['counter_icon'] ?? 'fas fa-check-circle' }}"></i>
                                </div>

                                <div class="counter-content">

                                    <h3>{{ $item['counter_title'] ?? '' }}</h3>

                                    <div class="d-flex align-items-center justify-content-center">

                                        <span class="counter-value" data-toggle="counter-up">
                                            {{ $item['counter_value'] ?? 0 }}
                                        </span>

                                        <h4 class="text-secondary mb-0" style="font-weight:600;font-size:25px;">
                                            {{ $item['counter_suffix'] ?? '+' }}
                                        </h4>

                                    </div>

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </section>
    <!-- End Counter Facts Section -->
    <!-- Counter Facts End -->
    <!-- about section start -->
    <!-- Start Services Section -->
    @php
        $servicesSection = $homePage?->sections->firstWhere('slug', 'services-section');
        $servicesContent = $servicesSection ? $sectionContents[$servicesSection->id] ?? [] : [];
    @endphp
    <section class="services container-fluid service overflow-hidden pt-5" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title st-center">
                        @include('front.partials._section_heading', [
                            'content' => $servicesContent,
                            'defaultTitle' => \App\Helper::sectionTitle(
                                'home',
                                'services',
                                'title',
                                'OUR SERVICES'),
                            'defaultSubtitle' => \App\Helper::sectionTitle('home', 'services', 'subtitle'),
                        ])
                    </div>
                    <div class="row g-4">
                        @foreach ($services as $service)
                            <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s"
                                style="
                    visibility: visible;
                    animation-delay: 0.1s;
                    animation-name: fadeInUp;
                  ">
                                <div class="service-item">
                                    <div class="service-inner">
                                        <div class="service-img">
                                            <img src="{{ !empty($service['featured_image']) ? asset('storage/' . $service['featured_image']) : asset('assets/frontend/images/1768234677_web-application.webp') }}"
                                                class="img-fluid w-100 rounded" alt="Image">
                                        </div>
                                        <div class="service-title">
                                            <div class="service-title-name">
                                                <div class="bg-primary text-center rounded p-3 mx-5 mb-4">
                                                    <a href="#"
                                                        class="h4 text-white mb-0">{{ $service->title }}</a>
                                                </div>
                                                <a class="btn bg-light text-secondary rounded-pill py-3 px-5 mb-4"
                                                    href="#">Explore More
                                                </a>
                                            </div>
                                            <div class="service-content pb-4">
                                                <a href="#">
                                                    <h4 class="text-white mb-4 py-3">{{ $service->title }}</h4>
                                                </a>
                                                <div class="px-4">
                                                    <p class="mb-4">
                                                        {!! $service->short_description !!}
                                                    </p>
                                                    <a class="btn btn-primary border-secondary rounded-pill py-3 px-5"
                                                        href="{{ route('front.services.details', $service['slug']) }}">Explore
                                                        More
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Services Section -->
    <!-- about section end -->
    <!-- Start Call to Action Section -->
    @php
        $ctaSection = $homePage?->sections->firstWhere('slug', 'cta-section');
        $ctaContent = $ctaSection ? $sectionContents[$ctaSection->id] ?? [] : [];
    @endphp
    <section class="call-2-acction" data-stellar-background-ratio="0.4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-title st-center">
                        @include('front.partials._section_heading', [
                            'content' => $ctaContent,
                            'defaultTitle' => \App\Helper::sectionTitle(
                                'home',
                                'cta',
                                'title',
                                "LET'S BUILD SOMETHING EXCEPTIONAL"),
                            'defaultSubtitle' => \App\Helper::sectionTitle('home', 'cta', 'subtitle'),
                        ])
                    </div>

                    <div class="c2a">

                        <p>
                            @if (!empty($ctaContent['cta_paragraph']))
                                {!! $ctaContent['cta_paragraph'] !!}
                            @else
                                Whether you're launching a startup, modernizing your business, or scaling your digital
                                presence,
                                {{ config('constants.BUSINESS.name') }} delivers custom websites, business software,
                                eCommerce
                                platforms, and innovative
                                technology solutions tailored to your goals. Partner with our experienced team to build
                                secure,
                                scalable, and high-performing digital products that create lasting business value.
                            @endif
                        </p>

                        <a href="{{ $ctaContent['btn_links'] ?? route('front.contact.index') }}"
                            class="btn btn-main btn-lg">
                            {{ $ctaContent['btn_text'] ?? 'Start Your Project' }}
                        </a>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End Call to Action Section -->

    <!-- Start Clients Logos Section -->
    @php
        $clientsSection = $homePage?->sections->firstWhere('slug', 'clients-section');
        $clientsContent = $clientsSection ? $sectionContents[$clientsSection->id] ?? [] : [];
        $clientLogos = $clientsContent['client_logos'] ?? [];

        if (empty($clientLogos)) {
            $clientLogos = collect(range(1, 9))
                ->map(
                    fn($i) => [
                        'path' => 'assets/front/img/client' . ($i === 1 ? '' : $i) . '.png',
                        'alt' => 'Client ' . $i,
                        'external' => true,
                    ],
                )
                ->all();
        }
    @endphp
    <section class="clients py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        @include('front.partials._section_heading', [
                            'content' => $clientsContent,
                            'defaultTitle' => \App\Helper::sectionTitle(
                                'home',
                                'clients_strip',
                                'title',
                                'TECHNOLOGIES WE WORK WITH'),
                            'defaultSubtitle' => \App\Helper::sectionTitle('home', 'clients_strip', 'subtitle'),
                        ])
                    </div>
                </div>
            </div>
            <div class="clients-carousel owl-carousel owl-theme">
                @foreach ($clientLogos as $logo)
                    <div class="item">
                        <img src="{{ !empty($logo['external']) ? asset($logo['path']) : asset('storage/' . ($logo['path'] ?? '')) }}"
                            class="img-fluid" alt="{{ $logo['alt'] ?? 'Client' }}">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Clients Logos Section -->


    <!-- Start Why Choose Us Section -->
    @php
        $whySection = $homePage?->sections->firstWhere('slug', 'why-choose-us-section');
        $whyContent = $whySection ? $sectionContents[$whySection->id] ?? [] : [];
        $whyItems = $whyContent['group_data']['why_items'] ?? [];

        if (empty($whyItems)) {
            $whyItems = [
                [
                    'item_image' => null,
                    'item_title' => 'Custom, Data-Driven Strategies',
                    'item_description' =>
                        'Every successful project starts with understanding your business goals. We create customized digital strategies backed by market research, customer insights, and modern technologies to deliver solutions that improve engagement, increase conversions, and support long-term business growth.',
                    'btn_text' => 'Start Your Project',
                    'btn_links' => null,
                    '_fallback_img' => 'assets/front/img/why-1.png',
                ],
                [
                    'item_image' => null,
                    'item_title' => 'Expert Team',
                    'item_description' =>
                        'Our experienced developers, designers, and technology specialists work together to build secure, scalable, and high-performing digital products. Every solution is developed using modern frameworks, clean coding standards, and industry best practices to ensure outstanding performance.',
                    'btn_text' => 'Talk to Our Experts',
                    'btn_links' => null,
                    '_fallback_img' => 'assets/front/img/why-2.png',
                ],
                [
                    'item_image' => null,
                    'item_title' => 'Proven Expertise Across Industries',
                    'item_description' =>
                        'We help startups, growing businesses, and enterprises build reliable websites, business software, eCommerce platforms, and digital solutions tailored to their industry needs. Our practical experience enables us to solve real business challenges through innovative technology.',
                    'btn_text' => 'Explore Our Expertise',
                    'btn_links' => null,
                    '_fallback_img' => 'assets/front/img/why-3.png',
                ],
                [
                    'item_image' => null,
                    'item_title' => 'Long-Term Partnership & Support',
                    'item_description' =>
                        'We believe in building long-term relationships with our clients. From regular maintenance and security updates to performance optimization and technical support, we ensure your digital solutions continue to perform efficiently as your business evolves.',
                    'btn_text' => "Let's Build Together",
                    'btn_links' => null,
                    '_fallback_img' => 'assets/front/img/why-4.png',
                ],
            ];
        }
    @endphp
    <section class="why-choose-us features bg-grey py-5" id="why-choose-us">
        <div class="container-fluid py-5">
            <div class="container py-5">

                <!-- Section Title -->
                <div class="row">
                    <div class="col-12">
                        <div class="section-title st-center">
                            @include('front.partials._section_heading', [
                                'content' => $whyContent,
                                'defaultTitle' => \App\Helper::sectionTitle(
                                    'home',
                                    'why_choose_us',
                                    'title',
                                    'WHY CHOOSE DEOVATE WORLD'),
                                'defaultSubtitle' => \App\Helper::sectionTitle(
                                    'home',
                                    'why_choose_us',
                                    'subtitle'),
                            ])
                        </div>
                    </div>
                </div>

                @foreach ($whyItems as $item)
                    <div class="service-item {{ $loop->even ? 'service-item-right' : 'service-item-left' }}">
                        <div class="row g-0 align-items-center">

                            <div class="col-md-5 {{ $loop->even ? 'order-md-1 text-md-end' : '' }}">
                                <div class="service-img p-5 wow {{ $loop->even ? 'fadeInLeft' : 'fadeInRight' }}"
                                    data-wow-delay="0.2s">
                                    <img class="img-fluid rounded-circle"
                                        src="{{ !empty($item['item_image']) ? asset('storage/' . $item['item_image']) : asset($item['_fallback_img'] ?? 'assets/front/img/why-1.png') }}"
                                        alt="{{ $item['item_title'] ?? '' }}">
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="service-text px-5 py-md-5 {{ $loop->even ? 'text-md-end' : '' }} wow {{ $loop->even ? 'fadeInLeft' : 'fadeInRight' }}"
                                    data-wow-delay="0.5s">

                                    <h3 class="text-uppercase">
                                        {{ $item['item_title'] ?? '' }}
                                    </h3>

                                    <p class="mb-4">
                                        {{ $item['item_description'] ?? '' }}
                                    </p>

                                    <a class="btn btn-outline-primary border-2 px-4"
                                        href="{{ $item['btn_links'] ?? route('front.contact.index') }}">
                                        {{ $item['btn_text'] ?? 'Learn More' }}
                                        <i class="fa fa-arrow-right ms-1"></i>
                                    </a>

                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- End Why Choose Us Section -->


    <!-- Start Roadmap Section -->
    @php
        $roadmapSection = $homePage?->sections->firstWhere('slug', 'roadmap-section');
        $roadmapContent = $roadmapSection ? $sectionContents[$roadmapSection->id] ?? [] : [];
        $roadmapSteps = $roadmapContent['group_data']['roadmap_steps'] ?? [];

        if (empty($roadmapSteps)) {
            $roadmapSteps = [
                [
                    'step_icon' => 'fas fa-search',
                    'step_title' => 'Discovery',
                    'step_heading' => 'Project Discovery & Consultation',
                    'step_description' =>
                        'We begin by understanding your business objectives, target audience, and project requirements. Through detailed consultation and market research, we create a clear strategy that aligns technology with your long-term business goals.',
                ],
                [
                    'step_icon' => 'fas fa-paint-brush',
                    'step_title' => 'Planning',
                    'step_heading' => 'Planning & UI/UX Design',
                    'step_description' =>
                        'Our designers and solution architects create intuitive user experiences, interactive prototypes, and scalable system architecture that provide the perfect foundation for successful digital products.',
                ],
                [
                    'step_icon' => 'fas fa-code',
                    'step_title' => 'Development',
                    'step_heading' => 'Development & Quality Assurance',
                    'step_description' =>
                        'Using modern technologies and clean coding standards, our developers build secure, responsive, and scalable solutions. Every feature is thoroughly tested to ensure performance, reliability, and security before launch.',
                ],
                [
                    'step_icon' => 'fas fa-rocket',
                    'step_title' => 'Launch',
                    'step_heading' => 'Launch, Growth & Continuous Support',
                    'step_description' =>
                        'After successful deployment, we continue supporting your business with maintenance, performance optimization, security updates, feature enhancements, and technical assistance to ensure sustainable digital growth.',
                ],
            ];
        }
    @endphp
    <section class="roadmap-area section-padding" id="roadmap">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="heading">
                        @if (!empty($roadmapContent['section_label']))
                            <h5>{{ $roadmapContent['section_label'] }}</h5>
                        @else
                            <h5>Our Development Process</h5>
                        @endif
                        <div class="space-10"></div>
                        <h1>{{ $roadmapContent['section_title'] ?? \App\Helper::sectionTitle('home', 'roadmap', 'title', 'From Vision to Digital Success') }}
                        </h1>
                        <p class="mt-3">
                            {{ $roadmapContent['section_subtitle'] ?? \App\Helper::sectionTitle('home', 'roadmap', 'subtitle') }}
                        </p>
                    </div>
                    <div class="space-60 d-none d-sm-block"></div>
                </div>
            </div>

            <div class="process-flow">
                @foreach ($roadmapSteps as $step)
                    <div class="process-step wow fadeInLeft" data-wow-delay="{{ 0.1 + $loop->index * 0.2 }}s"
                        data-slide-target="{{ $loop->index }}">
                        <div class="process-chevron process-chevron--{{ $loop->iteration }}">
                            <span class="process-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="process-icon"><i class="{{ $step['step_icon'] ?? 'fas fa-check' }}"></i></span>
                            <span class="process-title">{{ $step['step_title'] ?? '' }}</span>
                        </div>
                    </div>
                @endforeach
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
                            @foreach ($roadmapSteps as $step)
                                <div class="laptop-slide">
                                    <span class="process-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                    <span class="process-icon"><i
                                            class="{{ $step['step_icon'] ?? 'fas fa-check' }}"></i></span>
                                    <h5>{{ $step['step_heading'] ?? ($step['step_title'] ?? '') }}</h5>
                                    <p>
                                        {{ $step['step_description'] ?? '' }}
                                    </p>
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
    <!-- End Roadmap Section -->



    <!-- Start Portfolio Section -->
    @php
        $portfolioSection = $homePage?->sections->firstWhere('slug', 'portfolio-section');
        $portfolioSectionContent = $portfolioSection ? $sectionContents[$portfolioSection->id] ?? [] : [];
    @endphp
    <section class="portfolio" id="portfolio">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 no-padding">
                    <div class="section-title st-center">
                        @include('front.partials._section_heading', [
                            'content' => $portfolioSectionContent,
                            'defaultTitle' => \App\Helper::sectionTitle(
                                'home',
                                'portfolio',
                                'title',
                                'What We Have Done'),
                            'defaultSubtitle' => \App\Helper::sectionTitle('home', 'portfolio', 'subtitle'),
                        ])
                    </div>
                    <div class="filter mb40">
                        <form id="filter">
                            <fieldset class="group">
                                <label class="btn btn-default btn-main">
                                    <input type="radio" name="filter" value="all" checked="checked">All
                                </label>
                                @foreach ($portfolio_categories as $category)
                                    <label class="btn btn-default">
                                        <input type="radio" name="filter" value="{{ $category->slug }}"
                                            checked="checked">{{ $category->name }}
                                    </label>
                                @endforeach


                            </fieldset>
                        </form>
                        <!-- #filter -->
                    </div>
                    <!-- .filter .mb40 -->
                    <div class="grid">
                        @foreach ($portfolios as $portfolio)
                            <figure class="portfolio-item"
                                data-groups='["{{ $portfolio->category->slug ?? 'uncategorized' }}"]'>
                                <img src="{{ !empty($portfolio['featured_image']) ? asset('storage/' . $portfolio['featured_image']) : asset('assets/front/img/default-img.png') }}"
                                    alt="">
                                <figcaption>
                                    <h2>{{ $portfolio->title }}
                                        {{-- <span>Lily</span> --}}
                                    </h2>
                                    <p>{!! $portfolio->description !!}</p>
                                    <a href="{{ route('front.portfolios.details', ['slug' => $portfolio->slug]) }}"
                                        class="btn btn-main">
                                        <i class="fa fa-link"></i> View more
                                    </a>
                                </figcaption>
                            </figure>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Portfolio Section -->

    <!-- Start Technologies Section -->
    @php
        $technologiesSection = $homePage?->sections->firstWhere('slug', 'technologies-section');
        $technologiesSectionContent = $technologiesSection ? $sectionContents[$technologiesSection->id] ?? [] : [];
    @endphp
    <section class="technologies" id="technologies">

        <div class="container-fluid features overflow-hidden py-5">
            <div class="container">

                <div class="row">
                    <div class="col-12">
                        <div class="section-title st-center">
                            @include('front.partials._section_heading', [
                                'content' => $technologiesSectionContent,
                                'defaultTitle' => \App\Helper::sectionTitle(
                                    'home',
                                    'technologies_grid',
                                    'title',
                                    'OUR TECH STACK'),
                                'defaultSubtitle' => \App\Helper::sectionTitle(
                                    'home',
                                    'technologies_grid',
                                    'subtitle'),
                            ])
                        </div>
                    </div>
                </div>

                <div class="row g-4 justify-content-center">

                    @forelse($technologies as $technology)
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="{{ $loop->iteration * 0.2 }}s">

                            <div class="feature-item text-center p-4 h-100">

                                <div class="feature-icon mb-4">

                                    @if (!empty($technology->image))
                                        <img src="{{ asset('storage/' . $technology->image) }}"
                                            alt="{{ $technology->name }}"
                                            class="img-fluid rounded-circle industry-image">
                                    @elseif(!empty($technology->icon))
                                        <i class="{{ $technology->icon }} fa-4x text-primary"></i>
                                    @else
                                        <img src="{{ asset('assets/front/img/default-tech.png') }}"
                                            alt="{{ $technology->name }}"
                                            class="img-fluid rounded-circle industry-image">
                                    @endif

                                </div>

                                <div class="feature-content">

                                    <h5 class="mb-3">

                                        {{ $technology->name }}

                                    </h5>

                                    <p>

                                        {{ \Illuminate\Support\Str::limit(strip_tags($technology->description), 120) }}

                                    </p>

                                    @if (!empty($technology->website_url))
                                        <a href="{{ $technology->website_url }}" target="_blank" rel="noopener"
                                            class="btn btn-secondary rounded-pill">

                                            Official Website

                                            <i class="fas fa-external-link-alt ms-2"></i>

                                        </a>
                                    @else
                                        <a href="#" class="btn btn-secondary rounded-pill">

                                            Learn More

                                            <i class="fas fa-arrow-right ms-2"></i>

                                        </a>
                                    @endif

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="col-12 text-center">

                            <h5>No technologies available.</h5>

                        </div>
                    @endforelse

                </div>

                @if ($technologies->count() >= 8)
                    <div class="text-center mt-5">

                        <a href="#" class="btn btn-primary rounded-pill py-3 px-5">

                            View All Technologies

                        </a>

                    </div>
                @endif

            </div>
        </div>

    </section>
    <!-- End Technologies Section -->



    <!-- Start Industries Section -->
    @php
        $industriesSection = $homePage?->sections->firstWhere('slug', 'industries-section');
        $industriesSectionContent = $industriesSection ? $sectionContents[$industriesSection->id] ?? [] : [];
    @endphp
    <section class="industries" id="industries">

        <div class="container-fluid training overflow-hidden bg-light py-5">
            <div class="container py-5">

                <!-- Section Title -->
                <div class="row">
                    <div class="col-12">
                        <div class="section-title st-center">
                            @include('front.partials._section_heading', [
                                'content' => $industriesSectionContent,
                                'defaultTitle' => \App\Helper::sectionTitle(
                                    'home',
                                    'industries',
                                    'title',
                                    'INDUSTRIES WE SERVE'),
                                'defaultSubtitle' => \App\Helper::sectionTitle('home', 'industries', 'subtitle'),
                            ])
                        </div>
                    </div>
                </div>

                <div class="row g-4">

                    @forelse($industries as $industry)
                        <div class="col-lg-6 col-md-6 col-xl-3 wow fadeInUp"
                            data-wow-delay="{{ $loop->iteration * 0.2 }}s">

                            <div class="training-item">

                                <div class="training-inner">

                                    <img src="{{ !empty($industry->image) ? asset('storage/' . $industry->image) : asset('assets/front/img/default-img.png') }}"
                                        class="img-fluid w-100 rounded" alt="{{ $industry->name }}">

                                    <div class="training-title-name">

                                        <a href="#" class="h4 text-white mb-0">

                                            {{ $industry->name }}

                                        </a>

                                    </div>

                                </div>

                                <div class="training-content bg-secondary rounded-bottom p-4">

                                    <a href="#">

                                        <h4 class="text-white">

                                            {{ $industry->name }}

                                        </h4>

                                    </a>

                                    <p class="text-white-50">

                                        {{ \Illuminate\Support\Str::limit(strip_tags($industry->description), 110) }}

                                    </p>

                                    <a class="btn btn-secondary rounded-pill text-white p-0" href="#">

                                        Learn More

                                        <i class="fa fa-arrow-right ms-2"></i>

                                    </a>

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="col-12">

                            <div class="alert alert-warning text-center">

                                No industries found.

                            </div>

                        </div>
                    @endforelse

                </div>

                @if ($industries->count() >= 8)
                    <div class="text-center mt-5">

                        <a href="#" class="btn btn-primary border-secondary rounded-pill py-3 px-5">

                            View All Industries

                        </a>

                    </div>
                @endif

            </div>
        </div>

    </section>
    <!-- End Industries Section -->


    <!-- Start Achievements Funfacts Section -->
    @php
        $funfactsSection = $homePage?->sections->firstWhere('slug', 'achievements-funfacts-section');
        $funfactsContent = $funfactsSection ? $sectionContents[$funfactsSection->id] ?? [] : [];
        $funfactItems = $funfactsContent['group_data']['funfact_items'] ?? [];

        if (empty($funfactItems)) {
            $funfactItems = [
                [
                    'funfact_icon' => 'fas fa-laptop-code',
                    'funfact_value' => '50',
                    'funfact_suffix' => '+',
                    'funfact_title' => 'Projects Delivered',
                ],
                [
                    'funfact_icon' => 'fas fa-users',
                    'funfact_value' => '35',
                    'funfact_suffix' => '+',
                    'funfact_title' => 'Happy Clients',
                ],
                [
                    'funfact_icon' => 'fas fa-code',
                    'funfact_value' => '25',
                    'funfact_suffix' => '+',
                    'funfact_title' => 'Technologies',
                ],
                [
                    'funfact_icon' => 'fas fa-headset',
                    'funfact_value' => '24',
                    'funfact_suffix' => '/7',
                    'funfact_title' => 'Technical Support',
                ],
            ];
        }
    @endphp
    <section class="funfacts" data-stellar-background-ratio="0.4">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        @include('front.partials._section_heading', [
                            'content' => $funfactsContent,
                            'defaultTitle' => \App\Helper::sectionTitle(
                                'home',
                                'achievements_funfacts',
                                'title',
                                'OUR IMPACT IN NUMBERS'),
                            'defaultSubtitle' => \App\Helper::sectionTitle(
                                'home',
                                'achievements_funfacts',
                                'subtitle'),
                        ])
                    </div>
                </div>
            </div>

            <div class="row">

                @foreach ($funfactItems as $item)
                    <div class="col-md-3">
                        <div class="funfact">

                            <div class="st-funfact-icon">
                                <i class="{{ $item['funfact_icon'] ?? 'fas fa-check' }}"></i>
                            </div>

                            <div class="st-funfact-counter">
                                <span class="st-ff-count" data-from="0"
                                    data-to="{{ (int) ($item['funfact_value'] ?? 0) }}"
                                    data-runit="1">{{ $item['funfact_value'] ?? 0 }}</span>{{ $item['funfact_suffix'] ?? '+' }}
                            </div>

                            <strong class="funfact-title">
                                {{ $item['funfact_title'] ?? '' }}
                            </strong>

                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section>
    <!-- End Achievements Funfacts Section -->





    <!-- Start Industries Carousel Section -->
    @php
        $industriesCarouselSection = $homePage?->sections->firstWhere('slug', 'industries-carousel-section');
        $industriesCarouselContent = $industriesCarouselSection
            ? $sectionContents[$industriesCarouselSection->id] ?? []
            : [];
    @endphp
    <section id="team-section">
        <div class="container-fluid training overflow-hidden bg-light py-5">
            <div class="container py-5">

                <div class="row">
                    <div class="col-12">
                        <div class="section-title st-center">
                            @include('front.partials._section_heading', [
                                'content' => $industriesCarouselContent,
                                'defaultTitle' => \App\Helper::sectionTitle(
                                    'home',
                                    'industries_carousel',
                                    'title',
                                    'INDUSTRIES WE POWER'),
                                'defaultSubtitle' => \App\Helper::sectionTitle(
                                    'home',
                                    'industries_carousel',
                                    'subtitle'),
                            ])
                        </div>
                    </div>
                </div>

                <div class="phones-carousel owl-carousel wow fadeInUp" data-wow-delay="0.1s">

                    @forelse ($industries as $industry)
                        <div class="phone-mockup">
                            <div class="phone-frame">
                                <div class="phone-notch"></div>
                                <div class="phone-screen">
                                    <div class="phone-statusbar">
                                        <span class="phone-brand">{{ config('constants.BRAND_NAME') }}</span>
                                    </div>
                                    <div class="phone-slide">
                                        <div class="phone-slide-img">
                                            <img src="{{ \App\Helper::img($industry->image) }}"
                                                alt="{{ $industry->name }}">
                                            <div class="phone-slide-overlay">
                                                <h4>{{ $industry->name }}</h4>
                                                <span>Industry</span>
                                                <p>{{ \Illuminate\Support\Str::limit(strip_tags($industry->description), 90) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="phone-slide-info">
                                            <h6>{{ $industry->name }}</h6>
                                            <a href="{{ route('front.industries.details', $industry->slug) }}"
                                                class="phone-slide-btn">View Details</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="phone-home-indicator"></div>
                            </div>
                            <div class="phone-shadow"></div>
                        </div>
                    @empty
                        <p class="text-center text-muted">Industries will be listed here shortly.</p>
                    @endforelse

                </div>

            </div>
        </div>
    </section>
    <!-- End Industries Carousel Section -->


    <!-- Start Call Us Section -->
    @php
        $callUsSection = $homePage?->sections->firstWhere('slug', 'call-us-section');
        $callUsContent = $callUsSection ? $sectionContents[$callUsSection->id] ?? [] : [];
    @endphp
    <section class="call-us">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="call-us-inner wow fadeInUp" data-wow-delay="0.1s">
                        <span
                            class="call-us-kicker">{{ $callUsContent['section_label'] ?? \App\Helper::sectionTitle('home', 'call_us', 'kicker', "Let's Talk") }}</span>
                        <h3>{{ $callUsContent['section_title'] ?? \App\Helper::sectionTitle('home', 'call_us', 'title', 'If You Like To Work With Us') }}
                        </h3>
                        <p class="call-us-sub">
                            {{ $callUsContent['section_subtitle'] ?? \App\Helper::sectionTitle('home', 'call_us', 'subtitle') }}
                        </p>
                        <div class="call-us-actions">
                            <a href="tel:{{ config('constants.CONTACT.country_code') }}{{ config('constants.CONTACT.phones.0.number') }}"
                                class="btn btn-main btn-lg call-us-btn">
                                <i class="fas fa-phone"></i> Call Us Now
                            </a>
                            <a href="tel:{{ config('constants.CONTACT.country_code') }}{{ config('constants.CONTACT.phones.0.number') }}"
                                class="call-us-number">
                                {{ config('constants.CONTACT.country_code') }}
                                {{ config('constants.CONTACT.phones.0.number') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Call Us Section -->

    <!-- Start Industries We Serve Section -->
    @php
        $officeSection = $homePage?->sections->firstWhere('slug', 'industries-we-serve-section');
        $officeContent = $officeSection ? $sectionContents[$officeSection->id] ?? [] : [];
        $officeItems = $officeContent['group_data']['office_items'] ?? [];

        if (empty($officeItems)) {
            $officeItems = [
                [
                    'office_icon' => 'fa fa-heartbeat',
                    'office_title' => 'Healthcare',
                    'office_description' =>
                        'Hospital Management System, Telemedicine, Patient Portal and EMR Solutions.',
                    '_fallback_img' => 'assets/front/img/office-2.jpg',
                ],
                [
                    'office_icon' => 'fa fa-shopping-cart',
                    'office_title' => 'E-Commerce',
                    'office_description' => 'Online Stores, Multi Vendor Marketplace, Inventory & Payment Gateway.',
                    '_fallback_img' => 'assets/front/img/office-1.jpg',
                ],
                [
                    'office_icon' => 'fa fa-graduation-cap',
                    'office_title' => 'Education',
                    'office_description' => 'Learning Management Systems, Student Portals and Online Examination.',
                    '_fallback_img' => 'assets/front/img/office-3.jpg',
                ],
                [
                    'office_icon' => 'fa fa-building',
                    'office_title' => 'Real Estate',
                    'office_description' => 'Property Management, CRM and Real Estate Listing Platforms.',
                    '_fallback_img' => 'assets/front/img/office-4.jpg',
                ],
            ];
        }
    @endphp
    <section id="casestudies">
        <div class="container-fluid contact overflow-hidden pb-5">
            <div class="container py-5">

                <!-- Section Title -->
                <div class="row">
                    <div class="col-12">
                        <div class="section-title st-center">
                            @include('front.partials._section_heading', [
                                'content' => $officeContent,
                                'defaultTitle' => \App\Helper::sectionTitle(
                                    'home',
                                    'industries_we_serve',
                                    'title',
                                    'SOLUTIONS BY INDUSTRY'),
                                'defaultSubtitle' => \App\Helper::sectionTitle(
                                    'home',
                                    'industries_we_serve',
                                    'subtitle'),
                            ])
                        </div>
                    </div>
                </div>

                <!-- Owl Carousel -->
                <div class="office-carousel owl-carousel owl-theme">
                    @foreach ($officeItems as $item)
                        <div class="office-item">
                            <div class="office-img">
                                <img src="{{ !empty($item['office_image']) ? asset('storage/' . $item['office_image']) : asset($item['_fallback_img'] ?? 'assets/front/img/office-1.jpg') }}"
                                    class="img-fluid w-100" alt="{{ $item['office_title'] ?? '' }}">
                                <span class="office-icon"><i
                                        class="{{ $item['office_icon'] ?? 'fa fa-briefcase' }}"></i></span>
                            </div>

                            <div class="office-content">
                                <h4>{{ $item['office_title'] ?? '' }}</h4>
                                <p>{{ $item['office_description'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
    <!-- End Industries We Serve Section -->


    <!-- Start Newsletter Subscribe Section -->
    @php
        $newsletterSection = $homePage?->sections->firstWhere('slug', 'newsletter-section');
        $newsletterContent = $newsletterSection ? $sectionContents[$newsletterSection->id] ?? [] : [];
    @endphp
    <section class="subscribe">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        @include('front.partials._section_heading', [
                            'content' => $newsletterContent,
                            'defaultTitle' => \App\Helper::sectionTitle(
                                'home',
                                'newsletter',
                                'title',
                                'Subscribe to Our Newsletter'),
                            'defaultSubtitle' => \App\Helper::sectionTitle('home', 'newsletter', 'subtitle'),
                        ])
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <form role="form" class="subscribe-form app-newsletter-form" method="POST"
                        action="{{ route('front.newsletter.subscribe') }}" novalidate="true">
                        @csrf
                        <div class="input-group">
                            <input type="email" class="form-control" id="mc-email" placeholder="Enter E-mail..."
                                name="email" required>
                            <span class="input-group-btn">
                                <button class="btn btn-main btn-lg sub-btn" type="submit">Subscribe!</button>
                            </span>
                        </div>
                    </form>
                    <div class="subscribe-result"></div>
                    <p class="subscribe-or">or</p>
                    <ul class="subscribe-social">
                        <li><a href="#" class="social twitter"><i class="fa fa-twitter"></i> Follow</a></li>
                        <li><a href="#" class="social facebook"><i class="fa fa-facebook"></i> Like</a></li>
                        <li><a href="#" class="social rss"><i class="fa fa-rss"></i> RSS</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End Newsletter Subscribe Section -->

    <!--=================================
                        Latest Blog Section
                ==================================-->
    <!-- Start Latest Blog Section -->
    @php
        $latestBlogSection = $homePage?->sections->firstWhere('slug', 'latest-blog-section');
        $latestBlogContent = $latestBlogSection ? $sectionContents[$latestBlogSection->id] ?? [] : [];
    @endphp
    <section id="blog-section" class="section-padding">

        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        @include('front.partials._section_heading', [
                            'content' => $latestBlogContent,
                            'defaultTitle' => \App\Helper::sectionTitle(
                                'home',
                                'latest_blog',
                                'title',
                                'FROM OUR BLOG'),
                            'defaultSubtitle' => \App\Helper::sectionTitle('home', 'latest_blog', 'subtitle'),
                        ])
                    </div>
                </div>
            </div>

            <div class="tablets-carousel owl-carousel wow fadeInUp" data-wow-delay="0.1s">

                @forelse ($blogs->take(4) as $blog)
                    <div class="tablet-mockup">
                        <div class="tablet-frame">
                            <div class="tablet-cam"></div>
                            <div class="tablet-screen">
                                <div class="tablet-statusbar">
                                    <span class="phone-brand">{{ config('constants.BRAND_NAME') }} Blog</span>
                                </div>
                                <div class="tablet-slide">
                                    <div class="tablet-slide-img">
                                        <img src="{{ \App\Helper::img($blog->featured_image) }}"
                                            alt="{{ $blog->title }}">
                                    </div>
                                    <div class="tablet-slide-info">
                                        <span class="tablet-meta">{{ $blog->author->name ?? 'Admin' }} &nbsp;&bull;&nbsp;
                                            {{ $blog->created_at->format('d F Y') }}</span>
                                        <h6><a
                                                href="{{ route('front.blog.details', $blog->slug) }}">{{ $blog->title }}</a>
                                        </h6>
                                        <p>
                                            {{ \Illuminate\Support\Str::limit(strip_tags($blog->excerpt), 100) }}
                                        </p>
                                        <a href="{{ route('front.blog.details', $blog->slug) }}"
                                            class="tablet-slide-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tablet-home-btn"></div>
                        </div>
                        <div class="tablet-shadow"></div>
                    </div>
                @empty
                    <p class="text-center text-muted">Blog posts will be listed here shortly.</p>
                @endforelse

            </div>

        </div>

    </section>
    <!-- End Latest Blog Section -->

    <!--========================================
                            Testimonials
                =========================================-->

    <!-- Start Testimonials Section -->
    @php
        $testimonialsSection = $homePage?->sections->firstWhere('slug', 'testimonials-section');
        $testimonialsContent = $testimonialsSection ? $sectionContents[$testimonialsSection->id] ?? [] : [];
    @endphp
    <section class="testimonials">

        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        @include('front.partials._section_heading', [
                            'content' => $testimonialsContent,
                            'defaultTitle' => \App\Helper::sectionTitle(
                                'home',
                                'testimonials',
                                'title',
                                'WHAT OUR CLIENTS SAY'),
                            'defaultSubtitle' => \App\Helper::sectionTitle('home', 'testimonials', 'subtitle'),
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

                            @forelse ($testimonials as $testimonial)
                                <div class="testimonial">
                                    <div class="testimonial-img">
                                        <img src="{{ \App\Helper::img($testimonial->photo) }}"
                                            alt="{{ $testimonial->name }}">
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


    <!--========================================
                                FAQ SECTION
                =========================================-->

    <!-- Start FAQ and Contact Section -->
    @php
        $faqSection = $homePage?->sections->firstWhere('slug', 'faq-section');
        $faqSectionContent = $faqSection ? $sectionContents[$faqSection->id] ?? [] : [];
    @endphp
    <section id="faq-section" class="faq-section">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        @include('front.partials._section_heading', [
                            'content' => $faqSectionContent,
                            'defaultTitle' => \App\Helper::sectionTitle(
                                'home',
                                'faq',
                                'title',
                                'Frequently Asked Questions'),
                            'defaultSubtitle' => \App\Helper::sectionTitle('home', 'faq', 'subtitle'),
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

                                    @forelse ($category->faqs ?? [] as $faq)
                                        <div class="faq-item @if ($loop->first) active @endif">
                                            <div class="faq-title">
                                                <h5>{{ $faq->question }}</h5>
                                                <span class="faq-icon">
                                                    <i class="fa fa-{{ $loop->first ? 'minus' : 'plus' }}"></i>
                                                </span>
                                            </div>

                                            <div class="faq-content"
                                                @if ($loop->first) style="display:block;" @endif>
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
    <!-- End FAQ and Contact Section -->
@endsection
