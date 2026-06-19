@extends('layouts.app')

@section('title', 'Login - Campus Event Management')

@section('content')
    <div class="auth-page">
        <div class="auth-container">
            <div class="auth-visual">
                <div class="mb-8">
                    <i class="fas fa-calendar-alt text-6xl mb-4"></i>
                </div>
                <h2>Welcome Back!</h2>
                <p class="mb-8">Sign in to access your dashboard, manage events, and track your registrations.</p>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle"></i>
                        <span>Manage your events</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle"></i>
                        <span>Track registrations</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle"></i>
                        <span>Get real-time analytics</span>
                    </div>
                </div>
            </div>
            
            <div class="auth-form-wrapper">
                <div class="auth-header">
                    <h1>Sign In</h1>
                    <p>Enter your credentials to access your account</p>
                </div>
                
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input 
                                type="email" 
                                id="email" 
                                name="email"
                                class="form-input pl-12" 
                                placeholder="Enter your email"
                                value="{{ old('email') }}"
                                required
                            >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input 
                                type="password" 
                                id="password" 
                                name="password"
                                class="form-input pl-12 pr-12" 
                                placeholder="Enter your password"
                                required
                            >
                            <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="togglePassword('password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary">
                            <span class="text-sm text-gray-600">Remember me</span>
                        </label>
                        <a href="#" class="text-sm text-primary hover:text-primary-dark font-medium">Forgot password?</a>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-full">
                        <i class="fas fa-sign-in-alt"></i>
                        Sign In
                    </button>
                </form>
                
                <div class="auth-footer">
                    <p>Don't have an account? <a href="{{ route('register') }}">Create account</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        field.type = field.type === 'password' ? 'text' : 'password';
    }
</script>
@endpush
