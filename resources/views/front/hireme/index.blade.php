@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.hireme.title'))
@section('meta_description', config('constants.PAGE_SEO.hireme.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.hireme.meta_keywords'))
@section('content')

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('hire-me.avif', 'assets/front/img/hero/h3_hero.avif') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Hire Our Team</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Hire Me</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Engagement Models Section -->
    @php
        $engagementSection = $page?->sections->firstWhere('slug', 'hireme-engagement-models-section');
        $engagementContent = $engagementSection ? $sectionContents[$engagementSection->id] ?? [] : [];
        $models = $engagementContent['group_data']['engagement_items'] ?? [];

        if (empty($models)) {
            $models = [
                ['item_icon' => 'fas fa-users', 'item_title' => 'Dedicated Team', 'item_text' => 'A committed team of developers and designers working exclusively on your product, scaling up or down as you need.'],
                ['item_icon' => 'fas fa-tasks', 'item_title' => 'Fixed Scope Project', 'item_text' => 'Clear requirements, a fixed timeline, and a fixed budget — ideal for well-defined projects with a set outcome.'],
                ['item_icon' => 'fas fa-clock', 'item_title' => 'Hourly / Retainer', 'item_text' => 'Flexible support for ongoing maintenance, feature additions, or an extension of your existing team.'],
            ];
        }
    @endphp
    <section class="py-5">
        <div class="container py-5">
            <div class="section-title st-center">
                @include('front.common._section_heading', [
                    'content' => $engagementContent,
                    'defaultTitle' => \App\Helper::sectionTitle('hireme', 'engagement_models', 'title', 'Engagement Models Built Around You'),
                    'defaultSubtitle' => \App\Helper::sectionTitle('hireme', 'engagement_models', 'subtitle'),
                ])
            </div>

            <div class="row g-4">
                @foreach ($models as $model)
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="office-item icon-only h-100">
                            <div class="office-img"><i class="{{ $model['item_icon'] ?? 'fas fa-star' }}"></i></div>
                            <div class="office-content text-center">
                                <h4 style="color:inherit;">{{ $model['item_title'] ?? '' }}</h4>
                                <p>{{ $model['item_text'] ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Engagement Models Section -->

    <!-- Start How It Works Section -->
    @php
        $howItWorksSection = $page?->sections->firstWhere('slug', 'hireme-how-it-works-section');
        $howItWorksContent = $howItWorksSection ? $sectionContents[$howItWorksSection->id] ?? [] : [];
        $steps = $howItWorksContent['group_data']['how_it_works_steps'] ?? [];

        if (empty($steps)) {
            $steps = [
                ['step_number' => '01', 'step_title' => 'Share Your Needs', 'step_description' => 'Tell us about your project, timeline, and the skills you need.'],
                ['step_number' => '02', 'step_title' => 'Meet the Team', 'step_description' => 'We match you with the right developers and designers for your goals.'],
                ['step_number' => '03', 'step_title' => 'Align on Scope', 'step_description' => 'We agree on scope, timeline, and engagement model together.'],
                ['step_number' => '04', 'step_title' => 'Start Building', 'step_description' => 'Work kicks off with clear milestones and regular communication.'],
            ];
        }
    @endphp
    <section class="py-5" style="background:#f5f8fd;">
        <div class="container py-5">
            <div class="section-title st-center">
                @include('front.common._section_heading', [
                    'content' => $howItWorksContent,
                    'defaultTitle' => \App\Helper::sectionTitle('hireme', 'how_it_works', 'title', 'How It Works'),
                    'defaultSubtitle' => \App\Helper::sectionTitle('hireme', 'how_it_works', 'subtitle'),
                ])
            </div>
            <div class="row g-4">
                @foreach ($steps as $step)
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
    <!-- End How It Works Section -->

    <!-- Start CTA Section -->
    <!-- CTA -->
    @php
        $hireCtaSection = $page?->sections->firstWhere('slug', 'hireme-cta-section');
        $hireCtaContent = $hireCtaSection ? $sectionContents[$hireCtaSection->id] ?? [] : [];
    @endphp
    <section class="call-us" style="background-image:url('{{ !empty($hireCtaContent['bg_image']) ? asset('storage/' . $hireCtaContent['bg_image']) : asset('assets/front/img/funfact.avif') }}');">
        <div class="container">
            <div class="call-us-inner text-center">
                <span class="kicker">{{ $hireCtaContent['section_label'] ?? "Let's Get Started" }}</span>
                <h3>{{ $hireCtaContent['section_title'] ?? 'Ready to Build Something Great?' }}</h3>
                <p>{{ $hireCtaContent['section_subtitle'] ?? "Tell us what you're building — we'll help you find the right team and engagement model." }}</p>
                <div class="actions">
                    <a href="{{ $hireCtaContent['btn_links'] ?? route('front.contact.index') }}" class="call-us-btn">{{ $hireCtaContent['btn_text'] ?? 'Start a Conversation' }}</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End CTA Section -->

@endsection
