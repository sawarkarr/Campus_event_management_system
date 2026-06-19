@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <a href="{{ route('events.index') }}" class="text-primary hover:text-primary-dark mb-2 inline-block">
                <i class="fas fa-arrow-left mr-1"></i> Back to Events
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Edit Event</h1>
            <p class="text-gray-500 mt-1">Update the details for your event: <span class="font-semibold">{{ $event->title }}</span></p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ Auth::user()->hasRole('admin') ? route('admin.events.update', $event->id) : route('organizer.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="card p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="form-group md:col-span-2">
                        <label class="form-label">Event Title *</label>
                        <input type="text" name="title" class="form-input" placeholder="e.g. Annual Tech Symposium" value="{{ old('title', $event->title) }}" required>
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                        <label class="form-label">Category *</label>
                        <select name="category_id" class="form-input" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $event->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Capacity -->
                    <div class="form-group">
                        <label class="form-label">Capacity *</label>
                        <input type="number" name="capacity" class="form-input" placeholder="Max attendees" value="{{ old('capacity', $event->capacity) }}" min="1" required>
                    </div>

                    <!-- Location -->
                    <div class="form-group md:col-span-2">
                        <label class="form-label">Location/Venue *</label>
                        <input type="text" name="location" class="form-input" placeholder="e.g. Main Auditorium, Room 101" value="{{ old('location', $event->location) }}" required>
                    </div>

                    <!-- Start Time -->
                    <div class="form-group">
                        <label class="form-label">Start Date & Time *</label>
                        <input type="datetime-local" name="start_time" class="form-input" value="{{ old('start_time', $event->start_time->format('Y-m-d\TH:i')) }}" required>
                    </div>

                    <!-- End Time -->
                    <div class="form-group">
                        <label class="form-label">End Date & Time *</label>
                        <input type="datetime-local" name="end_time" class="form-input" value="{{ old('end_time', $event->end_time->format('Y-m-d\TH:i')) }}" required>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-input" required>
                            <option value="draft" {{ old('status', $event->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $event->status) == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="cancelled" {{ old('status', $event->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="completed" {{ old('status', $event->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="form-group md:col-span-2">
                        <label class="form-label">Description *</label>
                        <textarea name="description" rows="6" class="form-textarea" placeholder="Tell us more about the event..." required>{{ old('description', $event->description) }}</textarea>
                    </div>

                    <!-- Event Image -->
                    <div class="form-group md:col-span-2">
                        <label class="form-label">Event Banner Image</label>
                        @if($event->image)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $event->image) }}" alt="Current Banner" class="w-full h-48 object-cover rounded-xl shadow-sm">
                                <p class="text-sm text-gray-500 mt-2">Current Banner</p>
                            </div>
                        @endif
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-primary transition-colors cursor-pointer" onclick="document.getElementById('imageInput').click()">
                            <div class="space-y-1 text-center">
                                <i class="fas fa-image text-4xl text-gray-400 mb-2"></i>
                                <div class="flex text-sm text-gray-600">
                                    <span class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary-dark">Upload a new file</span>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                            </div>
                            <input id="imageInput" name="image" type="file" class="hidden">
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-4">
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary px-8">
                        <i class="fas fa-save mr-2"></i> Update Event
                    </button>
                </div>
            </div>
        </form>

        <!-- Delete Event (Admin or Owner only) -->
        <div class="mt-12 p-8 border-2 border-red-100 bg-red-50 rounded-3xl">
            <h3 class="text-xl font-bold text-red-700 mb-2">Danger Zone</h3>
            <p class="text-red-600 mb-6">Once you delete an event, there is no going back. Please be certain.</p>
            <form action="{{ Auth::user()->hasRole('admin') ? route('admin.events.destroy', $event->id) : route('organizer.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn bg-red-600 text-white hover:bg-red-700 border-none px-8">
                    <i class="fas fa-trash-alt mr-2"></i> Delete Event
                </button>
            </form>
        </div>
    </div>
@endsection
