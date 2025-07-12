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
            // Biodata
            $table->string('nama_lengkap', 100);
            $table->string('nik', 20);
            $table->enum('jenis_kelamin', ['Pria', 'Wanita']);
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->text('tempat_lahir');
            $table->date('ttl');
            $table->text('alamat');
            $table->enum('lingkungan', [
            'Eusebius Damianus',
            'Regina Pacis',
            'Ratu Rosari Bunda Allah (RRBA)',
            'Ratu Rosari Semesta Alam (RRSA)',
            'Santa Agnes',
            'Santa Anna',
            'Santa Bernadetha',
            'Santo Agustinus',
            'Santo Anthonius',
            'Santo Yohanes Don Bosco',
            'Santo Hermanus',
            'Santo Kornelis',
            'Santo Marselino',
            'Santo Paulus',
            'Santo Petrus',
            'Santo Yoseph',
            'St. Fransiskus Xaverius',
            'Stella Maris'
]);
            $table->enum('status_pendaftaran', ['Pending', 'Diterima', 'Ditolak'])->default('Pending');
            $table->timestamp('tanggal_daftar')->useCurrent();

            // kontak
            $table->string('no_hp', 15);
            $table->string('email', 50);

            // berkas universal
            $table->string('kk_file', 255)->nullable();
            $table->string('akte_file', 255)->nullable();


            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('umat');
    }
}
