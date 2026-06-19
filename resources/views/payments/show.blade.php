@extends('layouts.app')

@section('title', 'Complete Payment - ' . $booking->event->title)

@section('content')
    <main class="pt-[120px] pb-20 bg-slate-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-6">
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-bold text-gray-800">Complete Your Payment</h1>
                <p class="text-gray-500 mt-2">Securely finalize your booking for <span class="font-semibold">{{ $booking->event->title }}</span></p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Payment Summary -->
                <div class="md:col-span-1">
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 sticky top-[120px]">
                        <h3 class="font-bold text-gray-800 mb-4 pb-4 border-b border-gray-100">Booking Summary</h3>
                        <div class="space-y-4 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Ticket Type</span>
                                <span class="font-medium text-gray-800">Regular</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Quantity</span>
                                <span class="font-medium text-gray-800">{{ $booking->quantity }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Price per ticket</span>
                                <span class="font-medium text-gray-800">$0.00</span>
                            </div>
                            <div class="pt-4 mt-4 border-t border-gray-100 flex justify-between items-center">
                                <span class="text-gray-800 font-bold">Total</span>
                                <span class="text-2xl font-bold text-primary">${{ number_format($booking->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Methods -->
                <div class="md:col-span-2">
                    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Select Payment Method</h3>
                        
                        <form action="{{ route('payments.process', $booking->id) }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 gap-4">
                                <label class="relative flex items-center p-4 border-2 border-gray-100 rounded-2xl cursor-pointer hover:border-primary transition-all group has-[:checked]:border-primary has-[:checked]:bg-primary/5">
                                    <input type="radio" name="payment_method" value="card" checked class="hidden peer">
                                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mr-4 group-hover:bg-primary group-hover:text-white transition-colors peer-checked:bg-primary peer-checked:text-white">
                                        <i class="fas fa-credit-card text-xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-bold text-gray-800">Credit or Debit Card</p>
                                        <p class="text-sm text-gray-500">Secure payment via Stripe</p>
                                    </div>
                                    <div class="peer-checked:block hidden text-primary">
                                        <i class="fas fa-check-circle text-xl"></i>
                                    </div>
                                </label>

                                <label class="relative flex items-center p-4 border-2 border-gray-100 rounded-2xl cursor-pointer hover:border-primary transition-all group has-[:checked]:border-primary has-[:checked]:bg-primary/5">
                                    <input type="radio" name="payment_method" value="paypal" class="hidden peer">
                                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mr-4 group-hover:bg-primary group-hover:text-white transition-colors peer-checked:bg-primary peer-checked:text-white">
                                        <i class="fab fa-paypal text-xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-bold text-gray-800">PayPal</p>
                                        <p class="text-sm text-gray-500">Pay using your PayPal account</p>
                                    </div>
                                    <div class="peer-checked:block hidden text-primary">
                                        <i class="fas fa-check-circle text-xl"></i>
                                    </div>
                                </label>

                                <label class="relative flex items-center p-4 border-2 border-gray-100 rounded-2xl cursor-pointer hover:border-primary transition-all group has-[:checked]:border-primary has-[:checked]:bg-primary/5">
                                    <input type="radio" name="payment_method" value="bank_transfer" class="hidden peer">
                                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mr-4 group-hover:bg-primary group-hover:text-white transition-colors peer-checked:bg-primary peer-checked:text-white">
                                        <i class="fas fa-university text-xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-bold text-gray-800">Bank Transfer</p>
                                        <p class="text-sm text-gray-500">Direct deposit to university account</p>
                                    </div>
                                    <div class="peer-checked:block hidden text-primary">
                                        <i class="fas fa-check-circle text-xl"></i>
                                    </div>
                                </label>
                            </div>

                            <div class="pt-6 border-t border-gray-100">
                                <button type="submit" class="btn btn-primary w-full py-4 text-lg">
                                    <i class="fas fa-lock mr-2"></i>
                                    Pay ${{ number_format($booking->total_amount, 2) }}
                                </button>
                                <p class="text-center text-xs text-gray-500 mt-4">
                                    <i class="fas fa-shield-alt mr-1"></i> Your payment data is encrypted and secure
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
