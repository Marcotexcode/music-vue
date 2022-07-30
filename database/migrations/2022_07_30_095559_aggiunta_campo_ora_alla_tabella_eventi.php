<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AggiuntaCampoOraAllaTabellaEventi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eventi', function (Blueprint $table) {
            $table->time('ora')->after('data_evento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eventi', function (Blueprint $table) {
            $table->dropColumn('ora')->after('data_evento');
        });
    }
}
