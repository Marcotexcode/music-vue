<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AggiuntaCampoCompensoAllaTabellaEventi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eventi', function (Blueprint $table) {
            $table->float('compenso', 8, 2)->after('ora');
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
            $table->dropColumn('compenso', 8, 2)->after('ora');
        });
    }
}
