<?php

use Illuminate\Database\Seeder;
class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('test_user')->insert([
            'testId' => 1,
            'userId' => 4
        ]);
        DB::table('test_user')->insert([
            'testId' => 2,
            'userId' => 8,
        ]);
    }
}
