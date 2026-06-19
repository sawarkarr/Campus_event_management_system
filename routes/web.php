<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\NotificationController;

// Public Routes
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{slug}', [EventController::class, 'show'])->name('events.show');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/contact', function () { return view('contact'); })->name('contact');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes
Route::middleware('auth')->group(function () {
    
    // Common Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', AuthController::class); // User management
        Route::resource('events', EventController::class);
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/analytics', [ReportController::class, 'analytics'])->name('analytics');
    });

    // Organizer Routes
    Route::middleware('organizer')->prefix('organizer')->name('organizer.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('events', EventController::class);
        Route::get('/events/{event}/attendance', [AttendanceController::class, 'index'])->name('events.attendance');
        Route::post('/events/{event}/attendance/check-in', [AttendanceController::class, 'checkIn'])->name('events.checkin');
        Route::get('/reports', [ReportController::class, 'organizerReports'])->name('reports');
    });

    // Student Routes
    Route::middleware('student')->prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.index');
        Route::get('/tickets/{booking}', [TicketController::class, 'download'])->name('tickets.download');
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    });

    // Reports Management
    Route::post('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');

    // Shared Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

    // Profile Management
    Route::get('/profile', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [AuthController::class, 'updatePassword'])->name('profile.password');

    // Booking & Payment (Shared)
    Route::post('/events/{event}/book', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}/payment', [PaymentController::class, 'show'])->name('payments.show');
    Route::post('/payments/{booking}/process', [PaymentController::class, 'process'])->name('payments.process');

});
