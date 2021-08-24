<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EvidenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('evidences')->insert([
          'link' => '1.txt',
          'attributeId' => 1,
          'verified' => 1,
            'userId' => 4,
            'companyId' => 1,

        ]);
        DB::table('evidences')->insert([
            'link' => '2.txt',
            'attributeId' => 2,
            'verified' => 1,
            'userId' => 4,
            'companyId' => 1,

        ]);
        DB::table('evidences')->insert([
            'link' => '3.txt',
            'attributeId' => 3,
            'verified' => 1,
            'userId' => 4,
            'companyId' => 1,

        ]);
        DB::table('evidences')->insert([
          'link' => '4.txt',
          'attributeId' => 4,
          'verified' => 1,
            'userId' => 4,
            'companyId' => 1,
        ]);
        DB::table('evidences')->insert([
          'link' => '5.txt',
          'attributeId' => 5,
          'verified' => 1,
            'userId' => 4,
            'companyId' => 1,
        ]);
        DB::table('evidences')->insert([
          'link' => '6.txt',
          'attributeId' => 6,
          'verified' => 1,
            'userId' => 4,
            'companyId' => 1,
        ]);
        DB::table('evidences')->insert([
          'link' => '7.txt',
          'attributeId' => 7,
          'verified' => 1,
            'userId' => 4,
            'companyId' => 1,
        ]);
        DB::table('evidences')->insert([
          'link' => '8.txt',
          'attributeId' => 8,
          'verified' => 1,
            'userId' => 4,
            'companyId' => 1,
        ]);
        DB::table('evidences')->insert([
            'link' => '9.txt',
            'attributeId' => 9,
            'verified' => 1,
            'userId' => 4,
            'companyId' => 1,

        ]);
        DB::table('evidences')->insert([
            'link' => '10.txt',
            'attributeId' => 10,
            'verified' => 1,
            'userId' => 4,
            'companyId' => 1,
        ]);
        DB::table('evidences')->insert([
            'link' => '11.txt',
            'attributeId' => 11,
            'verified' => 1,
            'userId' => 4,
            'companyId' => 1,
        ]);
        DB::table('evidences')->insert([
            'link' => '12.txt',
            'attributeId' => 12,
            'verified' => 1,
            'userId' => 4,
            'companyId' => 1,
        ]);
        DB::table('evidences')->insert([
            'link' => '13.txt',
            'attributeId' => 13,
            'verified' => 1,
            'userId' => 4,
            'companyId' => 1,
        ]);
        DB::table('evidences')->insert([
            'link' => '14.txt',
            'attributeId' => 14,
            'verified' => 1,
            'userId' => 4,
            'companyId' => 1,
        ]);
        DB::table('evidences')->insert([
            'link' => '15.txt',
            'attributeId' => 15,
            'verified' => 1,
            'userId' => 4,
            'companyId' => 1,
        ]);
    }
}
