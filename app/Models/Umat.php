<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umat extends Model
{
    use HasFactory;

    protected $table = 'umat';

    protected $fillable = [
        'nama_lengkap',
        'nik',
        'ttl',
        'alamat',
        'no_hp',
        'email',
        'lingkungan',
        'kk_file',
        'akte_file',
        'status_pendaftaran',
        'tanggal_daftar',
    ];

    public function sertifikatSakramen()
    {
        return $this->hasMany(SertifikatSakramen::class, 'umat_id');
    }
}
