<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // اگر جدول وجود داشت حذف می‌کنیم (اختیاری)
        Schema::dropIfExists('all_questions');

        // ساخت جدول جدید
        Schema::create('all_questions', function (Blueprint $table) {
            $table->id(); // bigint unsigned auto_increment primary key
            $table->string('section'); // varchar(255) not null
            $table->text('question'); // text not null
            $table->unsignedBigInteger('quiz_id')->nullable(); // bigint unsigned nullable
            $table->timestamps(); // created_at و updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // حذف جدول هنگام ریورز
        Schema::dropIfExists('all_questions');
    }
}
