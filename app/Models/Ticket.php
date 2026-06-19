<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'event_id', 'name', 'price', 'quantity', 'available_quantity',
        'sale_start', 'sale_end', 'description'
    ];

    protected $casts = [
        'sale_start' => 'datetime',
        'sale_end' => 'datetime',
        'price' => 'decimal:2',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
