@extends('backend.layouts.app')
@section('title', config('constants.BUSINESS.name') . ' | Dashboard')

@php
    $statusColors = [
        'new'         => 'primary',
        'in_progress' => 'info',
        'responded'   => 'info',
        'converted'   => 'success',
        'closed'      => 'secondary',
        'spam'        => 'danger',
        'shortlisted' => 'info',
        'interview'   => 'warning',
        'offered'     => 'success',
        'hired'       => 'success',
        'rejected'    => 'danger',
    ];
@endphp

@section('content')

{{-- ================= KPI CARDS ================= --}}
<div class="row g-4 mb-4">

@php
$cards = [
    ['title'=>'New Enquiries','count'=>$stats['enquiries_new'],'sub'=>$stats['enquiries_follow_up'].' need follow-up','icon'=>'bx-message-dots','color'=>'danger','route'=>'admin.enquiries.index'],
    ['title'=>'Published Blogs','count'=>$stats['blogs'],'sub'=>null,'icon'=>'bx-news','color'=>'info','route'=>'admin.blogs.index'],
    ['title'=>'Active Services','count'=>$stats['services'],'sub'=>null,'icon'=>'bx-briefcase','color'=>'warning','route'=>'admin.services.index'],
    ['title'=>'Portfolios','count'=>$stats['portfolios'],'sub'=>null,'icon'=>'bx-collection','color'=>'success','route'=>'admin.portfolios.index'],
    ['title'=>'Case Studies','count'=>$stats['case_studies'],'sub'=>null,'icon'=>'bx-book','color'=>'dark','route'=>'admin.casestudies.index'],
    ['title'=>'Team Members','count'=>$stats['users'],'sub'=>null,'icon'=>'bx-user','color'=>'primary','route'=>'admin.users.index'],
];
@endphp

@foreach($cards as $card)
<div class="col-xl-2 col-md-4 col-sm-6">
    <a href="{{ route($card['route']) }}" class="text-decoration-none">
        <div class="card stat-card stat-{{ $card['color'] }}">
            <div class="card-body d-flex align-items-center">
                <div class="avatar me-3 stat-icon">
                    <span class="avatar-initial rounded">
                        <i class="bx {{ $card['icon'] }}"></i>
                    </span>
                </div>
                <div class="stat-text">
                    <h6 class="mb-0">{{ $card['title'] }}</h6>
                    <h4 class="mb-0">{{ $card['count'] }}</h4>
                    @if($card['sub'])
                        <small class="text-danger">{{ $card['sub'] }}</small>
                    @endif
                </div>
            </div>
        </div>
    </a>
</div>
@endforeach

</div>

{{-- ================= ENQUIRY FUNNEL + FOLLOW-UPS ================= --}}
<div class="row g-4 mb-4">

    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Enquiry Pipeline</h5>
                <a href="{{ route('admin.enquiries.index') }}" class="small">View all</a>
            </div>
            <div class="card-body">
                <canvas id="enquiryStatusChart" height="220"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">Needs Follow-up</h5>
            </div>
            <div class="card-body p-0">
                @if($followUpEnquiries->isEmpty())
                    <p class="text-muted p-3 mb-0">Nothing pending follow-up. You're all caught up.</p>
                @else
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Follow-up</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($followUpEnquiries as $enquiry)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.enquiries.details', $enquiry->uuid) }}">
                                            {{ $enquiry->name }}
                                        </a>
                                    </td>
                                    <td class="text-truncate" style="max-width: 220px;">{{ $enquiry->subject ?? '—' }}</td>
                                    <td><span class="badge bg-label-{{ $statusColors[$enquiry->status] ?? 'secondary' }}">{{ ucfirst(str_replace('_',' ', $enquiry->status)) }}</span></td>
                                    <td>{{ $enquiry->follow_up_at?->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

</div>

{{-- ================= CONTENT MIX + RECENT ENQUIRIES ================= --}}
<div class="row g-4 mb-4">

    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">Content Distribution</h5>
            </div>
            <div class="card-body">
                <canvas id="contentChart" height="240"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Enquiries</h5>
                <a href="{{ route('admin.enquiries.index') }}" class="small">View all</a>
            </div>
            <div class="card-body p-0">
                @if($recentEnquiries->isEmpty())
                    <p class="text-muted p-3 mb-0">No enquiries yet.</p>
                @else
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Received</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentEnquiries as $enquiry)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.enquiries.details', $enquiry->uuid) }}">
                                            {{ $enquiry->name }}
                                        </a>
                                        <div class="text-muted small">{{ $enquiry->email }}</div>
                                    </td>
                                    <td>{{ ucfirst($enquiry->type ?? '—') }}</td>
                                    <td><span class="badge bg-label-{{ $statusColors[$enquiry->status] ?? 'secondary' }}">{{ ucfirst(str_replace('_',' ', $enquiry->status)) }}</span></td>
                                    <td>{{ $enquiry->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

</div>

{{-- ================= ACTIVITY + SECURITY LOGS ================= --}}
<div class="row g-4 mb-4">

    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Activity</h5>
                <a href="{{ route('admin.activity-logs.index') }}" class="small">View all</a>
            </div>
            <div class="card-body p-0">
                @if($recentActivity->isEmpty())
                    <p class="text-muted p-3 mb-0">No activity recorded yet.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($recentActivity as $log)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div>
                                    <span class="badge bg-label-secondary me-1">{{ $log->action }}</span>
                                    {{ $log->description ?? ($log->module . ' updated') }}
                                    <div class="text-muted small">
                                        {{ $log->user?->name ?? 'System' }} · {{ $log->ip_address }}
                                    </div>
                                </div>
                                <small class="text-muted text-nowrap ms-2">{{ $log->created_at->diffForHumans() }}</small>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Login &amp; Security Activity</h5>
                <a href="{{ route('admin.auth.logs.index') }}" class="small">View all</a>
            </div>
            <div class="card-body p-0">
                @if($recentAuthLogs->isEmpty())
                    <p class="text-muted p-3 mb-0">No login activity recorded yet.</p>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach($recentAuthLogs as $log)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div>
                                    <span class="badge bg-label-{{ $log->is_success ? 'success' : 'danger' }} me-1">
                                        {{ str_replace('_', ' ', $log->event) }}
                                    </span>
                                    {{ $log->user?->name ?? 'Unknown user' }}
                                    <div class="text-muted small">
                                        {{ $log->ip_address }} · {{ $log->browser ?? 'Unknown browser' }} · {{ $log->device ?? '—' }}
                                    </div>
                                </div>
                                <small class="text-muted text-nowrap ms-2">{{ $log->created_at->diffForHumans() }}</small>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

</div>

{{-- ================= TOP CONTENT + CAREER PIPELINE ================= --}}
<div class="row g-4">

    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">Top Performing Content</h5>
            </div>
            <div class="card-body p-0">
                @if($topContent->isEmpty())
                    <p class="text-muted p-3 mb-0">No views recorded yet.</p>
                @else
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th class="text-end">Views</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topContent as $item)
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td><span class="badge bg-label-info">{{ $item->type }}</span></td>
                                    <td class="text-end">{{ number_format($item->views) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Career Application Pipeline</h5>
                <a href="{{ route('admin.careers.applications.index') }}" class="small">View all</a>
            </div>
            <div class="card-body">
                @php
                    $pipelineStages = ['new','shortlisted','interview','offered','hired','rejected'];
                @endphp
                @if($careerPipeline->sum() === 0)
                    <p class="text-muted mb-0">No applications received yet.</p>
                @else
                    @foreach($pipelineStages as $stage)
                        @php $count = $careerPipeline[$stage] ?? 0; @endphp
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-capitalize">{{ str_replace('_',' ', $stage) }}</span>
                            <span class="badge bg-label-{{ $statusColors[$stage] ?? 'secondary' }}">{{ $count }}</span>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

</div>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
(function () {

    const enquiryCanvas = document.getElementById('enquiryStatusChart');
    if (enquiryCanvas) {
        new Chart(enquiryCanvas, {
            type: 'doughnut',
            data: {
                labels: @json($enquiryStatusBreakdown->keys()->map(fn($s) => ucfirst(str_replace('_',' ',$s)))),
                datasets: [{
                    data: @json($enquiryStatusBreakdown->values()),
                    backgroundColor: ['#0d6efd', '#0dcaf0', '#198754', '#6c757d', '#dc3545', '#ffc107'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }

    const contentCanvas = document.getElementById('contentChart');
    if (contentCanvas) {
        new Chart(contentCanvas, {
            type: 'pie',
            data: {
                labels: @json(array_keys($contentDistribution)),
                datasets: [{
                    data: @json(array_values($contentDistribution)),
                    backgroundColor: ['#0dcaf0', '#ffc107', '#198754', '#212529', '#0d6efd'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }

})();
</script>
@endpush
