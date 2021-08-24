<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'SED',
            'address' => '-',
            'phoneNumber' => '-',
            'email' => '-',
            'status' => '1'
        ]);

//        DB::table('companies')->insert([
//            'name' => 'Samsung',
//            'address' => 'Parque Industrial Florido',
//            'phoneNumber' => '6641234567',
//            'email' => 'samsung@samsung.com',
//            'status' => '1'
//        ]);
//
//        DB::table('companies')->insert([
//            'name' => 'ArkusNexus',
//            'address' => 'Zona Rio',
//            'phoneNumber' => '6645242131',
//            'email' => 'arkus@nexus.com',
//            'status' => '1'
//        ]);
    }
}
