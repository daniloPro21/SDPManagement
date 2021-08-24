<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_dossier');
            $table->string('nom_service');
            $table->string('transmettant');
            $table->string('num_dossier');
            $table->enum('motif',['traiter','signe','rejete','transmis'])->nullable();
            $table->date('date_sortie')->nullable();
            $table->boolean('is_delete')->nullable();
            $table->timestamps();
            $table->foreign("id_dossier")->references("id")->on("dossiers");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traces');
    }
}
