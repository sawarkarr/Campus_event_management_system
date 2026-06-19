@extends('layouts.admin')

@section('title', 'My Profile')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Account Settings</h1>
            <p class="text-gray-500 mt-1">Manage your profile information and account security.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Info -->
            <div class="lg:col-span-2 space-y-6">
                <div class="card p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Profile Information</h3>
                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-input" value="{{ old('phone', $user->phone) }}">
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>

                <div class="card p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Update Password</h3>
                    <form action="{{ route('profile.password') }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" class="form-input" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-input" required>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-6">
                <div class="card p-6 text-center">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center text-white text-3xl font-bold mx-auto mb-4">
                        {{ substr($user->name, 0, 2) }}
                    </div>
                    <h4 class="text-xl font-bold text-gray-800">{{ $user->name }}</h4>
                    <p class="text-gray-500 mb-4">{{ ucfirst($user->roles->first()->name ?? 'User') }}</p>
                    <div class="pt-4 border-t border-gray-100">
                        <p class="text-sm text-gray-500">Member since {{ $user->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
