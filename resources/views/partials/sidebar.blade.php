<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h3>Dashboard</h3>
        <p class="text-sm text-gray-500">Manage your events</p>
    </div>
    
    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Overview</span>
            </a>
        </li>
        
        @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('organizer'))
            <li>
                <a href="{{ route(Auth::user()->hasRole('admin') ? 'admin.events.index' : 'organizer.events.index') }}" class="{{ request()->routeIs('*.events.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar"></i>
                    <span>Events</span>
                </a>
            </li>
        @endif

        @if(Auth::user()->hasRole('student'))
            <li>
                <a href="{{ route('student.bookings.index') }}" class="{{ request()->routeIs('*.bookings.*') ? 'active' : '' }}">
                    <i class="fas fa-ticket-alt"></i>
                    <span>My Bookings</span>
                </a>
            </li>
        @endif

        @if(Auth::user()->hasRole('admin'))
            <li>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('*.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.reports.index') }}" class="{{ request()->routeIs('*.reports.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>Reports</span>
                </a>
            </li>
        @endif

        @if(Auth::user()->hasRole('organizer'))
            <li>
                <a href="{{ route('organizer.reports') }}" class="{{ request()->routeIs('*.reports.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>My Reports</span>
                </a>
            </li>
        @endif

        <li>
            <a href="{{ route('notifications.index') }}" class="{{ request()->routeIs('notifications.*') ? 'active' : '' }}">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
            </a>
        </li>
    </ul>
    
    <div class="sidebar-footer">
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 w-full p-3 rounded-xl hover:bg-gray-100 transition-colors text-gray-600">
            <i class="fas fa-cog"></i>
            <span>Settings</span>
        </a>
    </div>
</aside>
