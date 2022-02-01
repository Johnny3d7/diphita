<?php

namespace Database\Seeders;

use App\Models\Caisse;
use Illuminate\Database\Seeder;

class CaisseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Caisse::truncate();

        Caisse::create([
            'titre' => "Caisse principale",
            'description' => "Ceci est la caisse principale"
        ]);
    }
}
