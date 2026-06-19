<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Attendance;
use App\Models\Booking;

class AttendanceController extends Controller
{
    public function index(Event $event)
    {
        // Check authorization (Admin or Event Organizer)
        if (!auth()->user()->hasRole('admin') && $event->organizer_id != auth()->id()) {
            return abort(403);
        }

        $bookings = Booking::with('user')->where('event_id', $event->id)->where('status', 'confirmed')->get();
        $attendance = Attendance::where('event_id', $event->id)->get()->keyBy('user_id');

        return view('events.attendance', compact('event', 'bookings', 'attendance'));
    }

    public function checkIn(Request $request, Event $event)
    {
        if (!auth()->user()->hasRole('admin') && $event->organizer_id != auth()->id()) {
            return abort(403);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'booking_id' => 'required|exists:bookings,id',
        ]);

        Attendance::updateOrCreate(
            [
                'event_id' => $event->id,
                'user_id' => $request->user_id,
                'booking_id' => $request->booking_id,
            ],
            [
                'check_in_time' => now(),
                'status' => 'checked_in',
            ]
        );

        return back()->with('success', 'Attendee checked in successfully.');
    }
}
