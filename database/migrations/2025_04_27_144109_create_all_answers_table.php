<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllAnswersTable extends Migration
{
    /**
     * اجرای مایگریشن برای ایجاد جدول all_answers.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_answers', function (Blueprint $table) {
            $table->id(); // ستون ID خودکار
            $table->unsignedBigInteger('user_id'); // شناسه کاربر
            $table->unsignedBigInteger('question_id'); // شناسه سوال
            $table->text('answer_value'); // مقدار جواب
            $table->timestamps(); // تاریخ‌های created_at و updated_at

            // تعریف کلید خارجی
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // فرض بر اینکه جدول users دارید
            $table->foreign('question_id')->references('id')->on('all_questions')->onDelete('cascade'); // فرض بر اینکه جدول all_questions دارید
        });
    }

    /**
     * بازگردانی مایگریشن در صورت نیاز
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('all_answers');
    }
}
