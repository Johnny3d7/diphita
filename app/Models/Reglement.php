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
        'id_admin'
    ];
    
    public function adherent()
    {
        return $this->belongsTo(Adherents::class, 'id_adherent');
    }
    
    public function cotisation()
    {
        return $this->belongsTo(Cotisation::class, 'id_cotisation');
    }



}
