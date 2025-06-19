<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komuni extends Model
{
    protected $table = 'komuni';

    protected $fillable = [
        'umat_id',
        'gereja_tempat_komuni',
        'tanggal_komuni',
        'surat_komuni',

        'status_pendaftaran',
        'tanggal_pendaftaran',
        'status_penerimaan',
        'tanggal_terima',
    ];

    protected $casts = [
        'tanggal_daftar' => 'datetime',
        'tanggal_terima' => 'datetime',
    ];


    public function umat(){
        return $this->belongsTo(Umat::class);
    }
}
