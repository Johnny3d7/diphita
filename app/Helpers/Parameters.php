<?php

namespace App\Helpers;

use App\Models\CotisationAnnuelle;
use App\Models\CotisationExceptionnelle;
use App\Models\DroitInscription;
use App\Models\DureeFincarences;
use App\Models\TraitementKit;

class Parameters
{
    public static function droitInscription() {
        return DroitInscription::whereStatus(1)->first()->montant ?? 2500;
        // return DroitInscription::latest()->first()->montant ?? 2500;
    }
    
    public static function cotisationAnnuelle() {
        return CotisationAnnuelle::whereStatus(1)->first()->montant ?? 2500;
        // return CotisationAnnuelle::latest()->first()->montant ?? 2500;
    }
    
    public static function cotisationExceptionnelle() {
        return CotisationExceptionnelle::whereStatus(1)->first()->montant ?? 2500;
        // return CotisationExceptionnelle::latest()->first()->montant ?? 2500;
    }
    
    public static function traitementKit() {
        return TraitementKit::whereStatus(1)->first()->montant ?? 2500;
        // return TraitementKit::latest()->first()->montant ?? 2500;
    }
    
    public static function dureeFinCarrence() {
        return DureeFincarences::whereStatus(1)->first()->duree ?? 5;
        // return DureeFincarences::latest()->first()->duree ?? 5;
    }
}