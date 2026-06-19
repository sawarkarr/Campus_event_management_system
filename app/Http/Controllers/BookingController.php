<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Booking;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:5',
            'ticket_id' => 'required|exists:tickets,id',
        ]);

        $ticket = $event->tickets()->where('id', $request->ticket_id)->first();
        
        if (!$ticket) {
            return back()->with('error', 'Invalid ticket selected for this event.');
        }

        if ($ticket->available_quantity < $request->quantity) {
            return back()->with('error', 'Not enough tickets available.');
        }

        // Simple free booking for now
        $booking = Booking::create([
            'booking_reference' => 'BK-' . strtoupper(Str::random(8)),
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'ticket_id' => $ticket->id,
            'quantity' => $request->quantity,
            'total_amount' => $ticket->price * $request->quantity,
            'status' => 'confirmed',
            'booking_date' => now(),
        ]);

        // Update ticket quantity
        $ticket->decrement('available_quantity', $request->quantity);

        return redirect()->route('student.bookings.index')->with('success', 'Booking confirmed successfully!');
    }

    public function myBookings()
    {
        $bookings = Booking::with('event')->where('user_id', Auth::id())->latest()->paginate(10);
        return view('student.bookings.index', compact('bookings'));
    }
}
