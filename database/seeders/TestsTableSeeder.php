<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tests')->insert([
            'areaId' => 1,
            'startedAt' => date('Y-m-d'),
            'name' => 'Test1'
        ]);
        DB::table('tests')->insert([
            'areaId' => 2,
            'startedAt' => date('Y-m-d'),
            'name' => 'Test2'
        ]);
        DB::table('tests')->insert([
            'areaId' => 2,
            'startedAt' => date('Y-m-d'),
            'name' => 'Test3'
        ]);
    }
}
