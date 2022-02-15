<?php

namespace Database\Seeders;

use App\Models\CotisationAnnuelle;
use App\Models\CotisationExceptionnelle;
use App\Models\DroitInscription;
use App\Models\DureeFincarences;
use App\Models\TraitementKit;
use Illuminate\Database\Seeder;

class ParametersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DroitInscription::truncate();
        CotisationAnnuelle::truncate();
        CotisationExceptionnelle::truncate();
        TraitementKit::truncate();
        DureeFincarences::truncate();

        DroitInscription::create(['montant' => 7000, 'status' => true]);
        CotisationAnnuelle::create(['montant' => 2000, 'status' => true]);
        CotisationExceptionnelle::create(['montant' => 650, 'status' => true]);
        TraitementKit::create(['montant' => 1000, 'status' => true]);
        DureeFincarences::create(['duree' => 4, 'status' => true]);
    }
}
