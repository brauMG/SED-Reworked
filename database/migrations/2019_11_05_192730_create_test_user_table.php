<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_user', function (Blueprint $table) {
            $table->bigIncrements('testUserid');

            $table->unsignedBigInteger('testId');
            $table->foreign('testId')->references('testId')->on('tests');
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_user');
    }
}
