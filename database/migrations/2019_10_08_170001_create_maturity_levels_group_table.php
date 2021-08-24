<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaturityLevelsGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maturity_levels_group', function (Blueprint $table) {
            $table->bigIncrements('MLGroupId');
            $table->string('name',255);
            $table->unsignedBigInteger('companyId');
            $table->foreign('companyId')->references('companyId')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maturity_levels_group');
    }
}
