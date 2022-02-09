<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{
    use HasFactory;

    protected $table = 'reglements';
    
    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'montant',
        'status',
        'id_adherent',
        'id_cotisation',
        'parcouru',
        'type',
        'description',
        'id_admin'
    ];

    public static function boot(){
        parent::boot();

        static::created(function($item) {
            $cotisation = Cotisation::find($item->id_cotisation);
            $adherent = Adherents::find($item->id_adherent);
            $adherentHasCotisation = $adherent && $cotisation ? $adherent->psCotisation($cotisation) : null;
            if($cotisation && $adherent && ($cotisation->reglements($adherent)->sum('montant') >= ($adherentHasCotisation->montant() ?? 0 ))){
                $adherentHasCotisation->update(['reglee' => true]);
            } else {
                if($adherentHasCotisation) $adherentHasCotisation->update(['reglee' => false]);
            }
        });
    }
    
    public function adherent()
    {
        return $this->belongsTo(Adherents::class, 'id_adherent');
    }
    
    public function cotisation()
    {
        return $this->belongsTo(Cotisation::class, 'id_cotisation');
    }



}
