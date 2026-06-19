<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['title', 'type', 'parameters', 'file_path', 'generated_by'];

    protected $casts = [
        'parameters' => 'json',
    ];

    public function generator()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
}
