<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'description', 'category_id', 'organizer_id',
        'location', 'start_time', 'end_time', 'image', 'capacity', 'status', 'is_featured'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'category_id');
    }

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
