<!-- Navigation -->
<nav class="main-nav">
    <a href="{{ route('home') }}" class="nav-brand">
        <i class="fas fa-calendar-alt"></i>
        <span>Event Hub</span>
    </a>
    
    <ul class="nav-menu" id="navMenu">
        <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"><i class="fas fa-info-circle"></i> About</a></li>
        <li><a href="{{ route('events.index') }}" class="nav-link {{ request()->routeIs('events.*') ? 'active' : '' }}"><i class="fas fa-calendar"></i> Events</a></li>
        @auth
            <li><a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> Dashboard</a></li>
        @endauth
        <li><a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"><i class="fas fa-envelope"></i> Contact</a></li>
    </ul>
    
    <div class="nav-actions">
        @guest
            <a href="{{ route('login') }}" class="btn btn-outline btn-sm">Sign In</a>
            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Get Started</a>
        @else
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-slate-700">Hi, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="btn btn-outline btn-sm">Logout</button>
                </form>
            </div>
        @endguest
    </div>
    
    <button class="mobile-toggle" id="mobileToggle">
        <i class="fas fa-bars"></i>
    </button>
</nav>
