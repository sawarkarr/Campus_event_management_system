<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('category', 'organizer');

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $events = $query->latest()->paginate(10);
        $categories = EventCategory::all();

        return view('events.index', compact('events', 'categories'));
    }

    public function show($slug)
    {
        $event = Event::with('category', 'organizer', 'tickets')->where('slug', $slug)->firstOrFail();
        return view('events.show', compact('event'));
    }

    public function create()
    {
        $categories = EventCategory::all();
        return view('events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:event_categories,id',
            'location' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
        }

        $event = Event::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'description' => $request->description,
            'category_id' => $request->category_id,
            'organizer_id' => Auth::id(),
            'location' => $request->location,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'capacity' => $request->capacity,
            'status' => 'published',
            'image' => $imagePath,
        ]);

        // Create a default ticket for the event
        \App\Models\Ticket::create([
            'event_id' => $event->id,
            'name' => 'Regular Ticket',
            'price' => 0.00,
            'quantity' => $request->capacity,
            'available_quantity' => $request->capacity,
            'description' => 'Standard event admission',
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        // Check authorization
        if (Auth::user()->hasRole('admin') || $event->organizer_id == Auth::id()) {
            $categories = EventCategory::all();
            return view('events.edit', compact('event', 'categories'));
        }
        return abort(403);
    }

    public function update(Request $request, Event $event)
    {
        if (!Auth::user()->hasRole('admin') && $event->organizer_id != Auth::id()) {
            return abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required|exists:event_categories,id',
            'location' => 'required',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($event->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        if (!Auth::user()->hasRole('admin') && $event->organizer_id != Auth::id()) {
            return abort(403);
        }

        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
