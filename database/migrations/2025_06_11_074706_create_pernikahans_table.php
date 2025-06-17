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
        Schema::create('pernikahans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('umat_id_pria')->nullable();
            $table->foreignId('umat_id_wanita')->nullable();

            // mempelai pria
            $table->string('nama_lengkap_pria', 100)->nullable();
            $table->text('tempat_lahir_pria')->nullable();
            $table->date('ttl_pria')->nullable();
            $table->text('alamat_pria')->nullable();
            $table->string('lingkungan_pria')->nullable();
            $table->enum('agama_pria', ['Kristen', 'Islam', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu ',])->default('Katolik');
            // kontak mempelai pria
            $table->string('email_pria', 50)->nullable();
            // berkas mempelai pria
            $table->string('akte_file_pria', 255)->nullable();

            // mempelai wanita
            $table->string('nama_lengkap_wanita', 100)->nullable();
            $table->text('tempat_lahir_wanita')->nullable();
            $table->date('ttl_wanita')->nullable();
            $table->text('alamat_wanita')->nullable();
            $table->string('lingkungan_wanita')->nullable();
            $table->enum('agama_wanita', ['Kristen', 'Islam', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu ',])->nullable();

            // kontak mempelai wanita
            $table->string('email_wanita', 50)->nullable();
            // berkas mempelai wanita
            $table->string('akte_file_wanita', 255)->nullable();

            // Data penerimaan
            $table->enum('status_pendaftaran', ['Pending', 'Diterima', 'Ditolak'])->default('Pending');
            $table->timestamp('tanggal_daftar')->useCurrent();
            $table->enum('status_penerimaan', ['Pending', 'Diterima', 'Ditolak'])->default('Pending');
            $table->timestamp('tanggal_terima')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pernikahans');
    }
};
