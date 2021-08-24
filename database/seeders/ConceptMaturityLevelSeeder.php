<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConceptMaturityLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('concept_maturity_level')->insert([
            'conceptId' => 1,
            'maturityLevelId' => 1,
        ]);
        DB::table('concept_maturity_level')->insert([
            'conceptId' => 1,
            'maturityLevelId' => 2,
        ]);
        DB::table('concept_maturity_level')->insert([
            'conceptId' => 1,
            'maturityLevelId' => 3,
        ]);
        DB::table('concept_maturity_level')->insert([
            'conceptId' => 1,
            'maturityLevelId' => 4,
        ]);
        DB::table('concept_maturity_level')->insert([
            'conceptId' => 1,
            'maturityLevelId' => 5,
        ]);
        DB::table('concept_maturity_level')->insert([
            'conceptId' => 2,
            'maturityLevelId' => 1,
        ]);
        DB::table('concept_maturity_level')->insert([
            'conceptId' => 2,
            'maturityLevelId' => 2,
        ]);
        DB::table('concept_maturity_level')->insert([
            'conceptId' => 2,
            'maturityLevelId' => 3,
        ]);
        DB::table('concept_maturity_level')->insert([
            'conceptId' => 2,
            'maturityLevelId' => 4,
        ]);
        DB::table('concept_maturity_level')->insert([
            'conceptId' => 2,
            'maturityLevelId' => 5,
        ]);
    }
}
