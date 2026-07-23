{{--
    Shared "Track Speed" / "Track SEO" popup — used by both hero buttons.
    Usage: @include('front.common.audit-tracker-modal', ['type' => 'speed', 'modalId' => 'speedTrackerModal'])
    $type is either 'speed' or 'seo'; both run the same Google PageSpeed
    Insights report (mobile + desktop), just framed differently.
--}}
@php
    $isSeo = $type === 'seo';
    $toolTitle = $isSeo ? 'SEO Tracking' : 'Speed Tracking';
@endphp

<div class="modal fade audit-tracker-modal" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content audit-tracker-window">

            <div class="audit-tracker-chrome">
                <span class="audit-dot" style="background:#ff5f56;"></span>
                <span class="audit-dot" style="background:#ffbd2e;"></span>
                <span class="audit-dot" style="background:#27c93f;"></span>
                <span class="audit-tracker-title">{{ config('constants.BUSINESS.name') }} — {{ $toolTitle }}</span>
                <button type="button" class="btn-close ms-auto" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form class="audit-lead-form" data-type="{{ $type }}" data-action="{{ route('front.pagespeed.lead') }}">
                    @csrf
                    <h5 class="mb-1">{{ $isSeo ? 'Free SEO Score Check' : 'Free Speed Score Check' }}</h5>
                    <p class="text-muted small mb-3">
                        {{ $isSeo
                            ? 'Get your website\'s SEO, accessibility, and best-practices score — mobile & desktop.'
                            : 'Get your website\'s performance score and key load metrics — mobile & desktop.' }}
                    </p>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone (optional)</label>
                            <input type="tel" name="phone" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Website URL</label>
                            <div class="input-group">
                                <span class="input-group-text">https://</span>
                                <input type="text" name="url" class="form-control audit-url-input"
                                       placeholder="example.com" required>
                            </div>
                        </div>
                    </div>

                    <div class="audit-lead-error text-danger small mt-3 d-none"></div>

                    <button type="submit" class="btn btn-main w-100 mt-4 audit-submit-btn">
                        <span class="audit-submit-text">{{ $isSeo ? 'Check My SEO Score' : 'Check My Speed Score' }}</span>
                        <span class="spinner-border spinner-border-sm ms-1 d-none audit-submit-spinner" role="status"></span>
                    </button>
                </form>

                <div class="audit-results d-none">
                    <p class="text-muted small mb-3 audit-result-url"></p>

                    <ul class="nav nav-pills mb-3" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-audit-tab="mobile" type="button">
                                <i class="fas fa-mobile-alt me-1"></i> Mobile
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-audit-tab="desktop" type="button">
                                <i class="fas fa-desktop me-1"></i> Desktop
                            </button>
                        </li>
                    </ul>

                    <div class="audit-tab-pane" data-audit-pane="mobile">
                        <div class="audit-tab-message text-muted small d-none"></div>
                        <div class="audit-tab-content">
                            <div class="row text-center g-3 mb-3">
                                <div class="col-6 col-md-3">
                                    <div class="audit-score-circle" data-score="performance">—</div>
                                    <div class="small mt-2">Performance</div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="audit-score-circle" data-score="seo">—</div>
                                    <div class="small mt-2">SEO</div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="audit-score-circle" data-score="accessibility">—</div>
                                    <div class="small mt-2">Accessibility</div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="audit-score-circle" data-score="best_practices">—</div>
                                    <div class="small mt-2">Best Practices</div>
                                </div>
                            </div>
                            <table class="table table-sm">
                                <tbody>
                                    <tr><td>First Contentful Paint</td><td class="text-end fw-semibold" data-metric="first_contentful_paint">—</td></tr>
                                    <tr><td>Largest Contentful Paint</td><td class="text-end fw-semibold" data-metric="largest_contentful_paint">—</td></tr>
                                    <tr><td>Total Blocking Time</td><td class="text-end fw-semibold" data-metric="total_blocking_time">—</td></tr>
                                    <tr><td>Cumulative Layout Shift</td><td class="text-end fw-semibold" data-metric="cumulative_layout_shift">—</td></tr>
                                    <tr><td>Speed Index</td><td class="text-end fw-semibold" data-metric="speed_index">—</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="audit-tab-pane d-none" data-audit-pane="desktop">
                        <div class="audit-tab-message text-muted small d-none"></div>
                        <div class="audit-tab-content">
                            <div class="row text-center g-3 mb-3">
                                <div class="col-6 col-md-3">
                                    <div class="audit-score-circle" data-score="performance">—</div>
                                    <div class="small mt-2">Performance</div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="audit-score-circle" data-score="seo">—</div>
                                    <div class="small mt-2">SEO</div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="audit-score-circle" data-score="accessibility">—</div>
                                    <div class="small mt-2">Accessibility</div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="audit-score-circle" data-score="best_practices">—</div>
                                    <div class="small mt-2">Best Practices</div>
                                </div>
                            </div>
                            <table class="table table-sm">
                                <tbody>
                                    <tr><td>First Contentful Paint</td><td class="text-end fw-semibold" data-metric="first_contentful_paint">—</td></tr>
                                    <tr><td>Largest Contentful Paint</td><td class="text-end fw-semibold" data-metric="largest_contentful_paint">—</td></tr>
                                    <tr><td>Total Blocking Time</td><td class="text-end fw-semibold" data-metric="total_blocking_time">—</td></tr>
                                    <tr><td>Cumulative Layout Shift</td><td class="text-end fw-semibold" data-metric="cumulative_layout_shift">—</td></tr>
                                    <tr><td>Speed Index</td><td class="text-end fw-semibold" data-metric="speed_index">—</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@once
<style>
    .audit-tracker-window {
        border-radius: 12px;
        overflow: hidden;
    }
    .audit-tracker-chrome {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 10px 14px;
        background: #f1f1f4;
        border-bottom: 1px solid #e2e2ea;
    }
    .audit-dot {
        width: 11px;
        height: 11px;
        border-radius: 50%;
        display: inline-block;
    }
    .audit-tracker-title {
        margin-left: 10px;
        font-size: 13px;
        font-weight: 600;
        color: #073965;
    }
    @media (max-width: 575px) {
        .audit-tracker-title { font-size: 11px; }
    }

    .audit-score-circle {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        font-weight: 700;
        margin: 0 auto;
        color: #fff;
        background: #9aa4b4;
    }
    .audit-score-circle.score-good { background: #0cce6b; }
    .audit-score-circle.score-average { background: #ffa400; }
    .audit-score-circle.score-poor { background: #ff4e42; }
</style>
@endonce
