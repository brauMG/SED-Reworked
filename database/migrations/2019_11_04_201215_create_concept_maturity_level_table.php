<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConceptMaturityLevelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concept_maturity_level', function (Blueprint $table) {
            $table->bigIncrements('conceptMLId');
            $table->unsignedBigInteger('conceptId');
            $table->foreign('conceptId')->references('conceptId')->on('concepts');
            $table->unsignedBigInteger('maturityLevelId');
            $table->foreign('maturityLevelId')->references('maturityLevelId')->on('maturity_levels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_maturity_level');
    }
}
