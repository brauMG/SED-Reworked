<?php

use Illuminate\Database\Seeder;

class TestMaturityLevelAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
        public function run()
    {
        DB::table('test_maturity_level_attribute')->insert([
            'testMLId' => 1,
            'attributeId' => 1,
        ]);
        DB::table('test_maturity_level_attribute')->insert([
            'testMLId' => 1,
            'attributeId' => 2,
        ]);
        DB::table('test_maturity_level_attribute')->insert([
            'testMLId' => 1,
            'attributeId' => 3,
        ]);
        DB::table('test_maturity_level_attribute')->insert([
            'testMLId' => 2,
            'attributeId' => 4,
        ]);
        DB::table('test_maturity_level_attribute')->insert([
            'testMLId' => 2,
            'attributeId' => 5,
        ]);
        DB::table('test_maturity_level_attribute')->insert([
            'testMLId' => 2,
            'attributeId' => 6,
        ]);
        DB::table('test_maturity_level_attribute')->insert([
            'testMLId' => 3,
            'attributeId' => 7,
        ]);
        DB::table('test_maturity_level_attribute')->insert([
            'testMLId' => 3,
            'attributeId' => 8,
        ]);
        DB::table('test_maturity_level_attribute')->insert([
            'testMLId' => 3,
            'attributeId' => 9,
        ]);
        DB::table('test_maturity_level_attribute')->insert([
            'testMLId' => 6,
            'attributeId' => 10,
        ]);
        DB::table('test_maturity_level_attribute')->insert([
            'testMLId' => 6,
            'attributeId' => 11,
        ]);
        DB::table('test_maturity_level_attribute')->insert([
            'testMLId' => 6,
            'attributeId' => 12,
        ]);
        DB::table('test_maturity_level_attribute')->insert([
            'testMLId' => 7,
            'attributeId' => 13,
        ]);
        DB::table('test_maturity_level_attribute')->insert([
            'testMLId' => 7,
            'attributeId' => 14,
        ]);
        DB::table('test_maturity_level_attribute')->insert([
            'testMLId' => 7,
            'attributeId' => 15,
        ]);
    }
}
