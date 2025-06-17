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
        Schema::create('komuni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umat_id')->constrained('umat')->onDelete('cascade');
            $table->string('gereja_tempat_komuni');

            // diisi saat daftar komuni
            $table->string('surat_komuni', 255)->nullable();
            $table->date('tanggal_komuni')->nullable();

            // Data penerimaan
            $table->enum('status_pendaftaran', ['Pending', 'Diterima', 'Ditolak'])->default('Pending');
            $table->timestamp('tanggal_daftar')->useCurrent();
            $table->enum('status_penerimaan', ['Pending', 'Diterima', 'Ditolak'])->default('Pending');
            $table->timestamp('tanggal_terima')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komuni');
    }
};
