<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('booking.user', 'booking.event')->latest()->paginate(10);
        $total_revenue = Payment::where('status', 'completed')->sum('amount');
        $completed_payments = Payment::where('status', 'completed')->count();
        $pending_payments = Payment::where('status', 'pending')->count();
        $failed_payments = Payment::where('status', 'failed')->count();

        return view('payments.index', compact('payments', 'total_revenue', 'completed_payments', 'pending_payments', 'failed_payments'));
    }

    public function show(Booking $booking)
    {
        return view('payments.show', compact('booking'));
    }

    public function process(Request $request, Booking $booking)
    {
        // Simple mock payment processing
        $payment = Payment::create([
            'transaction_id' => 'TXN-' . time() . '-' . rand(1000, 9999),
            'booking_id' => $booking->id,
            'amount' => $booking->total_amount,
            'payment_method' => $request->payment_method ?? 'card',
            'status' => 'completed',
            'payment_date' => now(),
        ]);

        $booking->update(['status' => 'confirmed']);

        return redirect()->route('student.bookings.index')->with('success', 'Payment successful!');
    }
}
