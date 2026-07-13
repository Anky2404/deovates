@extends('front.layouts.app')
@section('content')
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
                                        Deovate
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
    <!-- slider Area End-->
    <!-- about section start -->
    <section class="about" id="about">
        <div class="container">

            <div class="row">
                <div class="col-md-12">

                    <div class="section-title st-center">

                        <h3>WELCOME TO <span>DEOVATE WORLD</span></h3>

                        <p>
                            Building Modern Websites, Smart Software & Digital Solutions
                            That Help Businesses Grow Faster.
                        </p>

                    </div>

                    <div class="row align-items-center mb90">

                        <div class="col-lg-6 col-md-6">

                            {{-- <h2 class="about-title">
                            Your Trusted Partner for Digital Innovation &
                            Business Growth
                        </h2> --}}

                            <p class="about-text">

                                At <strong>Deovate World</strong>, we build powerful digital
                                solutions that help businesses establish a strong online
                                presence, improve customer engagement, and achieve
                                sustainable growth. From custom websites and enterprise
                                software to eCommerce platforms and SEO-driven digital
                                strategies, every solution is carefully designed to deliver
                                performance, security, scalability, and measurable business
                                results.

                            </p>

                            <div class="row mt-4">

                                <div class="col-sm-6">

                                    <ul class="about-list">

                                        <li>
                                            <i class="fa fa-check-circle"></i>
                                            Custom Website Development
                                        </li>

                                        <li>
                                            <i class="fa fa-check-circle"></i>
                                            Business Software Solutions
                                        </li>

                                        <li>
                                            <i class="fa fa-check-circle"></i>
                                            Responsive UI/UX Design
                                        </li>

                                        <li>
                                            <i class="fa fa-check-circle"></i>
                                            eCommerce Development
                                        </li>

                                    </ul>

                                </div>

                                <div class="col-sm-6">

                                    <ul class="about-list">

                                        <li>
                                            <i class="fa fa-check-circle"></i>
                                            Search Engine Optimization
                                        </li>

                                        <li>
                                            <i class="fa fa-check-circle"></i>
                                            Secure & Scalable Solutions
                                        </li>

                                        <li>
                                            <i class="fa fa-check-circle"></i>
                                            API Integrations
                                        </li>

                                        <li>
                                            <i class="fa fa-check-circle"></i>
                                            Ongoing Technical Support
                                        </li>

                                    </ul>

                                </div>

                            </div>

                            <div class="mt-4">

                                <a href="#" class="btn btn-main">

                                    Let's Build Together

                                </a>

                            </div>

                        </div>

                        <div class="col-lg-6 col-md-6 text-center">

                            <img src="{{ asset('assets/front/img/about.png') }}" alt="Professional Web Development Company"
                                class="img-responsive about-img">

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>
    <!-- about section end -->

    <!-- Counter Facts Start -->
    <section class="counter container-fluid service overflow-hidden pt-5" id="counter">
        <div class="container-fluid counter-facts py-5">
            <div class="container py-1">
                <div class="row mb-30">
                    <div class="col-12">
                        <div class="section-title st-center">

                            <h3>OUR ACHIEVEMENTS</h3>

                            <p>
                                Delivering Reliable Digital Solutions That Create Real Business Impact
                            </p>

                        </div>

                    </div>
                </div>

                <div class="row g-4">

                    <!-- Projects -->
                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">


                        <div class="counter">

                            <div class="counter-icon">
                                <i class="fas fa-laptop"></i>
                            </div>

                            <div class="counter-content">

                                <h3>Projects Delivered</h3>

                                <div class="d-flex align-items-center justify-content-center">

                                    <span class="counter-value" data-toggle="counter-up">
                                        50
                                    </span>

                                    <h4 class="text-secondary mb-0" style="font-weight:600;font-size:25px;">
                                        +
                                    </h4>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Happy Clients -->

                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp" data-wow-delay="0.3s">

                        <div class="counter">

                            <div class="counter-icon">
                                <i class="fas fa-users"></i>
                            </div>

                            <div class="counter-content">

                                <h3>Happy Clients</h3>

                                <div class="d-flex align-items-center justify-content-center">

                                    <span class="counter-value" data-toggle="counter-up">
                                        35
                                    </span>

                                    <h4 class="text-secondary mb-0" style="font-weight:600;font-size:25px;">
                                        +
                                    </h4>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Technologies -->

                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp" data-wow-delay="0.5s">

                        <div class="counter">

                            <div class="counter-icon">
                                <i class="fas fa-code"></i>
                            </div>

                            <div class="counter-content">

                                <h3>Technologies Used</h3>

                                <div class="d-flex align-items-center justify-content-center">

                                    <span class="counter-value" data-toggle="counter-up">
                                        15
                                    </span>

                                    <h4 class="text-secondary mb-0" style="font-weight:600;font-size:25px;">
                                        +
                                    </h4>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Support -->

                    <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp" data-wow-delay="0.7s">

                        <div class="counter">

                            <div class="counter-icon">
                                <i class="fas fa-server"></i>
                            </div>

                            <div class="counter-content">

                                <h3>Technical Support</h3>

                                <div class="d-flex align-items-center justify-content-center">

                                    <span class="counter-value">
                                        24
                                    </span>

                                    <h4 class="text-secondary mb-0" style="font-weight:600;font-size:25px;">
                                        /7
                                    </h4>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- Counter Facts End -->
    <!-- about section start -->
    <section class="services container-fluid service overflow-hidden pt-5" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title st-center">
                        <h3>OUR SERVICES</h3>
                        <p>
                            Innovative Digital Solutions Designed to Accelerate Business Growth
                        </p>
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
                                                    <a href="#" class="h4 text-white mb-0">{{ $service->title }}</a>
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
    <!-- about section end -->
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

    <section class="clients py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        <h3>TECHNOLOGIES WE WORK WITH</h3>

                        <p>
                            Building modern, secure, and scalable digital solutions using trusted technologies and
                            industry-leading platforms.
                        </p>
                    </div>
                </div>
            </div>
            <div class="clients-carousel owl-carousel owl-theme">
                <div class="item">
                    <img src="{{ asset('assets/front/img/client.png') }}" class="img-fluid" alt="Client 1">
                </div>
                <div class="item">
                    <img src="{{ asset('assets/front/img/client2.png') }}" class="img-fluid" alt="Client 2">
                </div>
                <div class="item">
                    <img src="{{ asset('assets/front/img/client3.png') }}" class="img-fluid" alt="Client 3">
                </div>
                <div class="item">
                    <img src="{{ asset('assets/front/img/client4.png') }}" class="img-fluid" alt="Client 4">
                </div>
                <div class="item">
                    <img src="{{ asset('assets/front/img/client5.png') }}" class="img-fluid" alt="Client 5">
                </div>
                <div class="item">
                    <img src="{{ asset('assets/front/img/client6.png') }}" class="img-fluid" alt="Client 6">
                </div>
                <div class="item">
                    <img src="{{ asset('assets/front/img/client7.png') }}" class="img-fluid" alt="Client 7">
                </div>
                <div class="item">
                    <img src="{{ asset('assets/front/img/client8.png') }}" class="img-fluid" alt="Client 8">
                </div>
                <div class="item">
                    <img src="{{ asset('assets/front/img/client9.png') }}" class="img-fluid" alt="Client 9">
                </div>
            </div>
        </div>
    </section>


    <section class="why-choose-us features bg-grey py-5" id="why-choose-us">
        <div class="container-fluid py-5">
            <div class="container py-5">

                <!-- Section Title -->
                <div class="row">
                    <div class="col-12">
                        <div class="section-title st-center">
                            <h3>WHY CHOOSE DEOVATE WORLD</h3>
                            <p>
                                Experience, Innovation, and Technology Combined to Deliver Reliable Digital Solutions That
                                Help Businesses Grow with Confidence.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Item 1 -->
                <div class="service-item service-item-left">
                    <div class="row g-0 align-items-center">

                        <div class="col-md-5">
                            <div class="service-img p-5 wow fadeInRight" data-wow-delay="0.2s">
                                <img class="img-fluid rounded-circle" src="{{ asset('assets/front/img/why-1.png') }}"
                                    alt="Custom Digital Strategy">
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="service-text px-5 py-md-5 wow fadeInRight" data-wow-delay="0.5s">

                                <h3 class="text-uppercase">
                                    Custom, Data-Driven Strategies
                                </h3>

                                <p class="mb-4">
                                    Every successful project starts with understanding your business goals. We create
                                    customized digital strategies backed by market research, customer insights, and modern
                                    technologies to deliver solutions that improve engagement, increase conversions, and
                                    support long-term business growth.
                                </p>

                                <a class="btn btn-outline-primary border-2 px-4"
                                    href="{{ route('front.contact.index') }}">
                                    Start Your Project
                                    <i class="fa fa-arrow-right ms-1"></i>
                                </a>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- Item 2 -->

                <div class="service-item service-item-right">

                    <div class="row g-0 align-items-center">

                        <div class="col-md-5 order-md-1 text-md-end">

                            <div class="service-img p-5 wow fadeInLeft" data-wow-delay="0.2s">

                                <img class="img-fluid rounded-circle" src="{{ asset('assets/front/img/why-2.png') }}"
                                    alt="Expert Development Team">

                            </div>

                        </div>

                        <div class="col-md-7">

                            <div class="service-text px-5 py-md-5 text-md-end wow fadeInLeft" data-wow-delay="0.5s">

                                <h3 class="text-uppercase">

                                    Expert Team

                                </h3>

                                <p class="mb-4">

                                    Our experienced developers, designers, and technology specialists work together to build
                                    secure, scalable, and high-performing digital products. Every solution is developed
                                    using modern frameworks, clean coding standards, and industry best practices to ensure
                                    outstanding performance.

                                </p>

                                <a class="btn btn-outline-primary border-2 px-4"
                                    href="{{ route('front.contact.index') }}">

                                    Talk to Our Experts

                                    <i class="fa fa-arrow-right ms-1"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Item 3 -->

                <div class="service-item service-item-left">

                    <div class="row g-0 align-items-center">

                        <div class="col-md-5">

                            <div class="service-img p-5 wow fadeInRight" data-wow-delay="0.2s">

                                <img class="img-fluid rounded-circle" src="{{ asset('assets/front/img/why-3.png') }}"
                                    alt="Industry Expertise">

                            </div>

                        </div>

                        <div class="col-md-7">

                            <div class="service-text px-5 py-md-5 wow fadeInRight" data-wow-delay="0.5s">

                                <h3 class="text-uppercase">

                                    Proven Expertise Across Industries

                                </h3>

                                <p class="mb-4">

                                    We help startups, growing businesses, and enterprises build reliable websites, business
                                    software, eCommerce platforms, and digital solutions tailored to their industry needs.
                                    Our practical experience enables us to solve real business challenges through innovative
                                    technology.

                                </p>

                                <a class="btn btn-outline-primary border-2 px-4"
                                    href="{{ route('front.contact.index') }}">

                                    Explore Our Expertise

                                    <i class="fa fa-arrow-right ms-1"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Item 4 -->

                <div class="service-item service-item-right">

                    <div class="row g-0 align-items-center">

                        <div class="col-md-5 order-md-1 text-md-end">

                            <div class="service-img p-5 wow fadeInLeft" data-wow-delay="0.2s">

                                <img class="img-fluid rounded-circle" src="{{ asset('assets/front/img/why-4.png') }}"
                                    alt="Long Term Support">

                            </div>

                        </div>

                        <div class="col-md-7">

                            <div class="service-text px-5 py-md-5 text-md-end wow fadeInLeft" data-wow-delay="0.5s">

                                <h3 class="text-uppercase">

                                    Long-Term Partnership & Support

                                </h3>

                                <p class="mb-4">

                                    We believe in building long-term relationships with our clients. From regular
                                    maintenance and security updates to performance optimization and technical support, we
                                    ensure your digital solutions continue to perform efficiently as your business evolves.

                                </p>

                                <a class="btn btn-outline-primary border-2 px-4"
                                    href="{{ route('front.contact.index') }}">

                                    Let's Build Together

                                    <i class="fa fa-arrow-right ms-1"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>


    <section class="roadmap-area section-padding" id="roadmap">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="heading">
                    <h5>Our Development Process</h5>
                    <div class="space-10"></div>
                    <h1>From Vision to Digital Success</h1>
                    <p class="mt-3">
                        At Deovate World, every successful project follows a proven development process.
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



    <section class="portfolio" id="portfolio">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 no-padding">
                    <div class="section-title st-center">
                        <h3>What we have done</h3>
                        <p>Avocent deditum long</p>
                    </div>
                    <div class="filter mb40">
                        <form id="filter">
                            <fieldset class="group">
                                <label class="btn btn-default btn-main">
                                    <input type="radio" name="filter" value="all" checked="checked">All
                                </label>
                                @foreach ($portfolio_categories as $category)
                                     <label class="btn btn-default">
                                    <input type="radio" name="filter" value="{{ $category->slug }}" checked="checked">{{ $category->name }}
                                </label>
                                @endforeach


                            </fieldset>
                        </form>
                        <!-- #filter -->
                    </div>
                    <!-- .filter .mb40 -->
                    <div class="grid">
                        @foreach ($portfolios as $portfolio)
                        <figure class="portfolio-item" data-groups='["{{ $portfolio->category->slug }}"]'>
                            <img src="{{ !empty($portfolio['featured_image']) ? asset('storage/' . $portfolio['featured_image']) : asset('assets/front/img/default-img.png') }}" alt="">
                            <figcaption>
                                <h2>{{ $portfolio->title }}
                                    {{-- <span>Lily</span> --}}
                                </h2>
                                <p>{!! $portfolio->description !!}</p>
                                <a href="{{ route('front.portfolios.details',['slug' => $portfolio->slug]) }}" class="btn btn-main">
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

<section class="technologies" id="technologies">

    <div class="container-fluid features overflow-hidden py-5">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        <h3>Technologies We Work With</h3>
                        <p>
                            We leverage modern technologies, powerful frameworks, and industry-leading tools to build secure, scalable, and high-performance digital solutions for businesses of every size.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-4 justify-content-center">

                @forelse($technologies as $technology)

                    <div class="col-lg-3 col-md-6 wow fadeInUp"
                        data-wow-delay="{{ $loop->iteration * 0.2 }}s">

                        <div class="feature-item text-center p-4 h-100">

                            <div class="feature-icon mb-4">

                                @if(!empty($technology->image))

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

                                @if(!empty($technology->website_url))

                                    <a href="{{ $technology->website_url }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="btn btn-secondary rounded-pill">

                                        Official Website

                                        <i class="fas fa-external-link-alt ms-2"></i>

                                    </a>

                                @else

                                    <a href="#"
                                        class="btn btn-secondary rounded-pill">

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

            @if($technologies->count() >= 8)

                <div class="text-center mt-5">

                    <a href="#"
                        class="btn btn-primary rounded-pill py-3 px-5">

                        View All Technologies

                    </a>

                </div>

            @endif

        </div>
    </div>

</section>



    <section class="industries" id="industries">

    <div class="container-fluid training overflow-hidden bg-light py-5">
        <div class="container py-5">

            <!-- Section Title -->
            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        <h3>INDUSTRIES WE SERVE</h3>

                        <p>
                            Delivering innovative web development, business software,
                            and digital transformation solutions tailored to the
                            unique needs of businesses across diverse industries.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-4">

                @forelse($industries as $industry)

                    <div class="col-lg-6 col-md-6 col-xl-3 wow fadeInUp"
                        data-wow-delay="{{ $loop->iteration * 0.2 }}s">

                        <div class="training-item">

                            <div class="training-inner">

                                <img
                                    src="{{ !empty($industry->image) ? asset('storage/'.$industry->image) : asset('assets/front/img/default-img.png') }}"
                                    class="img-fluid w-100 rounded"
                                    alt="{{ $industry->name }}">

                                <div class="training-title-name">

                                    <a href="#"
                                        class="h4 text-white mb-0">

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

                                    {{ \Illuminate\Support\Str::limit(strip_tags($industry->description),110) }}

                                </p>

                                <a class="btn btn-secondary rounded-pill text-white p-0"
                                    href="#">

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

            @if($industries->count() >= 8)

                <div class="text-center mt-5">

                    <a href="#"
                        class="btn btn-primary border-secondary rounded-pill py-3 px-5">

                        View All Industries

                    </a>

                </div>

            @endif

        </div>
    </div>

</section>


<section class="funfacts" data-stellar-background-ratio="0.4">
    <div class="container">

        <div class="row">
            <div class="col-12">
                <div class="section-title st-center">
                    <h3>OUR ACHIEVEMENTS</h3>

                    <p>
                        Delivering innovative digital solutions with a strong focus on quality,
                        performance, and long-term client success.
                    </p>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Projects -->
            <div class="col-md-3">
                <div class="funfact">

                    <div class="st-funfact-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>

                    <div class="st-funfact-counter">
                        <span class="st-ff-count"
                            data-from="0"
                            data-to="50"
                            data-runit="1">50</span>+
                    </div>

                    <strong class="funfact-title">
                        Projects Delivered
                    </strong>

                </div>
            </div>

            <!-- Clients -->

            <div class="col-md-3">

                <div class="funfact">

                    <div class="st-funfact-icon">
                        <i class="fas fa-users"></i>
                    </div>

                    <div class="st-funfact-counter">
                        <span class="st-ff-count"
                            data-from="0"
                            data-to="35"
                            data-runit="1">35</span>+
                    </div>

                    <strong class="funfact-title">
                        Happy Clients
                    </strong>

                </div>

            </div>

            <!-- Technologies -->

            <div class="col-md-3">

                <div class="funfact">

                    <div class="st-funfact-icon">
                        <i class="fas fa-code"></i>
                    </div>

                    <div class="st-funfact-counter">
                        <span class="st-ff-count"
                            data-from="0"
                            data-to="25"
                            data-runit="1">25</span>+
                    </div>

                    <strong class="funfact-title">
                        Technologies
                    </strong>

                </div>

            </div>

            <!-- Support -->

            <div class="col-md-3">

                <div class="funfact">

                    <div class="st-funfact-icon">
                        <i class="fas fa-headset"></i>
                    </div>

                    <div class="st-funfact-counter">

                        <span class="st-ff-count"
                            data-from="0"
                            data-to="24"
                            data-runit="1">24</span>/7

                    </div>

                    <strong class="funfact-title">
                        Technical Support
                    </strong>

                </div>

            </div>

        </div>

    </div>
</section>


    {{-- <section class="funfacts" data-stellar-background-ratio="0.4" style="background-position: 50% 47.58px;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        <h3>Industries</h3>
                        <p>Avocent deditum long</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="funfact">
                        <div class="st-funfact-icon"><i class="fa fa-briefcase"></i></div>
                        <div class="st-funfact-counter"><span class="st-ff-count" data-from="0" data-to="25964"
                                data-runit="1">25964</span>+</div>
                        <strong class="funfact-title">Projects</strong>
                    </div><!-- .funfact -->
                </div>
                <div class="col-md-3">
                    <div class="funfact">
                        <div class="st-funfact-icon"><i class="fa fa-clock-o"></i></div>
                        <div class="st-funfact-counter"><span class="st-ff-count" data-from="0" data-to="35469"
                                data-runit="1">35469</span>+</div>
                        <strong class="funfact-title">Hours Work</strong>
                    </div><!-- .funfact -->
                </div>
                <div class="col-md-3">
                    <div class="funfact">
                        <div class="st-funfact-icon"><i class="fa fa-send"></i></div>
                        <div class="st-funfact-counter"><span class="st-ff-count" data-from="0" data-to="86214"
                                data-runit="1">86214</span>+</div>
                        <strong class="funfact-title">E-mail</strong>
                    </div><!-- .funfact -->
                </div>
                <div class="col-md-3">
                    <div class="funfact">
                        <div class="st-funfact-icon"><i class="fa fa-magic"></i></div>
                        <div class="st-funfact-counter"><span class="st-ff-count" data-from="0" data-to="3647"
                                data-runit="1">3647</span>+</div>
                        <strong class="funfact-title">Completed</strong>
                    </div><!-- .funfact -->
                </div>
            </div>
        </div>
    </section> --}}


    <section id="team-section">
        <div class="container-fluid training overflow-hidden bg-light py-5">
            <div class="container py-5">

                <div class="row">
                    <div class="col-12">
                        <div class="section-title st-center">
                            <h3>Industries</h3>
                            <p>Avocent deditum long</p>
                        </div>
                    </div>
                </div>

                <div class="phones-carousel owl-carousel wow fadeInUp" data-wow-delay="0.1s">

                    <div class="phone-mockup">
                        <div class="phone-frame">
                            <div class="phone-notch"></div>
                            <div class="phone-screen">
                                <div class="phone-statusbar">
                                    <span class="phone-brand">Deovate</span>
                                </div>
                                <div class="phone-slide">
                                    <div class="phone-slide-img">
                                        <img src="{{ asset('assets/front/img/team/1.jpg') }}" alt="Healthcare">
                                        <div class="phone-slide-overlay">
                                            <h4>Healthcare</h4>
                                            <span>Industry</span>
                                            <p>Healthcare software, HMS, Telemedicine, EMR & Patient Management.</p>
                                        </div>
                                    </div>
                                    <div class="phone-slide-info">
                                        <h6>Healthcare</h6>
                                        <a href="#" class="phone-slide-btn">View Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="phone-home-indicator"></div>
                        </div>
                        <div class="phone-shadow"></div>
                    </div>

                    <div class="phone-mockup">
                        <div class="phone-frame">
                            <div class="phone-notch"></div>
                            <div class="phone-screen">
                                <div class="phone-statusbar">
                                    <span class="phone-brand">Deovate</span>
                                </div>
                                <div class="phone-slide">
                                    <div class="phone-slide-img">
                                        <img src="{{ asset('assets/front/img/team/2.jpg') }}" alt="E-Commerce">
                                        <div class="phone-slide-overlay">
                                            <h4>E-Commerce</h4>
                                            <span>Industry</span>
                                            <p>Custom Ecommerce, Marketplace, Inventory, Payment Gateway.</p>
                                        </div>
                                    </div>
                                    <div class="phone-slide-info">
                                        <h6>E-Commerce</h6>
                                        <a href="#" class="phone-slide-btn">View Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="phone-home-indicator"></div>
                        </div>
                        <div class="phone-shadow"></div>
                    </div>

                    <div class="phone-mockup">
                        <div class="phone-frame">
                            <div class="phone-notch"></div>
                            <div class="phone-screen">
                                <div class="phone-statusbar">
                                    <span class="phone-brand">Deovate</span>
                                </div>
                                <div class="phone-slide">
                                    <div class="phone-slide-img">
                                        <img src="{{ asset('assets/front/img/team/3.jpg') }}" alt="Education">
                                        <div class="phone-slide-overlay">
                                            <h4>Education</h4>
                                            <span>Industry</span>
                                            <p>School ERP, LMS, Online Classes, Student Management System.</p>
                                        </div>
                                    </div>
                                    <div class="phone-slide-info">
                                        <h6>Education</h6>
                                        <a href="#" class="phone-slide-btn">View Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="phone-home-indicator"></div>
                        </div>
                        <div class="phone-shadow"></div>
                    </div>

                </div>

            </div>
        </div>
    </section>


     <section class="call-us">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="call-us-inner wow fadeInUp" data-wow-delay="0.1s">
                        <span class="call-us-kicker">Let's Talk</span>
                        <h3>If You Like To Work With Us</h3>
                        <p class="call-us-sub">
                            Get in touch and let's discuss how we can bring your idea to life.
                        </p>
                        <div class="call-us-actions">
                            <a href="tel:{{ config('constants.CONTACT.country_code') }}{{ config('constants.CONTACT.phones.0.number') }}"
                                class="btn btn-main btn-lg call-us-btn">
                                <i class="fas fa-phone"></i> Call Us Now
                            </a>
                            <a href="tel:{{ config('constants.CONTACT.country_code') }}{{ config('constants.CONTACT.phones.0.number') }}"
                                class="call-us-number">
                                {{ config('constants.CONTACT.country_code') }} {{ config('constants.CONTACT.phones.0.number') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="casestudies">
        <div class="container-fluid contact overflow-hidden pb-5">
            <div class="container py-5">

                <!-- Section Title -->
                <div class="row">
                    <div class="col-12">
                        <div class="section-title st-center">
                            <h3>Industries We Serve</h3>
                            <p>Delivering innovative solutions across multiple industries.</p>
                        </div>
                    </div>
                </div>

                <!-- Owl Carousel -->
                <div class="office-carousel owl-carousel owl-theme">

                    <!-- Item 1 -->
                    <div class="office-item">
                        <div class="office-img">
                            <img src="{{ asset('assets/front/img/office-2.jpg') }}" class="img-fluid w-100" alt="Healthcare">
                            <span class="office-icon"><i class="fa fa-heartbeat"></i></span>
                        </div>

                        <div class="office-content">
                            <h4>Healthcare</h4>
                            <p>Hospital Management System, Telemedicine, Patient Portal and EMR Solutions.</p>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="office-item">
                        <div class="office-img">
                            <img src="{{ asset('assets/front/img/office-1.jpg') }}" class="img-fluid w-100" alt="E-Commerce">
                            <span class="office-icon"><i class="fa fa-shopping-cart"></i></span>
                        </div>

                        <div class="office-content">
                            <h4>E-Commerce</h4>
                            <p>Online Stores, Multi Vendor Marketplace, Inventory & Payment Gateway.</p>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="office-item">
                        <div class="office-img">
                            <img src="{{ asset('assets/front/img/office-3.jpg') }}" class="img-fluid w-100" alt="Education">
                            <span class="office-icon"><i class="fa fa-graduation-cap"></i></span>
                        </div>

                        <div class="office-content">
                            <h4>Education</h4>
                            <p>Learning Management Systems, Student Portals and Online Examination.</p>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="office-item">
                        <div class="office-img">
                            <img src="{{ asset('assets/front/img/office-4.jpg') }}" class="img-fluid w-100" alt="Real Estate">
                            <span class="office-icon"><i class="fa fa-building"></i></span>
                        </div>

                        <div class="office-content">
                            <h4>Real Estate</h4>
                            <p>Property Management, CRM and Real Estate Listing Platforms.</p>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </section>


    <section class="subscribe">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        <h3>Industries</h3>
                        <p>Avocent deditum long</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <form role="form" class="subscribe-form" novalidate="true">
                        <div class="input-group">
                            <input type="email" class="form-control" id="mc-email" placeholder="Enter E-mail..."
                                name="EMAIL">
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

    <!--=================================
                Latest Blog Section
        ==================================-->
    <section id="blog-section" class="section-padding">

        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        <h3>Industries</h3>
                        <p>Avocent deditum long</p>
                    </div>
                </div>
            </div>

            <div class="tablets-carousel owl-carousel wow fadeInUp" data-wow-delay="0.1s">

                <!-- Blog 1 -->
                <div class="tablet-mockup">
                    <div class="tablet-frame">
                        <div class="tablet-cam"></div>
                        <div class="tablet-screen">
                            <div class="tablet-statusbar">
                                <span class="phone-brand">Deovate Blog</span>
                            </div>
                            <div class="tablet-slide">
                                <div class="tablet-slide-img">
                                    <img src="{{ asset('assets/front/img/blog/1.jpg') }}" alt="Top Web Development Trends in 2026">
                                </div>
                                <div class="tablet-slide-info">
                                    <span class="tablet-meta">Admin &nbsp;&bull;&nbsp; 05 July 2026</span>
                                    <h6><a href="blog-details.html">Top Web Development Trends in 2026</a></h6>
                                    <p>
                                        Discover the latest technologies including AI, Laravel,
                                        React and cloud computing that are transforming modern businesses.
                                    </p>
                                    <a href="blog-details.html" class="tablet-slide-btn">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="tablet-home-btn"></div>
                    </div>
                    <div class="tablet-shadow"></div>
                </div>

                <!-- Blog 2 -->
                <div class="tablet-mockup">
                    <div class="tablet-frame">
                        <div class="tablet-cam"></div>
                        <div class="tablet-screen">
                            <div class="tablet-statusbar">
                                <span class="phone-brand">Deovate Blog</span>
                            </div>
                            <div class="tablet-slide">
                                <div class="tablet-slide-img">
                                    <img src="{{ asset('assets/front/img/blog/2.jpg') }}" alt="Laravel vs Node.js — Complete Comparison">
                                </div>
                                <div class="tablet-slide-info">
                                    <span class="tablet-meta">Admin &nbsp;&bull;&nbsp; 02 July 2026</span>
                                    <h6><a href="blog-details.html">Laravel vs Node.js — Complete Comparison</a></h6>
                                    <p>
                                        Which framework is best for your next enterprise project?
                                        Let's compare Laravel and Node.js in depth.
                                    </p>
                                    <a href="blog-details.html" class="tablet-slide-btn">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="tablet-home-btn"></div>
                    </div>
                    <div class="tablet-shadow"></div>
                </div>

                <!-- Blog 3 -->
                <div class="tablet-mockup">
                    <div class="tablet-frame">
                        <div class="tablet-cam"></div>
                        <div class="tablet-screen">
                            <div class="tablet-statusbar">
                                <span class="phone-brand">Deovate Blog</span>
                            </div>
                            <div class="tablet-slide">
                                <div class="tablet-slide-img">
                                    <img src="{{ asset('assets/front/img/blog/3.jpg') }}" alt="Why Every Business Needs a Professional Website">
                                </div>
                                <div class="tablet-slide-info">
                                    <span class="tablet-meta">Admin &nbsp;&bull;&nbsp; 28 June 2026</span>
                                    <h6><a href="blog-details.html">Why Every Business Needs a Professional Website</a></h6>
                                    <p>
                                        Learn how a professional website increases trust,
                                        sales and online visibility.
                                    </p>
                                    <a href="blog-details.html" class="tablet-slide-btn">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="tablet-home-btn"></div>
                    </div>
                    <div class="tablet-shadow"></div>
                </div>

                <!-- Blog 4 -->
                <div class="tablet-mockup">
                    <div class="tablet-frame">
                        <div class="tablet-cam"></div>
                        <div class="tablet-screen">
                            <div class="tablet-statusbar">
                                <span class="phone-brand">Deovate Blog</span>
                            </div>
                            <div class="tablet-slide">
                                <div class="tablet-slide-img">
                                    <img src="{{ asset('assets/front/img/blog/4.jpg') }}" alt="SEO Strategies That Actually Work">
                                </div>
                                <div class="tablet-slide-info">
                                    <span class="tablet-meta">Admin &nbsp;&bull;&nbsp; 25 June 2026</span>
                                    <h6><a href="blog-details.html">SEO Strategies That Actually Work</a></h6>
                                    <p>
                                        Improve your rankings using the latest SEO
                                        techniques and optimization strategies.
                                    </p>
                                    <a href="blog-details.html" class="tablet-slide-btn">Read More</a>
                                </div>
                            </div>
                        </div>
                        <div class="tablet-home-btn"></div>
                    </div>
                    <div class="tablet-shadow"></div>
                </div>

            </div>

        </div>

    </section>

    <!--========================================
                    Testimonials
        =========================================-->

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
                        <span class="laptop-url">deovate.world/reviews</span>
                    </div>
                    <div class="laptop-screen-glass testi-glass">
                        <div class="laptop-shine"></div>
                        <div class="testimonials-carousel owl-carousel owl-theme">

                            <!-- Testimonial 1 -->
                            <div class="testimonial">
                                <div class="testimonial-img">
                                    <img src="{{ asset('assets/front/img/testimonial/Homepage_testi.png') }}" alt="John Anderson">
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
                                    <img src="{{ asset('assets/front/img/testimonial/1.png') }}" alt="Sarah Williams">
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
                                    <img src="{{ asset('assets/front/img/testimonial/Homepage_testi.png') }}" alt="Michael Brown">
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


    <!--========================================
                        FAQ SECTION
        =========================================-->

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
                                    <span class="phone-brand">Deovate</span>
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
                                    <span class="phone-brand">Deovate</span>
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
@endsection
