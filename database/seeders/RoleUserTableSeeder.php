<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->insert([
          'role_id' => 1,
          'user_id' => 1
        ]);

//        DB::table('role_user')->insert([
//          'role_id' => 2,
//          'user_id' => 2
//        ]);
//
//        DB::table('role_user')->insert([
//          'role_id' => 3,
//          'user_id' => 3
//        ]);
//
//        DB::table('role_user')->insert([
//          'role_id' => 4,
//          'user_id' => 4
//        ]);
//        DB::table('role_user')->insert([
//            'role_id' => 1,
//            'user_id' => 5
//        ]);
//
//        DB::table('role_user')->insert([
//            'role_id' => 2,
//            'user_id' => 6
//        ]);
//
//        DB::table('role_user')->insert([
//            'role_id' => 3,
//            'user_id' => 7
//        ]);
//
//        DB::table('role_user')->insert([
//            'role_id' => 4,
//            'user_id' => 8
//        ]);
//        DB::table('role_user')->insert([
//            'role_id' => 1,
//            'user_id' => 9
//        ]);
//
//        DB::table('role_user')->insert([
//            'role_id' => 2,
//            'user_id' => 10
//        ]);
//
//        DB::table('role_user')->insert([
//            'role_id' => 3,
//            'user_id' => 11
//        ]);
//
//        DB::table('role_user')->insert([
//            'role_id' => 4,
//            'user_id' => 12
//        ]);
    }
}
