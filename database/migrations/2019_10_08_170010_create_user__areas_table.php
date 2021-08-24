<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_areas', function (Blueprint $table) {
            $table->bigIncrements('userAreaId');

            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users');

            $table->unsignedBigInteger('areaId');
            $table->foreign('areaId')->references('areaId')->on('areas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_areas');
    }
}
