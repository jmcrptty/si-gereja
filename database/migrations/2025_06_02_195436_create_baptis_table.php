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
        Schema::create('baptis', function (Blueprint $table) {
            $table->id();
            // fk umat
            $table->foreignId('umat_id')->constrained('umat')->onDelete('cascade');

            // berkas-berkas
            $table->string('nama_baptis');
            $table->string('fotokopi_ktp_ortu', 255);
            $table->string('surat_pernikahan_katolik_ortu', 255)->nullable();

            $table->string('nama_wali_baptis')->nullable();
            $table->string('surat_krisma_wali_baptis', 255)->nullable();

            $table->string('nama_wali_baptis_pria')->nullable();
            $table->string('nama_wali_baptis_wanita')->nullable();
            $table->string('surat_pernikahan_wali_baptis', 255)->nullable();
            $table->string('gereja_tempat_baptis');

            // diisi saat daftar komuni
            $table->date('tanggal_baptis')->nullable();
            $table->string('surat_baptis', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baptis');
    }
};
