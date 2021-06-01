<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("id_service");
            $table->unsignedBigInteger("id_dossier");
            $table->boolean("is_delete")->nullable();
            $table->foreign("id_dossier")->references("id")->on("dossiers");
            $table->foreign("id_service")->references("id")->on("services");
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
        Schema::dropIfExists('cotations');
    }
}
