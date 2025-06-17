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
        'jenis_kelamin',
        'nama_ayah',
        'nama_ibu',
        'tempat_lahir',
        'ttl',
        'alamat',
        'lingkungan',
        'status_pendaftaran',
        'tanggal_daftar',
        'no_hp',
        'email',
        'kk_file',
        'akte_file',
    ];

    public function sertifikatSakramen()
    {
        return $this->hasMany(SertifikatSakramen::class, 'umat_id');
    }

    public function baptis(){
        return $this->hasOne(Baptis::class);
    }

    public function komuni(){
        return $this->hasOne(Komuni::class);
    }

     public function sakramenYangDiterima()
    {
        return $this->belongsToMany(Sakramen::class, 'penerimaan_sakramen', 'umat_id', 'sakramen_id')->withPivot(['tanggal_terima', 'tempat_terima', 'keterangan']);
    }

    public function krisma(){
        return $this->hasOne(Krisma::class);
    }

    public function pernikahanPria() {
    return $this->hasOne(Pernikahan::class, 'umat_id_pria');
    }

    public function pernikahanWanita() {
        return $this->hasOne(Pernikahan::class, 'umat_id_wanita');
    }

}
