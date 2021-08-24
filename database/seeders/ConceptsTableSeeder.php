<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConceptsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('concepts')->insert([
          'description' => 'Calidad',
        ]);

        DB::table('concepts')->insert([
          'description' => 'Tecnologia',
        ]);

        DB::table('concepts')->insert([
          'description' => 'Procesos',
        ]);

        DB::table('concepts')->insert([
          'description' => 'Servicio',
        ]);

        DB::table('concepts')->insert([
          'description' => 'Gente',
        ]);

        DB::table('concepts')->insert([
          'description' => 'Crecimiento',
        ]);

        DB::table('concepts')->insert([
          'description' => 'Estrategia',
        ]);

        DB::table('concepts')->insert([
          'description' => 'Controles',
        ]);

        DB::table('concepts')->insert([
          'description' => 'Costo',
        ]);
        DB::table('concepts')->insert([
            'description' => 'Mantenimiento',
        ]);
        DB::table('concepts')->insert([
            'description' => 'Concepto',
        ]);
        DB::table('concepts')->insert([
            'description' => 'Concepto2',
        ]);
    }
}
