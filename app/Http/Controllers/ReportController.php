<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Event;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $total_events = Event::count();
        $total_attendees = Booking::where('status', 'confirmed')->sum('quantity');
        $total_tickets_sold = Booking::where('status', 'confirmed')->sum('quantity');
        $total_revenue = Booking::where('status', 'confirmed')->sum('total_amount');
        
        $reports = Report::latest()->paginate(10);

        return view('reports.index', compact('total_events', 'total_attendees', 'total_tickets_sold', 'total_revenue', 'reports'));
    }

    public function analytics()
    {
        return $this->index();
    }

    public function organizerReports()
    {
        $user = Auth::user();
        $total_events = Event::where('organizer_id', $user->id)->count();
        $total_attendees = Booking::whereHas('event', function($q) use ($user) {
            $q->where('organizer_id', $user->id);
        })->where('status', 'confirmed')->sum('quantity');
        $total_tickets_sold = $total_attendees;
        $total_revenue = Booking::whereHas('event', function($q) use ($user) {
            $q->where('organizer_id', $user->id);
        })->where('status', 'confirmed')->sum('total_amount');
        
        $reports = Report::where('generated_by', $user->id)->latest()->paginate(10);

        return view('reports.index', compact('total_events', 'total_attendees', 'total_tickets_sold', 'total_revenue', 'reports'));
    }

    public function generate(Request $request)
    {
        $report = Report::create([
            'title' => 'Report - ' . now()->format('Y-m-d H:i'),
            'type' => 'events',
            'generated_by' => Auth::id(),
        ]);

        return back()->with('success', 'Report generated successfully.');
    }

    public function export()
    {
        return response()->json(['message' => 'Exporting all data to CSV...']);
    }
}
