<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AggiuntaCampoImagePathAllaTabellaBand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('band', function (Blueprint $table) {
            $table->string('image_path')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('band', function (Blueprint $table) {
            $table->dropColumn('image_path')->after('user_id');
        });
    }
}
