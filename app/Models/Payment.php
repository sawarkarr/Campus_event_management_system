<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'transaction_id', 'booking_id', 'amount', 'payment_method',
        'status', 'payment_date', 'payment_details'
    ];

    protected $casts = [
        'payment_date' => 'datetime',
        'amount' => 'decimal:2',
        'payment_details' => 'json',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
