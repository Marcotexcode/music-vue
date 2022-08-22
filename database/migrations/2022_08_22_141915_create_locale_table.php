<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locale', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('indirizzo');
            $table->string('provincia');
            $table->string('cap');
            $table->string('regione');
            $table->string('telefono');
            $table->string('tipo');
            $table->unsignedBigInteger('band_id')->unsigned();
            $table->foreign('band_id')->references('id')->on('band')->onDelete('cascade');
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
        Schema::dropIfExists('locale');
    }
}
