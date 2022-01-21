<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistance extends Model
{
    use HasFactory;

    protected $table = 'assistances';
    
    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'id_benef',
        'date_deces',
        'lieu_deces',
        'date_obseques',
        'date_assistance',
        'moyen_assistance',
        'enfant_defunt',
        'enfant_contact',
        'proche_defunt',
        'proche_contact',
        'id_souscripteur',
        'status',
        'valide'      
    ];


    /**
     * Get the options for generating the slug.
     */
    /*public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nom','pnom')
            ->saveSlugsTo('slug');
    }*/

    public function souscripteur()
    {
        return $this->belongsTo(Adherents::class, 'id_souscripteur');
    }

    public function beneficiaire()
    {
        return $this->belongsTo(Adherents::class, 'id_benef');
    }
}
