@extends('layouts.app')

@section('title', $event->title . ' - Campus Event Management')

@section('content')
    <main class="pt-[100px] pb-20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Event Content -->
                <div class="lg:col-span-2">
                    <div class="mb-8">
                        <img src="{{ $event->image ? asset('storage/' . $event->image) : 'https://via.placeholder.com/800x400' }}" alt="{{ $event->title }}" class="w-full h-[400px] object-cover rounded-3xl shadow-lg">
                    </div>
                    
                    <div class="flex items-center gap-3 mb-6">
                        <span class="badge badge-info">{{ $event->category->name }}</span>
                        <span class="text-gray-500 text-sm"><i class="fas fa-clock mr-1"></i> Posted {{ $event->created_at->diffForHumans() }}</span>
                    </div>

                    <h1 class="text-4xl font-bold text-gray-800 mb-6">{{ $event->title }}</h1>
                    
                    <div class="prose prose-lg max-w-none text-gray-600 mb-10">
                        {!! nl2br(e($event->description)) !!}
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 p-8 bg-white rounded-2xl shadow-sm border border-gray-100 mb-10">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-calendar-alt text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Date & Time</h4>
                                <p class="text-gray-600">{{ $event->start_time->format('M d, Y') }}</p>
                                <p class="text-sm text-gray-500">{{ $event->start_time->format('H:i') }} - {{ $event->end_time->format('H:i') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-green-50 text-green-600 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Location</h4>
                                <p class="text-gray-600">{{ $event->location }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Capacity</h4>
                                <p class="text-gray-600">{{ $event->capacity }} Attendees</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user-tie text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Organizer</h4>
                                <p class="text-gray-600">{{ $event->organizer->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-[100px]">
                        <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6">Book Your Spot</h3>
                            
                            @auth
                                <form action="{{ route('bookings.store', $event->id) }}" method="POST" class="space-y-6">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">Select Ticket Type</label>
                                        <select name="ticket_id" class="form-input" required>
                                            <option value="">Choose a ticket</option>
                                            @foreach($event->tickets as $ticket)
                                                <option value="{{ $ticket->id }}">
                                                    {{ $ticket->name }} - {{ $ticket->price > 0 ? '$' . number_format($ticket->price, 2) : 'Free' }}
                                                    ({{ $ticket->available_quantity }} available)
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-label">Quantity</label>
                                        <input type="number" name="quantity" class="form-input" value="1" min="1" max="5" required>
                                    </div>

                                    <div class="pt-4 border-t border-gray-100">
                                        <div class="flex justify-between items-center mb-6">
                                            <span class="text-gray-600 font-medium">Total Amount</span>
                                            <span class="text-3xl font-bold text-primary">$0.00</span>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary w-full py-4 text-lg">
                                            <i class="fas fa-ticket-alt mr-2"></i>
                                            Book Now
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div class="text-center py-6">
                                    <p class="text-gray-600 mb-6">Please sign in to book your tickets for this event.</p>
                                    <a href="{{ route('login') }}" class="btn btn-primary w-full">Sign In to Book</a>
                                </div>
                            @endauth

                            <div class="mt-8 pt-6 border-t border-gray-100">
                                <div class="flex items-center gap-3 text-sm text-gray-500">
                                    <i class="fas fa-shield-alt text-green-500"></i>
                                    <span>Secure Booking Guaranteed</span>
                                </div>
                            </div>
                        </div>

                        <!-- Share Event -->
                        <div class="mt-6 bg-slate-50 rounded-2xl p-6 border border-gray-100">
                            <h4 class="font-semibold text-gray-800 mb-4 text-center">Share this Event</h4>
                            <div class="flex justify-center gap-4">
                                <button class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:opacity-90 transition-opacity">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                                <button class="w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center hover:opacity-90 transition-opacity">
                                    <i class="fab fa-twitter"></i>
                                </button>
                                <button class="w-10 h-10 rounded-full bg-red-600 text-white flex items-center justify-center hover:opacity-90 transition-opacity">
                                    <i class="fab fa-pinterest-p"></i>
                                </button>
                                <button class="w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center hover:opacity-90 transition-opacity">
                                    <i class="fab fa-whatsapp"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
