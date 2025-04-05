<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('question_id');
            $table->foreign('question_id', 'fk_answers_questions')->references('id')->on('questions')->onDelete('cascade');
            // باید با نوع id در جدول questions هماهنگ باشه
            $table->integer('answer_value');
            $table->timestamps();
        
            // کلید خارجی
            $table->foreign('user_id', 'fk_answers_users')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
