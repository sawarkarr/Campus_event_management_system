@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('admin.users.index') }}" class="text-primary hover:text-primary-dark mb-2 inline-block">
                <i class="fas fa-arrow-left mr-1"></i> Back to Users
            </a>
            <h1 class="text-3xl font-bold text-gray-800">Edit User</h1>
            <p class="text-gray-500 mt-1">Update information for <span class="font-semibold">{{ $user->name }}</span></p>
        </div>

        <div class="card p-8">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-input" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-input" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-input" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-input" required>
                            <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="suspended" {{ $user->status == 'suspended' ? 'selected' : '' }}>Suspended</option>
                        </select>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-100 flex justify-end gap-4">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary px-8">Update User</button>
                </div>
            </form>
        </div>
    </div>
@endsection
