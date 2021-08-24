<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("serviceA");
            $table->string("serviceB");
            $table->string("dossier_id");
            $table->string("motif");
            $table->foreign("dossier_id")->references("id")->on("dossiers");
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
        Schema::dropIfExists('tracages');
    }
}
