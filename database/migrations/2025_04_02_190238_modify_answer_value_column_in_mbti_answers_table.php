<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('mbti_answers', function (Blueprint $table) {
            $table->string('answer_value')->change(); // تغییر نوع به string
        });
    }

    public function down()
    {
        Schema::table('mbti_answers', function (Blueprint $table) {
            $table->integer('answer_value')->change(); // بازگشت به integer
        });
    }
};
