<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Campus Event Management')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
                        accent: '#f59e0b',
                        success: '#10b981',
                        danger: '#ef4444',
                        warning: '#f59e0b',
                        info: '#3b82f6',
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
    
    <!-- Loading Overlay -->
    <div id="loader" class="loader-overlay">
        <div class="loader"></div>
    </div>
    
    <!-- Toast Container -->
    <div id="toastContainer" class="toast-container"></div>
    
    @include('partials.header')
    
    <main>
        @yield('content')
    </main>
    
    @include('partials.footer')
    
    <!-- JavaScript -->
    <script src="{{ asset('script.js') }}"></script>
    <script>
        // Mobile menu toggle
        document.getElementById('mobileToggle')?.addEventListener('click', function() {
            document.getElementById('navMenu').classList.toggle('active');
        });
        
        // Hide loader when page loads
        window.addEventListener('load', function() {
            setTimeout(() => {
                document.getElementById('loader')?.classList.add('hidden');
            }, 500);
        });

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
