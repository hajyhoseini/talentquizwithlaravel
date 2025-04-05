<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('mbti_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('section');
            $table->bigInteger('question_id');
            $table->string('answer_value'); // تغییر نوع ستون به string برای ذخیره مقادیر 'yes' و 'no'
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('mbti_answers');
    }
};
