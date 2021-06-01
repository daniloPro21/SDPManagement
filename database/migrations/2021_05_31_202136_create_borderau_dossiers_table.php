<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorderauDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borderau_dossiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_dossier');
            $table->unsignedBigInteger('id_borderaux');
            $table->foreign('id_borderaux')->references('id')->on('borderaux');
            $table->foreign('id_dossier')->references('id')->on('dossiers');
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
        Schema::dropIfExists('borderau_dossiers');
    }
}
