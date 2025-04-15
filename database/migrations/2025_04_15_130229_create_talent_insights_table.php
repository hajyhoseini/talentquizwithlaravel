<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalentInsightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talent_insights', function (Blueprint $table) {
            $table->id();

            // بخش استعداد (مثلاً: musical, motor, logical, etc)
            $table->string('section');

            // سطح استعداد: high, medium, low
            $table->enum('level', ['high', 'medium', 'low']);

            // تفسیر نهایی
            $table->text('interpretation');

            // راهکارها به‌صورت JSON
            $table->json('suggestions')->nullable();

            $table->timestamps();

            // اطمینان از عدم تکرار سطح برای یک بخش خاص
            $table->unique(['section', 'level']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('talent_insights');
    }
}
