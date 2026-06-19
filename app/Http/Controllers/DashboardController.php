<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            return $this->adminDashboard();
        } elseif ($user->hasRole('organizer')) {
            return $this->organizerDashboard();
        } else {
            return $this->studentDashboard();
        }
    }

    private function adminDashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_events' => Event::count(),
            'total_bookings' => Booking::count(),
            'total_revenue' => Booking::where('status', 'confirmed')->sum('total_amount'),
        ];
        
        $recent_events = Event::with('category', 'organizer')->latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recent_events'));
    }

    private function organizerDashboard()
    {
        $user = Auth::user();
        $stats = [
            'my_events' => Event::where('organizer_id', $user->id)->count(),
            'total_attendees' => Booking::whereHas('event', function($q) use ($user) {
                $q->where('organizer_id', $user->id);
            })->where('status', 'confirmed')->sum('quantity'),
            'my_revenue' => Booking::whereHas('event', function($q) use ($user) {
                $q->where('organizer_id', $user->id);
            })->where('status', 'confirmed')->sum('total_amount'),
        ];
        
        $my_events = Event::where('organizer_id', $user->id)->latest()->take(5)->get();
        
        return view('organizer.dashboard', compact('stats', 'my_events'));
    }

    private function studentDashboard()
    {
        $user = Auth::user();
        $stats = [
            'my_bookings' => Booking::where('user_id', $user->id)->count(),
            'upcoming_events' => Event::where('start_time', '>', now())->count(),
        ];
        
        $my_recent_bookings = Booking::with('event')->where('user_id', $user->id)->latest()->take(5)->get();
        
        return view('student.dashboard', compact('stats', 'my_recent_bookings'));
    }
}
