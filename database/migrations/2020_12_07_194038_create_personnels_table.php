<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //"nom","prenom","matricule","sexe","date_naissance","grade"
        Schema::create('personnels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("nom");
            $table->string("prenom")->nullable();
            $table->string("grade")->nullable();
            $table->string("matricule")->unique();
            $table->string("telephone")->nullable();
            $table->string("sexe")->nullable();
            $table->string("date_naissance")->nullable();
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
        Schema::dropIfExists('personnels');
    }
}
