@extends('backend.layouts.app')
@section('title', 'Deovate World | Dashboard')

@section('content')

{{-- ================= TOP COLORFUL CARDS ================= --}}
<div class="row g-4 mb-4">

@php
$cards = [
    ['title'=>'Users','count'=>128,'icon'=>'bx-user','color'=>'primary'],
    ['title'=>'Blogs','count'=>46,'icon'=>'bx-news','color'=>'info'],
    ['title'=>'Services','count'=>12,'icon'=>'bx-briefcase','color'=>'warning'],
    ['title'=>'Portfolios','count'=>38,'icon'=>'bx-collection','color'=>'success'],
    ['title'=>'Case Studies','count'=>9,'icon'=>'bx-book','color'=>'dark'],
    ['title'=>'Enquiries','count'=>94,'icon'=>'bx-message-dots','color'=>'danger'],
];
@endphp


@foreach($cards as $card)
<div class="col-xl-2 col-md-4 col-sm-6">
    <div class="card stat-card stat-{{ $card['color'] }} ">
        <div class="card-body d-flex align-items-center">
            <div class="avatar me-3 stat-icon">
                <span class="avatar-initial rounded">
                    <i class="bx {{ $card['icon'] }}"></i>
                </span>
            </div>
            <div class="stat-text">
                <h6 class="mb-0">{{ $card['title'] }}</h6>
                <h4 class="mb-0">{{ $card['count'] }}</h4>
            </div>
        </div>
    </div>
</div>
@endforeach


</div>

{{-- ================= PIE CHART + TABLE ================= --}}
<div class="row g-4 mb-4">

    {{-- Pie Chart --}}
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">Content Distribution</h5>
            </div>
            <div class="card-body">
                <canvas id="dashboardPieChart" height="260"></canvas>
            </div>
        </div>
    </div>

    {{-- Summary Table --}}
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="mb-0">System Overview</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Module</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Users</td><td>128</td><td><span class="badge bg-success">Active</span></td></tr>
                        <tr><td>Blogs</td><td>46</td><td><span class="badge bg-primary">Published</span></td></tr>
                        <tr><td>Services</td><td>12</td><td><span class="badge bg-warning">Live</span></td></tr>
                        <tr><td>Portfolios</td><td>38</td><td><span class="badge bg-info">Completed</span></td></tr>
                        <tr><td>Case Studies</td><td>9</td><td><span class="badge bg-dark">Published</span></td></tr>
                        <tr><td>Enquiries</td><td>94</td><td><span class="badge bg-danger">Pending</span></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- ================= PORTFOLIO PROGRESS TABLE ================= --}}
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Portfolio Progress</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Period</th>
                            <th>Completed</th>
                            <th>Progress</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Today</td>
                            <td>2</td>
                            <td><div class="progress"><div class="progress-bar bg-primary" style="width:20%"></div></div></td>
                        </tr>
                        <tr>
                            <td>This Week</td>
                            <td>8</td>
                            <td><div class="progress"><div class="progress-bar bg-info" style="width:45%"></div></div></td>
                        </tr>
                        <tr>
                            <td>This Month</td>
                            <td>21</td>
                            <td><div class="progress"><div class="progress-bar bg-warning" style="width:70%"></div></div></td>
                        </tr>
                        <tr>
                            <td>This Year</td>
                            <td>38</td>
                            <td><div class="progress"><div class="progress-bar bg-success" style="width:100%"></div></div></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- ================= LATEST DATA TABLE ================= --}}
<div class="row g-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Latest Activities</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Title / Name</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Blog</td><td>Laravel Best Practices</td><td><span class="badge bg-success">Published</span></td><td>2 days ago</td></tr>
                        <tr><td>Portfolio</td><td>Healthcare SaaS</td><td><span class="badge bg-info">Completed</span></td><td>5 days ago</td></tr>
                        <tr><td>Enquiry</td><td>John Doe</td><td><span class="badge bg-warning">New</span></td><td>Today</td></tr>
                        <tr><td>Case Study</td><td>Fintech Platform</td><td><span class="badge bg-primary">Live</span></td><td>1 week ago</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
(function () {

    const canvas = document.getElementById('dashboardPieChart');
    if (!canvas) return;

    // ✅ OFFICIAL FIX: destroy existing chart if any
    const existingChart = Chart.getChart(canvas);
    if (existingChart) {
        existingChart.destroy();
    }

    new Chart(canvas, {
        type: 'pie',
        data: {
            labels: [
                'Blogs',
                'Services',
                'Portfolios',
                'Case Studies',
                'Users',
                'Enquiries'
            ],
            datasets: [{
                data: [46, 12, 38, 9, 128, 94],
                backgroundColor: [
                    '#0dcaf0',
                    '#ffc107',
                    '#198754',
                    '#212529',
                    '#0d6efd',
                    '#dc3545'
                ],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

})();
</script>
@endpush
