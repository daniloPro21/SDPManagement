<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFicheAffectationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //["type","etat"];
        Schema::create('fiche_affectations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("type");
            $table->string("date")->nullable();
            $table->string("numero_decision")->nullable();
            $table->string("titre")->nullable();
            $table->text("decision")->nullable();
            $table->enum("etat",["ouvert","cloturer"]);
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
        Schema::dropIfExists('fiche_affectations');
    }
}
