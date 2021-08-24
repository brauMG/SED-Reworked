<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('test_attribute')->insert([
          'testId' => 1,
          'attributeId' => 1
        ]);
    }
}
