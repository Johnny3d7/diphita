<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class AyantDroit extends Model
{
    use HasFactory; use HasSlug;

    protected $table = 'ayantdroits';
    
    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'num_ayant',
        'nom',
        'pnom',
        'slug',
        'civilite',
        'email',
        'date_naiss',
        'lieu_hab',
        'contact',
        'priorite',
        'status',
        'id_adherent'
    ];


    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nom','pnom')
            ->saveSlugsTo('slug');
    }
}
