<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerimaanSakramenTable extends Migration
{
    public function up()
    {
        Schema::create('penerimaan_sakramen', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->foreignId('umat_id')->constrained('umat')->onDelete('cascade');
            $table->foreignId('sakramen_id')->constrained('sakramen')->onDelete('cascade');

            // Data penerimaan
            $table->date('tanggal_terima');
            $table->string('tempat_terima', 100)->nullable();
            $table->string('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penerimaan_sakramen');
    }
}
