@extends('front.layouts.app')

@section('title', $portfolio->meta_title ?: $portfolio->title)
@section('meta_description', $portfolio->meta_description ?: strip_tags($portfolio->overview))
@section('content')

    <!-- Hero -->
    <!-- Start Hero Section -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::img($portfolio->banner_image, 'assets/front/img/hero/h3_hero.png') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>{{ $portfolio->title }}</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('front.portfolios.index') }}">Portfolio</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ $portfolio->title }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Portfolio Details Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Start Project Content Section -->
                <div class="col-lg-8">
                    <img src="{{ \App\Helper::img($portfolio->featured_image) }}"
                        class="img-fluid rounded mb-4" alt="{{ $portfolio->title }}">

                    @if ($portfolio->overview)
                        <h4 style="color:#073965;">Overview</h4>
                        <p class="text-muted mb-4">{{ $portfolio->overview }}</p>
                    @endif

                    @if ($portfolio->description)
                        <div class="mb-4">{!! $portfolio->description !!}</div>
                    @endif

                    <div class="row g-4">
                        @if ($portfolio->challenges)
                            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <h5 style="color:#073965;"><i class="fas fa-exclamation-circle text-warning me-2"></i>
                                    Challenges</h5>
                                <p class="text-muted">{{ $portfolio->challenges }}</p>
                            </div>
                        @endif
                        @if ($portfolio->solutions)
                            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                                <h5 style="color:#073965;"><i class="fas fa-lightbulb text-warning me-2"></i>Solutions
                                </h5>
                                <p class="text-muted">{{ $portfolio->solutions }}</p>
                            </div>
                        @endif
                        @if ($portfolio->results)
                            <div class="col-12 wow fadeInUp" data-wow-delay="0.3s">
                                <h5 style="color:#073965;"><i class="fas fa-chart-line text-success me-2"></i>Results
                                </h5>
                                <p class="text-muted">{{ $portfolio->results }}</p>
                            </div>
                        @endif
                    </div>

                    @if ($portfolio->skills->isNotEmpty())
                        <h5 class="mt-4 mb-3" style="color:#073965;">Skills Used</h5>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach ($portfolio->skills as $skill)
                                <span class="badge rounded-pill px-3 py-2"
                                    style="background:#f5f8fd;color:#073965;border:1px solid #e3e8f0;">{{ $skill->name }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
                <!-- End Project Content Section -->

                <!-- Start Sidebar Section -->
                <div class="col-lg-4">
                    <div class="p-4 rounded-4" style="background:#f5f8fd; position:sticky; top:100px;">
                        <h4 class="mb-3" style="color:#073965;">Project Details</h4>
                        <ul class="list-unstyled mb-4">
                            @if ($portfolio->client_name)
                                <li class="mb-2"><strong>Client:</strong> {{ $portfolio->client_name }}</li>
                            @endif
                            @if ($portfolio->category)
                                <li class="mb-2"><strong>Category:</strong> {{ $portfolio->category->name }}</li>
                            @endif
                            @if ($portfolio->project_type)
                                <li class="mb-2"><strong>Type:</strong> {{ $portfolio->project_type }}</li>
                            @endif
                            @if ($portfolio->industry)
                                <li class="mb-2"><strong>Industry:</strong> {{ $portfolio->industry }}</li>
                            @endif
                            @if ($portfolio->project_duration)
                                <li class="mb-2"><strong>Duration:</strong> {{ $portfolio->project_duration }}</li>
                            @endif
                        </ul>
                        @if ($portfolio->project_url)
                            <a href="{{ $portfolio->project_url }}" target="_blank" rel="noopener noreferrer"
                                class="btn btn-outline-secondary w-100 text-center mb-2">Visit Live Site</a>
                        @endif
                        <a href="{{ route('front.contact.index') }}" class="btn btn-main w-100 text-center">Start a
                            Similar Project</a>
                    </div>
                </div>
                <!-- End Sidebar Section -->
            </div>

            <!-- Start Related Projects Section -->
            @if ($related->isNotEmpty())
                <div class="section-title st-center mt-5">
                    <h3>More Projects</h3>
                </div>
                <div class="row g-4">
                    @foreach ($related as $item)
                        <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="office-item h-100">
                                <div class="office-img">
                                    <img src="{{ \App\Helper::img($item->featured_image) }}"
                                        alt="{{ $item->title }}">
                                    <div class="office-icon"><i class="fas fa-briefcase"></i></div>
                                </div>
                                <div class="office-content">
                                    <h4><a href="{{ route('front.portfolios.details', $item->slug) }}"
                                            class="text-decoration-none"
                                            style="color:inherit;">{{ $item->title }}</a></h4>
                                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->overview), 90) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <!-- End Related Projects Section -->
        </div>
    </section>
    <!-- End Portfolio Details Section -->

@endsection
