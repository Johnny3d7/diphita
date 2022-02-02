<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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

    public static function selectAll(Bool $souscripteur = false){
        $valides = static::where(['valide'=>1,'status'=>1]);
        if($souscripteur) $valides = $valides->whereRole(1);
        return $valides->get();
    }

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
  
    public function assistances()
    {
        return $this->hasMany(Assistance::class, 'id_souscripteur');
    }
    /**
     * Get the real type of the Adherent [Souscripteur = 1 | Beneficiaire = 2]
     * @return True means Beneficiaire (having a subscriptor parent)
     * @return False means Souscripteur
     */
    public function isBeneficiaire(){
        return $this->role == 2 ? true : false;
    }

    public function isSouscripteur(){
        return $this->role == 1 ? true : false;
    }

    public function beneficiaires(){
        return $this->isBeneficiaire() ? null : self::where(['status'=>1,'role'=>2,'parent'=>$this->id])->orderBy('created_at', 'DESC')->get();
    }

    public function versements(){
        return $this->hasMany(Versement::class, 'id_adherent');
    }

    public function souscripteur(){
        // dd($this->hasOne(Adherents::class, 'parent'));
        return $this->isBeneficiaire() ? self::whereId($this->parent)->first() : null;
        return $this->isBeneficiaire() ? $this->hasOne(Adherents::class, 'parent') : $this->hasOne(Adherents::class, 'id');
    }

    public function assistance(){
        return $this->hasOne(Assistance::class, 'id_benef');
    }

    public function transactions(){
        // $reglements = Versement::whereIdAdherent($this->id)->get();
        $transactions = $this->versements;
        $transactions = $transactions->merge($this->cotisations());
        // dd($transactions);
        return $transactions;
    }

    public function cotisations(String $type = null){
        // $cotisations = new Collection();
        $cotisations = Cotisation::whereNotNull('type');
        if($type) $cotisations = Cotisation::whereType($type);
        $cotisations = $cotisations->where(function ($q) { 
            $q->where('annee_cotis', '>=', Carbon::create($this->date_adhesion)->year)
                ->orWhere('date_annonce', '>=', Carbon::create($this->date_adhesion));
        });
        return $cotisations->get();
    }

    public function total_benef_life(){
        return $this->isSouscripteur() ? self::where(['status'=>1,'parent'=>$this->id,'cas'=> 0])->whereNotIn('id',[$this->id])->count() : null;
    }

    public function add_benef_is_possible(){
        return $this->total_benef_life() < 4 ? true : false;
    }

    public function total_ayant_droit(){
        return $this->isSouscripteur() ? AyantDroit::where(['status'=>1,'id_adherent'=>$this->id])->count() : null;
    }

    public function add_ayant_droit_is_possible(){
        return $this->total_ayant_droit() < 3 ? true : false;
    }

    public function nom_pnom(){
        return $this->nom.' '.$this->pnom;
    }

    public function is_not_cas(){
        return $this->cas == 0 ? true : false;
    }

    public function is_not_in_assistance(){
        return Assistance::where(['id_benef'=>$this->id,'valide'=>0])->exists()? false : true;
    }

    // public function cas_(){
    //     return Assistance::where(['id_benef'=>$this->id,'valide'=>0])->exists()? false : true;
    // }

    

}
