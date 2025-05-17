<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('umats', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->foreignId('lingkungan_id')->nullable()->constrained()->onDelete('cascade'); //cari tau arti constrained()
            $table->string('alamat');
            $table->enum('jenis_kelamin', ['Pria','Wanita']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('pendidikan');
            $table->string('jenis_pekerjaan');

            $table->unsignedTinyInteger('umur')->nullable();
            $table->enum('status_hubungan', ['Menikah', 'Belum Menikah']);
            $table->boolean('baptis')->default(0);
            $table->boolean('komuni')->default(0);
            $table->boolean('krisma')->default(0);
            $table->boolean('pernikahan')->default(0);

            $table->string('nomor_telpon');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umats');
    }
};
