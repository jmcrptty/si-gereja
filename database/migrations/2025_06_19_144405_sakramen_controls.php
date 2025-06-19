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
        Schema::create('sakramen_controls', function(Blueprint $table){
            $table->id();

            $table->enum('jenis_sakramen', ['Baptis', 'Komuni', 'Krisma', 'Pernikahan',])->unique();

            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();

            $table->enum('override_status', ['on', 'off'])->default('off');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sakramen_controls');
    }
};
