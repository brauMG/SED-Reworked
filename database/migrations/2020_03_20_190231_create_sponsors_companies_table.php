<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorsCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsors_companies', function (Blueprint $table) {
            $table->bigIncrements('sponsorCompanyId');
            $table->unsignedBigInteger('sponsorId');
            $table->foreign('sponsorId')->references('sponsorId')->on('sponsors');
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
        Schema::dropIfExists('sponsors_companies');
    }
}
