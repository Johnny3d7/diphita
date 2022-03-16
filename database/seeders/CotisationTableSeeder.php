<?php

namespace Database\Seeders;

use App\Models\AdherentHasCotisations;
use App\Models\Assistance;
use App\Models\Cotisation;
use App\Models\Reglement;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CotisationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Assistance::truncate();
        Cotisation::truncate();
        Reglement::truncate();
        AdherentHasCotisations::truncate();

        for ($i=2018; $i <= Carbon::now()->isoFormat('YYYY'); $i++) {
            for ($j=1; $j <= 12; $j++) { 
                $date_assistance = Carbon::create($i, $j, 05, 0, 0, 0);
                if(!($i == 2018 && ($j < 4 || $j == 5 )) && $date_assistance < Carbon::now()->addMonths(2)) Cotisation::create(['date_butoire' => $date_assistance]);
            }
            Cotisation::create(['annee_cotis' => $i]);
        }
    }
}
