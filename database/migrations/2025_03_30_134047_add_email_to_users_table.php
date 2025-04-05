<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailToUsersTable extends Migration
{
  
   public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('email')->unique()->nullable(false); // اضافه کردن ستون email
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('email'); // حذف ستون email در صورت بازگشت مهاجرت
    });
}

  
  
}
