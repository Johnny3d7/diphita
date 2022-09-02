<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Versement extends Model
{
    use HasFactory;

    protected $table = 'versements';

    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'montant',
        'status',
        'id_adherent',
        'parcouru',
        'id_admin'
    ];

    public static function boot(){
        parent::boot();

        static::creating(function($item){
            $item->description = "Versement";
        });
    }

    public static function getNonParcouru(){
        return static::whereParcouru(false)->get();
    }

    public function adherent()
    {
        return $this->belongsTo(Adherents::class, 'id_adherent');
    }

    public static function getMontant(){
        return static::getNonParcouru()->sum('montant');
    }

}
