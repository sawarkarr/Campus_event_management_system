@extends('layouts.admin')

@section('title', 'Reports & Analytics')

@section('content')
    <!-- Page Header with Date Filter -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Reports & Analytics</h1>
            <p class="text-gray-500 mt-1">Detailed insights and comprehensive reports</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <select id="dateRange" class="form-input w-auto" onchange="updateCharts()">
                <option value="7">Last 7 Days</option>
                <option value="30" selected>Last 30 Days</option>
                <option value="90">Last 90 Days</option>
                <option value="365">Last Year</option>
            </select>
            <form action="{{ route('reports.generate') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-file-alt mr-2"></i>Generate Report
                </button>
            </form>
            <a href="{{ route('reports.export') }}" class="btn btn-secondary">
                <i class="fas fa-download mr-2"></i>Export CSV
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Key Performance Indicators -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="stat-card bg-gradient-to-br from-blue-500 to-blue-600 text-white">
            <div class="stat-icon bg-white/20">
                <i class="fas fa-calendar-check text-white"></i>
            </div>
            <div class="stat-info">
                <h3 class="text-white">{{ $total_events }}</h3>
                <p class="text-blue-100">Total Events</p>
            </div>
        </div>
        <div class="stat-card bg-gradient-to-br from-green-500 to-green-600 text-white">
            <div class="stat-icon bg-white/20">
                <i class="fas fa-users text-white"></i>
            </div>
            <div class="stat-info">
                <h3 class="text-white">{{ $total_attendees }}</h3>
                <p class="text-green-100">Total Attendees</p>
            </div>
        </div>
        <div class="stat-card bg-gradient-to-br from-orange-500 to-orange-600 text-white">
            <div class="stat-icon bg-white/20">
                <i class="fas fa-ticket-alt text-white"></i>
            </div>
            <div class="stat-info">
                <h3 class="text-white">{{ $total_tickets_sold }}</h3>
                <p class="text-orange-100">Tickets Sold</p>
            </div>
        </div>
        <div class="stat-card bg-gradient-to-br from-purple-500 to-purple-600 text-white">
            <div class="stat-icon bg-white/20">
                <i class="fas fa-dollar-sign text-white"></i>
            </div>
            <div class="stat-info">
                <h3 class="text-white">${{ number_format($total_revenue, 2) }}</h3>
                <p class="text-purple-100">Total Revenue</p>
            </div>
        </div>
    </div>

    <!-- Charts Row - Different from Dashboard -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Line Chart - Booking Trends -->
        <div class="card lg:col-span-2">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-semibold text-lg text-gray-800"><i class="fas fa-chart-line mr-2 text-primary"></i>Booking Trends</h3>
                <div class="flex gap-2">
                    <button class="btn btn-sm btn-secondary" onclick="setChartType('daily')">Daily</button>
                    <button class="btn btn-sm btn-primary" onclick="setChartType('weekly')">Weekly</button>
                </div>
            </div>
            <div class="p-6">
                <canvas id="bookingTrendChart" height="200"></canvas>
            </div>
        </div>
        <!-- Event Status Distribution -->
        <div class="card">
            <div class="p-6 border-b border-gray-100">
                <h3 class="font-semibold text-lg text-gray-800"><i class="fas fa-chart-pie mr-2 text-primary"></i>Event Status</h3>
            </div>
            <div class="p-6">
                <canvas id="eventStatusChart" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Second Row Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Revenue by Category -->
        <div class="card">
            <div class="p-6 border-b border-gray-100">
                <h3 class="font-semibold text-lg text-gray-800"><i class="fas fa-layer-group mr-2 text-primary"></i>Revenue by Category</h3>
            </div>
            <div class="p-6">
                <canvas id="revenueByCategoryChart" height="250"></canvas>
            </div>
        </div>
        <!-- Top Performing Events -->
        <div class="card">
            <div class="p-6 border-b border-gray-100">
                <h3 class="font-semibold text-lg text-gray-800"><i class="fas fa-trophy mr-2 text-primary"></i>Top Performing Events</h3>
            </div>
            <div class="p-6">
                <canvas id="topEventsChart" height="250"></canvas>
            </div>
        </div>
    </div>

    <!-- Report Types Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="card p-6 hover:shadow-lg transition-shadow cursor-pointer" onclick="generateReport('events')">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <i class="fas fa-calendar text-2xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800">Event Report</h4>
                    <p class="text-sm text-gray-500">Complete event analytics</p>
                </div>
            </div>
        </div>
        <div class="card p-6 hover:shadow-lg transition-shadow cursor-pointer" onclick="generateReport('financial')">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl bg-green-100 text-green-600 flex items-center justify-center">
                    <i class="fas fa-dollar-sign text-2xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800">Financial Report</h4>
                    <p class="text-sm text-gray-500">Revenue & transactions</p>
                </div>
            </div>
        </div>
        <div class="card p-6 hover:shadow-lg transition-shadow cursor-pointer" onclick="generateReport('attendance')">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800">Attendance Report</h4>
                    <p class="text-sm text-gray-500">Check-in analytics</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Generated Reports Table -->
    <div class="card">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="font-semibold text-lg text-gray-800"><i class="fas fa-history mr-2 text-primary"></i>Generated Reports History</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Report Name</th>
                        <th>Type</th>
                        <th>Date Range</th>
                        <th>Generated On</th>
                        <th>Generated By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reports as $report)
                    <tr>
                        <td class="font-medium">
                            <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                            {{ $report->title }}
                        </td>
                        <td><span class="badge badge-{{ $report->type == 'financial' ? 'success' : ($report->type == 'attendance' ? 'warning' : 'info') }}">{{ ucfirst($report->type) }}</span></td>
                        <td class="text-gray-500">{{ $report->date_range ?? 'All Time' }}</td>
                        <td>{{ $report->created_at->format('M d, Y H:i') }}</td>
                        <td>{{ $report->generator->name ?? 'System' }}</td>
                        <td>
                            <div class="flex items-center gap-2">
                                <a href="#" class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 flex items-center justify-center" title="Download">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="#" class="w-9 h-9 rounded-lg bg-green-50 text-green-600 hover:bg-green-100 flex items-center justify-center" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-gray-500">
                            <i class="fas fa-folder-open text-4xl mb-2 block"></i>
                            No reports generated yet. Click "Generate Report" to create one.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($reports->hasPages())
        <div class="p-6 border-t border-gray-100">
            {{ $reports->links() }}
        </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Booking Trend Chart (Line)
        const bookingCtx = document.getElementById('bookingTrendChart').getContext('2d');
        new Chart(bookingCtx, {
            type: 'line',
            data: {
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6'],
                datasets: [{
                    label: 'Bookings',
                    data: [65, 78, 90, 81, 95, 110],
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#4f46e5',
                    pointRadius: 6
                }, {
                    label: 'Cancelled',
                    data: [5, 8, 3, 6, 4, 7],
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });

        // Event Status Chart
        const statusCtx = document.getElementById('eventStatusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Published', 'Draft', 'Completed', 'Cancelled'],
                datasets: [{
                    data: [45, 15, 30, 10],
                    backgroundColor: ['#10b981', '#f59e0b', '#4f46e5', '#ef4444'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });

        // Revenue by Category
        const revenueCtx = document.getElementById('revenueByCategoryChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: ['Cultural', 'Technical', 'Sports', 'Academic', 'Workshop'],
                datasets: [{
                    label: 'Revenue ($)',
                    data: [4500, 3200, 2800, 1500, 1200],
                    backgroundColor: ['#4f46e5', '#06b6d4', '#10b981', '#f59e0b', '#8b5cf6'],
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true } }
            }
        });

        // Top Events Chart
        const topEventsCtx = document.getElementById('topEventsChart').getContext('2d');
        new Chart(topEventsCtx, {
            type: 'bar',
            data: {
                labels: ['Tech Fest', 'Cultural Night', 'Sports Day', 'Science Fair', 'Workshop'],
                datasets: [{
                    label: 'Attendees',
                    data: [450, 380, 320, 280, 150],
                    backgroundColor: '#4f46e5',
                    borderRadius: 8
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } }
            }
        });
    });

    function generateReport(type) {
        if(confirm('Generate ' + type + ' report?')) {
            // Submit form or make AJAX call
            showToast('Generating ' + type + ' report...', 'info');
        }
    }

    function updateCharts() {
        showToast('Updating charts...', 'info');
    }

    function setChartType(type) {
        showToast('Switched to ' + type + ' view', 'success');
    }
</script>
@endpush
