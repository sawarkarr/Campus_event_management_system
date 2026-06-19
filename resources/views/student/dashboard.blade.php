@extends('layouts.admin')

@section('title', 'Student Dashboard')

@section('content')

<div class="space-y-8">

    <!-- Welcome Section -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-500 p-8 text-white shadow-2xl">
        
        <div class="absolute top-0 right-0 opacity-10 text-[180px] font-bold leading-none">
            🎓
        </div>

        <div class="relative z-10">
            <h1 class="text-4xl font-bold mb-3">
                Welcome back, {{ Auth::user()->name }} 👋
            </h1>

            <p class="text-white/80 text-lg">
                Track your bookings, upcoming campus events, and download tickets easily.
            </p>

            <div class="mt-6 flex flex-wrap gap-4">
                <a href="{{ route('student.bookings.index') }}"
                   class="px-5 py-3 bg-white text-indigo-700 rounded-xl font-semibold shadow hover:bg-gray-100 transition duration-300">
                    View My Bookings
                </a>

                <a href="#"
                   class="px-5 py-3 bg-white/20 backdrop-blur-lg border border-white/20 rounded-xl font-semibold hover:bg-white/30 transition duration-300">
                    Explore Events
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Bookings -->
        <div class="group relative overflow-hidden rounded-2xl bg-white shadow-lg hover:shadow-2xl transition duration-500">
            
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-cyan-500 opacity-5 group-hover:opacity-10 transition"></div>

            <div class="relative p-6 flex items-center justify-between">
                
                <div>
                    <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">
                        My Bookings
                    </p>

                    <h3 class="text-4xl font-bold text-gray-800 mt-2">
                        {{ $stats['my_bookings'] }}
                    </h3>

                    <p class="text-blue-600 mt-2 text-sm font-medium">
                        Active Event Reservations
                    </p>
                </div>

                <div class="w-20 h-20 rounded-2xl bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center shadow-lg">
                    <i class="fas fa-ticket-alt text-3xl text-white"></i>
                </div>
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="group relative overflow-hidden rounded-2xl bg-white shadow-lg hover:shadow-2xl transition duration-500">
            
            <div class="absolute inset-0 bg-gradient-to-r from-green-500 to-emerald-500 opacity-5 group-hover:opacity-10 transition"></div>

            <div class="relative p-6 flex items-center justify-between">

                <div>
                    <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">
                        Upcoming Events
                    </p>

                    <h3 class="text-4xl font-bold text-gray-800 mt-2">
                        {{ $stats['upcoming_events'] }}
                    </h3>

                    <p class="text-green-600 mt-2 text-sm font-medium">
                        Events Happening Soon
                    </p>
                </div>

                <div class="w-20 h-20 rounded-2xl bg-gradient-to-r from-green-500 to-emerald-500 flex items-center justify-center shadow-lg">
                    <i class="fas fa-calendar-check text-3xl text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">

        <!-- Header -->
        <div class="flex items-center justify-between px-8 py-6 border-b border-gray-100 bg-gray-50">
            
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    My Recent Bookings
                </h2>

                <p class="text-gray-500 text-sm mt-1">
                    View and manage your latest event registrations
                </p>
            </div>

            <a href="{{ route('student.bookings.index') }}"
               class="px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl shadow hover:scale-105 transition duration-300">
                View All
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-100">

                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Event Name
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Booking Ref
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Date
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Status
                        </th>

                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">

                    @forelse($my_recent_bookings as $booking)

                    <tr class="hover:bg-indigo-50/40 transition duration-300">

                        <td class="px-6 py-5">
                            <div class="font-semibold text-gray-800">
                                {{ $booking->event->title }}
                            </div>
                        </td>

                        <td class="px-6 py-5">
                            <code class="px-3 py-1 rounded-lg bg-gray-100 text-indigo-600 font-semibold">
                                {{ $booking->booking_reference }}
                            </code>
                        </td>

                        <td class="px-6 py-5 text-gray-600">
                            {{ $booking->booking_date->format('M d, Y') }}
                        </td>

                        <td class="px-6 py-5">

                            @if($booking->status == 'confirmed')

                                <span class="px-4 py-1.5 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                                    Confirmed
                                </span>

                            @else

                                <span class="px-4 py-1.5 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-700">
                                    Pending
                                </span>

                            @endif

                        </td>

                        <td class="px-6 py-5">

                            @if($booking->status == 'confirmed')

                                <a href="{{ route('student.tickets.download', $booking->id) }}"
                                   class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-medium shadow hover:scale-105 transition duration-300">

                                    <i class="fas fa-download"></i>
                                    Download Ticket
                                </a>

                            @else

                                <button class="px-4 py-2 rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed text-sm">
                                    Not Available
                                </button>

                            @endif

                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center">

                            <div class="flex flex-col items-center justify-center">

                                <div class="w-20 h-20 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                                    <i class="fas fa-calendar-times text-3xl text-indigo-500"></i>
                                </div>

                                <h3 class="text-xl font-semibold text-gray-700 mb-2">
                                    No Bookings Found
                                </h3>

                                <p class="text-gray-500">
                                    You haven’t booked any events yet.
                                </p>
                            </div>

                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>
        </div>
    </div>

</div>

@endsection