<?php

use Illuminate\Database\Seeder;

class UserAreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_areas')->insert([
            'userId' => 3,
            'areaId' => 1
        ]);
        DB::table('user_areas')->insert([
            'userId' => 3,
            'areaId' => 4
        ]);
        DB::table('user_areas')->insert([
            'userId' => 3,
            'areaId' => 5
        ]);
        DB::table('user_areas')->insert([
            'userId' => 3,
            'areaId' => 6
        ]);
    }
}
