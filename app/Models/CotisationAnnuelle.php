<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotisationAnnuelle extends Model
{
    use HasFactory;

    protected $table = 'cotisation_annuelles';
    
    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'montant',
        'status',
    ];

    public static function boot(){
        parent::boot();

        static::created(function($item) {
            $cotisation = Cotisation::whereType('annuelle')->whereParcouru(false)->latest()->first();
            if($cotisation) $cotisation->update(['montant' => $item->montant]);
        });
    }

}
