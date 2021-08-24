<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'firstName' => '-',
          'lastName' => 'Gamez',
          'username' => 'Gamez',
          'password' => Hash::make('asdasdasd'),
          'email' => '-',
          'companyId' => 1,
          'email_verified_at' => date('Y-m-d H:i:s'),
          'remember_token' => Str::random(10),
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s')
        ]);

//        DB::table('users')->insert([
//          'firstName' => 'Luis',
//          'lastName' => 'Avila',
//          'username' => 'lavila',
//          'password' => Hash::make('asdasdasd'),
//          'email' => 'lavila@g.com',
//          'companyId' => 1,
//          'email_verified_at' => date('Y-m-d H:i:s'),
//          'remember_token' => Str::random(10),
//          'created_at' => date('Y-m-d H:i:s'),
//          'updated_at' => date('Y-m-d H:i:s')
//        ]);
//
//        DB::table('users')->insert([
//          'firstName' => 'Luciana',
//          'lastName' => 'Robles',
//          'username' => 'lrobles',
//          'password' => Hash::make('asdasdasd'),
//          'email' => 'lrobles@g.com',
//          'companyId' => 1,
//          'email_verified_at' => date('Y-m-d H:i:s'),
//          'remember_token' => Str::random(10),
//          'created_at' => date('Y-m-d H:i:s'),
//          'updated_at' => date('Y-m-d H:i:s')
//        ]);
//
//        DB::table('users')->insert([
//          'firstName' => 'Paola',
//          'lastName' => 'Molina',
//          'username' => 'pmolina',
//          'password' => Hash::make('asdasdasd'),
//          'email' => 'pmolina@g.com',
//          'companyId' => 1,
//          'email_verified_at' => date('Y-m-d H:i:s'),
//          'remember_token' => Str::random(10),
//          'created_at' => date('Y-m-d H:i:s'),
//          'updated_at' => date('Y-m-d H:i:s')
//        ]);
//        DB::table('users')->insert([
//            'firstName' => 'Julio',
//            'lastName' => 'Mendez',
//            'username' => 'jmendez2',
//            'password' => Hash::make('asdasdasd'),
//            'email' => 'jmendez2@g.com',
//            'companyId' => 2,
//            'email_verified_at' => null,
//            'remember_token' => Str::random(10),
//            'created_at' => date('Y-m-d H:i:s'),
//            'updated_at' => date('Y-m-d H:i:s')
//        ]);
//
//        DB::table('users')->insert([
//            'firstName' => 'Luis',
//            'lastName' => 'Avila',
//            'username' => 'lavila2',
//            'password' => Hash::make('asdasdasd'),
//            'email' => 'lavila2@g.com',
//            'companyId' => 2,
//            'email_verified_at' => date('Y-m-d H:i:s'),
//            'remember_token' => Str::random(10),
//            'created_at' => date('Y-m-d H:i:s'),
//            'updated_at' => date('Y-m-d H:i:s')
//        ]);
//
//        DB::table('users')->insert([
//            'firstName' => 'Luciana',
//            'lastName' => 'Robles',
//            'username' => 'lrobles2',
//            'password' => Hash::make('asdasdasd'),
//            'email' => 'lrobles2@g.com',
//            'companyId' => 2,
//            'email_verified_at' => date('Y-m-d H:i:s'),
//            'remember_token' => Str::random(10),
//            'created_at' => date('Y-m-d H:i:s'),
//            'updated_at' => date('Y-m-d H:i:s')
//        ]);
//
//        DB::table('users')->insert([
//            'firstName' => 'Paola',
//            'lastName' => 'Molina',
//            'username' => 'pmolina2',
//            'password' => Hash::make('asdasdasd'),
//            'email' => 'pmolin2a@g.com',
//            'companyId' => 2,
//            'email_verified_at' => date('Y-m-d H:i:s'),
//            'remember_token' => Str::random(10),
//            'created_at' => date('Y-m-d H:i:s'),
//            'updated_at' => date('Y-m-d H:i:s')
//        ]);
//        DB::table('users')->insert([
//            'firstName' => 'Julio',
//            'lastName' => 'Mendez',
//            'username' => 'jmendez3',
//            'password' => Hash::make('asdasdasd'),
//            'email' => 'jmendez3@g.com',
//            'companyId' => 3,
//            'email_verified_at' => null,
//            'remember_token' => Str::random(10),
//            'created_at' => date('Y-m-d H:i:s'),
//            'updated_at' => date('Y-m-d H:i:s')
//        ]);
//
//        DB::table('users')->insert([
//            'firstName' => 'Luis',
//            'lastName' => 'Avila',
//            'username' => 'lavila3',
//            'password' => Hash::make('asdasdasd'),
//            'email' => 'lavila3@g.com',
//            'companyId' => 3,
//            'email_verified_at' => date('Y-m-d H:i:s'),
//            'remember_token' => Str::random(10),
//            'created_at' => date('Y-m-d H:i:s'),
//            'updated_at' => date('Y-m-d H:i:s')
//        ]);
//
//        DB::table('users')->insert([
//            'firstName' => 'Luciana',
//            'lastName' => 'Robles',
//            'username' => 'lrobles3',
//            'password' => Hash::make('asdasdasd'),
//            'email' => 'lrobles3@g.com',
//            'companyId' => 3,
//            'email_verified_at' => date('Y-m-d H:i:s'),
//            'remember_token' => Str::random(10),
//            'created_at' => date('Y-m-d H:i:s'),
//            'updated_at' => date('Y-m-d H:i:s')
//        ]);
//
//        DB::table('users')->insert([
//            'firstName' => 'Paola',
//            'lastName' => 'Molina',
//            'username' => 'pmolina3',
//            'password' => Hash::make('asdasdasd'),
//            'email' => 'pmolina3@g.com',
//            'companyId' => 3,
//            'email_verified_at' => date('Y-m-d H:i:s'),
//            'remember_token' => Str::random(10),
//            'created_at' => date('Y-m-d H:i:s'),
//            'updated_at' => date('Y-m-d H:i:s')
//        ]);
    }
}
