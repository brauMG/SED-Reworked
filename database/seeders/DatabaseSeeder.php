<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CompaniesTableSeeder::class,
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            //AreasTableSeeder::class,
            RoleUserTableSeeder::class,
            //ConceptsTableSeeder::class,
            //MaturitiyLevelsTableSeeder::class,
            //AttributesTableSeeder::class,
            //EvidenceTableSeeder::class,
            //TestsTableSeeder::class,
            //ConceptMaturityLevelSeeder::class,
            //TestConceptSeeder::class,
            //TestUserSeeder::class,
            //UserAreasSeeder::class,
            //ConceptMaturityLevelAttributeSeeder::class,
        ]);
    }
}
