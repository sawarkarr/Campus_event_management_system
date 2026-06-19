@extends('layouts.app')

@section('title', 'Register - Campus Event Management')

@section('content')
    <div class="auth-page">
        <div class="auth-container" style="max-width: 1000px;">
            <div class="auth-visual">
                <div class="mb-8">
                    <i class="fas fa-user-plus text-6xl mb-4"></i>
                </div>
                <h2>Join Event Hub!</h2>
                <p class="mb-8">Create your account and start managing campus events efficiently.</p>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle"></i>
                        <span>Free registration</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle"></i>
                        <span>Access all events</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-check-circle"></i>
                        <span>Real-time notifications</span>
                    </div>
                </div>
            </div>
            
            <div class="auth-form-wrapper" style="padding: 40px;">
                <div class="auth-header">
                    <h1>Create Account</h1>
                    <p>Fill in your details to get started</p>
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

                <form action="{{ route('register') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label class="form-label">Full Name *</label>
                            <div class="relative">
                                <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="text" 
                                    id="fullName" 
                                    name="name"
                                    class="form-input pl-12" 
                                    placeholder="Enter your full name"
                                    value="{{ old('name') }}"
                                    required
                                >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Email Address *</label>
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
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label class="form-label">Role *</label>
                            <div class="relative">
                                <i class="fas fa-user-tag absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <select id="role" name="role" class="form-input pl-12" required>
                                    <option value="">Select Role</option>
                                    <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                                    <option value="organizer" {{ old('role') == 'organizer' ? 'selected' : '' }}>Event Organizer</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <div class="relative">
                                <i class="fas fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    name="phone"
                                    class="form-input pl-12" 
                                    placeholder="Enter phone number"
                                    value="{{ old('phone') }}"
                                >
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label class="form-label">Password *</label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password"
                                    class="form-input pl-12 pr-12" 
                                    placeholder="Create password"
                                    required
                                >
                                <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="togglePassword('password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Confirm Password *</label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="password" 
                                    id="confirmPassword" 
                                    name="password_confirmation"
                                    class="form-input pl-12 pr-12" 
                                    placeholder="Confirm password"
                                    required
                                >
                                <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600" onclick="togglePassword('confirmPassword')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" id="terms" name="terms" class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary mt-0.5" required>
                            <span class="text-sm text-gray-600">
                                I agree to the <a href="#" class="text-primary hover:underline">Terms of Service</a> and 
                                <a href="#" class="text-primary hover:underline">Privacy Policy</a> *
                            </span>
                        </label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-full">
                        <i class="fas fa-user-plus"></i>
                        Create Account
                    </button>
                </form>
                
                <div class="auth-footer">
                    <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
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
