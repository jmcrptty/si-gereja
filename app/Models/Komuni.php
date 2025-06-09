<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komuni extends Model
{
    protected $table = 'komuni';

    protected $fillable = [
        'umat_id',
        'tanggal_pembaptisan',
        'surat_baptis'
    ];

    public function umat(){
        return $this->belongsTo(Umat::class);
    }
}
