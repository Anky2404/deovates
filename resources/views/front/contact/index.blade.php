@extends('front.layouts.app')

@section('title', $data['hero']['meta_title'] ?? $data['hero']['title'] ?? config('constants.PAGE_SEO.contact.title'))
@section('meta_description', $data['hero']['meta_description'] ?? config('constants.PAGE_SEO.contact.meta_description'))
@section('meta_keywords', $data['hero']['meta_keywords'] ?? config('constants.PAGE_SEO.contact.meta_keywords'))
@section('content')

    @php
        $heroSection = $page?->sections->firstWhere('slug', 'contact-hero-section');
        $heroContent = $heroSection ? $sectionContents[$heroSection->id] ?? [] : [];

        $formDetailsSection = $page?->sections->firstWhere('slug', 'contact-form-details-section');
        $formDetailsContent = $formDetailsSection ? $sectionContents[$formDetailsSection->id] ?? [] : [];
        $introLines = $formDetailsContent['group_data']['intro_lines'] ?? [];
        if (empty($introLines)) {
            $introLines = collect($data['contact_details']['intro_lines'] ?? [])->map(fn ($l) => ['line_text' => $l])->all();
        }
    @endphp

    @push('preload')
        <link rel="preload" as="image" href="{{ !empty($heroContent['hero_image']) ? asset('storage/' . $heroContent['hero_image']) : \App\Helper::heroBanner('contact.avif', 'assets/front/img/hero/h2_hero.avif') }}" fetchpriority="high">
    @endpush

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ !empty($heroContent['hero_image']) ? asset('storage/' . $heroContent['hero_image']) : \App\Helper::heroBanner('contact.avif', 'assets/front/img/hero/h2_hero.avif') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>{{ $heroContent['section_title'] ?? $data['hero']['title'] }}</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Contact</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Contact Form & Details Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="row g-5 justify-content-center">
                <div class="col-lg-7">
                    <div class="section-title st-start">
                        <h3>{{ $formDetailsContent['form_title'] ?? $data['contact_form']['title'] }}</h3>
                        <p>{{ $formDetailsContent['form_description'] ?? $data['contact_form']['description'] }}</p>
                    </div>

                    <!-- Desktop: form inside a tablet iframe -->
                    <div class="app-tablet contact-form-tablet d-none d-lg-block wow fadeInLeft" data-wow-delay="0.1s">
                        <div class="tablet-frame app-tablet-frame">
                            <div class="tablet-cam"></div>
                            <div class="tablet-screen app-tablet-screen">
                                <div class="tablet-statusbar">
                                    <span class="phone-brand">{{ config('constants.BRAND_NAME') }}</span>
                                </div>
                                <div class="app-screen-header">
                                    <h4>Contact Form</h4>
                                    <p>{{ config('constants.BRAND_NAME') }}/contact</p>
                                </div>
                                @include('front.contact._form-fields', ['prefix' => 'mc'])
                            </div>
                        </div>
                    </div>

                    <!-- Mobile: form inside a phone iframe -->
                    <div class="phone-mockup contact-form-phone d-lg-none wow fadeInUp" data-wow-delay="0.1s"
                        style="max-width:340px;">
                        <div class="phone-frame">
                            <div class="phone-notch"></div>
                            <div class="phone-screen">
                                <div class="phone-statusbar">
                                    <span class="phone-brand">{{ config('constants.BRAND_NAME') }}</span>
                                </div>
                                <div class="app-screen-header">
                                    <h4>Contact Form</h4>
                                    <p>{{ config('constants.BRAND_NAME') }}/contact</p>
                                </div>
                                @include('front.contact._form-fields', ['prefix' => 'mcm'])
                            </div>
                            <div class="phone-home-indicator"></div>
                        </div>
                        <div class="phone-shadow"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                   <div class="section-title st-start">
    <h3>{{ $formDetailsContent['details_title'] ?? $data['contact_details']['title'] }}</h3>
    <p>{{ $formDetailsContent['details_subtitle'] ?? $data['contact_details']['subtitle'] }}</p>
</div>

                    <!-- Contact details styled as a mobile app -->
                    <div class="phone-mockup contact-info-phone wow fadeInRight" data-wow-delay="0.15s">
                        <div class="phone-frame">
                            <div class="phone-notch"></div>
                            <div class="phone-screen">
                                <div class="phone-statusbar">
                                    <span class="phone-brand">{{ config('constants.BRAND_NAME') }}</span>
                                </div>
                                <div class="contact-info-app">
                                    <ul class="list-unstyled mb-3">
                                        @foreach ($introLines as $line)
                                            <li><i class="fas fa-check-circle"></i>{{ $line['line_text'] ?? '' }}</li>
                                        @endforeach
                                    </ul>

                                    <a href="tel:{{ config('constants.CONTACT.country_code') }}{{ config('constants.CONTACT.phones.0.number') }}"
                                        class="contact-info-card">
                                        <span class="contact-info-icon"><i class="fas fa-phone-alt"></i></span>
                                        <span>
                                            <span class="contact-info-label">Call Us</span>
                                            <span class="contact-info-value">{{ config('constants.CONTACT.country_code') }}-{{ config('constants.CONTACT.phones.0.number') }}</span>
                                        </span>
                                    </a>

                                    <a href="mailto:{{ config('constants.CONTACT.emails.0.address') }}"
                                        class="contact-info-card">
                                        <span class="contact-info-icon"><i class="fas fa-envelope"></i></span>
                                        <span>
                                            <span class="contact-info-label">Email Us</span>
                                            <span class="contact-info-value">{{ config('constants.CONTACT.emails.0.address') }}</span>
                                        </span>
                                    </a>

                                    <div class="contact-info-card">
                                        <span class="contact-info-icon"><i class="fas fa-map-marker-alt"></i></span>
                                        <span>
                                            <span class="contact-info-label">Location</span>
                                            <span class="contact-info-value">{{ $formDetailsContent['location'] ?? ($data['contact_details']['location'] ?? 'Ludhiana, Punjab, India') }}</span>
                                        </span>
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
    <!-- End Contact Form & Details Section -->

    <!-- Start Process Section -->
    @php
        $processSection = $page?->sections->firstWhere('slug', 'contact-process-section');
        $processContent = $processSection ? $sectionContents[$processSection->id] ?? [] : [];
        $processSteps = $processContent['group_data']['process_steps'] ?? [];
        if (empty($processSteps)) {
            $processSteps = collect($data['process']['steps'] ?? [])->map(fn ($s) => [
                'step_number' => $s['step'] ?? '', 'step_title' => $s['title'] ?? '', 'step_description' => $s['description'] ?? '',
            ])->all();
        }
    @endphp
    @if (!empty($processSteps))
        <section class="py-5" style="background:#f5f8fd;">
            <div class="container py-5">
                <div class="section-title st-center">
                    <h3>{{ $processContent['section_title'] ?? $data['process']['title'] }}</h3>
                    <p>{{ $processContent['section_subtitle'] ?? $data['process']['subtitle'] }}</p>
                </div>

                <div class="row g-4">
                    @foreach ($processSteps as $step)
                        <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="{{ 0.1 * $loop->iteration }}s">
                            <div class="simple-process-item">
                                <div class="simple-process-number">{{ $step['step_number'] ?? '' }}</div>
                                <h4>{{ $step['step_title'] ?? '' }}</h4>
                                <p>{{ $step['step_description'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- End Process Section -->

    <!-- Start Map Section -->
    @php
        $mapSection = $page?->sections->firstWhere('slug', 'contact-map-section');
        $mapContent = $mapSection ? $sectionContents[$mapSection->id] ?? [] : [];
        $mapIframeUrl = $mapContent['iframe_url'] ?? ($data['map_section']['iframe_url'] ?? null);
    @endphp
    @if (!empty($mapIframeUrl))
        <section class="py-5">
            <div class="container py-5">
                <div class="section-title st-center">
                    <h3>{{ $mapContent['section_title'] ?? $data['map_section']['title'] }}</h3>
                    <p>{{ $mapContent['section_subtitle'] ?? $data['map_section']['subtitle'] }}</p>
                </div>

                <!-- Desktop: map inside a laptop/browser frame -->
                <div class="laptop-mockup d-none d-lg-block wow fadeInUp" data-wow-delay="0.1s">
                    <div class="laptop-screen">
                        <div class="laptop-browser-bar">
                            <span class="dot dot-red"></span>
                            <span class="dot dot-yellow"></span>
                            <span class="dot dot-green"></span>
                            <span class="laptop-url">maps.{{ config('constants.BRAND_NAME') }}/office-location</span>
                        </div>
                        <div class="laptop-screen-glass">
                            <div class="laptop-shine"></div>
                            <iframe src="{{ $mapIframeUrl }}" width="100%" height="420"
                                style="border:0; position:relative; display:block;" allowfullscreen loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="laptop-base">
                        <span class="laptop-notch"></span>
                    </div>
                    <div class="laptop-shadow"></div>
                </div>

                <!-- Mobile: map inside a phone frame -->
                <div class="phone-mockup d-lg-none wow fadeInUp" data-wow-delay="0.1s" style="max-width:320px;">
                    <div class="phone-frame">
                        <div class="phone-notch"></div>
                        <div class="phone-screen">
                            <div class="phone-statusbar">
                                <span class="phone-brand">{{ config('constants.BRAND_NAME') }} Maps</span>
                            </div>
                            <iframe src="{{ $mapIframeUrl }}" width="100%" height="420"
                                style="border:0; display:block;" allowfullscreen loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div class="phone-home-indicator"></div>
                    </div>
                    <div class="phone-shadow"></div>
                </div>
            </div>
        </section>
    @endif
    <!-- End Map Section -->

@endsection
