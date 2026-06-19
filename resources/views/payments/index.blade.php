@extends('layouts.admin')

@section('title', 'Payment Management')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Payment Management</h1>
            <p class="text-gray-500 mt-1">Track and manage all transactions</p>
        </div>
        <div class="flex gap-3">
            <button class="btn btn-secondary">
                <i class="fas fa-download mr-2"></i>Export
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-info">
                <h3>${{ number_format($total_revenue, 2) }}</h3>
                <p>Total Revenue</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $completed_payments }}</h3>
                <p>Completed</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $pending_payments }}</h3>
                <p>Pending</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon red">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $failed_payments }}</h3>
                <p>Failed</p>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>User</th>
                        <th>Event</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>
                        <td class="font-mono text-sm">#{{ $payment->transaction_id }}</td>
                        <td>{{ $payment->booking->user->name }}</td>
                        <td>{{ $payment->booking->event->title }}</td>
                        <td class="font-semibold">${{ number_format($payment->amount, 2) }}</td>
                        <td>{{ ucfirst($payment->payment_method) }}</td>
                        <td><span class="badge badge-{{ $payment->status == 'completed' ? 'success' : ($payment->status == 'pending' ? 'warning' : 'danger') }}">{{ ucfirst($payment->status) }}</span></td>
                        <td>{{ $payment->payment_date->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-6 border-t border-gray-100">
            {{ $payments->links() }}
        </div>
    </div>
@endsection
