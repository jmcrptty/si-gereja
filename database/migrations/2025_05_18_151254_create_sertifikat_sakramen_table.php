<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSertifikatSakramenTable extends Migration
{
    public function up()
    {
        Schema::create('sertifikat_sakramen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('umat_id')->constrained('umat')->onDelete('cascade');
            $table->foreignId('sakramen_id')->constrained('sakramen')->onDelete('cascade');
            $table->date('tanggal_penerimaan')->nullable();
            $table->string('file_sertifikat', 255)->nullable();   // Foto sertifikat opsional
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sertifikat_sakramen');
    }
}
