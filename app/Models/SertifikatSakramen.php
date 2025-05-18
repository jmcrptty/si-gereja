<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikatSakramen extends Model
{
    use HasFactory;

    protected $table = 'sertifikat_sakramen';

    protected $fillable = [
        'umat_id',
        'sakramen_id',
        'tanggal_penerimaan',
        'file_sertifikat',
        'keterangan',
    ];

    public function umat()
    {
        return $this->belongsTo(Umat::class, 'umat_id');
    }

    public function sakramen()
    {
        return $this->belongsTo(Sakramen::class, 'sakramen_id');
    }
}
