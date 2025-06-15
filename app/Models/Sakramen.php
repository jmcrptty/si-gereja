<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sakramen extends Model
{
    use HasFactory;

    protected $table = 'sakramen';

    protected $fillable = ['nama_sakramen'];

    public function sertifikatSakramen()
    {
        return $this->hasMany(SertifikatSakramen::class, 'sakramen_id');
    }
    public function umatPenerima()
    {
    return $this->belongsToMany(Umat::class, 'penerimaan_sakramen', 'sakramen_id', 'umat_id')
                ->withPivot(['tanggal_terima', 'tempat_terima', 'keterangan'])
                ->withTimestamps();
    }
    
}
