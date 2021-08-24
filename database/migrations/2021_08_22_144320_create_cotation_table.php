<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotations', function (Blueprint $table) {
            $table->bigIncrements('id_cotation');
            $table->unsignedBigInteger('servicegeneral_id');
            $table->unsignedBigInteger('dossier_id');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign("servicegeneral_id")->references("id")->on("service_generals");
            $table->foreign("service_id")->references("id")->on("services");
            $table->foreign("dossier_id")->references("id")->on("dossiers");
            $table->foreign("user_id")->references("id")->on("users");
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
        Schema::dropIfExists('cotation');
    }
}
