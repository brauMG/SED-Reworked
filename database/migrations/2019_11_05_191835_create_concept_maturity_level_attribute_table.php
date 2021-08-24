<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConceptMaturityLevelAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concept_maturity_level_attribute', function (Blueprint $table) {
            $table->bigIncrements('conceptMLAid');
            $table->unsignedBigInteger('conceptMLId');
            $table->foreign('conceptMLId')->references('conceptMLId')->on('concept_maturity_level');
            $table->unsignedBigInteger('attributeId');
            $table->foreign('attributeId')->references('attributeId')->on('attributes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_maturity_level_attribute');
    }
}
