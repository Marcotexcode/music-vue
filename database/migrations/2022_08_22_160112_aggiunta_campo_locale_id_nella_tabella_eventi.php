<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AggiuntaCampoLocaleIdNellaTabellaEventi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eventi', function (Blueprint $table) {
            $table->unsignedBigInteger('locale_id')->unsigned()->after('band_id');
            $table->foreign('locale_id')->references('id')->on('locale')->onDelete('cascade');
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
            $table->dropForeign(['locale_id']);
            $table->dropColumn('locale_id');
        });
    }
}
