@extends('front.layouts.app')

@section('title', $casestudy->meta_title ?: $casestudy->title)
@section('meta_description', $casestudy->meta_description ?: strip_tags($casestudy->overview))
@section('content')

    <!-- Hero -->
    <!-- Start Hero Section -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ \App\Helper::img($casestudy->banner_image, 'assets/front/img/hero/h3_hero.avif') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>{{ $casestudy->title }}</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('front.casestudies.index') }}">Case Studies</a></li>
                                    <li class="breadcrumb-item active">{{ $casestudy->title }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Case Study Details Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-8">
                    <img src="{{ \App\Helper::img($casestudy->featured_image) }}" class="img-fluid rounded mb-4"
                        alt="{{ $casestudy->title }}">

                    @if ($casestudy->overview)
                        <h4 style="color:#073965;">Overview</h4>
                        <p class="text-muted mb-4">{{ $casestudy->overview }}</p>
                    @endif

                    <div class="row g-4">
                        @if ($casestudy->challenges)
                            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <h5 style="color:#073965;"><i class="fas fa-exclamation-circle text-warning me-2"></i>
                                    Challenges</h5>
                                <p class="text-muted">{{ $casestudy->challenges }}</p>
                            </div>
                        @endif
                        @if ($casestudy->solutions)
                            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                                <h5 style="color:#073965;"><i class="fas fa-lightbulb text-warning me-2"></i>Solutions
                                </h5>
                                <p class="text-muted">{{ $casestudy->solutions }}</p>
                            </div>
                        @endif
                        @if ($casestudy->results)
                            <div class="col-12 wow fadeInUp" data-wow-delay="0.3s">
                                <h5 style="color:#073965;"><i class="fas fa-chart-line text-success me-2"></i>Results
                                </h5>
                                <p class="text-muted">{{ $casestudy->results }}</p>
                            </div>
                        @endif
                    </div>

                    @if ($casestudy->testimonial)
                        <blockquote class="p-4 rounded-4 mt-4" style="background:#f5f8fd;border-left:4px solid #f85603;">
                            <i class="fas fa-quote-left text-muted me-2"></i>{{ $casestudy->testimonial }}
                        </blockquote>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="p-4 rounded-4" style="background:#f5f8fd; position:sticky; top:100px;">
                        <h4 class="mb-3" style="color:#073965;">Case Study Details</h4>
                        <ul class="list-unstyled mb-4">
                            @if ($casestudy->client_name)
                                <li class="mb-2"><strong>Client:</strong> {{ $casestudy->client_name }}</li>
                            @endif
                            @if ($casestudy->category)
                                <li class="mb-2"><strong>Category:</strong> {{ $casestudy->category->name }}</li>
                            @endif
                            @if ($casestudy->industry)
                                <li class="mb-2"><strong>Industry:</strong> {{ $casestudy->industry }}</li>
                            @endif
                            @if ($casestudy->project_duration)
                                <li class="mb-2"><strong>Duration:</strong> {{ $casestudy->project_duration }}</li>
                            @endif
                        </ul>

                        @if (!empty($casestudy->key_metrics))
                            <h5 class="mb-2" style="color:#073965;">Key Metrics</h5>
                            <ul class="list-unstyled mb-4">
                                @foreach ($casestudy->key_metrics as $metric)
                                    <li class="mb-1"><i class="fas fa-check-circle text-success me-2"></i>{{ $metric }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <a href="{{ route('front.contact.index') }}" class="btn btn-main w-100 text-center">Start a
                            Similar Project</a>
                    </div>
                </div>
            </div>

            @if ($related->isNotEmpty())
                <!-- Start Related Case Studies Section -->
                <div class="section-title st-center mt-5">
                    <h3>More Case Studies</h3>
                </div>
                <div class="row g-4">
                    @foreach ($related as $item)
                        <div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="office-item h-100">
                                <div class="office-img">
                                    <img src="{{ \App\Helper::img($item->featured_image) }}" alt="{{ $item->title }}">
                                    <div class="office-icon"><i class="fas fa-chart-line"></i></div>
                                </div>
                                <div class="office-content">
                                    <h4><a href="{{ route('front.casestudies.details', $item->slug) }}"
                                            class="text-decoration-none"
                                            style="color:inherit;">{{ $item->title }}</a></h4>
                                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->overview), 90) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- End Related Case Studies Section -->
            @endif
        </div>
    </section>
    <!-- End Case Study Details Section -->

@endsection
