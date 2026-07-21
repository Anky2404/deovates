@extends('front.layouts.app')

@section('title', $career->meta_title ?: $career->title)
@section('meta_description', $career->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($career->description), 150))
@section('content')

    <!-- Hero -->
    <!-- Start Hero Section -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ asset('assets/front/img/hero/h1_hero.avif') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>{{ $career->title }}</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('front.career.index') }}">Careers</a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ $career->title }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Career Details Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-8">
                    @if ($career->description)
                        <h4 style="color:#073965;">About the Role</h4>
                        <p class="text-muted mb-4">{{ $career->description }}</p>
                    @endif
                    @if ($career->responsibilities)
                        <h5 style="color:#073965;">Responsibilities</h5>
                        <p class="text-muted mb-4">{{ $career->responsibilities }}</p>
                    @endif
                    @if ($career->requirements)
                        <h5 style="color:#073965;">Requirements</h5>
                        <p class="text-muted mb-4">{{ $career->requirements }}</p>
                    @endif
                    @if ($career->benefits)
                        <h5 style="color:#073965;">Benefits</h5>
                        <p class="text-muted mb-4">{{ $career->benefits }}</p>
                    @endif
                    @php
                        $careerSkills = is_string($career->skills) ? json_decode($career->skills, true) : $career->skills;
                    @endphp
                    @if (!empty($careerSkills))
                        <h5 style="color:#073965;">Skills</h5>
                        <div class="d-flex flex-wrap gap-2 mb-4">
                            @foreach ($careerSkills as $skill)
                                <span class="badge rounded-pill px-3 py-2"
                                    style="background:#f5f8fd;color:#073965;border:1px solid #e3e8f0;">{{ ucfirst($skill) }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="p-4 rounded-4" style="background:#f5f8fd; position:sticky; top:100px;">
                        <h4 class="mb-3" style="color:#073965;">Job Overview</h4>
                        <ul class="list-unstyled mb-4">
                            @if ($career->department)
                                <li class="mb-2"><i class="fas fa-layer-group text-secondary me-2"></i>{{ $career->department->name }}</li>
                            @endif
                            <li class="mb-2"><i class="fas fa-map-marker-alt text-secondary me-2"></i>{{ ucfirst($career->location ?? '') }}{{ $career->is_remote ? ' · Remote' : '' }}</li>
                            <li class="mb-2"><i class="fas fa-briefcase text-secondary me-2"></i>{{ ucfirst(str_replace('-', ' ', $career->employment_type)) }}</li>
                            <li class="mb-2"><i class="fas fa-user-tie text-secondary me-2"></i>{{ ucfirst($career->experience_level) }} level</li>
                            <li class="mb-2"><i class="fas fa-users text-secondary me-2"></i>{{ $career->openings }} opening(s)</li>
                            @if ($career->salary_min && $career->salary_max)
                                <li class="mb-2"><i class="fas fa-money-bill-wave text-secondary me-2"></i>
                                    {{ $career->salary_currency }} {{ number_format($career->salary_min) }} –
                                    {{ number_format($career->salary_max) }}</li>
                            @endif
                            @if ($career->application_deadline)
                                <li class="mb-2"><i class="fas fa-calendar-alt text-secondary me-2"></i>Apply by
                                    {{ $career->application_deadline->format('M d, Y') }}</li>
                            @endif
                        </ul>

                        @if ($career->slug && $career->isOpen())
                            <button type="button" class="btn btn-main w-100 text-center" data-bs-toggle="modal"
                                data-bs-target="#applyJobModal">Apply Now</button>
                        @elseif ($career->apply_url)
                            <a href="{{ $career->apply_url }}" target="_blank" rel="noopener noreferrer"
                                class="btn btn-main w-100 text-center">Apply Now</a>
                        @elseif ($career->apply_email)
                            <a href="mailto:{{ $career->apply_email }}?subject=Application for {{ $career->title }}"
                                class="btn btn-main w-100 text-center">Apply via Email</a>
                        @else
                            <a href="{{ route('front.contact.index') }}" class="btn btn-main w-100 text-center">Apply
                                Now</a>
                        @endif
                    </div>
                </div>
            </div>

            @if ($related->isNotEmpty())
                <!-- Start Related Careers Section -->
                <div class="section-title st-center mt-5">
                    <h3>Other Open Roles</h3>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach ($related as $item)
                        <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="office-item">
                                <div class="office-content d-flex flex-wrap align-items-center justify-content-between gap-3"
                                    style="padding:28px 30px;">
                                    <h4 class="mb-0"><a href="{{ route('front.career.details', $item->slug) }}"
                                            class="text-decoration-none"
                                            style="color:inherit;">{{ $item->title }}</a></h4>
                                    <a href="{{ route('front.career.details', $item->slug) }}"
                                        class="btn btn-main flex-shrink-0">View Role</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- End Related Careers Section -->
            @endif
        </div>
    </section>
    <!-- End Career Details Section -->

    <!-- Start Apply Job Modal -->
    <div class="modal fade" id="applyJobModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('front.career.apply', $career->slug) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" style="color:#073965;">Apply for {{ $career->title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" required>
                                @error('full_name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                                @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Portfolio URL</label>
                                <input type="url" name="portfolio_url" class="form-control" value="{{ old('portfolio_url') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Current Company</label>
                                <input type="text" name="current_company" class="form-control" value="{{ old('current_company') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Current CTC</label>
                                <input type="number" name="current_ctc" class="form-control" value="{{ old('current_ctc') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Notice Period (days)</label>
                                <input type="number" name="notice_period" class="form-control" value="{{ old('notice_period') }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Cover Letter</label>
                                <textarea name="cover_letter" rows="4" class="form-control">{{ old('cover_letter') }}</textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Resume (PDF/DOC, max 5MB) *</label>
                                <input type="file" name="resume_file" class="form-control" accept=".pdf,.doc,.docx" required>
                                @error('resume_file') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-main">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Apply Job Modal -->

    @if ($errors->any() || session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var modal = new bootstrap.Modal(document.getElementById('applyJobModal'));
                modal.show();
            });
        </script>
    @endif

@endsection
