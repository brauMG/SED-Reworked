<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            'name' => 'Recursos Humanos',
            'companyId'=>'1',
            'created_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('areas')->insert([
            'name' => 'Ventas',
            'companyId'=>'1',
            'created_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('areas')->insert([
            'name' => 'Contabilidad',
            'companyId'=>'1',
            'created_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('areas')->insert([
            'name' => 'Procesos',
            'companyId'=>'1',
            'created_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('areas')->insert([
            'name' => 'Mantenimiento',
            'companyId'=>'1',
            'created_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('areas')->insert([
            'name' => 'IT',
            'companyId'=>'1',
            'created_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('areas')->insert([
            'name' => 'Recursos Humanos2',
            'companyId'=>'2',
            'created_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('areas')->insert([
            'name' => 'Ventas2',
            'companyId'=>'2',
            'created_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('areas')->insert([
            'name' => 'Contabilidad2',
            'companyId'=>'2',
            'created_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('areas')->insert([
            'name' => 'Procesos2',
            'companyId'=>'2',
            'created_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('areas')->insert([
            'name' => 'Recursos Humanos3',
            'companyId'=>'3',
            'created_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('areas')->insert([
            'name' => 'Ventas3',
            'companyId'=>'3',
            'created_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('areas')->insert([
            'name' => 'Contabilidad3',
            'companyId'=>'3',
            'created_at'=>date('Y-m-d H:i:s')
        ]);
        DB::table('areas')->insert([
            'name' => 'Procesos3',
            'companyId'=>'3',
            'created_at'=>date('Y-m-d H:i:s')
        ]);
    }
}
