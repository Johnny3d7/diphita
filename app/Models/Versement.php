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
        'id_adherent'
    ];
}
