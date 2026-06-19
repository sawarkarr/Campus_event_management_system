@extends('layouts.admin')

@section('title', 'Organizer Dashboard')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
        <p class="text-gray-500">Manage your events and track attendee registrations.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-calendar"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $stats['my_events'] }}</h3>
                <p>My Events</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $stats['total_attendees'] }}</h3>
                <p>Total Attendees</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-info">
                <h3>${{ number_format($stats['my_revenue'], 2) }}</h3>
                <p>My Revenue</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 card">
            <div class="card-header">
                <h3 class="card-title">My Recent Events</h3>
                <a href="{{ route('organizer.events.index') }}" class="text-primary hover:text-primary-dark text-sm font-medium">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($my_events as $event)
                        <tr>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->start_time->format('M d, Y') }}</td>
                            <td><span class="badge badge-{{ $event->status == 'published' ? 'success' : 'warning' }}">{{ ucfirst($event->status) }}</span></td>
                            <td>
                                <a href="{{ route('organizer.events.edit', $event->id) }}" class="text-blue-600 hover:text-blue-800 mr-3">Edit</a>
                                <a href="{{ route('organizer.events.attendance', $event->id) }}" class="text-green-600 hover:text-green-800">Attendance</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Quick Actions</h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('organizer.events.create') }}" class="w-full flex items-center gap-3 p-4 rounded-xl bg-blue-50 hover:bg-blue-100 transition-colors text-left">
                    <div class="w-10 h-10 rounded-lg bg-blue-500 text-white flex items-center justify-center">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Create Event</p>
                        <p class="text-sm text-gray-500">New campus event</p>
                    </div>
                </a>
                
                <a href="{{ route('organizer.reports') }}" class="w-full flex items-center gap-3 p-4 rounded-xl bg-green-50 hover:bg-green-100 transition-colors text-left">
                    <div class="w-10 h-10 rounded-lg bg-green-500 text-white flex items-center justify-center">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">Event Reports</p>
                        <p class="text-sm text-gray-500">View analytics</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
