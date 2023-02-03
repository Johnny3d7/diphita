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
        $this->command->info('Truncating data');
        Assistance::truncate();
        Cotisation::truncate();
        Reglement::truncate();
        AdherentHasCotisations::truncate();
        
        $this->command->info('Creating new data');
        for ($i=2018; $i <= Carbon::now()->isoFormat('YYYY'); $i++) {
            $this->command->info("Year $i...");
            for ($j=1; $j <= 12; $j++) { 
                $this->command->info("$j - $i");
                $date_assistance = Carbon::create($i, $j, 05, 0, 0, 0);
                if(!($i == 2018 && ($j < 4 || $j == 5 )) && $date_assistance < Carbon::now()->addMonths(2)) {
                    if(!Cotisation::whereDateButoire($date_assistance)->first()) Cotisation::create(['date_butoire' => $date_assistance]);
                }
            }
            if(!Cotisation::whereAnneeCotis($i)->first()) Cotisation::create(['annee_cotis' => $i]);
        }
        $this->command->info("Completed !");
    }
}
