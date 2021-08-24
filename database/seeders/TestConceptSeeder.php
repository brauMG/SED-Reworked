<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestConceptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('test_concept')->insert([
            'testId' => 1,
            'conceptId' => 1,
        ]);
        DB::table('test_concept')->insert([
            'testId' => 1,
            'conceptId' => 2,
        ]);
        DB::table('test_concept')->insert([
            'testId' => 1,
            'conceptId' => 3,
        ]);
        DB::table('test_concept')->insert([
        'testId' => 2,
        'conceptId' => 4,
    ]);
        DB::table('test_concept')->insert([
            'testId' => 2,
            'conceptId' => 5,
        ]);
        DB::table('test_concept')->insert([
            'testId' => 2,
            'conceptId' => 6,
        ]);
        DB::table('test_concept')->insert([
            'testId' => 3,
            'conceptId' => 4,
        ]);
        DB::table('test_concept')->insert([
            'testId' => 3,
            'conceptId' => 5,
        ]);
        DB::table('test_concept')->insert([
            'testId' => 3,
            'conceptId' => 6,
        ]);
        DB::table('test_concept')->insert([
          'testId' => 2,
          'conceptId' => 6,
        ]);
    }
}
