<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->string('num_courrier')->nullable(false);
            $table->unsignedBigInteger('type_id');
            $table->date('date_entre');
            $table->date('date_sortie')->nullable();
            $table->text('note')->nullable();
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->string('matricule')->nullable();
            $table->string('grade')->nullable();
            $table->string('telephone');
            $table->string('num_drh')->nullable()->unique();
            $table->string('num_service')->nullable();
            $table->enum('statut',['traiter','signe','rejete','transmis'])->nullable();
            $table->boolean('is_delete')->default(false);
            $table->unsignedBigInteger('sous_service_id')->nullable();
            $table->foreign('sous_service_id')->references('id')->on('services');
            $table->foreign('service_id')->references('id')->on('service_generals');
            $table->foreign('type_id')->references('id')->on('type_dossiers');
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
        Schema::dropIfExists('dossiers');
    }
}
