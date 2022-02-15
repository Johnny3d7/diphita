<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
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
        'num_cheque',
        'num_compte',
        'num_depot',
        'id_souscripteur',
        'status',
        'assiste',
        'valide',
        'code_deces',
    ];

    public static function boot() {
	    parent::boot();

	    static::creating(function($item) {

        });

        static::created(function($item) {
            if($item->cotisation) $item->cotisation->refreshCotisations();
        });
	}



    /**
     * Get the options for generating the slug.
     */
    /*public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nom','pnom')
            ->saveSlugsTo('slug');
    }*/

    public function adherent()
    {
        return $this->belongsTo(Adherents::class, 'id_souscripteur');
    }
    
    public function beneficiaire()
    {
        return $this->belongsTo(Adherents::class, 'id_benef');
    }
    
    public function cotisation()
    {
        return $this->belongsTo(Cotisation::class, 'code_deces', 'code_deces');
    }
}
