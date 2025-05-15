<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformasiMisaTable extends Migration
{
    public function up()
    {
        Schema::create('informasi_misa', function (Blueprint $table) {
            $table->id();
            $table->enum('jenis_misa', ['Harian', 'Jumat Pertama', 'Minggu']); // Jenis misa
            $table->text('jadwal_misa'); // Jadwal misa disimpan dalam format teks
            $table->timestamps(); // Timestamps untuk created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('informasi_misa');
    }
}
