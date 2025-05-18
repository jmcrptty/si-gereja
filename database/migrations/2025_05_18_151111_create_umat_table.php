<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmatTable extends Migration
{
    public function up()
    {
        Schema::create('umat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 100);
            $table->string('nik', 20)->nullable();
            $table->date('ttl')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->string('email', 50)->nullable();
            $table->enum('lingkungan', ['st.petrus', 'st.yohanes', 'st.maria']);
            $table->string('kk_file', 255)->nullable();
            $table->string('akte_file', 255)->nullable();
            $table->enum('status_pendaftaran', ['Pending', 'Diterima', 'Ditolak'])->default('Pending');
            $table->timestamp('tanggal_daftar')->useCurrent();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('umat');
    }
}