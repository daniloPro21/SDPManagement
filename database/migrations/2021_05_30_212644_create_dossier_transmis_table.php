<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDossierTransmisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossier_transmis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_dossier');
            $table->unsignedBigInteger('transmission_id');
            $table->foreign('transmission_id')->references('id')->on('transmissions');
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
        Schema::dropIfExists('dossier_transmis');
    }
}
