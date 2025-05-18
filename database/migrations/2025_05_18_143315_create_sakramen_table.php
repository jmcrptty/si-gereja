<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSakramenTable extends Migration
{
    public function up()
    {
        Schema::create('sakramen', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sakramen', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sakramen');
    }
}
