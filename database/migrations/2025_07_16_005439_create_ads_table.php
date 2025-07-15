<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
 public function up()
{
    Schema::create('ads', function (Blueprint $table) {
        $table->id();
        $table->string('number');
        $table->enum('operator', ['mci', 'irancell', 'rightel']);
        $table->decimal('price', 10, 2);
        $table->string('voice_url')->nullable();
        $table->string('video_url')->nullable();
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
        Schema::dropIfExists('ads');
    }
}
