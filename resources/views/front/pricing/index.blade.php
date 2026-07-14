@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.pricing.title'))
@section('meta_description', config('constants.PAGE_SEO.pricing.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.pricing.meta_keywords'))
@section('content')

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('pricing.png', 'assets/front/img/hero/h1_hero.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Simple, Transparent Pricing</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Pricing</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Plans That Scale With You Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="section-title st-center">
                <h3>{{ \App\Helper::sectionTitle('pricing', 'listing', 'title', 'Plans That Scale With You') }}</h3>
                <p>{{ \App\Helper::sectionTitle('pricing', 'listing', 'subtitle') }}</p>
            </div>

            @php
                $plans = [
                    [
                        'name' => 'Starter',
                        'price' => '$999',
                        'period' => 'starting at',
                        'description' => 'A focused website or landing page to get your business online fast.',
                        'features' => ['Up to 5 pages', 'Responsive design', 'Basic SEO setup', 'Contact form integration', '2 weeks delivery'],
                        'highlight' => false,
                    ],
                    [
                        'name' => 'Growth',
                        'price' => '$2,999',
                        'period' => 'starting at',
                        'description' => 'A full-featured website or web app for businesses ready to scale.',
                        'features' => ['Up to 15 pages', 'Custom UI/UX design', 'CMS / admin panel', 'Advanced SEO & analytics', 'Priority support', '4-6 weeks delivery'],
                        'highlight' => true,
                    ],
                    [
                        'name' => 'Enterprise',
                        'price' => 'Custom',
                        'period' => 'let\'s talk',
                        'description' => 'Custom software, integrations, and dedicated teams for complex needs.',
                        'features' => ['Unlimited pages / modules', 'Custom software development', 'Third-party integrations', 'Dedicated project manager', 'Ongoing maintenance & support'],
                        'highlight' => false,
                    ],
                ];
            @endphp

            <div class="row g-5 justify-content-center align-items-center">
                @foreach ($plans as $plan)
                    <div class="col-sm-6 col-lg-4 wow fadeInUp" data-wow-delay="{{ 0.1 * ($loop->index + 1) }}s">
                        <div class="phone-mockup pricing-phone {{ $plan['highlight'] ? 'pricing-phone--highlight' : '' }}">
                            @if ($plan['highlight'])
                                <span class="pricing-phone-ribbon">Most Popular</span>
                            @endif
                            <div class="phone-frame">
                                <div class="phone-notch"></div>
                                <div class="phone-screen">
                                    <div class="phone-statusbar">
                                        <span class="phone-brand">Deovate</span>
                                    </div>
                                    <div class="pricing-phone-body {{ $plan['highlight'] ? 'pricing-phone-body--highlight' : '' }}">
                                        <h4>{{ $plan['name'] }}</h4>
                                        <p>{{ $plan['description'] }}</p>
                                        <div class="pricing-phone-price">
                                            <span class="amount">{{ $plan['price'] }}</span>
                                            <span class="period">{{ $plan['period'] }}</span>
                                        </div>
                                        <ul class="list-unstyled text-start">
                                            @foreach ($plan['features'] as $feature)
                                                <li><i class="fas fa-check-circle"></i>{{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                        <a href="{{ route('front.contact.index') }}"
                                            class="btn {{ $plan['highlight'] ? 'btn-light' : 'btn-main' }} w-100">Get
                                            Started</a>
                                    </div>
                                </div>
                                <div class="phone-home-indicator"></div>
                            </div>
                            <div class="phone-shadow"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Plans That Scale With You Section -->

@endsection
