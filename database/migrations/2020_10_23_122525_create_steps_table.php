<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('steps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dossier_id');
            $table->enum('type',['info','warning','move']);
            $table->text('message')->nullable();
            $table->date('action_date')->nullable();
            //$table->foreign('dossier_id')->references('id')->on('dossiers');
            $table->timestamps();
            $table->boolean('is_delete')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('steps');
    }
}
