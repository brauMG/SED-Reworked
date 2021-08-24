<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaturityLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maturity_levels', function (Blueprint $table) {
            $table->bigIncrements('maturityLevelId');
            $table->string('description',255);

            $table->unsignedBigInteger('companyId');
            $table->foreign('companyId')->references('companyId')->on('companies');
            $table->unsignedBigInteger('level');
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
        Schema::dropIfExists('maturity_levels');
    }
}
