@extends('front.layouts.app')

@section('title', $data['meta_title'] ?? $data['title'] ?? config('constants.PAGE_SEO.services.title'))
@section('meta_description', $data['meta_description'] ?? config('constants.PAGE_SEO.services.meta_description'))
@section('meta_keywords', $data['meta_keywords'] ?? config('constants.PAGE_SEO.services.meta_keywords'))
@section('content')

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ asset('assets/front/img/hero/h2_hero.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Our Services</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Services</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Services Grid Section -->
    <!-- Services grid -->
    @php
        $servicesGridSection = $page?->sections->firstWhere('slug', 'services-grid-section');
        $servicesGridContent = $servicesGridSection ? $sectionContents[$servicesGridSection->id] ?? [] : [];
    @endphp
    <section class="services container-fluid service overflow-hidden py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title st-center">
                        @include('front.partials._section_heading', [
                            'content' => $servicesGridContent,
                            'defaultTitle' => \App\Helper::sectionTitle('services', 'grid', 'title', 'What We Offer'),
                            'defaultSubtitle' => \App\Helper::sectionTitle('services', 'grid', 'subtitle'),
                        ])
                    </div>

                    @if ($services->isEmpty())
                        <p class="text-center text-muted">Services will be listed here shortly.</p>
                    @else
                        <div class="row g-4">
                            @foreach ($services as $service)
                                <div class="col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="service-item">
                                        <div class="service-inner">
                                            <div class="service-img">
                                                <img src="{{ \App\Helper::img($service->featured_image) }}"
                                                    class="img-fluid w-100 rounded" alt="{{ $service->title }}">
                                            </div>
                                            <div class="service-title">
                                                <div class="service-title-name">
                                                    <div class="bg-primary text-center rounded p-3 mx-5 mb-4">
                                                        <a href="{{ route('front.services.details', $service->slug) }}"
                                                            class="h4 text-white mb-0">{{ $service->title }}</a>
                                                    </div>
                                                    <a class="btn bg-light text-secondary rounded-pill py-3 px-5 mb-4"
                                                        href="{{ route('front.services.details', $service->slug) }}">Explore
                                                        More</a>
                                                </div>
                                                <div class="service-content pb-4">
                                                    <a href="{{ route('front.services.details', $service->slug) }}">
                                                        <h4 class="text-white mb-4 py-3">{{ $service->title }}</h4>
                                                    </a>
                                                    <div class="px-4">
                                                        <p class="mb-4">{!! \Illuminate\Support\Str::limit(strip_tags($service->short_description), 110) !!}</p>
                                                        <a class="btn btn-primary border-secondary rounded-pill py-3 px-5"
                                                            href="{{ route('front.services.details', $service->slug) }}">Explore
                                                            More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- End Services Grid Section -->

    <!-- Start Roadmap Section -->
    @php
        $roadmapSection = $page?->sections->firstWhere('slug', 'roadmap-section');
        $roadmapContent = $roadmapSection ? $sectionContents[$roadmapSection->id] ?? [] : [];
        $roadmapSteps = $roadmapContent['group_data']['roadmap_steps'] ?? [];

        if (empty($roadmapSteps)) {
            $roadmapSteps = [
                ['step_icon' => 'fas fa-search', 'step_title' => 'Discovery', 'step_heading' => 'Project Discovery & Consultation', 'step_description' => 'We begin by understanding your business objectives, target audience, and project requirements. Through detailed consultation and market research, we create a clear strategy that aligns technology with your long-term business goals.'],
                ['step_icon' => 'fas fa-paint-brush', 'step_title' => 'Planning', 'step_heading' => 'Planning & UI/UX Design', 'step_description' => 'Our designers and solution architects create intuitive user experiences, interactive prototypes, and scalable system architecture that provide the perfect foundation for successful digital products.'],
                ['step_icon' => 'fas fa-code', 'step_title' => 'Development', 'step_heading' => 'Development & Quality Assurance', 'step_description' => 'Using modern technologies and clean coding standards, our developers build secure, responsive, and scalable solutions. Every feature is thoroughly tested to ensure performance, reliability, and security before launch.'],
                ['step_icon' => 'fas fa-rocket', 'step_title' => 'Launch', 'step_heading' => 'Launch, Growth & Continuous Support', 'step_description' => 'After successful deployment, we continue supporting your business with maintenance, performance optimization, security updates, feature enhancements, and technical assistance to ensure sustainable digital growth.'],
            ];
        }
    @endphp
    <section class="roadmap-area section-padding" id="roadmap">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="heading">
                        <h5>{{ $roadmapContent['section_label'] ?? 'Our Development Process' }}</h5>
                        <div class="space-10"></div>
                        <h1>{{ $roadmapContent['section_title'] ?? \App\Helper::sectionTitle('services', 'roadmap', 'title', 'From Vision to Digital Success') }}</h1>
                        <p class="mt-3">
                            {{ $roadmapContent['section_subtitle'] ?? \App\Helper::sectionTitle('services', 'roadmap', 'subtitle') }}
                        </p>
                    </div>
                    <div class="space-60 d-none d-sm-block"></div>
                </div>
            </div>

            <div class="process-flow">
                @foreach ($roadmapSteps as $step)
                    <div class="process-step wow fadeInLeft" data-wow-delay="{{ 0.1 + ($loop->index * 0.2) }}s"
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
                                    <span class="process-icon"><i class="{{ $step['step_icon'] ?? 'fas fa-check' }}"></i></span>
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

    <!-- Start Testimonials Section -->
    <!-- Testimonials -->
    @php
        $servicesTestimonialsSection = $page?->sections->firstWhere('slug', 'testimonials-section');
        $servicesTestimonialsContent = $servicesTestimonialsSection ? $sectionContents[$servicesTestimonialsSection->id] ?? [] : [];
    @endphp
    @if ($testimonials->isNotEmpty())
        <section class="testimonials">

            <div class="container">

                <div class="row">
                    <div class="col-12">
                        <div class="section-title st-center">
                            @include('front.partials._section_heading', [
                                'content' => $servicesTestimonialsContent,
                                'defaultTitle' => \App\Helper::sectionTitle('services', 'testimonials', 'title', 'What Our Clients Say'),
                                'defaultSubtitle' => \App\Helper::sectionTitle('services', 'testimonials', 'subtitle'),
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
    @php
        $servicesCtaSection = $page?->sections->firstWhere('slug', 'cta-section');
        $servicesCtaContent = $servicesCtaSection ? $sectionContents[$servicesCtaSection->id] ?? [] : [];
    @endphp
    <section class="call-2-acction" data-stellar-background-ratio="0.4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-title st-center">
                        @include('front.partials._section_heading', [
                            'content' => $servicesCtaContent,
                            'defaultTitle' => \App\Helper::sectionTitle('services', 'cta', 'title', "LET'S BUILD SOMETHING EXCEPTIONAL"),
                            'defaultSubtitle' => \App\Helper::sectionTitle('services', 'cta', 'subtitle'),
                        ])
                    </div>

                    <div class="c2a">

                        <p>
                            @if (!empty($servicesCtaContent['cta_paragraph']))
                                {!! $servicesCtaContent['cta_paragraph'] !!}
                            @else
                                Whether you're launching a startup, modernizing your business, or scaling your digital presence,
                                {{ config('constants.BUSINESS.name') }} delivers custom websites, business software, eCommerce platforms, and innovative
                                technology solutions tailored to your goals. Partner with our experienced team to build secure,
                                scalable, and high-performing digital products that create lasting business value.
                            @endif
                        </p>

                        <a href="{{ $servicesCtaContent['btn_links'] ?? route('front.contact.index') }}" class="btn btn-main btn-lg">
                            {{ $servicesCtaContent['btn_text'] ?? 'Start Your Project' }}
                        </a>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End CTA Section -->

    <!-- Start FAQ & Contact Section -->
    @php
        $servicesFaqSection = $page?->sections->firstWhere('slug', 'faq-section');
        $servicesFaqContent = $servicesFaqSection ? $sectionContents[$servicesFaqSection->id] ?? [] : [];
    @endphp
    <section id="faq-section" class="faq-section">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="section-title st-center">
                        @include('front.partials._section_heading', [
                            'content' => $servicesFaqContent,
                            'defaultTitle' => \App\Helper::sectionTitle('services', 'faq', 'title', 'Frequently Asked Questions'),
                            'defaultSubtitle' => \App\Helper::sectionTitle('services', 'faq', 'subtitle'),
                        ])
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
    <!-- End FAQ & Contact Section -->






@endsection
