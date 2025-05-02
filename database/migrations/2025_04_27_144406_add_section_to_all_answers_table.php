<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSectionToAllAnswersTable extends Migration
{
    /**
     * اجرای مایگریشن برای اضافه کردن ستون section به جدول all_answers.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('all_answers', function (Blueprint $table) {
            $table->string('section')->nullable(); // اضافه کردن ستون section به جدول
        });
    }

    /**
     * بازگردانی مایگریشن در صورت نیاز
     *
     * @return void
     */
    public function down()
    {
        Schema::table('all_answers', function (Blueprint $table) {
            $table->dropColumn('section'); // حذف ستون section در صورت نیاز به بازگشت
        });
    }
}
