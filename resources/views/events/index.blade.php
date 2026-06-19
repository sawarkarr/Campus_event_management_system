@extends('layouts.admin')

@section('title', 'Event Management')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Event Management</h1>
            <p class="text-gray-500 mt-1">Create, manage and track all campus events</p>
        </div>
        @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('organizer'))
            <a href="{{ Auth::user()->hasRole('admin') ? route('admin.events.create') : route('organizer.events.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Create New Event
            </a>
        @endif
    </div>

    <!-- Filters -->
    <div class="card mb-6">
        <div class="p-6">
            <form action="{{ route('events.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" placeholder="Search events..." class="form-input pl-12" value="{{ request('search') }}">
                </div>
                <select name="category" class="form-input">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <select name="status" class="form-input">
                    <option value="">All Status</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="btn btn-secondary">Filter</button>
            </form>
        </div>
    </div>

    <!-- Events Table -->
    <div class="card">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Event Details</th>
                        <th>Category</th>
                        <th>Date & Time</th>
                        <th>Venue</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td>
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white">
                                    <i class="fas fa-calendar text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">{{ $event->title }}</h4>
                                    <p class="text-sm text-gray-500">{{ Str::limit($event->description, 30) }}</p>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge badge-info">{{ $event->category->name }}</span></td>
                        <td>
                            <div class="text-sm">
                                <p class="font-medium text-gray-800">{{ $event->start_time->format('M d, Y') }}</p>
                                <p class="text-gray-500">{{ $event->start_time->format('H:i') }}</p>
                            </div>
                        </td>
                        <td>{{ $event->location }}</td>
                        <td><span class="badge badge-{{ $event->status == 'published' ? 'success' : 'warning' }}">{{ ucfirst($event->status) }}</span></td>
                        <td>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('events.show', $event->slug) }}" class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 flex items-center justify-center transition-colors">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(Auth::user()->hasRole('admin') || (Auth::user()->hasRole('organizer') && $event->organizer_id == Auth::id()))
                                    <a href="{{ Auth::user()->hasRole('admin') ? route('admin.events.edit', $event->id) : route('organizer.events.edit', $event->id) }}" class="w-9 h-9 rounded-lg bg-green-50 text-green-600 hover:bg-green-100 flex items-center justify-center transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="p-6 border-t border-gray-100">
            {{ $events->links() }}
        </div>
    </div>
@endsection
