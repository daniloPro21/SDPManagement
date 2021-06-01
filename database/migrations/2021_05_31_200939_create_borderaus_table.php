<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorderausTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borderaux', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titre');
            $table->string('numero');
            $table->string('destinataire');
            $table->string('observation');
            $table->date('date');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('service_generals');
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
        Schema::dropIfExists('borderaus');
    }
}
