<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StoredProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
          DROP PROCEDURE IF EXISTS p_fetch_verified_evidences;
          CREATE PROCEDURE p_fetch_verified_evidences (IN conId int)
          BEGIN
          SELECT COUNT(evidenceID)
          FROM evidences
          WHERE verified=1 AND attributeid IN (
                  SELECT attributeid
                  FROM concept_maturity_level_attribute
                  WHERE conceptmlid IN (
                        SELECT conceptmlid
                        FROM concept_maturity_level
                        WHERE conceptid IN (
                              SELECT conceptid
                              FROM concepts
                              WHERE conceptid =conId) ) );
          END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS p_fetch_verified_evidences;');
    }
}
