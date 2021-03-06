<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use PhpParser\ErrorHandler\Collecting;

class AdherentHasCotisations extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function souscripteur(){
        return $this->belongsTo(Adherents::class, 'id_adherent');
    }
   
    public function cotisation(){
        return $this->belongsTo(Cotisation::class, 'id_cotisation');
    }

    public function montant(){
        return ($this->cotisation->montant * 
            ($this->cotisation->type == "exceptionnelle" ? $this->cotisation->cas()->count() : 1) * 
            ($this->nbre_benef));
        return $this->cotisation->parcouru ? $this->montant : ($this->cotisation->montant * 
                                                            ($this->cotisation->type == "exceptionnelle" ? $this->cotisation->cas()->count() : 1) * 
                                                            ($this->nbre_benef));
                                                            // ($this->souscripteur->total_benef_life() + 1));
    }

    public static function getSouscripteursFromCotisation(Cotisation $cotisation){
        $souscripteurs = new Collection();
        foreach ($cotisation->ahcs as $ahc) {
            $souscripteurs->add($ahc->souscripteur);
        }
        return $souscripteurs;
    }
    
    public static function getCotisationsFromSouscripteur(Adherents $souscripteur){
        $cotisations = new Collection();
        foreach ($souscripteur->ahcs as $ahc) {
            $cotisations->add($ahc->cotisation);
        }
        return $cotisations;
    }



}
