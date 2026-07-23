@extends('front.layouts.app')

@section('title', 'Free Website Speed Test — ' . config('constants.BUSINESS.name'))
@section('meta_description', 'Check any website\'s Google PageSpeed Insights score instantly — performance, SEO, accessibility, and best practices, right here on our site.')

@section('content')

    <!-- Start Hero Section -->
    <div class="slider-area">
        <div class="single-slider hero-overly slider-height2 d-flex align-items-center"
            data-background="{{ asset('assets/front/img/hero/h1_hero.avif') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap pt-100">
                            <h2>Free Website Speed Test</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Speed Test</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Speed Test Section -->
    <section class="py-5">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center mb-5">
                    <h3 style="color:#073965;">Check Any Website's Google PageSpeed Score</h3>
                    <p class="text-muted">Powered by Google PageSpeed Insights — enter a URL below to see performance, SEO, accessibility, and best-practices scores instantly.</p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <form id="speedTestForm" class="d-flex flex-wrap gap-3 align-items-center justify-content-center mb-3">
                        @csrf
                        <input type="url" id="speedTestUrl" class="form-control" style="max-width:420px;"
                               placeholder="https://example.com" required>

                        <select id="speedTestStrategy" class="form-select" style="max-width:160px;">
                            <option value="mobile">Mobile</option>
                            <option value="desktop">Desktop</option>
                        </select>

                        <button type="submit" id="speedTestBtn" class="btn btn-main px-4">
                            <span id="speedTestBtnText">Check Speed</span>
                            <span id="speedTestSpinner" class="spinner-border spinner-border-sm ms-1 d-none" role="status"></span>
                        </button>
                    </form>
                    <div id="speedTestError" class="text-danger text-center small d-none"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Speed Test Section -->

    <!-- Speed Test Results Modal -->
    <div class="modal fade" id="speedTestModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Speed Test Results</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-muted small mb-4" id="speedTestResultUrl"></p>

                    <div class="row text-center g-4 mb-4">
                        <div class="col-6 col-md-3">
                            <div class="speed-score-circle" id="scorePerformance">—</div>
                            <div class="small mt-2">Performance</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="speed-score-circle" id="scoreSeo">—</div>
                            <div class="small mt-2">SEO</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="speed-score-circle" id="scoreAccessibility">—</div>
                            <div class="small mt-2">Accessibility</div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="speed-score-circle" id="scoreBestPractices">—</div>
                            <div class="small mt-2">Best Practices</div>
                        </div>
                    </div>

                    <table class="table table-sm">
                        <tbody>
                            <tr>
                                <td>First Contentful Paint</td>
                                <td class="text-end fw-semibold" id="metricFcp">—</td>
                            </tr>
                            <tr>
                                <td>Largest Contentful Paint</td>
                                <td class="text-end fw-semibold" id="metricLcp">—</td>
                            </tr>
                            <tr>
                                <td>Total Blocking Time</td>
                                <td class="text-end fw-semibold" id="metricTbt">—</td>
                            </tr>
                            <tr>
                                <td>Cumulative Layout Shift</td>
                                <td class="text-end fw-semibold" id="metricCls">—</td>
                            </tr>
                            <tr>
                                <td>Speed Index</td>
                                <td class="text-end fw-semibold" id="metricSi">—</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @once
    <style>
        .speed-score-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
            margin: 0 auto;
            color: #fff;
            background: #9aa4b4;
        }
        .speed-score-circle.score-good { background: #0cce6b; }
        .speed-score-circle.score-average { background: #ffa400; }
        .speed-score-circle.score-poor { background: #ff4e42; }
    </style>
    @endonce

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('speedTestForm');
    var btn = document.getElementById('speedTestBtn');
    var btnText = document.getElementById('speedTestBtnText');
    var spinner = document.getElementById('speedTestSpinner');
    var errorBox = document.getElementById('speedTestError');
    var csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    function scoreClass(score) {
        if (score === null || score === undefined) return '';
        if (score >= 90) return 'score-good';
        if (score >= 50) return 'score-average';
        return 'score-poor';
    }

    function setScore(elId, score) {
        var el = document.getElementById(elId);
        el.textContent = (score === null || score === undefined) ? '—' : score;
        el.className = 'speed-score-circle ' + scoreClass(score);
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        var url = document.getElementById('speedTestUrl').value;
        var strategy = document.getElementById('speedTestStrategy').value;

        errorBox.classList.add('d-none');
        btn.disabled = true;
        btnText.textContent = 'Checking...';
        spinner.classList.remove('d-none');

        fetch('{{ route('front.pagespeed.check') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ url: url, strategy: strategy })
        })
            .then(function (response) { return response.json().then(function (data) { return { status: response.status, data: data }; }); })
            .then(function (result) {
                btn.disabled = false;
                btnText.textContent = 'Check Speed';
                spinner.classList.add('d-none');

                if (!result.data.success) {
                    errorBox.textContent = result.data.message || 'Something went wrong. Please try again.';
                    errorBox.classList.remove('d-none');
                    return;
                }

                var data = result.data;
                document.getElementById('speedTestResultUrl').textContent = data.url + ' — ' + (data.strategy === 'mobile' ? 'Mobile' : 'Desktop');

                setScore('scorePerformance', data.scores.performance);
                setScore('scoreSeo', data.scores.seo);
                setScore('scoreAccessibility', data.scores.accessibility);
                setScore('scoreBestPractices', data.scores.best_practices);

                document.getElementById('metricFcp').textContent = data.metrics.first_contentful_paint;
                document.getElementById('metricLcp').textContent = data.metrics.largest_contentful_paint;
                document.getElementById('metricTbt').textContent = data.metrics.total_blocking_time;
                document.getElementById('metricCls').textContent = data.metrics.cumulative_layout_shift;
                document.getElementById('metricSi').textContent = data.metrics.speed_index;

                new bootstrap.Modal(document.getElementById('speedTestModal')).show();
            })
            .catch(function () {
                btn.disabled = false;
                btnText.textContent = 'Check Speed';
                spinner.classList.add('d-none');
                errorBox.textContent = 'Something went wrong. Please try again.';
                errorBox.classList.remove('d-none');
            });
    });
});
</script>
@endpush
