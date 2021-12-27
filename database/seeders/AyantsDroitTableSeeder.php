<?php

namespace Database\Seeders;

use App\Models\AyantDroit;
use Illuminate\Database\Seeder;

class AyantsDroitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        AyantDroit::truncate();

        $faker = (new \Faker\Factory())::create();

        for ($i=0; $i < 6; $i++) { 
            AyantDroit::create([
                'nom' => $faker->lastName(),
                'pnom' => $faker->firstName(),
                'civilite' => $faker->title(),
                'contact' => $faker->e164PhoneNumber,
                'priorite' => 1,
                'id_adherent' => $faker->numberBetween(1,3),
                'status' => 1,
            ]);
        }

    }
}
