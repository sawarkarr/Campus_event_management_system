@extends('layouts.admin')

@section('title', 'Event Attendance - ' . $event->title)

@section('content')
    <div class="mb-8">
        <a href="{{ route('events.index') }}" class="text-primary hover:text-primary-dark mb-2 inline-block">
            <i class="fas fa-arrow-left mr-1"></i> Back to Events
        </a>
        <h1 class="text-3xl font-bold text-gray-800">Event Attendance</h1>
        <p class="text-gray-500 mt-1">Manage check-ins for <span class="font-semibold text-gray-700">{{ $event->title }}</span></p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $bookings->count() }}</h3>
                <p>Total Bookings</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-user-check"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $attendance->where('status', 'checked_in')->count() }}</h3>
                <p>Checked In</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fas fa-user-clock"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $bookings->count() - $attendance->where('status', 'checked_in')->count() }}</h3>
                <p>Remaining</p>
            </div>
        </div>
    </div>

    <!-- Attendees Table -->
    <div class="card">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="font-bold text-gray-800 text-lg">Attendee List</h3>
            <div class="relative w-64">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" placeholder="Search attendee..." class="form-input pl-10 py-2 text-sm">
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Attendee Name</th>
                        <th>Email</th>
                        <th>Booking Ref</th>
                        <th>Check-in Status</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        @php $record = $attendance->get($booking->user_id); @endphp
                        <tr>
                            <td>
                                <div class="font-medium text-gray-800">{{ $booking->user->name }}</div>
                            </td>
                            <td>{{ $booking->user->email }}</td>
                            <td><code>{{ $booking->booking_reference }}</code></td>
                            <td>
                                @if($record && $record->status == 'checked_in')
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle mr-1"></i> Checked In
                                    </span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            </td>
                            <td>
                                {{ $record ? $record->check_in_time->format('H:i:s') : '-' }}
                            </td>
                            <td>
                                @if(!$record || $record->status != 'checked_in')
                                    <form action="{{ route(auth()->user()->hasRole('admin') ? 'admin.events.checkin' : 'organizer.events.checkin', $event->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $booking->user_id }}">
                                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            Check In
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-outline btn-sm" disabled>
                                        Checked In
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-500">No confirmed bookings for this event yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
