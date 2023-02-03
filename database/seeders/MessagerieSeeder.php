<?php

namespace Database\Seeders;

use App\Models\Campagne;
use App\Models\Message;
use Illuminate\Database\Seeder;
use Faker\Generator;

class MessagerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::truncate();
        Campagne::truncate();

        $faker = app(Generator::class);

        for ($i=0; $i < 5; $i++) {
            Campagne::create([
                'titre' => $faker->word(),
                'description' => $faker->sentence(),
                'nbre_destinataires' => rand(1,5),
                'destinataires' => $faker->sentence(),
                'status' => 'pending',
            ]);
        }
    }
}
