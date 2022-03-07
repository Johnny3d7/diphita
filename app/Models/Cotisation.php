<?php

namespace App\Models;

use App\Helpers\Parameters;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotisation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function boot(){
        parent::boot();
        
        static::creating(function($item) {
            // Log::info('Item Creating Event:'.$item);
            if($item->date_butoire){
                $newId = (count(static::selectAll('false')->sortByDesc('id')) > 0 ? (int) substr(static::selectAll('false')->sortByDesc('id')->first()->code_deces, 3) : 0) + 1;
                $item->code_deces = "AD-".($newId<10 ? '000' : ($newId<100 ? '00' : ($newId<1000 ? '0' : '') )).$newId;
                
                $date_annonce = $item->date_butoire;
                $date_annonce->subMonths(2);
                $item->date_annonce = Carbon::create($date_annonce->isoFormat('YYYY'), $date_annonce->isoFormat('MM'), 25, 0, 0, 0);
                $item->date_butoire->addMonths(2);
                $item->type = 'exceptionnelle';
            }

            $item->montant = $item->type == "exceptionnelle" ? Parameters::cotisationExceptionnelle() : Parameters::cotisationAnnuelle();

            // if this month or this year => parcouru : false
            if($item->type != "exceptionnelle" && $item->annee_cotis < Carbon::now()->year) $item->parcouru = true;
            if($item->type == "exceptionnelle" && Carbon::create($item->date_annonce) < Carbon::create(Carbon::now()->year, Carbon::now()->month, 5)) $item->parcouru = true;
        });

        static::created(function($item) {
            // Creating cotisation items for each adherent based on $this
            // $adherents = Adherents::whereYe('annee_cotis', '>=', Carbon::create($item->date_adhesion)->year)->orWhere('date_annonce', '>=', Carbon::create($item->date_debutcotisation))->get();
            // $adherents =  Adherents::whereYear('date_adhesion', '<', $item->annee_cotis)->get();
            // $adherents = $item->type == "annuelle" ? Adherents::whereYear('date_adhesion', '>=', $item->annee_cotis)->get() : Adherents::whereDate('date_debutcotisation', '>=', 'date_annonce')->get();
            // $adherents = $item->type == "exceptionnelle" ? [Adherents::selectAll()[0]] : [Adherents::selectAll(true)[0]];
            // $adherents = $item->type == "exceptionnelle" ? Adherents::whereDate('date_adhesion', '<=', $item->date_annonce)->get() : [];
            

            $adherents = $item->type == "exceptionnelle" ? Adherents::whereDate('date_debutcotisation', '<=', $item->date_annonce)->get() : Adherents::whereYear('date_adhesion', '<=', $item->annee_cotis)->get();

            foreach ($adherents as $adherent) { // Select all souscripteurs and create items
                if(!AdherentHasCotisations::whereIdCotisation($item->id)->whereIdAdherent($adherent->id)->first()){
                    AdherentHasCotisations::create([
                        'id_cotisation' => $item->id,
                        'id_adherent' => $adherent->id,
                        'nbre_benef' => $adherent->total_benef_life() + 1,
                        'montant' => $item->montant * ($adherent->total_benef_life() +1 ),
                        'reglee' => false,
                        'parcouru' => false,
                    ]);
                }
            }
        });

        static::updated(function($item){
            if($item->montant != $item->getOriginal('montant')) $item->refreshCotisations();
        });
    }

    public static function selectAllExceptionnelle() {
        $tabYear = [];
        $result = new Collection();
        $all = static::whereType('exceptionnelle')->get();

        foreach ($all as $value) {
            $year = substr($value->date_butoire, 0, 4);
            if(!in_array($year, $tabYear)){
                $tabYear []= $year;
                $result->add(new Collection(["year" => $year, "cotisations" => new Collection()]));
            }
            ($result->where("year",$year)->first()['cotisations'])->add($value);
        }
        return $result->sort();
    }

    public static function selectAll(String $type = 'exceptionnelles'){
        return $type=='exceptionnelles' ? static::selectAllExceptionnelle() : ($type=='annuelles' ? static::whereType('annuelle')->get() : ($type=='false' ? static::whereType('exceptionnelle')->get() : null));
    }

    public function refreshCotisations(){
        $cotisations = AdherentHasCotisations::whereIdCotisation($this->id)->get();
        foreach ($cotisations as  $cotisation) {
            $cotisation->update([
                'montant' => $this->montant * $this->cas()->count() * $cotisation->nbre_benef,
            ]);
        }
    }

    public function cas (){
        return $this->type == "exceptionnelle" ? Assistance::whereCodeDeces($this->code_deces)->get() : null;
    }

    public function souscripteurs(String $filter=null) {
        $souscripteurs = new Collection();
        $cotisations = AdherentHasCotisations::whereIdCotisation($this->id);
        if($filter){
            $cotisations = $filter=="Regle" ? $cotisations->whereReglee(true) : $cotisations->whereReglee(false);
        }
        foreach ($cotisations->get() as $cotisation) {
            if($cotisation->souscripteur->isValide()) $souscripteurs->add($cotisation->souscripteur);
        }

        return $souscripteurs;
    }

    public function montant_total(){
        $ahcs = $this->hasMany(AdherentHasCotisations::class, 'id_cotisation')->get();
        $montant = 0;
        foreach ($ahcs as $ahc) {
            $souscripteur = $ahc->souscripteur;
            $montant += $souscripteur->psCotisation($this)->montant();
        }
        return $montant;
    }

    public function reglements(Adherents $adherent=null){
        $reglements = $this->hasMany(Reglement::class, 'id_cotisation')->get();
        if($adherent) $reglements = $adherent->reglements($this);
        return $reglements;
    }

    public function montant_collecte(){
        return $this->reglements()->sum('montant');
    }

    public function isClosing(){
        return false;
    }
}
