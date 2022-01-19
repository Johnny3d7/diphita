<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;

    protected $table = 'depenses';
    
    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'lib',
        'montant',
        'date_depense',
        'observation',
        'parcouru',
        'id_admin',
        'id_ordonnateur',
        'status',
        'id_adherent'
    ];
    
            
    
}
