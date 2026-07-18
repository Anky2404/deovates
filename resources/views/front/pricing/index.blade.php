@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.pricing.title'))
@section('meta_description', config('constants.PAGE_SEO.pricing.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.pricing.meta_keywords'))
@section('content')

    @php
        $pricingSection = $page?->sections->firstWhere('slug', 'pricing-listing-section');
        $pricingContent = $pricingSection ? $sectionContents[$pricingSection->id] ?? [] : [];
        $plans = $pricingContent['group_data']['pricing_plans'] ?? [];

        if (empty($plans)) {
            $plans = [
                [
                    'plan_name' => 'Starter', 'plan_price' => '$999', 'plan_period' => 'starting at',
                    'plan_description' => 'A focused website or landing page to get your business online fast.',
                    'plan_features' => "Up to 5 pages\nResponsive design\nBasic SEO setup\nContact form integration\n2 weeks delivery",
                    'plan_highlight' => '0', 'plan_button_text' => 'Get Started', 'plan_button_link' => route('front.contact.index'),
                ],
                [
                    'plan_name' => 'Growth', 'plan_price' => '$2,999', 'plan_period' => 'starting at',
                    'plan_description' => 'A full-featured website or web app for businesses ready to scale.',
                    'plan_features' => "Up to 15 pages\nCustom UI/UX design\nCMS / admin panel\nAdvanced SEO & analytics\nPriority support\n4-6 weeks delivery",
                    'plan_highlight' => '1', 'plan_button_text' => 'Get Started', 'plan_button_link' => route('front.contact.index'),
                ],
                [
                    'plan_name' => 'Enterprise', 'plan_price' => 'Custom', 'plan_period' => "let's talk",
                    'plan_description' => 'Custom software, integrations, and dedicated teams for complex needs.',
                    'plan_features' => "Unlimited pages / modules\nCustom software development\nThird-party integrations\nDedicated project manager\nOngoing maintenance & support",
                    'plan_highlight' => '0', 'plan_button_text' => 'Get Started', 'plan_button_link' => route('front.contact.index'),
                ],
            ];
        }
    @endphp

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
                @include('front.partials._section_heading', [
                    'content' => $pricingContent,
                    'defaultTitle' => \App\Helper::sectionTitle('pricing', 'listing', 'title', 'Plans That Scale With You'),
                    'defaultSubtitle' => \App\Helper::sectionTitle('pricing', 'listing', 'subtitle'),
                ])
            </div>

            <div class="row g-5 justify-content-center align-items-center">
                @foreach ($plans as $plan)
                    @php $highlight = !empty($plan['plan_highlight']) && $plan['plan_highlight'] !== '0'; @endphp
                    <div class="col-sm-6 col-lg-4 wow fadeInUp" data-wow-delay="{{ 0.1 * ($loop->index + 1) }}s">
                        <div class="phone-mockup pricing-phone {{ $highlight ? 'pricing-phone--highlight' : '' }}">
                            @if ($highlight)
                                <span class="pricing-phone-ribbon">Most Popular</span>
                            @endif
                            <div class="phone-frame">
                                <div class="phone-notch"></div>
                                <div class="phone-screen">
                                    <div class="phone-statusbar">
                                        <span class="phone-brand">{{ config('constants.BRAND_NAME') }}</span>
                                    </div>
                                    <div class="pricing-phone-body {{ $highlight ? 'pricing-phone-body--highlight' : '' }}">
                                        <h4>{{ $plan['plan_name'] ?? '' }}</h4>
                                        <p>{{ $plan['plan_description'] ?? '' }}</p>
                                        <div class="pricing-phone-price">
                                            <span class="amount">{{ $plan['plan_price'] ?? '' }}</span>
                                            <span class="period">{{ $plan['plan_period'] ?? '' }}</span>
                                        </div>
                                        <ul class="list-unstyled text-start">
                                            @foreach (preg_split('/\r\n|\r|\n/', $plan['plan_features'] ?? '') as $feature)
                                                @continue(trim($feature) === '')
                                                <li><i class="fas fa-check-circle"></i>{{ trim($feature) }}</li>
                                            @endforeach
                                        </ul>
                                        <a href="{{ $plan['plan_button_link'] ?? route('front.contact.index') }}"
                                            class="btn {{ $highlight ? 'btn-light' : 'btn-main' }} w-100">{{ $plan['plan_button_text'] ?? 'Get Started' }}</a>
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
