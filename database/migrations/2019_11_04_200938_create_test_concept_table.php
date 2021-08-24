<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestConceptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_concept', function (Blueprint $table) {
            $table->bigIncrements('testConceptId');

            $table->unsignedBigInteger('testId');
            $table->foreign('testId')->references('testId')->on('tests');
            $table->unsignedBigInteger('conceptId');
            $table->foreign('conceptId')->references('conceptId')->on('concepts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_concept');
    }
}
