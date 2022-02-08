<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->cotisation->parcouru ? $this->montant : ($this->cotisation->montant * 
                                                            ($this->cotisation->type == "exceptionnelle" ? $this->cotisation->cas()->count() : 1) * 
                                                            ($this->nbre_benef + 1));
                                                            // ($this->souscripteur->total_benef_life() + 1));
    }
    

}
