@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.legal_terms.title'))
@section('meta_description', config('constants.PAGE_SEO.legal_terms.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.legal_terms.meta_keywords'))
@section('content')

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('legal-terms.avif', 'assets/front/img/hero/h2_hero.avif') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Terms &amp; Conditions</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Terms &amp; Conditions</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Terms & Conditions Content Section -->
    @php
        $legalSection = $page?->sections->firstWhere('slug', 'legal-terms-content-section');
        $legalContent = $legalSection ? $sectionContents[$legalSection->id] ?? [] : [];
        $sections = $legalContent['group_data']['legal_items'] ?? [];

        if (empty($sections)) {
            $sections = collect([
                ['id' => 'use', 'icon' => 'fas fa-globe', 'title' => 'Use of Our Website', 'body' => 'You agree to use our website only for lawful purposes and in a way that does not infringe the rights of, or restrict or inhibit the use of, this website by any third party.'],
                ['id' => 'services', 'icon' => 'fas fa-briefcase', 'title' => 'Services & Engagements', 'body' => 'Specific scope, pricing, timelines, and deliverables for any project will be agreed separately in a proposal or contract before work begins.'],
                ['id' => 'ip', 'icon' => 'fas fa-copyright', 'title' => 'Intellectual Property', 'body' => 'Unless otherwise agreed in writing, all content on this website — including text, graphics, logos, and images — is the property of ' . config('constants.BUSINESS.name') . ' and may not be used without permission.'],
                ['id' => 'liability', 'icon' => 'fas fa-shield-alt', 'title' => 'Limitation of Liability', 'body' => config('constants.BUSINESS.name') . ' will not be liable for any indirect, incidental, or consequential damages arising from the use of our website or services.'],
                ['id' => 'changes', 'icon' => 'fas fa-sync-alt', 'title' => 'Changes to These Terms', 'body' => 'We may update these terms from time to time. Continued use of our website after changes constitutes acceptance of the updated terms.'],
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
                        <p>{{ $legalContent['help_card_subtitle'] ?? \App\Helper::sectionTitle('legal_terms', 'intro', 'subtitle', "We're happy to walk you through any part of these terms.") }}</p>
                        <a href="{{ route('front.contact.index') }}" class="btn btn-main w-100">Contact Us</a>
                    </div>
                </div>

                <div class="col-lg-8">
                    <p class="legal-intro wow fadeInUp" data-wow-delay="0.1s">
                        @if (!empty($legalContent['legal_intro']))
                            {{ $legalContent['legal_intro'] }}
                        @else
                            These Terms &amp; Conditions govern
                            your use of the {{ config('constants.BUSINESS.name') }} website and services. By using our website or engaging our
                            services, you agree to these terms.
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
                                    If you have questions about these Terms &amp; Conditions, please
                                    <a href="{{ route('front.contact.index') }}">contact us</a>.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Terms & Conditions Content Section -->

@endsection
