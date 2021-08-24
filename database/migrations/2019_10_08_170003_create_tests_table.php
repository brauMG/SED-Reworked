<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->bigIncrements('testId');
            $table->date('startedAt')->nullable();
            $table->string('name',255);
            $table->unsignedBigInteger('areaId');
            $table->foreign('areaId')->references('areaId')->on('areas');
            $table->unsignedBigInteger('MLGroupId');
            $table->foreign('MLGroupId')->references('MLGroupId')->on('maturity_levels_group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
