<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MaturitiyLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('maturity_levels')->insert([
          'description' => 'Aislado',
          'companyId' => 1,
            'level' => 1
        ]);

        DB::table('maturity_levels')->insert([
          'description' => 'Tacticamente integrado',
          'companyId' => 1,
            'level' => 2
        ]);

        DB::table('maturity_levels')->insert([
          'description' => 'Orientado a procesos',
          'companyId' => 1,
            'level' => 3
        ]);
        DB::table('maturity_levels')->insert([
            'description' => 'Solvente',
            'companyId' => 1,
            'level' => 4
        ]);

        DB::table('maturity_levels')->insert([
            'description' => 'Tacticamente Independiente',
            'companyId' => 1,
            'level' => 5
        ]);

        DB::table('maturity_levels')->insert([
          'description' => 'Empresa optimizada',
          'companyId' => 2,
            'level' => 5
        ]);

        DB::table('maturity_levels')->insert([
          'description' => 'Red operativa inteligente',
          'companyId' => 2,
            'level' => 1
        ]);

        DB::table('maturity_levels')->insert([
          'description' => 'Adaptado',
          'companyId' => 2,
            'level' => 2
        ]);

        DB::table('maturity_levels')->insert([
          'description' => 'Funcional',
          'companyId' => 3,
            'level' => 1
        ]);

        DB::table('maturity_levels')->insert([
          'description' => 'Estable',
          'companyId' => 3,
            'level' => 2
        ]);

        DB::table('maturity_levels')->insert([
          'description' => 'Maduro',
          'companyId' => 3,
            'level' => 1
        ]);
    }
}
