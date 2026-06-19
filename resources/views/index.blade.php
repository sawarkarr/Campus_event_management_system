@extends('layouts.app')

@section('title', 'Campus Event Management & Ticketing System')

@section('content')
    <!-- Hero Section -->
    <section class="hero pt-[70px]">
        <div class="hero-content">
            <div class="hero-badge animate-fadeIn">
                <i class="fas fa-star text-yellow-500"></i>
                <span>#1 Campus Event Platform</span>
            </div>
            
            <h1 class="animate-fadeIn" style="animation-delay: 0.1s;">
                Manage Campus Events <br>
                <span>With Ease</span>
            </h1>
            
            <p class="animate-fadeIn" style="animation-delay: 0.2s;">
                Streamline event creation, ticketing, and attendance tracking for your campus. 
                The all-in-one solution for universities and colleges.
            </p>
            
            <div class="hero-buttons animate-fadeIn" style="animation-delay: 0.3s;">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-rocket"></i>
                    Get Started Free
                </a>
                <a href="{{ route('events.index') }}" class="btn btn-outline btn-lg">
                    <i class="fas fa-search"></i>
                    Browse Events
                </a>
            </div>
            
            <div class="hero-stats animate-fadeIn" style="animation-delay: 0.4s;">
                <div class="hero-stat">
                    <h3>500+</h3>
                    <p>Events Hosted</p>
                </div>
                <div class="hero-stat">
                    <h3>10K+</h3>
                    <p>Active Users</p>
                </div>
                <div class="hero-stat">
                    <h3>50+</h3>
                    <p>Universities</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Features Section -->
    <section class="features">
        <div class="section-header">
            <h2>Powerful Features</h2>
            <p>Everything you need to manage campus events efficiently</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon bg-blue-100 text-blue-600">
                    <i class="fas fa-calendar-plus"></i>
                </div>
                <h3>Event Creation</h3>
                <p>Create and manage academic, cultural, technical, and sports events with customizable details and schedules.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon bg-green-100 text-green-600">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <h3>Smart Ticketing</h3>
                <p>Digital ticketing system with QR codes, automated booking confirmations, and seat management.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon bg-purple-100 text-purple-600">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <h3>Analytics Dashboard</h3>
                <p>Real-time insights with interactive charts for attendance, revenue, and event performance tracking.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon bg-orange-100 text-orange-600">
                    <i class="fas fa-credit-card"></i>
                </div>
                <h3>Payment Management</h3>
                <p>Secure payment processing for paid events with multiple payment options and automatic invoicing.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon bg-pink-100 text-pink-600">
                    <i class="fas fa-bell"></i>
                </div>
                <h3>Smart Notifications</h3>
                <p>Automated email and SMS notifications for event reminders, confirmations, and updates.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon bg-cyan-100 text-cyan-600">
                    <i class="fas fa-users-cog"></i>
                </div>
                <h3>Role Management</h3>
                <p>Multi-level access control for administrators, organizers, and students with permissions.</p>
            </div>
        </div>
    </section>
    
    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary to-primary-dark">
        <div class="max-w-4xl mx-auto text-center px-6">
            <h2 class="text-4xl font-bold text-white mb-6">
                Ready to Transform Your Campus Events?
            </h2>
            <p class="text-white/80 text-lg mb-10">
                Join thousands of students and organizers already using Event Hub
            </p>
            <div class="flex gap-4 justify-center flex-wrap">
                <a href="{{ route('register') }}" class="bg-white text-primary px-8 py-4 rounded-xl font-semibold hover:bg-gray-100 transition-all shadow-lg hover:shadow-xl">
                    Create Free Account
                </a>
                <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-4 rounded-xl font-semibold hover:bg-white/10 transition-all">
                    Contact Sales
                </a>
            </div>
        </div>
    </section>
@endsection
