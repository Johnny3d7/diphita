<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotisationExceptionnelle extends Model
{
    use HasFactory;

    protected $table = 'cotisation_exeptionnelles';
    
    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'montant',
        'status',
    ];

    public static function boot(){
        parent::boot();

        static::created(function($item) {
            $cotisation = Cotisation::whereType('exceptionnelle')->whereParcouru(false)->latest()->first();
            if($cotisation) $cotisation->update(['montant' => $item->montant]);
        });
    }
}
