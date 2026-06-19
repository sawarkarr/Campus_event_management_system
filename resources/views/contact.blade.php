@extends('layouts.app')

@section('title', 'Contact Us - Campus Event Management')

@section('content')
    <main class="pt-[70px]">
        <!-- Contact Hero -->
        <section class="py-20 bg-gradient-to-br from-primary/5 to-secondary/5">
            <div class="max-w-6xl mx-auto px-6 text-center">
                <h1 class="text-5xl font-bold text-gray-800 mb-6">Get in Touch</h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Have questions about our campus event management system? We're here to help!
                </p>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="py-20 bg-white">
            <div class="max-w-6xl mx-auto px-6">
                <div class="grid lg:grid-cols-3 gap-12">
                    <!-- Contact Info -->
                    <div class="lg:col-span-1 space-y-8">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-6">Contact Information</h3>
                            <p class="text-gray-600 mb-8">
                                Fill out the form and our team will get back to you within 24 hours.
                            </p>
                        </div>
                        
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Address</h4>
                                    <p class="text-gray-600 text-sm">
                                        Campus Event Hub<br>
                                        123 University Avenue<br>
                                        College Campus, CA 90210
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-green-600 flex-shrink-0">
                                    <i class="fas fa-phone text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Phone</h4>
                                    <p class="text-gray-600 text-sm">
                                        +1 (555) 123-4567<br>
                                        Mon-Fri, 9am-6pm
                                    </p>
                                </div>
                            </div>
                            
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 flex-shrink-0">
                                    <i class="fas fa-envelope text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-1">Email</h4>
                                    <p class="text-gray-600 text-sm">
                                        support@eventhub.edu<br>
                                        info@eventhub.edu
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Social Links -->
                        <div class="pt-8 border-t border-gray-200">
                            <h4 class="font-semibold text-gray-800 mb-4">Follow Us</h4>
                            <div class="flex gap-3">
                                <a href="#" class="w-10 h-10 rounded-lg bg-gray-100 hover:bg-primary hover:text-white flex items-center justify-center text-gray-600 transition-all">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-lg bg-gray-100 hover:bg-primary hover:text-white flex items-center justify-center text-gray-600 transition-all">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-lg bg-gray-100 hover:bg-primary hover:text-white flex items-center justify-center text-gray-600 transition-all">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-lg bg-gray-100 hover:bg-primary hover:text-white flex items-center justify-center text-gray-600 transition-all">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                            <h3 class="text-2xl font-bold text-gray-800 mb-6">Send us a Message</h3>
                            
                            <form id="contactForm" class="space-y-6">
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="form-group">
                                        <label class="form-label">First Name *</label>
                                        <div class="relative">
                                            <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                            <input 
                                                type="text" 
                                                id="firstName" 
                                                name="first_name"
                                                class="form-input pl-12" 
                                                placeholder="Enter first name"
                                                required
                                            >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Last Name *</label>
                                        <div class="relative">
                                            <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                            <input 
                                                type="text" 
                                                id="lastName" 
                                                name="last_name"
                                                class="form-input pl-12" 
                                                placeholder="Enter last name"
                                                required
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="form-group">
                                        <label class="form-label">Email Address *</label>
                                        <div class="relative">
                                            <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                            <input 
                                                type="email" 
                                                id="email" 
                                                name="email"
                                                class="form-input pl-12" 
                                                placeholder="Enter email address"
                                                required
                                            >
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
                                            >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Subject *</label>
                                    <div class="relative">
                                        <i class="fas fa-tag absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                        <select id="subject" name="subject" class="form-input pl-12" required>
                                            <option value="">Select a subject</option>
                                            <option value="general">General Inquiry</option>
                                            <option value="support">Technical Support</option>
                                            <option value="sales">Sales & Pricing</option>
                                            <option value="partnership">Partnership</option>
                                            <option value="feedback">Feedback</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Message *</label>
                                    <textarea 
                                        id="message" 
                                        name="message"
                                        class="form-textarea" 
                                        rows="5" 
                                        placeholder="Write your message here..."
                                        required
                                    ></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary w-full md:w-auto min-w-[200px]">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
<script>
    function toggleFaq(button) {
        const content = button.nextElementSibling;
        const icon = button.querySelector('i');
        content.classList.toggle('hidden');
        icon.style.transform = content.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
    }
</script>
@endpush
