@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.career.title'))
@section('meta_description', config('constants.PAGE_SEO.career.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.career.meta_keywords'))
@section('content')

    @php
        $careerHeroSection = $page?->sections->firstWhere('slug', 'career-hero-section');
        $careerHeroContent = $careerHeroSection ? $sectionContents[$careerHeroSection->id] ?? [] : [];

        $careerListingSection = $page?->sections->firstWhere('slug', 'career-listing-section');
        $careerListingContent = $careerListingSection ? $sectionContents[$careerListingSection->id] ?? [] : [];
    @endphp

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('career.png', 'assets/front/img/hero/h1_hero.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>{{ $careerHeroContent['section_title'] ?? ('Careers at ' . config('constants.BRAND_NAME')) }}</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Careers</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Join Our Team Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="section-title st-center">
                @include('front.partials._section_heading', [
                    'content' => $careerListingContent,
                    'defaultTitle' => \App\Helper::sectionTitle('career', 'listing', 'title', 'Join Our Team'),
                    'defaultSubtitle' => \App\Helper::sectionTitle('career', 'listing', 'subtitle'),
                ])
            </div>

            @if ($careers->isEmpty())
                <p class="text-center text-muted">There are no open positions right now — check back soon.</p>
            @else
                <div class="row g-4 justify-content-center">
                    @foreach ($careers as $career)
                        <div class="col-6 col-lg-3 wow fadeInUp" data-wow-delay="{{ 0.1 * ($loop->index + 1) }}s">
                            <div class="phone-mockup career-phone">
                                <div class="phone-frame">
                                    <div class="phone-notch"></div>
                                    <div class="phone-screen">
                                        <div class="phone-statusbar">
                                            <span class="phone-brand">{{ config('constants.BRAND_NAME') }}</span>
                                        </div>
                                        <div class="career-phone-banner">
                                            <i class="fas fa-briefcase"></i>
                                        </div>
                                        <div class="career-phone-info">
                                            <h5>{{ $career->title }}</h5>
                                            <div class="career-phone-meta">
                                                @if ($career->department)
                                                    <span><i class="fas fa-layer-group"></i>{{ $career->department->name }}</span>
                                                @endif
                                                <span><i class="fas fa-map-marker-alt"></i>{{ ucfirst($career->location) }}{{ $career->is_remote ? ' · Remote' : '' }}</span>
                                                <span><i class="fas fa-briefcase"></i>{{ ucfirst(str_replace('-', ' ', $career->employment_type)) }}</span>
                                            </div>
                                            @if (!empty($career->slug))
                                                <button type="button" class="btn btn-main w-100" data-toggle="modal"
                                                    data-target="#careerModal{{ $career->id }}">View Role</button>
                                            @else
                                                <a href="{{ route('front.contact.index') }}"
                                                    class="btn btn-main w-100">Get in Touch</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="phone-home-indicator"></div>
                                </div>
                                <div class="phone-shadow"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    <!-- End Join Our Team Section -->

    <!-- Start Career Details Modals Section -->
    <!-- Full job details + apply popup (one per real career listing) -->
    @foreach ($careers as $career)
        @if (!empty($career->slug))
            <div class="modal fade career-modal" id="careerModal{{ $career->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content border-0 bg-transparent">
                        <button type="button" class="career-modal-close" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>

                        <div class="laptop-mockup career-modal-mockup">
                            <div class="laptop-screen">
                                <div class="laptop-browser-bar">
                                    <span class="dot dot-red"></span>
                                    <span class="dot dot-yellow"></span>
                                    <span class="dot dot-green"></span>
                                    <span class="laptop-url">{{ config('constants.BRAND_NAME') }}/career/{{ $career->slug }}</span>
                                </div>
                                <div class="laptop-screen-glass career-modal-glass">
                                    <div class="career-modal-body">
                                        <h3>{{ $career->title }}</h3>
                                        <div class="career-phone-meta career-modal-meta">
                                            @if ($career->department)
                                                <span><i class="fas fa-layer-group"></i>{{ $career->department->name }}</span>
                                            @endif
                                            <span><i class="fas fa-map-marker-alt"></i>{{ ucfirst($career->location) }}{{ $career->is_remote ? ' · Remote' : '' }}</span>
                                            <span><i class="fas fa-briefcase"></i>{{ ucfirst(str_replace('-', ' ', $career->employment_type)) }}</span>
                                            @if ($career->salary_min && $career->salary_max)
                                                <span><i class="fas fa-money-bill-wave"></i>{{ $career->salary_currency }}
                                                    {{ number_format($career->salary_min) }}–{{ number_format($career->salary_max) }}</span>
                                            @endif
                                        </div>

                                        @if ($career->description)
                                            <h5>About the Role</h5>
                                            <p>{{ $career->description }}</p>
                                        @endif
                                        @if ($career->responsibilities)
                                            <h5>Responsibilities</h5>
                                            <p>{{ $career->responsibilities }}</p>
                                        @endif
                                        @if ($career->requirements)
                                            <h5>Requirements</h5>
                                            <p>{{ $career->requirements }}</p>
                                        @endif
                                        @if ($career->benefits)
                                            <h5>Benefits</h5>
                                            <p>{{ $career->benefits }}</p>
                                        @endif

                                        @php
                                            $modalSkills = is_string($career->skills) ? json_decode($career->skills, true) : $career->skills;
                                        @endphp
                                        @if (!empty($modalSkills))
                                            <h5>Skills</h5>
                                            <div class="d-flex flex-wrap gap-2 mb-3">
                                                @foreach ($modalSkills as $skill)
                                                    <span class="career-modal-skill">{{ ucfirst($skill) }}</span>
                                                @endforeach
                                            </div>
                                        @endif

                                        <hr class="career-modal-divider">

                                        <h4 class="mb-1">Apply for this Role</h4>
                                        <p class="career-modal-sub">Fill in your details below and our team will get
                                            back to you.</p>

                                        <form class="app-contact-form" novalidate>
                                            <div class="row g-3">
                                                <div class="col-md-6 app-form-group">
                                                    <label for="cm-name-{{ $career->id }}">Full Name</label>
                                                    <input type="text" id="cm-name-{{ $career->id }}" name="name"
                                                        required placeholder="John Doe">
                                                    <span class="app-form-error">Please enter your name.</span>
                                                </div>
                                                <div class="col-md-6 app-form-group">
                                                    <label for="cm-email-{{ $career->id }}">Email Address</label>
                                                    <input type="email" id="cm-email-{{ $career->id }}" name="email"
                                                        required placeholder="john@example.com">
                                                    <span class="app-form-error">Please enter a valid email.</span>
                                                </div>
                                                <div class="col-md-6 app-form-group">
                                                    <label for="cm-phone-{{ $career->id }}">Phone Number</label>
                                                    <input type="tel" id="cm-phone-{{ $career->id }}" name="phone"
                                                        required placeholder="+91 12345 67890">
                                                    <span class="app-form-error">Please enter a valid phone
                                                        number.</span>
                                                </div>
                                                <div class="col-md-6 app-form-group">
                                                    <label for="cm-portfolio-{{ $career->id }}">Portfolio / LinkedIn
                                                        (optional)</label>
                                                    <input type="text" id="cm-portfolio-{{ $career->id }}"
                                                        name="portfolio" placeholder="https://">
                                                    <span class="app-form-error"></span>
                                                </div>
                                                <div class="col-12 app-form-group">
                                                    <label for="cm-message-{{ $career->id }}">Cover Message</label>
                                                    <textarea id="cm-message-{{ $career->id }}" name="message" rows="4"
                                                        required placeholder="Tell us why you're a great fit..."></textarea>
                                                    <span class="app-form-error">Please enter a short message.</span>
                                                </div>
                                            </div>

                                            <button type="submit" class="app-form-submit mt-3">
                                                <span class="app-form-submit-text">Submit Application</span>
                                                <span class="app-form-submit-loader"></span>
                                            </button>

                                            <div class="app-form-success">
                                                <i class="fa fa-check-circle"></i>
                                                <p>Thanks! Your application has been received.</p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="laptop-base">
                                <span class="laptop-notch"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
    <!-- End Career Details Modals Section -->

    <!-- Start General Application Section -->
    <!-- General application section -->
    @php
        $generalAppSection = $page?->sections->firstWhere('slug', 'career-general-application-section');
        $generalAppContent = $generalAppSection ? $sectionContents[$generalAppSection->id] ?? [] : [];
    @endphp
    <section class="py-5" style="background:#f5f8fd;">
        <div class="container py-5">
            <div class="section-title st-center">
                @include('front.partials._section_heading', [
                    'content' => $generalAppContent,
                    'defaultTitle' => \App\Helper::sectionTitle('career', 'general_application', 'title', "Don't See Your Role?"),
                    'defaultSubtitle' => \App\Helper::sectionTitle('career', 'general_application', 'subtitle'),
                ])
            </div>

            <!-- Desktop: application form inside a browser/computer frame -->
            <div class="laptop-mockup d-none d-lg-block wow fadeInUp" data-wow-delay="0.1s">
                <div class="laptop-screen">
                    <div class="laptop-browser-bar">
                        <span class="dot dot-red"></span>
                        <span class="dot dot-yellow"></span>
                        <span class="dot dot-green"></span>
                        <span class="laptop-url">{{ config('constants.BRAND_NAME') }}/career/application</span>
                    </div>
                    <div class="laptop-screen-glass career-apply-glass">
                        <div class="career-apply-panel">
                            @include('front.career._apply-form-fields', ['prefix' => 'ga'])
                        </div>
                    </div>
                </div>
                <div class="laptop-base">
                    <span class="laptop-notch"></span>
                </div>
                <div class="laptop-shadow"></div>
            </div>

            <!-- Mobile: application form inside a phone frame -->
            <div class="phone-mockup d-lg-none wow fadeInUp" data-wow-delay="0.1s" style="max-width:340px;">
                <div class="phone-frame">
                    <div class="phone-notch"></div>
                    <div class="phone-screen">
                        <div class="phone-statusbar">
                            <span class="phone-brand">{{ config('constants.BRAND_NAME') }} Careers</span>
                        </div>
                        <div class="career-apply-panel career-apply-panel--phone">
                            @include('front.career._apply-form-fields', ['prefix' => 'gam'])
                        </div>
                    </div>
                    <div class="phone-home-indicator"></div>
                </div>
                <div class="phone-shadow"></div>
            </div>
        </div>
    </section>
    <!-- End General Application Section -->

@endsection
