<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('forum_questions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nama penanya (umat)
            $table->text('question'); // isi pertanyaan
            $table->text('answer')->nullable(); // jawaban admin
            $table->timestamps(); // created_at dan updated_at
            $table->timestamp('answered_at')->nullable(); // waktu jawaban diberikan
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('forum_questions');
    }
};
