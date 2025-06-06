<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumQuestion extends Model
{
     protected $fillable = ['name', 'question', 'answer', 'answered_at'];

      protected $casts = [
        'answered_at' => 'datetime', // Ini penting agar bisa pakai ->format() di Blade
    ];
}

