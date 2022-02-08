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
        'num_compte',
        'num_depot',
        'id_souscripteur',
        'status',
        'assiste',
        'valide'      
    ];

    public static function boot() {
	    parent::boot();

        static::created(function($item) {
	        // Log::info('Item Created Event:'.$item);
	    });

	    static::creating(function($item) {
        /**
         * Affectation automatique d'un code decès à l'assistance
         *  */
        
            // $date_assistance = $item->date_assistance;
            
            // $date_assistance = $date_assistance->isoFormat('D') < 26 ? $date_assistance->addMonths(2) : $date_assistance->addMonths(3);
            // $date_assistance = Carbon::create($date_assistance->isoFormat('YYYY'), $date_assistance->isoFormat('MM'), 05, 0, 0, 0);
            
            // $existCotisation = Cotisation::whereDateButoire($date_assistance)->first() ?? Cotisation::create(['date_butoire' => $date_assistance]);
            // $item->code_deces = $existCotisation->code_deces;
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
