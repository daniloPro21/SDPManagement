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
        $this->call(ServiceSeeder::class);
        $this->call(TypeDossierSeeder::class);
        $this->call(PersonneSeeder::class);
        $this->call(DossierSeeder::class);
        $this->call(StepDossier::class);
    }
}
