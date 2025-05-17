<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiMisa extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'informasi_misa'; // Menggunakan nama tabel 'informasi_misa'

    // Tentukan kolom yang dapat diisi secara massal (mass assignable)
    protected $fillable = [
        'jenis_misa',  // Jenis misa, misalnya 'Harian', 'Jumat Pertama', 'Minggu'
        'jadwal_misa', // Jadwal misa dalam format teks
    ];

    // Opsional: Jika kamu ingin menambahkan relasi dengan model lain, kamu bisa menambahkannya di sini.
}
