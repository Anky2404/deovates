@extends('front.layouts.app')

@section('title', config('constants.PAGE_SEO.hireme.title'))
@section('meta_description', config('constants.PAGE_SEO.hireme.meta_description'))
@section('meta_keywords', config('constants.PAGE_SEO.hireme.meta_keywords'))
@section('content')

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('hire-me.png', 'assets/front/img/hero/h3_hero.png') }}">
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
    <section class="py-5">
        <div class="container py-5">
            <div class="section-title st-center">
                <h3>{{ \App\Helper::sectionTitle('hireme', 'engagement_models', 'title', 'Engagement Models Built Around You') }}</h3>
                <p>{{ \App\Helper::sectionTitle('hireme', 'engagement_models', 'subtitle') }}</p>
            </div>

            <div class="row g-4">
                @php
                    $models = [
                        ['icon' => 'fas fa-users', 'title' => 'Dedicated Team', 'text' => 'A committed team of developers and designers working exclusively on your product, scaling up or down as you need.'],
                        ['icon' => 'fas fa-tasks', 'title' => 'Fixed Scope Project', 'text' => 'Clear requirements, a fixed timeline, and a fixed budget — ideal for well-defined projects with a set outcome.'],
                        ['icon' => 'fas fa-clock', 'title' => 'Hourly / Retainer', 'text' => 'Flexible support for ongoing maintenance, feature additions, or an extension of your existing team.'],
                    ];
                @endphp
                @foreach ($models as $model)
                    <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="office-item icon-only h-100">
                            <div class="office-img"><i class="{{ $model['icon'] }}"></i></div>
                            <div class="office-content text-center">
                                <h4 style="color:inherit;">{{ $model['title'] }}</h4>
                                <p>{{ $model['text'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Engagement Models Section -->

    <!-- Start How It Works Section -->
    <section class="py-5" style="background:#f5f8fd;">
        <div class="container py-5">
            <div class="section-title st-center">
                <h3>{{ \App\Helper::sectionTitle('hireme', 'how_it_works', 'title', 'How It Works') }}</h3>
                <p>{{ \App\Helper::sectionTitle('hireme', 'how_it_works', 'subtitle') }}</p>
            </div>
            <div class="row g-4">
                @php
                    $steps = [
                        ['step' => '01', 'title' => 'Share Your Needs', 'description' => 'Tell us about your project, timeline, and the skills you need.'],
                        ['step' => '02', 'title' => 'Meet the Team', 'description' => 'We match you with the right developers and designers for your goals.'],
                        ['step' => '03', 'title' => 'Align on Scope', 'description' => 'We agree on scope, timeline, and engagement model together.'],
                        ['step' => '04', 'title' => 'Start Building', 'description' => 'Work kicks off with clear milestones and regular communication.'],
                    ];
                @endphp
                @foreach ($steps as $step)
                    <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="{{ 0.1 * $loop->iteration }}s">
                        <div class="simple-process-item">
                            <div class="simple-process-number">{{ $step['step'] }}</div>
                            <h4>{{ $step['title'] }}</h4>
                            <p>{{ $step['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End How It Works Section -->

    <!-- Start CTA Section -->
    <!-- CTA -->
    <section class="call-us" style="background-image:url('{{ asset('assets/front/img/funfact.png') }}');">
        <div class="container">
            <div class="call-us-inner text-center">
                <span class="kicker">Let's Get Started</span>
                <h3>Ready to Build Something Great?</h3>
                <p>Tell us what you're building — we'll help you find the right team and engagement model.</p>
                <div class="actions">
                    <a href="{{ route('front.contact.index') }}" class="call-us-btn">Start a Conversation</a>
                </div>
            </div>
        </div>
    </section>
    <!-- End CTA Section -->

@endsection
