<?php

namespace App\Models;

use App\Helpers\Parameters;
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
        'conseiller_diph',
        'cas',
        'status',
        'droit_inscription_montant',
        'cot_annuelle_montant',
        'kits_montant',
        'admin_id'
    ];

    public static function boot(){
        parent::boot();

        static::creating(function($item) {
            $dateAD = Carbon::create($item->date_adhesion);
            // Si $day < 5 alors day = 05 mois en cours sinon 05 mois suivant
            $item->date_debutcotisation = Carbon::create($dateAD->year, $dateAD->month + ($dateAD->day > 5 ?? 0), 5);

            $item->date_fincarence = $dateAD->addMonths(Parameters::dureeFinCarrence() ?? 4);
        });

        static::created(function($item) {
            // Creating cotisation items for each cotisation  based on $this->date_debutcotisation
            
            if($item->isValide()){
                if($item->isSouscripteur()) $item->firstCotisations();
                if($item->isBeneficiaire() && $item->souscripteur()){
                    $souscripteur = $item->souscripteur();
                    Versement::create([
                        'id_adherent' => $souscripteur->id,
                        'montant' => Parameters::cotisationAnnuelle()+Parameters::droitInscription()+Parameters::traitementKit()
                    ]);
            
                    $souscripteur->firstReglementPerso($item);

                    $annuelle = $item->cotisations("annuelle")->last()->first();
                    if($annuelle){
                        Reglement::create([
                            'id_adherent' => $item->id,
                            'id_cotisation' => $annuelle->id,
                            'montant' => $item->psCotisation($annuelle) ? $item->psCotisation($annuelle)->montant() : 0,
                            'type' => 'Paiement de cotisation première année',
                            'description' => "Cotisation annuelle : $annuelle->annee_cotis"
                        ]);
                    }
                }
            }
        });
    }

    public function firstCotisations(){
        $cotisations = Cotisation::where('annee_cotis', '>=', Carbon::create($this->date_adhesion)->year)->orWhere('date_annonce', '>=', Carbon::create($this->date_debutcotisation))->get();
        if($cotisations){
            foreach ($cotisations as $cotisation) { // Select all souscripteurs and create thiss
                if(!AdherentHasCotisations::whereIdCotisation($cotisation->id)->whereIdAdherent($this->id)->first()){
                    AdherentHasCotisations::create([
                        'id_cotisation' => $cotisation->id,
                        'id_adherent' => $this->id,
                        'nbre_benef' => $this->total_benef_life() + 1,
                        'montant' => $cotisation->montant * ($this->total_benef_life() + 1),
                        'reglee' => false,
                        'parcouru' => false,
                    ]);
                }
            }
        }
        $this->firstReglement();
    }

    public function firstReglementPerso(Adherents $adherent){
        Reglement::create([
            'id_adherent' => $this->id,
            'montant' => Parameters::droitInscription(),
            'type' => "Droit d'inscription",
            'description' => "Droit d'inscription : $adherent->num_adhesion"
        ]);
        Reglement::create([
            'id_adherent' => $this->id,
            'montant' => Parameters::traitementKit(),
            'type' => "Kit d'inscription",
            'description' => "Kit d'inscription : $adherent->num_adhesion"
        ]);
    }
    
    public function firstReglement(){
        Versement::create([
            'id_adherent' => $this->id,
            'montant' => (Parameters::cotisationAnnuelle()+Parameters::droitInscription()+Parameters::traitementKit()) * ($this->beneficiaires()->count() + 1)
        ]);

        $this->firstReglementPerso($this);
        foreach ($this->beneficiaires() as $beneficiaire) {
            $this->firstReglementPerso($beneficiaire);
        }

        $annuelle = $this->cotisations("annuelle")->last()->first();
        if($annuelle){
            Reglement::create([
                'id_adherent' => $this->id,
                'id_cotisation' => $annuelle->id,
                'montant' => $this->psCotisation($annuelle) ? $this->psCotisation($annuelle)->montant() : 0,
                'type' => 'Paiement de cotisation première année',
                'description' => "Cotisation annuelle : $annuelle->annee_cotis"
            ]);
        }
    }

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

    public function isValide(){
        return $this->valide;
    }

    public function beneficiaires(){
        return $this->isBeneficiaire() ? null : self::where(['status'=>1,'role'=>2,'parent'=>$this->id])->orderBy('created_at', 'DESC')->get();
    }

    public function versements(int $parcouru = 10){
        $versements = $this->hasMany(Versement::class, 'id_adherent');
        if($parcouru != 10) $versements = $versements->whereParcouru($parcouru)->get();
        return $versements;
    }
    
    public function reglements(Cotisation $cotisation=null, int $parcouru = 10){
        $reglements = $this->hasMany(Reglement::class, 'id_adherent');
        if($cotisation) $reglements = $reglements->whereIdCotisation($cotisation->id)->get();
        if($parcouru != 10) $reglements = $reglements->whereParcouru($parcouru)->get();
        return $reglements;
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
        $reglements = new Collection($this->reglements);
        $versements = new Collection($this->versements);
        $transactions = $reglements->concat($versements);
        return $transactions;
    }

    public function cotisations(String $type = null, int $reglee = 10){
        $owns = $this->ownCotisations;
        $cotisations = new Collection();
        foreach ($owns as $own) {
            if((!$type || ($type && $own->cotisation->type == $type)) && ($reglee == 10 || $own->reglee == $reglee)) $cotisations->add($own->cotisation);
        }
        return $cotisations;
    }

    public function ownCotisations(){
        return $this->hasMany(AdherentHasCotisations::class, 'id_adherent');
    }

    public function cotisationsBAk(String $type = null){
        // $cotisations = new Collection();
        $cotisations = Cotisation::whereNotNull('type');
        if($type) $cotisations = Cotisation::whereType($type);
        $cotisations = $cotisations->where(function ($q) { 
            $q->where('annee_cotis', '>=', Carbon::create($this->date_adhesion)->year)
                ->orWhere('date_annonce', '>=', Carbon::create($this->date_adhesion));
        });
        return $cotisations->get();
    }

    public function solde(){
        return $this->solde + $this->versements(0)->sum('montant') - $this->reglements(null, 0)->sum('montant');
    }

    public function total_benef_life(){
        return $this->isSouscripteur() ? self::where(['status'=>1,'parent'=>$this->id,'cas'=> 0])->whereNotIn('id',[$this->id])->count() : 0;
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

    public function psCotisation(Cotisation $cotisation){
        if($this->isBeneficiaire()) return null;
        return AdherentHasCotisations::whereIdCotisation($cotisation->id)->whereIdAdherent($this->id)->first();
    }


    public function list_benef_in_life(){
        return self::where(['status'=>1,'cas'=> 0])->get();
    }


    public function isReglee(Cotisation $cotisation){
        return $this->psCotisation($cotisation) ? $this->psCotisation($cotisation)->reglee : null;
    }

    public function admin(){
         return $this->belongsTo(User::class, 'admin_id');
    }
    

}
