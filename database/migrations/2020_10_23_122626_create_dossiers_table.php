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
            $table->unsignedBigInteger('personne_id');
            $table->unsignedBigInteger('type_id');
            $table->date('date_entre');
            $table->date('date_sortie')->nullable();
            $table->text('note')->nullable();
            $table->string('num_dra')->nullable();
            $table->string('num_sdp')->nullable();
            $table->string('num_service')->nullable();
            $table->boolean('traiter')->default(false);
            $table->boolean('is_delete')->default(false);
            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('personne_id')->references('id')->on('personnes');
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
