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

}
