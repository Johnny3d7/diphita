<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Adherents extends Model
{
    use HasFactory; use HasSlug;

    protected $table = 'adherents';
    
    protected $guarded = ['id'];

    public $timestamps = true;

    protected $fillable = [
        'num_adhesion',
        'num_contrat',
        'nom',
        'pnom',
        'slug',
        'civilite',
        'email',
        'date_naiss',
        'num_cni',
        'lieu_naiss',
        'lieu_hab',
        'contact',
        'contact_format',
        'role',
        'date_adhesion',
        'date_fincarence',
        'date_debutcotisation',
        'parent',
        'valide',
        'cas',
        'status',
        'admin_id'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('num_cni','nom','pnom')
            ->saveSlugsTo('slug');
    }

    public function ayants()
    {
        return $this->hasMany(AyantDroit::class, 'id_adherent');
    }

    public function beneficiaires()
    {
        return $this->hasMany(SELF::class, 'parent');
    }

    public function assistances()
    {
        return $this->hasMany(Assistance::class, 'id_souscripteur');
    }
}
