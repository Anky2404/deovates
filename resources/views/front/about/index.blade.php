@extends('front.layouts.app')

@section('title', $data['page_header']['meta_title'] ?? $data['page_header']['title'] ?? config('constants.PAGE_SEO.about.title'))
@section('meta_description', $data['page_header']['meta_description'] ?? config('constants.PAGE_SEO.about.meta_description'))
@section('meta_keywords', $data['page_header']['meta_keywords'] ?? config('constants.PAGE_SEO.about.meta_keywords'))
@section('content')

    @php
        $iconMap = [
            'icon-lightbulb' => 'fas fa-lightbulb',
            'icon-target' => 'fas fa-bullseye',
            'icon-shield' => 'fas fa-shield-alt',
            'icon-trophy' => 'fas fa-trophy',
            'icon-profile-male' => 'fas fa-user',
            'icon-clipboard' => 'fas fa-clipboard-list',
            'icon-speedometer' => 'fas fa-tachometer-alt',
            'icon-globe' => 'fas fa-globe',
            'icon-heart' => 'fas fa-heart',
            'icon-lock' => 'fas fa-lock',
            'icon-briefcase' => 'fas fa-briefcase',
            'icon-presentation' => 'fas fa-chalkboard-teacher',
            'icon-refresh' => 'fas fa-sync-alt',
            'icon-clock' => 'fas fa-clock',
            'icon-flag' => 'fas fa-flag',
            'icon-wallet' => 'fas fa-wallet',
            'icon-linegraph' => 'fas fa-chart-line',
            'icon-camera' => 'fas fa-camera',
            'icon-map-pin' => 'fas fa-map-marker-alt',
            'icon-bike' => 'fas fa-biking',
            'icon-tools' => 'fas fa-tools',
            'icon-gears' => 'fas fa-cogs',
        ];
        $icon = fn($key) => $iconMap[$key] ?? 'fas fa-star';
    @endphp

    <!-- Start Hero Section -->
    <!-- Hero -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::heroBanner('about.png', 'assets/front/img/hero/about.avif') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>{{ $data['page_header']['title'] ?? 'About Us' }}</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">About</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Who We Are Section -->
    <!-- Who We Are -->
    @php
        $whoWeAreSection = $aboutPage?->sections->firstWhere('slug', 'about-section-one');
        $whoWeAreContent = $whoWeAreSection ? $sectionContents[$whoWeAreSection->id] ?? [] : [];
        $whoWeAreStat = $data['growth_numbers']['items'][0] ?? null;
    @endphp
    <section class="py-5 about_section_one" id="about_section_one">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="position-relative" style="max-width:470px;">
                        <img src="{{ !empty($whoWeAreContent['side_image']) ? asset('storage/' . $whoWeAreContent['side_image']) : asset('assets/front/img/about.avif') }}"
                            class="about-img" alt="Inside {{ config('constants.BUSINESS.name') }}">

                        @if (!empty($whoWeAreContent['badge_count']))
                            <div class="d-flex align-items-center gap-3 p-3 rounded-4"
                                style="position:absolute; left:-24px; bottom:-24px; background:#fff; box-shadow:0 18px 40px rgba(11,28,57,.18); max-width:260px;">
                                <div class="simple-process-number flex-shrink-0"
                                    style="width:54px;height:54px;font-size:18px;margin:0;">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <div>
                                    <div class="h4 mb-0" style="color:#f85603;font-weight:700;">{{ $whoWeAreContent['badge_count'] }}+</div>
                                    <div class="small text-muted">{{ $whoWeAreContent['badge_label'] ?? '' }}</div>
                                </div>
                            </div>
                        @elseif ($whoWeAreStat)
                            <div class="d-flex align-items-center gap-3 p-3 rounded-4"
                                style="position:absolute; left:-24px; bottom:-24px; background:#fff; box-shadow:0 18px 40px rgba(11,28,57,.18); max-width:260px;">
                                <div class="simple-process-number flex-shrink-0"
                                    style="width:54px;height:54px;font-size:18px;margin:0;">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <div>
                                    <div class="h4 mb-0" style="color:#f85603;font-weight:700;">{{ $whoWeAreStat['count'] }}+</div>
                                    <div class="small text-muted">{{ $whoWeAreStat['label'] }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="section-title st-start">
                        @if (!empty($whoWeAreContent['section_label']))
                            <span class="sub-title">{{ $whoWeAreContent['section_label'] }}</span>
                        @endif
                        <h3>{{ $whoWeAreContent['section_title'] ?? $data['who_we_are']['title'] }}</h3>
                        <p>{{ $whoWeAreContent['section_subtitle'] ?? $data['who_we_are']['subtitle'] }}</p>
                    </div>
                    <div class="fs-6">
                        @if (!empty($whoWeAreContent['description']))
                            {!! $whoWeAreContent['description'] !!}
                        @else
                            {!! $data['who_we_are']['description'] !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Who We Are Section -->

    <!-- Start Vision & Mission Section -->
    <!-- Vision & Mission -->
    @php
        $vmSection = $aboutPage?->sections->firstWhere('slug', 'vision-mission-section');
        $vmContent = $vmSection ? $sectionContents[$vmSection->id] ?? [] : [];
        $vmItems = $vmContent['group_data']['vm_items'] ?? [];

        if (empty($vmItems)) {
            $vmItems = collect(['vision', 'mission'])->map(fn ($key) => [
                'item_icon' => $data['vision_mission'][$key]['icon'] ?? null,
                'item_title' => $data['vision_mission'][$key]['title'] ?? '',
                'item_text' => $data['vision_mission'][$key]['text'] ?? '',
                'item_stat_number' => $data['vision_mission'][$key]['stat_number'] ?? '',
                'item_stat_label' => $data['vision_mission'][$key]['stat_label'] ?? '',
                '_uses_icon_map' => true,
            ])->all();
        }
    @endphp
    <section class="vm-area py-5" style="background-image:url('{{ asset('assets/front/img/funfact.avif') }}');" id="vision_missin">
        <div class="vm-overlay"></div>
        <div class="container py-5 position-relative">
            <div class="section-title st-center st-light">
                @if (!empty($vmContent['section_label']))
                    <span class="sub-title">{{ $vmContent['section_label'] }}</span>
                @endif
                <h3>{{ $vmContent['section_title'] ?? $data['vision_mission']['title'] }}</h3>
                <p>{{ $vmContent['section_subtitle'] ?? $data['vision_mission']['subtitle']['subtitle'] }}</p>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($vmItems as $item)
                    <div class="col-md-6 col-lg-5 wow fadeInUp" data-wow-delay="{{ $loop->iteration * 0.15 }}s">
                        <div class="vm-glass-card h-100">
                            <div class="vm-glass-shine"></div>
                            <div class="text-center py-4 position-relative">
                                <div class="simple-process-number mx-auto">
                                    <i class="{{ !empty($item['_uses_icon_map']) ? $icon($item['item_icon']) : ($item['item_icon'] ?: 'fas fa-star') }}"></i>
                                </div>
                                <h4>{{ $item['item_title'] ?? '' }}</h4>
                                <p>{{ $item['item_text'] ?? '' }}</p>
                                <div class="mt-3">
                                    <span class="h3" style="color:#ff8a3d;font-weight:700;">{{ $item['item_stat_number'] ?? '' }}</span>
                                    <div class="small text-uppercase" style="color:rgba(255,255,255,.75);">{{ $item['item_stat_label'] ?? '' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Vision & Mission Section -->

    <!-- Start Growth Numbers Section -->
    <!-- Growth Numbers -->
    @php
        $growthSection = $aboutPage?->sections->firstWhere('slug', 'growth-numbers-section');
        $growthContent = $growthSection ? $sectionContents[$growthSection->id] ?? [] : [];
        $growthItems = $growthContent['group_data']['growth_items'] ?? [];

        if (empty($growthItems)) {
            $growthItems = collect($data['growth_numbers']['items'])->map(fn ($item) => [
                'item_icon' => $item['icon'] ?? null,
                'item_title' => $item['label'] ?? '',
                'item_value' => $item['count'] ?? '',
                'item_suffix' => '',
                '_uses_icon_map' => true,
            ])->all();
        }
    @endphp
    <section class="counter container-fluid service overflow-hidden py-5" id="counter">
        <div class="container-fluid counter-facts py-5">
            <div class="container py-1">
                <div class="section-title st-center">
                    @if (!empty($growthContent['section_label']))
                        <span class="sub-title">{{ $growthContent['section_label'] }}</span>
                    @endif
                    <h3>{{ $growthContent['section_title'] ?? $data['growth_numbers']['title'] }}</h3>
                    <p>{{ $growthContent['section_subtitle'] ?? $data['growth_numbers']['subtitle'] }}</p>
                </div>
                <div class="row g-4">
                    @foreach ($growthItems as $item)
                        <div class="col-12 col-sm-6 col-md-6 col-xl-3 wow fadeInUp"
                            data-wow-delay="{{ 0.1 * $loop->iteration }}s">
                            <div class="counter">
                                <div class="counter-icon">
                                    <i class="{{ !empty($item['_uses_icon_map']) ? $icon($item['item_icon']) : ($item['item_icon'] ?: 'fas fa-star') }}"></i>
                                </div>
                                <div class="counter-content">
                                    <h3>{{ $item['item_title'] ?? '' }}</h3>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="counter-value" data-toggle="counter-up">{{ $item['item_value'] ?? 0 }}</span>
                                        @if (!empty($item['item_suffix']))
                                            <h4 class="text-secondary mb-0" style="font-weight:600;font-size:25px;">{{ $item['item_suffix'] }}</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Growth Numbers Section -->

    <!-- Start Core Values Section -->
    <!-- Core Values -->
    @php
        $coreValuesSection = $aboutPage?->sections->firstWhere('slug', 'core-values-section');
        $coreValuesContent = $coreValuesSection ? $sectionContents[$coreValuesSection->id] ?? [] : [];
        $coreValuesItems = $coreValuesContent['group_data']['value_items'] ?? [];

        if (empty($coreValuesItems)) {
            $coreValuesItems = collect($data['core_values']['items'])->map(fn ($item) => [
                'item_icon' => $item['icon'] ?? null,
                'item_title' => $item['title'] ?? '',
                'item_description' => $item['description'] ?? '',
                '_uses_icon_map' => true,
            ])->all();
        }
    @endphp
    <section class="py-5 core-value">
        <div class="container py-5">
            <div class="section-title st-center">
                @if (!empty($coreValuesContent['section_label']))
                    <span class="sub-title">{{ $coreValuesContent['section_label'] }}</span>
                @endif
                <h3>{{ $coreValuesContent['section_title'] ?? $data['core_values']['title'] }}</h3>
                <p>{{ $coreValuesContent['section_subtitle'] ?? $data['core_values']['subtitle'] }}</p>
            </div>
            <div class="row g-4">
                @foreach ($coreValuesItems as $item)
                    <div class="col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="office-item icon-only h-100">
                            <div class="office-img">
                                <i class="{{ !empty($item['_uses_icon_map']) ? $icon($item['item_icon']) : ($item['item_icon'] ?: 'fas fa-star') }}"></i>
                            </div>
                            <div class="office-content text-center">
                                <h4>{{ $item['item_title'] ?? '' }}</h4>
                                <p>{{ $item['item_description'] ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Core Values Section -->

    <!-- Start Roadmap Section -->
    @include('front.partials._roadmap_section', [
        'page' => $aboutPage,
        'sectionContents' => $sectionContents,
        'defaultLabel' => 'Our Development Process',
        'defaultTitle' => 'From Vision to Digital Success',
        'defaultSubtitle' => 'At ' . config('constants.BUSINESS.name') . ', every successful project follows a proven development process. We combine strategic planning, creative design, modern technologies, and continuous support to deliver secure, scalable, and high-performing digital solutions that help businesses grow with confidence.',
    ])
    <!-- End Roadmap Section -->

    <!-- Start Founder Section -->
    <!-- Founder -->
    @php
        $founderSection = $aboutPage?->sections->firstWhere('slug', 'founder-section');
        $founderContent = $founderSection ? $sectionContents[$founderSection->id] ?? [] : [];
        $founderSocial = $founderContent['group_data']['founder_social'] ?? [];
        $founderExpertise = $founderContent['group_data']['founder_expertise'] ?? [];

        if (empty($founderSocial)) {
            $founderSocial = collect($data['founder']['social'] ?? [])->map(fn ($s) => [
                'social_icon' => $s['icon'] ?? '', 'social_link' => $s['link'] ?? '#',
            ])->all();
        }

        if (empty($founderExpertise)) {
            $founderExpertise = collect($data['founder']['expertise'] ?? [])->map(fn ($s) => [
                'skill_label' => $s['label'] ?? '', 'skill_percent' => $s['percent'] ?? 0,
            ])->all();
        }
    @endphp
    <section class="py-5 founder" style="background:#f5f8fd;">
        <div class="container py-5">
            <div class="section-title st-center">
                @if (!empty($founderContent['section_label']))
                    <span class="sub-title">{{ $founderContent['section_label'] }}</span>
                @endif
                <h3>{{ $founderContent['section_title'] ?? $data['founder']['section_title'] }}</h3>
                <p>{{ $founderContent['section_subtitle'] ?? $data['founder']['subtitle'] }}</p>
            </div>
            <div class="row g-5 align-items-center justify-content-center">
                <div class="col-lg-3 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="phone-mockup">
                        <div class="phone-frame">
                            <div class="phone-notch"></div>
                            <div class="phone-screen">
                                <div class="phone-statusbar">
                                    <span class="phone-brand">{{ config('constants.BRAND_NAME') }}</span>
                                </div>
                                <div class="founder-phone-photo">
                                    <img src="{{ !empty($founderContent['founder_photo']) ? asset('storage/' . $founderContent['founder_photo']) : asset('assets/front/img/team-1.avif') }}"
                                        alt="{{ $founderContent['founder_name'] ?? $data['founder']['name'] }}">
                                </div>
                                <div class="founder-phone-info">
                                    <h4>{{ $founderContent['founder_name'] ?? $data['founder']['name'] }}</h4>
                                    <p>{{ $founderContent['founder_role'] ?? $data['founder']['role'] }}</p>
                                    <div class="founder-phone-social">
                                        @foreach ($founderSocial as $social)
                                            <a href="{{ $social['social_link'] ?? '#' }}" target="_blank"
                                                rel="noopener noreferrer">
                                                <i class="fab fa-{{ $social['social_icon'] ?? '' }}"></i>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="phone-home-indicator"></div>
                        </div>
                        <div class="phone-shadow"></div>
                    </div>
                </div>

                <div class="col-lg-9 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="app-tablet">
                        <div class="tablet-frame app-tablet-frame">
                            <div class="tablet-cam"></div>
                            <div class="tablet-screen app-tablet-screen">
                                <div class="tablet-statusbar">
                                    <span class="phone-brand">{{ config('constants.BRAND_NAME') }}</span>
                                </div>

                                <div class="app-screen-header">
                                    <h4>Founder &amp; Leadership</h4>
                                    <p>The vision, strategy, and technology leadership behind the company</p>
                                </div>

                                <div class="founder-tablet-body">
                                    @if (!empty($founderContent['founder_bio']))
                                        {!! $founderContent['founder_bio'] !!}
                                    @else
                                        @foreach ($data['founder']['bio'] as $para)
                                            <p>{{ $para }}</p>
                                        @endforeach
                                    @endif

                                    @foreach ($founderExpertise as $skill)
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-1">
                                                <span style="color:#073965;font-weight:600;">{{ $skill['skill_label'] ?? '' }}</span>
                                                <span class="text-muted">{{ $skill['skill_percent'] ?? 0 }}%</span>
                                            </div>
                                            <div class="rounded-pill overflow-hidden" style="background:#e3e8f0;height:8px;">
                                                <div class="rounded-pill h-100"
                                                    style="width:{{ $skill['skill_percent'] ?? 0 }}%;background:linear-gradient(90deg,#073965,#f85603);">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Founder Section -->

    <!-- Start Office & Culture Section -->
    <!-- Office & Culture -->
    @php
        $officeSection = $aboutPage?->sections->firstWhere('slug', 'office-area-section');
        $officeAreaContent = $officeSection ? $sectionContents[$officeSection->id] ?? [] : [];
        $officeCultureImages = $officeAreaContent['culture_images'] ?? [];

        if (empty($officeCultureImages)) {
            $officeCultureImages = collect(['why-2.avif', 'why-4.avif', 'why-3.avif', 'why-1.avif'])->map(fn ($img) => [
                'path' => 'assets/front/img/' . $img, 'alt' => config('constants.BRAND_NAME') . ' culture', 'external' => true,
            ])->all();
        }
    @endphp
    <section class="vm-area py-5 office_area" id="office_area" style="background-image:url('{{ asset('assets/front/img/funfact.avif') }}');">
        <div class="vm-overlay"></div>
        <div class="container py-5 position-relative">
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 wow fadeInLeft" data-wow-delay="0.1s">
                    <div class="office-culture-slide-frame mx-auto">
                        <div class="office-culture-slider owl-carousel">
                            @foreach ($officeCultureImages as $img)
                                <div>
                                    <img src="{{ !empty($img['external']) ? asset($img['path']) : asset('storage/' . ($img['path'] ?? '')) }}"
                                        alt="{{ $img['alt'] ?? '' }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="vm-glass-card p-4 p-lg-5">
                        <div class="vm-glass-shine"></div>
                        <div class="position-relative">
                            <div class="section-title st-start st-light mb-4">
                                @if (!empty($officeAreaContent['section_label']))
                                    <span class="sub-title">{{ $officeAreaContent['section_label'] }}</span>
                                @endif
                                <h3>{{ $officeAreaContent['section_title'] ?? $data['office_culture']['title'] }}</h3>
                                <p>{{ $officeAreaContent['section_subtitle'] ?? $data['office_culture']['subtitle'] }}</p>
                            </div>
                            @if (!empty($officeAreaContent['content']))
                                <div style="color:rgba(255,255,255,.78);">{!! $officeAreaContent['content'] !!}</div>
                            @else
                                @foreach ($data['office_culture']['content'] as $para)
                                    <p style="color:rgba(255,255,255,.78);">{{ $para }}</p>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Office & Culture Section -->



    <!-- Start Key Advantages Section -->
    <!-- Key Advantages -->
    @php
        $advantagesSection = $aboutPage?->sections->firstWhere('slug', 'key-advantages-section');
        $advantagesContent = $advantagesSection ? $sectionContents[$advantagesSection->id] ?? [] : [];
        $advantageItems = $advantagesContent['group_data']['advantage_items'] ?? [];

        if (empty($advantageItems)) {
            $advantageItems = collect($data['advantages']['items'])->map(fn ($item) => [
                'item_icon' => $item['icon'] ?? null,
                'item_title' => $item['title'] ?? '',
                'item_description' => $item['description'] ?? '',
                '_uses_icon_map' => true,
            ])->all();
        }
    @endphp
    <section class="py-5 key-advantages">
        <div class="container py-5">
            <div class="section-title st-center">
                @if (!empty($advantagesContent['section_label']))
                    <span class="sub-title">{{ $advantagesContent['section_label'] }}</span>
                @endif
                <h3>{{ $advantagesContent['section_title'] ?? $data['advantages']['title'] }}</h3>
                <p>{{ $advantagesContent['section_subtitle'] ?? $data['advantages']['subtitle'] }}</p>
            </div>
            <div class="row g-4">
                @foreach ($advantageItems as $item)
                    <div class="col-sm-6 col-lg-3 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="office-item icon-only h-100">
                            <div class="office-img">
                                <i class="{{ !empty($item['_uses_icon_map']) ? $icon($item['item_icon']) : ($item['item_icon'] ?: 'fas fa-star') }}"></i>
                            </div>
                            <div class="office-content text-center">
                                <h4>{{ $item['item_title'] ?? '' }}</h4>
                                <p>{{ $item['item_description'] ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Key Advantages Section -->

    <!-- Start Testimonials Section -->
    <!-- Testimonials -->
    @include('front.partials._testimonials_section', [
        'page' => $aboutPage,
        'sectionContents' => $sectionContents,
        'testimonials' => $testimonials,
        'defaultTitle' => 'What Our Clients Say',
        'defaultSubtitle' => "Trusted by businesses we've helped grow",
    ])
    <!-- End Testimonials Section -->

    <!-- Start CTA Section -->
    <!-- CTA -->
    @include('front.partials._cta_section', [
        'page' => $aboutPage,
        'sectionContents' => $sectionContents,
        'defaultTitle' => "LET'S BUILD SOMETHING EXCEPTIONAL",
        'defaultSubtitle' => 'Transform Your Vision into Powerful Digital Solutions',
    ])
    <!-- End CTA Section -->

 <!-- Start FAQ Section -->
 @include('front.partials._faq_section', [
     'page' => $aboutPage,
     'sectionContents' => $sectionContents,
     'category' => $category,
     'defaultTitle' => 'Frequently Asked Questions',
     'defaultSubtitle' => 'Quick answers to common questions',
 ])
    <!-- End FAQ Section -->



@endsection
