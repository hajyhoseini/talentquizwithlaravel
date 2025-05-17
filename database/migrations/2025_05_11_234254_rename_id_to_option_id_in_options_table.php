<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameIdToOptionIdInOptionsTable extends Migration
{
    public function up()
    {
        Schema::table('options', function (Blueprint $table) {
            $table->renameColumn('id', 'option_id');
        });
    }

    public function down()
    {
        Schema::table('options', function (Blueprint $table) {
            $table->renameColumn('option_id', 'id');
        });
    }
}
