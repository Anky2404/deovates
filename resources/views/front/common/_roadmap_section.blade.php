{{--
    Shared "Our Development Process" roadmap block — reused as-is across
    Home, About, Services, and Blog (all point at the same `roadmap-section`
    Section; each page keeps its own PageSectionContent row so content can
    still diverge once an admin edits one page specifically).

    Params:
    - $page             App\Models\Page|null
    - $sectionContents  array [section_id => data]
    - $defaultLabel     string — fallback kicker text (plain <h5>, no orange sub-title styling here)
    - $defaultTitle     string — fallback title
    - $defaultSubtitle  string|null — fallback subtitle
--}}
@php
    $__roadmapSection = $page?->sections->firstWhere('slug', 'roadmap-section');
    $__roadmapContent = $__roadmapSection ? ($sectionContents[$__roadmapSection->id] ?? []) : [];
    $__roadmapSteps = $__roadmapContent['group_data']['roadmap_steps'] ?? [];

    if (empty($__roadmapSteps)) {
        $__roadmapSteps = [
            [
                'step_icon' => 'fas fa-search',
                'step_title' => 'Discovery',
                'step_heading' => 'Project Discovery & Consultation',
                'step_description' =>
                    'We begin by understanding your business objectives, target audience, and project requirements. Through detailed consultation and market research, we create a clear strategy that aligns technology with your long-term business goals.',
            ],
            [
                'step_icon' => 'fas fa-paint-brush',
                'step_title' => 'Planning',
                'step_heading' => 'Planning & UI/UX Design',
                'step_description' =>
                    'Our designers and solution architects create intuitive user experiences, interactive prototypes, and scalable system architecture that provide the perfect foundation for successful digital products.',
            ],
            [
                'step_icon' => 'fas fa-code',
                'step_title' => 'Development',
                'step_heading' => 'Development & Quality Assurance',
                'step_description' =>
                    'Using modern technologies and clean coding standards, our developers build secure, responsive, and scalable solutions. Every feature is thoroughly tested to ensure performance, reliability, and security before launch.',
            ],
            [
                'step_icon' => 'fas fa-rocket',
                'step_title' => 'Launch',
                'step_heading' => 'Launch, Growth & Continuous Support',
                'step_description' =>
                    'After successful deployment, we continue supporting your business with maintenance, performance optimization, security updates, feature enhancements, and technical assistance to ensure sustainable digital growth.',
            ],
        ];
    }
@endphp
<section class="roadmap-area section-padding" id="roadmap">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="heading">
                    <h5>{{ $__roadmapContent['section_label'] ?? $defaultLabel }}</h5>
                    <div class="space-10"></div>
                    <h1>{{ $__roadmapContent['section_title'] ?? $defaultTitle }}</h1>
                    <p class="mt-3">
                        {{ $__roadmapContent['section_subtitle'] ?? ($defaultSubtitle ?? '') }}
                    </p>
                </div>
                <div class="space-60 d-none d-sm-block"></div>
            </div>
        </div>

        <div class="process-flow">
            @foreach ($__roadmapSteps as $step)
                <div class="process-step wow fadeInLeft" data-wow-delay="{{ 0.1 + $loop->index * 0.2 }}s"
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
                        @foreach ($__roadmapSteps as $step)
                            <div class="laptop-slide">
                                <span class="process-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="process-icon"><i
                                        class="{{ $step['step_icon'] ?? 'fas fa-check' }}"></i></span>
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
