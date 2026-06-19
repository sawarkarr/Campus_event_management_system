<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'description', 'image', 'is_active'];

    public function events()
    {
        return $this->hasMany(Event::class, 'category_id');
    }
}
