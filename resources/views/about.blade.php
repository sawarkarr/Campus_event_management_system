@extends('layouts.app')

@section('title', 'About Us - Campus Event Management')

@section('content')
    <section class="py-20 bg-gradient-to-br from-primary/5 to-secondary/5 pt-[120px]">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h1 class="text-5xl font-bold text-gray-800 mb-6">About Event Hub</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Transforming campus event management with innovative digital solutions 
                that connect students, organizers, and administrators.
            </p>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Mission</h2>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Campus Event Management & Ticketing System is a comprehensive web-based application 
                        designed to automate and simplify the process of managing campus events. 
                    </p>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Our mission is to eliminate manual processes such as paper-based registrations 
                        and physical ticket distribution, improving transparency and reducing 
                        administrative workload.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        The system provides real-time insights using interactive charts and reports, 
                        making it essential for colleges, universities, and educational institutions 
                        to manage events in a structured and secure manner.
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-50 p-6 rounded-2xl text-center">
                        <i class="fas fa-bullseye text-4xl text-primary mb-4"></i>
                        <h3 class="font-semibold text-gray-800">Efficiency</h3>
                    </div>
                    <div class="bg-green-50 p-6 rounded-2xl text-center">
                        <i class="fas fa-shield-alt text-4xl text-green-600 mb-4"></i>
                        <h3 class="font-semibold text-gray-800">Security</h3>
                    </div>
                    <div class="bg-purple-50 p-6 rounded-2xl text-center">
                        <i class="fas fa-chart-line text-4xl text-purple-600 mb-4"></i>
                        <h3 class="font-semibold text-gray-800">Analytics</h3>
                    </div>
                    <div class="bg-orange-50 p-6 rounded-2xl text-center">
                        <i class="fas fa-users text-4xl text-orange-600 mb-4"></i>
                        <h3 class="font-semibold text-gray-800">Community</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-slate-50">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">System Modules</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-user-shield text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">User Management</h3>
                    <p class="text-gray-600">Handles authentication and authorization for different user roles: Admin, Event Organizer, and Student.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-calendar-alt text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Event Management</h3>
                    <p class="text-gray-600">Allows administrators and organizers to create, update, and delete campus events seamlessly.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-ticket-alt text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Ticketing & Registration</h3>
                    <p class="text-gray-600">Manages event registrations and ticket booking for students with digital QR codes.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-credit-card text-2xl text-orange-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Payment Management</h3>
                    <p class="text-gray-600">Handles paid and free event registrations with secure payment processing.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-pink-100 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-chart-pie text-2xl text-pink-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Dashboard & Analytics</h3>
                    <p class="text-gray-600">Provides visual insights and analytics using interactive charts for data-driven decisions.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-cyan-100 rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-bell text-2xl text-cyan-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Notifications & Reports</h3>
                    <p class="text-gray-600">Sends automated notifications and generates comprehensive reports for administrators.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-12">Project Details</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-slate-50 p-6 rounded-xl">
                    <p class="text-sm text-gray-500 mb-2">Student Name</p>
                    <p class="font-semibold text-gray-800">Shraddha Sawarkar</p>
                </div>
                <div class="bg-slate-50 p-6 rounded-xl">
                    <p class="text-sm text-gray-500 mb-2">Class</p>
                    <p class="font-semibold text-gray-800">MCA</p>
                </div>
                <div class="bg-slate-50 p-6 rounded-xl">
                    <p class="text-sm text-gray-500 mb-2">Platform</p>
                    <p class="font-semibold text-gray-800">Windows OS</p>
                </div>
                <div class="bg-slate-50 p-6 rounded-xl">
                    <p class="text-sm text-gray-500 mb-2">Company</p>
                    <p class="font-semibold text-gray-800">Software & IT Services</p>
                </div>
            </div>
        </div>
    </section>
@endsection
