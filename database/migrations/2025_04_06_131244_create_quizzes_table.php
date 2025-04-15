<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // عنوان آزمون
            $table->text('description')->nullable(); // توضیح کوتاه آزمون
            $table->string('slug')->unique(); // شناسه یکتا برای URL
            $table->timestamps(); // created_at و updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
