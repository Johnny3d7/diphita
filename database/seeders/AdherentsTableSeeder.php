<?php

namespace Database\Seeders;

use App\Models\Adherents;
use App\Models\AyantDroit;
use App\Models\Versement;
use Illuminate\Database\Seeder;

class AdherentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Versement::truncate();
        Adherents::truncate();
        AyantDroit::truncate();

        $faker = (new \Faker\Factory())::create();

        // Souscripteurs

        // for ($i=0; $i < 3; $i++) { 
        //     Adherents::create([
        //         'nom' => $faker->lastName(),
        //         'pnom' => $faker->firstName(),
        //         'civilite' => $faker->title(),
        //         'email' => $faker->email(),
        //         'date_naiss' => $faker->dateTimeThisCentury->format('Y-m-d'),
        //         'num_cni' => $faker->swiftBicNumber(),
        //         'lieu_naiss' => $faker->city().'-'.$faker->country,
        //         'lieu_hab' => $faker->city().'-'.$faker->country,
        //         'contact' => $faker->e164PhoneNumber,
        //         'date_adhesion' => date("Y-m-d", strtotime("-5 Months")),
        //         'date_fincarence' => date("Y-m-d", strtotime("-1 Months")),
        //         'role' => 1,
        //         'valide' => 1,
        //         'status' => 1,
        //     ]);
        // }

        //Bénéficiaires

        // for ($i=0; $i < 8; $i++) { 
        //     Adherents::create([
        //         'nom' => $faker->lastName(),
        //         'pnom' => $faker->firstName(),
        //         'civilite' => $faker->title(),
        //         'date_naiss' => $faker->dateTimeThisCentury->format('Y-m-d'),
        //         'num_cni' => $faker->swiftBicNumber(),
        //         'lieu_naiss' => $faker->city().'-'.$faker->country,
        //         'role' => 2,
        //         'date_adhesion' => date("Y-m-d", strtotime("-5 Months")),
        //         'date_fincarence' => date("Y-m-d", strtotime("-1 Months")),
        //         'parent' => $faker->numberBetween(1,3),
        //         'valide' => 1,
        //         'status' => 1,
        //     ]);
        // }

        
    }
}
