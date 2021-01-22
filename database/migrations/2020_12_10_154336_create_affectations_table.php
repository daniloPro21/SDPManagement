<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAffectationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affectations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('poste_id');
            $table->unsignedBigInteger('personnel_id');
            $table->string("raison")->nullable();
            $table->unsignedBigInteger('structure_id');
            $table->unsignedBigInteger('fiche_affectation_id');
            $table->string('motif')->nullable();
            $table->string('date')->nullable();
            $table->foreign("poste_id")->references("id")->on("postes");
            $table->foreign("personnel_id")->references("id")->on("personnels");
            $table->foreign("structure_id")->references("id")->on("structures");
            $table->foreign("fiche_affectation_id")->references("id")->on("fiche_affectations");
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
        Schema::dropIfExists('affectations');
    }
}
