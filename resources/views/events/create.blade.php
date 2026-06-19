@extends('layouts.admin')

@section('title', 'Create Event')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <a href="{{ route('events.index') }}" class="text-primary hover:text-primary-dark mb-2 inline-block">
                <i class="fas fa-arrow-left mr-1"></i> Back to Events
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Create New Event</h1>
            <p class="text-gray-500 mt-1">Fill in the details below to host a new campus event.</p>
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

        <form action="{{ Auth::user()->hasRole('admin') ? route('admin.events.store') : route('organizer.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="card p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="form-group md:col-span-2">
                        <label class="form-label">Event Title *</label>
                        <input type="text" name="title" class="form-input" placeholder="e.g. Annual Tech Symposium" value="{{ old('title') }}" required>
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                        <label class="form-label">Category *</label>
                        <select name="category_id" class="form-input" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Capacity -->
                    <div class="form-group">
                        <label class="form-label">Capacity *</label>
                        <input type="number" name="capacity" class="form-input" placeholder="Max attendees" value="{{ old('capacity') }}" min="1" required>
                    </div>

                    <!-- Location -->
                    <div class="form-group md:col-span-2">
                        <label class="form-label">Location/Venue *</label>
                        <input type="text" name="location" class="form-input" placeholder="e.g. Main Auditorium, Room 101" value="{{ old('location') }}" required>
                    </div>

                    <!-- Start Time -->
                    <div class="form-group">
                        <label class="form-label">Start Date & Time *</label>
                        <input type="datetime-local" name="start_time" class="form-input" value="{{ old('start_time') }}" required>
                    </div>

                    <!-- End Time -->
                    <div class="form-group">
                        <label class="form-label">End Date & Time *</label>
                        <input type="datetime-local" name="end_time" class="form-input" value="{{ old('end_time') }}" required>
                    </div>

                    <!-- Description -->
                    <div class="form-group md:col-span-2">
                        <label class="form-label">Description *</label>
                        <textarea name="description" rows="6" class="form-textarea" placeholder="Tell us more about the event..." required>{{ old('description') }}</textarea>
                    </div>

                    <!-- Event Image -->
                    <div class="form-group md:col-span-2">
                        <label class="form-label">Event Banner Image</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-primary transition-colors cursor-pointer" onclick="document.getElementById('imageInput').click()">
                            <div class="space-y-1 text-center">
                                <i class="fas fa-image text-4xl text-gray-400 mb-2"></i>
                                <div class="flex text-sm text-gray-600">
                                    <span class="relative cursor-pointer bg-white rounded-md font-medium text-primary hover:text-primary-dark">Upload a file</span>
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
                        <i class="fas fa-save mr-2"></i> Create Event
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
