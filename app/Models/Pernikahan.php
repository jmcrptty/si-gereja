<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pernikahan extends Model
{
    protected $table = 'pernikahans';

    public $timestamps = false;

    protected $fillable = [
        'umat_id_pria',
        'umat_id_wanita',

        'email_pria',
        'nama_lengkap_pria',
        'alamat_pria',
        'tempat_lahir_pria',
        'ttl_pria',
        'akte_file_pria',
        'agama_pria',
        'lingkungan_pria',

        'email_wanita',
        'nama_lengkap_wanita',
        'alamat_wanita',
        'tempat_lahir_wanita',
        'ttl_wanita',
        'akte_file_wanita',
        'agama_wanita',
        'lingkungan_wanita',

        'tanggal_daftar'

    ];
}
