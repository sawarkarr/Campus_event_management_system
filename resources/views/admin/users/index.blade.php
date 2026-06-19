@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">User Management</h1>
            <p class="text-gray-500 mt-1">Manage students, organizers, and administrators</p>
        </div>
        <button onclick="showCreateModal()" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Add New User
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $total_users }}</h3>
                <p>Total Users</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $total_students }}</h3>
                <p>Students</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $total_organizers }}</h3>
                <p>Organizers</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="fas fa-user-shield"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $total_admins }}</h3>
                <p>Admins</p>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-6">
        <div class="p-6">
            <form action="{{ route('admin.users.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" placeholder="Search users..." class="form-input pl-12" value="{{ request('search') }}">
                </div>
                <select name="role" class="form-input">
                    <option value="">All Roles</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
                <select name="status" class="form-input">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                </select>
                <button type="submit" class="btn btn-secondary">Filter</button>
            </form>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-semibold">
                                    {{ substr($user->name, 0, 2) }}
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">{{ $user->name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge badge-{{ $role->name == 'admin' ? 'warning' : ($role->name == 'organizer' ? 'info' : 'success') }}">
                                    {{ ucfirst($role->name) }}
                                </span>
                            @endforeach
                        </td>
                        <td><span class="badge badge-{{ $user->status == 'active' ? 'success' : 'danger' }}">{{ ucfirst($user->status) }}</span></td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="flex items-center gap-2">
                                <button onclick="viewUserDetails('{{ $user->name }}', '{{ $user->email }}', '{{ ucfirst($user->status) }}', '{{ $user->created_at->format('M d, Y') }}')" class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 flex items-center justify-center transition-colors">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="w-9 h-9 rounded-lg bg-green-50 text-green-600 hover:bg-green-100 flex items-center justify-center transition-colors">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-9 h-9 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 flex items-center justify-center transition-colors">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="p-6 border-t border-gray-100">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Create User Modal -->
    <div id="createUserModal" class="modal-overlay fixed inset-0 bg-black/50 z-[60] flex items-center justify-center p-4" style="display: none;">
        <div class="modal bg-white rounded-3xl w-full max-w-md shadow-2xl">
            <div class="modal-header p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="modal-title text-xl font-bold text-gray-800">Add New User</h3>
                <button onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body p-6">
                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-input" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="btn btn-primary w-full">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View User Modal -->
    <div id="viewUserModal" class="modal-overlay fixed inset-0 bg-black/50 z-[60] flex items-center justify-center p-4" style="display: none;">
        <div class="modal bg-white rounded-3xl w-full max-w-md shadow-2xl">
            <div class="modal-header p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="modal-title text-xl font-bold text-gray-800">User Details</h3>
                <button onclick="closeViewModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body p-6 space-y-4" id="viewUserContent">
                <!-- Content injected via JS -->
            </div>
            <div class="modal-footer p-6 border-t border-gray-100 flex justify-end">
                <button onclick="closeViewModal()" class="btn btn-secondary">Close</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function showCreateModal() {
        document.getElementById('createUserModal').style.display = 'flex';
    }
    function closeCreateModal() {
        document.getElementById('createUserModal').style.display = 'none';
    }
    function showViewModal() {
        document.getElementById('viewUserModal').style.display = 'flex';
    }
    function closeViewModal() {
        document.getElementById('viewUserModal').style.display = 'none';
    }

    function viewUserDetails(name, email, status, joined) {
        const content = `
            <div class="flex flex-col items-center mb-6">
                <div class="w-20 h-20 rounded-full bg-primary text-white text-2xl font-bold flex items-center justify-center mb-4">
                    ${name.substring(0, 2).toUpperCase()}
                </div>
                <h4 class="text-xl font-bold text-gray-800">${name}</h4>
                <p class="text-gray-500">${email}</p>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between border-b border-gray-50 pb-2">
                    <span class="text-gray-500">Status</span>
                    <span class="font-medium text-gray-800">${status}</span>
                </div>
                <div class="flex justify-between border-b border-gray-50 pb-2">
                    <span class="text-gray-500">Joined Date</span>
                    <span class="font-medium text-gray-800">${joined}</span>
                </div>
            </div>
        `;
        document.getElementById('viewUserContent').innerHTML = content;
        showViewModal();
    }
</script>
@endpush
