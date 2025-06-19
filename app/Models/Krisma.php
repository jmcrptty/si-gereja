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
        'gereja_tempat_krisma',

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
