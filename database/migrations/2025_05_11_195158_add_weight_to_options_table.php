<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeightToOptionsTable extends Migration
{
    /**
     * اجرای مایگریشن.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('options', function (Blueprint $table) {
            $table->integer('weight')->default(0); // افزودن ستون weight به جدول options
        });
    }

    /**
     * بازگردانی مایگریشن.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('options', function (Blueprint $table) {
            $table->dropColumn('weight'); // حذف ستون weight از جدول options
        });
    }
}
