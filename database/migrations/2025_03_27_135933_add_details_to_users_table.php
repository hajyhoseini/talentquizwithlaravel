<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
 
     public function up()
     {
         Schema::table('users', function (Blueprint $table) {
             $table->string('first_name')->nullable();
             $table->string('last_name')->nullable();
             $table->string('phone')->nullable();
         });
     }
     
     public function down()
     {
         Schema::table('users', function (Blueprint $table) {
             $table->dropColumn(['first_name', 'last_name', 'phone']);
         });
     }
     
    /**
     * Reverse the migrations.
     *
     * @return void
     */
 
}
