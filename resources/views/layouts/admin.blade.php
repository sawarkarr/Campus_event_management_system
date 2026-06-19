<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Campus Event Management</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',
                        'primary-dark': '#4338ca',
                        secondary: '#06b6d4',
                        success: '#10b981',
                        warning: '#f59e0b',
                        danger: '#ef4444',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    @stack('styles')
</head>
<body class="font-sans bg-slate-50">
    <div id="loader" class="loader-overlay">
        <div class="loader"></div>
    </div>
    <div id="toastContainer" class="toast-container"></div>

    <!-- Navigation Header -->
    <nav class="main-nav fixed top-0 left-0 right-0 z-50">
        <div class="flex items-center justify-between h-[70px] px-6 bg-white shadow-sm">
            <a href="{{ route('home') }}" class="nav-brand">
                <i class="fas fa-calendar-alt"></i>
                <span>Event Hub</span>
            </a>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('notifications.index') }}" class="relative p-2 text-gray-600 hover:text-primary transition-colors">
                    <i class="fas fa-bell text-xl"></i>
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                </a>
                <div class="flex items-center gap-3 pl-4 border-l border-gray-200">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary to-primary-dark flex items-center justify-center text-white font-semibold">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                        <div class="hidden md:block">
                            <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ ucfirst(Auth::user()->roles->first()->name ?? 'User') }}</p>
                        </div>
                    </a>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn btn-outline btn-sm ml-2">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Dashboard Layout -->
    <div class="dashboard-layout pt-[70px]">
        @include('partials.sidebar')

        <!-- Mobile Sidebar Toggle -->
        <button id="sidebarToggle" class="lg:hidden fixed bottom-6 right-6 w-14 h-14 bg-primary text-white rounded-full shadow-lg flex items-center justify-center z-50">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Main Content -->
        <main class="main-content p-6">
            @yield('content')
        </main>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('script.js') }}"></script>
    <script>
        // Hide loader when page loads
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('loader').classList.add('hidden');
            }, 500);
        });

        // Mobile Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });
        }

        // Auto-hide alerts/toasts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100, .toast');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
