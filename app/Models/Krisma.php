<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Krisma extends Model
{
    protected $table = 'krisma';

    protected $fillable = [
        'umat_id',
        'surat_krisma',
        'tanggal_krisma',
        'gereja_tempat_krisma'
    ];

    public function umat(){
        return $this->belongsTo(Umat::class);
    }
}
