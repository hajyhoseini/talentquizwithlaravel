<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMBTIQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mbti_questions', function (Blueprint $table) {
            $table->id();
            $table->string('section'); // نام بخش (مثلاً برون‌گرایی یا درون‌گرایی)
            $table->text('question'); // متن سوال
            $table->timestamps();
        });
    }
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_b_t_i_questions');
    }
}
