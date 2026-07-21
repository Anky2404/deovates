@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.legal_privacy.title'))
@section('meta_description', config('constants.PAGE_SEO.legal_privacy.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.legal_privacy.meta_keywords'))
@section('content')

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('legal-privacy.avif', 'assets/front/img/hero/h2_hero.avif') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Privacy Policy</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Privacy Policy</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Privacy Policy Content Section -->
    @php
        $legalSection = $page?->sections->firstWhere('slug', 'legal-privacy-content-section');
        $legalContent = $legalSection ? $sectionContents[$legalSection->id] ?? [] : [];
        $sections = $legalContent['group_data']['legal_items'] ?? [];

        if (empty($sections)) {
            $sections = collect([
                ['id' => 'collect', 'icon' => 'fas fa-database', 'title' => 'Information We Collect', 'body' => 'We may collect information you provide directly to us, such as your name, email address, phone number, and project details when you fill out a contact form or reach out to us.'],
                ['id' => 'use', 'icon' => 'fas fa-cogs', 'title' => 'How We Use Your Information', 'body' => 'We use the information we collect to respond to inquiries, provide our services, improve our website, and communicate with you about projects or updates.'],
                ['id' => 'sharing', 'icon' => 'fas fa-share-alt', 'title' => 'Data Sharing', 'body' => 'We do not sell your personal information. We may share information with trusted service providers who help us operate our business, subject to confidentiality obligations.'],
                ['id' => 'cookies', 'icon' => 'fas fa-globe', 'title' => 'Cookies', 'body' => 'Our website may use cookies to improve your browsing experience and understand how visitors use our site.'],
                ['id' => 'rights', 'icon' => 'fas fa-shield-alt', 'title' => 'Your Rights', 'body' => 'You may request access to, correction of, or deletion of your personal information at any time by contacting us.'],
            ])->map(fn ($s) => ['item_icon' => $s['icon'], 'item_title' => $s['title'], 'item_body' => $s['body']])->all();
        }
    @endphp

    <section class="py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="legal-sidebar wow fadeInLeft" data-wow-delay="0.1s">
                        <span class="legal-updated"><i class="far fa-clock me-2"></i>Last updated:
                            {{ now()->format('F d, Y') }}</span>

                        <h5>On This Page</h5>
                        <ul class="legal-toc">
                            @foreach ($sections as $index => $section)
                                <li><a href="#legal-item-{{ $index }}"><i class="{{ $section['item_icon'] ?? '' }}"></i>{{ $section['item_title'] ?? '' }}</a></li>
                            @endforeach
                            <li><a href="#contact"><i class="fas fa-envelope"></i>Contact Us</a></li>
                        </ul>
                    </div>

                    <div class="legal-help-card wow fadeInLeft" data-wow-delay="0.2s">
                        <i class="fas fa-question-circle"></i>
                        <h6>Have Questions?</h6>
                        <p>{{ $legalContent['help_card_subtitle'] ?? \App\Helper::sectionTitle('legal_privacy', 'intro', 'subtitle', "We're happy to walk you through how we handle your data.") }}</p>
                        <a href="{{ route('front.contact.index') }}" class="btn btn-main w-100">Contact Us</a>
                    </div>
                </div>

                <div class="col-lg-8">
                    <p class="legal-intro wow fadeInUp" data-wow-delay="0.1s">
                        @if (!empty($legalContent['legal_intro']))
                            {{ $legalContent['legal_intro'] }}
                        @else
                            {{ config('constants.BUSINESS.name') }} ("we", "us", "our")
                            respects your privacy and is committed to protecting the personal information you share
                            with us. This policy explains what information we collect, how we use it, and the choices
                            you have.
                        @endif
                    </p>

                    @foreach ($sections as $index => $section)
                        <div id="legal-item-{{ $index }}" class="legal-section wow fadeInUp" data-wow-delay="0.1s">
                            <div class="legal-section-icon"><i class="{{ $section['item_icon'] ?? '' }}"></i></div>
                            <div>
                                <h4>{{ $section['item_title'] ?? '' }}</h4>
                                <p>{{ $section['item_body'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach

                    <div id="contact" class="legal-section legal-section--contact wow fadeInUp" data-wow-delay="0.1s">
                        <div class="legal-section-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <h4>Contact Us</h4>
                            <p>
                                @if (!empty($legalContent['contact_text']))
                                    {{ $legalContent['contact_text'] }}
                                @else
                                    If you have questions about this Privacy Policy, please
                                    <a href="{{ route('front.contact.index') }}">contact us</a>.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Privacy Policy Content Section -->

@endsection
