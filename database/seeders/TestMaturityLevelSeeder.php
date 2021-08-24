<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestMaturityLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('test_maturity_level')->insert([
            'testId' => 1,
            'maturityLevelId' => 1,
        ]);
        DB::table('test_maturity_level')->insert([
            'testId' => 1,
            'maturityLevelId' => 2,
        ]);
        DB::table('test_maturity_level')->insert([
            'testId' => 1,
            'maturityLevelId' => 3,
        ]);
        DB::table('test_maturity_level')->insert([
            'testId' => 1,
            'maturityLevelId' => 4,
        ]);
        DB::table('test_maturity_level')->insert([
            'testId' => 1,
            'maturityLevelId' => 5,
        ]);
        DB::table('test_maturity_level')->insert([
            'testId' => 2,
            'maturityLevelId' => 6,
        ]);
        DB::table('test_maturity_level')->insert([
            'testId' => 2,
            'maturityLevelId' => 7,
        ]);
        DB::table('test_maturity_level')->insert([
            'testId' => 2,
            'maturityLevelId' => 8,
        ]);
    }
}
