<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baptis extends Model
{
    protected $table = 'baptis';

    protected $fillable = [
        'umat_id',
        'nama_baptis',
        'fotokopi_ktp_ortu',
        'surat_pernikahan_katolik_ortu',
        'nama_wali_baptis',
        'surat_krisma_wali_baptis',
        'nama_wali_baptis_pria',
        'nama_wali_baptis_wanita',
        'nama_wali_baptis_wanita',
        'gereja_tempat_baptis',

        'tanggal_baptis',
        'surat_baptis',

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
