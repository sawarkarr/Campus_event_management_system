<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class TicketController extends Controller
{
    public function download(Booking $booking)
    {
        // Check ownership
        if ($booking->user_id != auth()->id()) {
            return abort(403);
        }

        return response()->json([
            'message' => 'Ticket download functionality would generate a PDF here.',
            'booking_ref' => $booking->booking_reference,
            'event' => $booking->event->title,
            'attendee' => $booking->user->name
        ]);
    }
}
