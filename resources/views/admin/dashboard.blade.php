@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
        <p class="text-gray-500">Here's what's happening in your campus events today.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $stats['total_users'] }}</h3>
                <p>Total Users</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-calendar"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $stats['total_events'] }}</h3>
                <p>Total Events</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $stats['total_bookings'] }}</h3>
                <p>Total Bookings</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-info">
                <h3>${{ number_format($stats['total_revenue'], 2) }}</h3>
                <p>Total Revenue</p>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Bar Chart - Event Categories -->
        <div class="chart-container">
            <div class="chart-header">
                <h3 class="chart-title">Events by Category</h3>
            </div>
            <div class="chart-wrapper">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>

        <!-- Pie Chart - Ticket Distribution -->
        <div class="chart-container">
            <div class="chart-header">
                <h3 class="chart-title">Ticket Distribution</h3>
            </div>
            <div class="chart-wrapper" style="height: 280px;">
                <canvas id="ticketChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Events Table -->
        <div class="lg:col-span-2 card">
            <div class="card-header">
                <h3 class="card-title">Recent Events</h3>
                <a href="{{ route('admin.events.index') }}" class="text-primary hover:text-primary-dark text-sm font-medium">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Organizer</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recent_events as $event)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <span class="font-medium">{{ $event->title }}</span>
                                </div>
                            </td>
                            <td><span class="badge badge-info">{{ $event->category->name }}</span></td>
                            <td>{{ $event->start_time->format('M d, Y') }}</td>
                            <td><span class="badge badge-{{ $event->status == 'published' ? 'success' : 'warning' }}">{{ ucfirst($event->status) }}</span></td>
                            <td>{{ $event->organizer->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quick Actions</h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('admin.events.create') }}" class="w-full flex items-center gap-3 p-4 rounded-xl bg-green-50 hover:bg-green-100 transition-colors text-left">
                    <div class="w-10 h-10 rounded-lg bg-green-500 text-white flex items-center justify-center">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Create Event</p>
                        <p class="text-sm text-gray-500">Add new campus event</p>
                    </div>
                </a>
                
                <a href="{{ route('admin.reports.index') }}" class="w-full flex items-center gap-3 p-4 rounded-xl bg-green-50 hover:bg-green-100 transition-colors text-left">
                    <div class="w-10 h-10 rounded-lg bg-green-500 text-white flex items-center justify-center">
                        <i class="fas fa-file-export"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Export Report</p>
                        <p class="text-sm text-gray-500">Download analytics</p>
                    </div>
                </a>
                
                <a href="{{ route('admin.users.index') }}" class="w-full flex items-center gap-3 p-4 rounded-xl bg-orange-50 hover:bg-orange-100 transition-colors text-left">
                    <div class="w-10 h-10 rounded-lg bg-orange-500 text-white flex items-center justify-center">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Manage Users</p>
                        <p class="text-sm text-gray-500">Register new member</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Bar Chart - Event Categories
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        new Chart(categoryCtx, {
            type: 'bar',
            data: {
                labels: ['Academic', 'Cultural', 'Technical', 'Sports', 'Others'],
                datasets: [{
                    label: 'Number of Events',
                    data: [12, 19, 8, 15, 5],
                    backgroundColor: 'rgba(79, 70, 229, 0.8)',
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } }
            }
        });

        // Pie Chart - Ticket Distribution
        const ticketCtx = document.getElementById('ticketChart').getContext('2d');
        new Chart(ticketCtx, {
            type: 'doughnut',
            data: {
                labels: ['Sold', 'Available'],
                datasets: [{
                    data: [75, 25],
                    backgroundColor: ['#4f46e5', '#e2e8f0']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    });
</script>
@endpush
