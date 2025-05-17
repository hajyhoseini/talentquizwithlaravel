<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuizIdToOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('options', function (Blueprint $table) {
            $table->unsignedBigInteger('quiz_id')->nullable()->after('question_id');
            // اگر می‌خواهید این ستون به یک جدول دیگری (مانند quizzes) مرتبط باشد:
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('options', function (Blueprint $table) {
            $table->dropForeign(['quiz_id']); // حذف رابطه‌ی خارجی
            $table->dropColumn('quiz_id'); // حذف ستون
        });
    }
}
