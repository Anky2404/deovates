@extends('backend.layouts.app')

@section('title', 'Audit Lead Details')

@section('content')

<div class="card mb-4">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Audit Lead Details</h5>
        <a href="{{ route('admin.website-audit-leads.index') }}" class="btn btn-sm btn-secondary">
            <i class="bx bx-arrow-back"></i> Back
        </a>
    </div>

    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-4"><strong>Type</strong><p class="mb-0">
                <span class="badge bg-label-{{ $lead->type === 'seo' ? 'info' : 'primary' }}">{{ ucfirst($lead->type) }}</span>
            </p></div>
            <div class="col-md-4"><strong>Status</strong><p class="mb-0">
                <span class="badge bg-label-{{ $lead->status === 'completed' ? 'success' : ($lead->status === 'partial' ? 'warning' : 'danger') }}">{{ ucfirst($lead->status) }}</span>
            </p></div>
            <div class="col-md-4"><strong>Submitted At</strong><p class="mb-0">{{ $lead->created_at->format('d M Y, h:i A') }}</p></div>

            <div class="col-md-4"><strong>Name</strong><p class="mb-0">{{ $lead->name }}</p></div>
            <div class="col-md-4"><strong>Email</strong><p class="mb-0">{{ $lead->email }}</p></div>
            <div class="col-md-4"><strong>Phone</strong><p class="mb-0">{{ $lead->phone ?? '—' }}</p></div>

            <div class="col-md-6"><strong>Website URL</strong><p class="mb-0">
                <a href="{{ $lead->url }}" target="_blank" rel="noopener">{{ $lead->url }}</a>
            </p></div>
            <div class="col-md-3"><strong>IP Address</strong><p class="mb-0">{{ $lead->ip_address ?? '—' }}</p></div>
            <div class="col-md-3"><strong>User Agent</strong><p class="mb-0 small text-muted">{{ $lead->user_agent ?? '—' }}</p></div>
        </div>
    </div>
</div>

@php
    $scoreLabels = ['performance' => 'Performance', 'seo' => 'SEO', 'accessibility' => 'Accessibility', 'best_practices' => 'Best Practices'];
    $metricLabels = [
        'first_contentful_paint' => 'First Contentful Paint',
        'largest_contentful_paint' => 'Largest Contentful Paint',
        'total_blocking_time' => 'Total Blocking Time',
        'cumulative_layout_shift' => 'Cumulative Layout Shift',
        'speed_index' => 'Speed Index',
    ];

    $mobileScores = $lead->mobile_scores ?? [];
    $desktopScores = $lead->desktop_scores ?? [];
    $mobileMetrics = $lead->mobile_metrics ?? [];
    $desktopMetrics = $lead->desktop_metrics ?? [];

    if (! function_exists('auditScoreBadge')) {
        function auditScoreBadge($score) {
            if ($score === null) return 'bg-label-secondary';
            if ($score >= 90) return 'bg-label-success';
            if ($score >= 50) return 'bg-label-warning';
            return 'bg-label-danger';
        }
    }
@endphp

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Full Report — Mobile vs Desktop</h5>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th style="width:220px;">Metric</th>
                    <th class="text-center"><i class="fas fa-mobile-alt me-1"></i> Mobile</th>
                    <th class="text-center"><i class="fas fa-desktop me-1"></i> Desktop</th>
                </tr>
            </thead>
            <tbody>
                <tr class="table-light">
                    <td colspan="3"><strong>Scores</strong></td>
                </tr>
                @foreach ($scoreLabels as $key => $label)
                    <tr>
                        <td>{{ $label }}</td>
                        <td class="text-center">
                            <span class="badge {{ auditScoreBadge($mobileScores[$key] ?? null) }}">
                                {{ $mobileScores[$key] ?? '—' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="badge {{ auditScoreBadge($desktopScores[$key] ?? null) }}">
                                {{ $desktopScores[$key] ?? '—' }}
                            </span>
                        </td>
                    </tr>
                @endforeach

                <tr class="table-light">
                    <td colspan="3"><strong>Metrics</strong></td>
                </tr>
                @foreach ($metricLabels as $key => $label)
                    <tr>
                        <td>{{ $label }}</td>
                        <td class="text-center">{{ $mobileMetrics[$key] ?? '—' }}</td>
                        <td class="text-center">{{ $desktopMetrics[$key] ?? '—' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@if ($lead->type === 'seo' && $lead->seo_audit)
    @php
        $seo = $lead->seo_audit;
        $seoItems = [
            ['label' => 'Title Tag', 'ok' => $seo['title']['ok'] ?? false, 'detail' => ($seo['title']['value'] ?? '—') . ' (' . ($seo['title']['length'] ?? 0) . ' chars)'],
            ['label' => 'Meta Description', 'ok' => $seo['meta_description']['ok'] ?? false, 'detail' => ($seo['meta_description']['value'] ? ($seo['meta_description']['length'] . ' chars') : 'Missing')],
            ['label' => 'Single H1 Heading', 'ok' => $seo['h1_ok'] ?? false, 'detail' => 'H1 count: ' . ($seo['headings']['h1'] ?? 0)],
            ['label' => 'Canonical URL', 'ok' => $seo['canonical']['ok'] ?? false, 'detail' => $seo['canonical']['value'] ?? 'Missing'],
            ['label' => 'Robots Meta (indexable)', 'ok' => $seo['robots']['ok'] ?? false, 'detail' => $seo['robots']['value'] ?? 'Not blocked'],
            ['label' => 'Mobile Viewport Tag', 'ok' => $seo['viewport']['ok'] ?? false, 'detail' => ''],
            ['label' => 'HTML Lang Attribute', 'ok' => $seo['lang']['ok'] ?? false, 'detail' => $seo['lang']['value'] ?? 'Missing'],
            ['label' => 'Favicon Present', 'ok' => $seo['favicon_ok'] ?? false, 'detail' => ''],
            ['label' => 'Open Graph Tags', 'ok' => $seo['open_graph_ok'] ?? false, 'detail' => ''],
            ['label' => 'Twitter Card Tags', 'ok' => $seo['twitter_card_ok'] ?? false, 'detail' => ''],
            ['label' => 'Image ALT Coverage', 'ok' => $seo['images']['ok'] ?? false, 'detail' => ($seo['images']['missing_alt'] ?? 0) . ' of ' . ($seo['images']['total'] ?? 0) . ' images missing ALT'],
            ['label' => 'Structured Data (Schema)', 'ok' => $seo['schema_ok'] ?? false, 'detail' => ''],
        ];
    @endphp
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">On-Page SEO Checklist</h5>
        </div>
        <div class="card-body">
            @if (($seo['success'] ?? true) === false)
                <p class="text-danger mb-0">{{ $seo['message'] ?? 'Could not run the SEO checklist for this URL.' }}</p>
            @else
                <ul class="list-unstyled mb-0">
                    @foreach ($seoItems as $item)
                        <li class="d-flex align-items-start gap-2 py-2 border-bottom">
                            @if ($item['ok'])
                                <i class="bx bx-check-circle text-success mt-1"></i>
                            @else
                                <i class="bx bx-error-circle text-danger mt-1"></i>
                            @endif
                            <div>
                                <div class="fw-semibold">{{ $item['label'] }}</div>
                                @if ($item['detail'])
                                    <div class="small text-muted">{{ $item['detail'] }}</div>
                                @endif
                            </div>
                        </li>
                    @endforeach
                    <li class="d-flex align-items-start gap-2 pt-2">
                        <i class="bx bx-link text-info mt-1"></i>
                        <div class="small text-muted">
                            Internal links: {{ $seo['links']['internal'] ?? 0 }} &nbsp;|&nbsp; External links: {{ $seo['links']['external'] ?? 0 }}
                        </div>
                    </li>
                </ul>
            @endif
        </div>
    </div>
@endif

@endsection
