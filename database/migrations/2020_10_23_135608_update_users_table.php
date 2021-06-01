<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          $table->enum('role',['superadmin','admin','secretaire','service','cardre'])->nullable();
          $table->unsignedBigInteger('service_id')->nullable();
          $table->unsignedBigInteger('sous_service_id')->nullable();
          $table->foreign('service_id')->references('id')->on('service_generals');
          $table->foreign('sous_service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
