<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanSakramen extends Model
{
    protected $table = 'sakramen_controls';

    protected $fillable = [
        'jenis_sakramen',
        'tanggal_mulai',
        'tanggal_selesai',
        'override_status'
    ];
}
