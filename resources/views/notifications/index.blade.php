@extends('layouts.admin')

@section('title', 'Notifications')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Notifications</h1>
            <p class="text-gray-500 mt-1">Manage system alerts and user notifications</p>
        </div>
        <div class="flex gap-3">
            <button class="btn btn-secondary">
                <i class="fas fa-check-double mr-2"></i>Mark All Read
            </button>
            @if(Auth::user()->hasRole('admin'))
                <button class="btn btn-primary">
                    <i class="fas fa-paper-plane mr-2"></i>Send Notification
                </button>
            @endif
        </div>
    </div>

    <!-- Notification List -->
    <div class="card mb-6">
        <div class="divide-y divide-gray-100" id="notificationList">
            @forelse($notifications as $notification)
                <div class="p-6 hover:bg-gray-50 transition-colors flex items-start gap-4 {{ $notification->read_at ? '' : 'bg-blue-50/50' }}">
                    <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $notification->data['title'] ?? 'Notification' }}</p>
                                <p class="text-gray-600 mt-1">{{ $notification->data['message'] ?? '' }}</p>
                                <div class="flex items-center gap-4 mt-2 text-sm text-gray-500">
                                    <span><i class="far fa-clock mr-1"></i>{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center text-gray-500">
                    <i class="fas fa-bell-slash text-4xl mb-4 opacity-20"></i>
                    <p>No notifications found.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
