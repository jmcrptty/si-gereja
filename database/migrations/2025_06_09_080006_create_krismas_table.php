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
        Schema::create('krisma', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umat_id')->constrained('umat')->onDelete('cascade');
            $table->string('gereja_tempat_krisma');

            // diisi saat daftar nikah
            $table->string('surat_krisma', 255)->nullable();
            $table->date('tanggal_krisma')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('krismas');
    }
};
