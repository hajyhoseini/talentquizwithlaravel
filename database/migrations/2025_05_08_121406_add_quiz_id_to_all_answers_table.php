<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuizIdToAllAnswersTable extends Migration
{
    public function up()
    {
        Schema::table('all_answers', function (Blueprint $table) {
            $table->unsignedBigInteger('quiz_id')->nullable()->after('question_id');

            // اگر جدول quizzes وجود داره و رابطه‌ای هست
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('all_answers', function (Blueprint $table) {
            $table->dropForeign(['quiz_id']);
            $table->dropColumn('quiz_id');
        });
    }
}
