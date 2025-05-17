<?php

// app/Models/Pengumuman.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'jenis_pengumuman',
        'title',
        'sub',
        'image',
        'content',
    ];
}

