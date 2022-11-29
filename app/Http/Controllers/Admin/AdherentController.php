<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Parameters;
use App\Http\Controllers\Controller;
use App\Imports\AdhesionsImport;
use App\Imports\BeneficiairesImport;
use App\Imports\SouscripteursImport;
use App\Models\AdherentHasCotisations;
use App\Models\Adherents;
use App\Models\AyantDroit;
use App\Models\Cotisation;
use App\Models\CotisationAnnuelle;
use App\Models\DroitInscription;
use App\Models\DureeFincarences;
use App\Models\Reglement;
use App\Models\TraitementKit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Auth;


class AdherentController extends Controller
{
    public static $globalResult = [
        "statut" => "En attente",
        "beneficiaires" => [
            "statut" => "En attente",
            "total" => null,
            "courant" => null,
            "results" => null
        ],
        "souscripteurs" => [
            "statut" => "En attente",
            "total" => null,
            "courant" => null,
            "results" => null
        ],
        "ayantdroits" => [
            "statut" => "En attente",
            "total" => null,
            "courant" => null,
            "results" => null
        ],
    ];

    public function verify(){
        $data = cache('globalResult');
        if($data && $data['beneficiaires']['statut'] == 'Terminé') $this->empty_cache();
        return response()->json($data);


        $id = session('import');

        return response()->json([
            'started' => filled(cache("start_date_$id")),
            'finished' => filled(cache("end_date_$id")),
            'current_row' => (int) cache("current_row_$id"),
            'total_rows' => (int) cache("total_rows_$id"),
        ]);
    }

    public function empty_cache(){
        cache()->forget("beneficiaires");
        cache()->forget("souscripteurs");
        cache()->forget("ayantdroits");
        cache()->forget("globalResult");
    }

    public function initialize_cache(){
        $this->empty_cache();
        cache()->forever("beneficiaires", [
            "statut" => "En attente",
            "total" => null,
            "courant" => null,
            "results" => null
        ]);
        cache()->forever("souscripteurs", [
            "statut" => "En attente",
            "total" => null,
            "courant" => null,
            "results" => null
        ]);
        cache()->forever("ayantdroits", [
            "statut" => "En attente",
            "total" => null,
            "courant" => null,
            "results" => null
        ]);
        cache()->forever("globalResult", [
            "statut" => "En attente",
            "beneficiaires" => cache("beneficiaires"),
            "souscripteurs" => cache("souscripteurs"),
            "ayantdroits" => cache("ayantdroits"),
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(in_array(Auth::user()->role,['super_admin','admin'])){
            $souscripteurs = Adherents::selectAllForAdmin()->sortByDesc('created_at');
            $localite = 'index';
        }
        elseif (Auth::user()->role == "admin_oume") {
            $souscripteurs = Adherents::selectAllForAdmin('OUMÉ')->sortByDesc('created_at');
            $localite = 'oume';
        }
        elseif (Auth::user()->role == "admin_ouelle") {
            $souscripteurs = Adherents::selectAllForAdmin('OUELLÉ')->sortByDesc('created_at');
            $localite = 'ouelle';
        }

        return view('admin.adherent.'.$localite,compact('souscripteurs'));
    }

    public function adherent_inactif_liste(){
        if(in_array(Auth::user()->role,['super_admin','admin'])){
            $souscripteurs = Adherents::selectAllForAdmin(null,0)->sortByDesc('created_at');
            $localite = 'index';
        }
        elseif (Auth::user()->role == "admin_oume") {
            $souscripteurs = Adherents::selectAllForAdmin('OUMÉ',0)->sortByDesc('created_at');
            $localite = 'oume';
        }
        elseif (Auth::user()->role == "admin_ouelle") {
            $souscripteurs = Adherents::selectAllForAdmin('OUELLÉ',0)->sortByDesc('created_at');
            $localite = 'ouelle';
        }
        return view('admin.adherent.inactif.index',compact('souscripteurs'));
    }

    public function adhesion_par_localite_liste($localite){

        if ($localite == "oume") {
            $souscripteurs = Adherents::selectAllForAdmin('OUMÉ',0)->sortByDesc('created_at');

        } elseif($localite == "ouelle") {
            $souscripteurs = Adherents::selectAllForAdmin('OUELLÉ',0)->sortByDesc('created_at');
        }

        return view('admin.adherent.'.$localite,compact('souscripteurs'));

    }

    public function getInfos(Request $request) {
        $request->merge(['types' => ['annuelle', 'exceptionnelle']]) ;
        $request->validate([
            'num_souscripteur' => 'required|exists:adherents,num_adhesion',
            'cotisation' => 'required',
            'type' => 'required|in_array:types.*',
            'id_user' => 'required'
        ]);

        $souscripteur = Adherents::whereNumAdhesion($request->num_souscripteur)->first();

        $identifiant = $request->type == 'exceptionnelle' ? 'code_deces' : 'annee_cotis';
        $cotisation = Cotisation::whereType($request->type)->where($identifiant, $request->cotisation)->first();
        // dd($souscripteur);
        $array = [
            'id_adherent' => $souscripteur->id,
            'nom_pnom' => $souscripteur->nom.' '.$souscripteur->pnom,
            'solde' => $souscripteur->solde(),

            'id_cotisation' => $cotisation->id,
            'annuelle' => $cotisation->type == "annuelle" ? true : false,
            'montant' => $souscripteur->psCotisation($cotisation)->montant(),

            'deja_payer' => $cotisation->reglements($souscripteur)->sum('montant'),
            'reste_a_payer' => $souscripteur->psCotisation($cotisation)->montant() - $cotisation->reglements($souscripteur)->sum('montant'),

        ];
        // dd($array);
        return $array;
    }

    public function getMontantDu(Request $request)
    {
        $souscripteur = Adherents::whereNumAdhesion($request->num_souscripteur)->first();
        $data = $souscripteur->montant_du() ?? null;

        return [
            'status' => 'OK',
            'data' => $data
        ];
    }

    public function getSouscripteurAvertir() {
        $adherents = Adherents::avertir();
        // $adherents = $adherents->only(['num_adhesion']);
        return $adherents->all();
    }

    public function getCotisationsDues(Request $request) {
        $adherent = Adherents::where('num_adhesion',$request->num_adhesion)->first();
        $annuelles = $adherent->cotisations_annuelles_dues();
        $exceptionnelles = $adherent->cotisations_exceptionnelles_dues();

        $result = new Collection();
        foreach($annuelles->merge($exceptionnelles) as $cotisation){
            $ahc = $adherent->psCotisation($cotisation);
            $result->add([
                'identifiant' => $cotisation->annee_cotis ?? $cotisation->code_deces,
                'type' => $cotisation->type,
                'nbre_benef' => $ahc->nbre_benef,
                'montant' => $ahc->montant(),
            ]);
        }

        return $result;
    }

    public function getPersonnalMessage(Request $request) {
        $adherent = Adherents::where('num_adhesion',$request->num_adhesion)->first();
        $conversion = [
            '%Nom%' => $adherent->nom,
            '%Prénoms%' => $adherent->pnom,
            '%MontantTotal%' => $adherent->montant_du(),
            '%MontantCotisationAnnuelle%' => $adherent->montant_annuel_du(),
            '%MontantCotisationExceptionnelle%' => $adherent->montant_exceptionnel_du(),
        ];
        $message = $request->message;
        $result = implode('<br>', explode("\n", trim($message)));

        foreach ($conversion as $var => $val) {
            $result = str_replace($var, $val, $result);
        }
        // dd($request->all(), $result, $message);

        return $result;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beneficiaires()
    {
        //
        if(in_array(Auth::user()->role,['super_admin','admin'])){
            $beneficiaires = Adherents::selectAll()->sortByDesc('created_at');
        }
        elseif(Auth::user()->role == "admin_oume"){
            $beneficiaires = Adherents::selectAllBenefLocalite('OUMÉ');
        }
        elseif(Auth::user()->role == "admin_ouelle"){
            $beneficiaires = Adherents::selectAllBenefLocalite('OUELLÉ');
        }
        return view('admin.adherent.beneficiaires',compact('beneficiaires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.adherent.create');
    }

    /**
     * Show the form for importing datas.
     *
     * @return \Illuminate\Http\Response
     */
    public function importation()
    {
        return view('admin.adherent.importation');
    }

    /**
     * Post method for importing datas.
     *
     * @return \Illuminate\Http\Response
     */
    public function importationPost(Request $request)
    {
        $this->initialize_cache();

        $fileValidator = Validator::make($request->all(), [
            'csv' => 'required|max:5000|mimes:xlsx,xls,csv'
        ]);


        if($fileValidator->fails()){
            if($request->api) return response()->json(['error' => $request->all()]);
            return redirect()->back()->withErrors($fileValidator);
        } else {

            $id = now()->unix();
            session(['import' => $id ]);
            Excel::queueImport(new AdhesionsImport($id), request()->file('csv')->store('temp'));
            if($request->api) return response()->json(['success' => 'true', 'data' => $request->all()]);

            try {
                // $import = new AdhesionsImport;
                // $collection = Excel::import($import, $request->file('csv'));
                dd(static::$globalResult);
                static::$globalResult['statut'] = "terminé";
                if($request->api) return response()->json(['success' => 'true', 'data' => $request->all()]);

                $adherents = session('resultsSousc')['data'];
                if(count($adherents) > 0){
                    foreach ($adherents as $adherent) { // Select all souscripteurs created
                        $adherent->firstCotisations();
                        // $cotisations = Cotisation::where('annee_cotis', '>=', Carbon::create($adherent->date_adhesion)->year)->orWhere('date_annonce', '>=', Carbon::create($adherent->date_debutcotisation))->get();
                        // if($cotisations){
                        //     foreach ($cotisations as $cotisation) { // Select all souscripteurs and create items
                        //         $ligne = AdherentHasCotisations::whereIdAdherent($adherent->id)->whereIdCotisation($cotisation->id);
                        //         if($ligne) {
                        //             $ligne->update([
                        //                 'nbre_benef' => $adherent->total_benef_life() + 1,
                        //                 'montant' => $cotisation->montant * ($adherent->total_benef_life() + 1),
                        //                 'reglee' => false,
                        //                 'parcouru' => false,
                        //             ]);
                        //         }
                        //     }
                        // }
                    }
                }

                return redirect()->back();
            } catch (\Throwable $th) {
                return redirect()->back()->withErrors(['csv' => "Fichier incompatible avec les exigences de l'importation : ".$th->getMessage()]);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Stockage d'une adhésion
        $validatedData = $request->validate([
            "souscript_civilite" => "required",
            "souscript_nom" => "required",
            "souscript_pnom" => "required",
            "souscript_lhab" => "required",
            "souscript_lnaiss" => "required",
            "souscript_dnaiss" => "required",
            "souscript_email" => "required|email",
            "souscript_contact" => "required",
            "souscript_ncni" => "required|unique:adherents,num_cni",
            "souscript_conseiller" => "required",
            "benef_civilite.*" => "required",
            "benef_nom.*" => "required",
            "benef_pnom.*" => "required",
            "benef_lnaiss.*" => "required",
            "benef_dnaiss.*" => "required",
            "benef_ncni.*" => "required|unique:adherents,num_cni",
            "benef_lieu_hab.*" => "required",
            "ayant_civilite.*" => "required",
            "ayant_nom.*" => "required",
            "ayant_pnom.*" => "required",
            "ayant_contact.*" => "required|unique:ayantdroits,contact",
        ], [
            /*"nom.required" => "Le nom est un champ est requis",
            "category.required" => "La catégorie est un champ est requis",
            "statut.required" => "Name is required",
            "adresse.required" => "Name is required",
            "email.required" => "Name is required",
            "email.email" => "Name is required",
            "contact.required" => "Name is required",*/
        ]);


        // Traiter le champ contact prévu pour les sms
        $contact = explode("-", substr($request->souscript_contact, 7, 14));
        $contact_format = "225".$contact[0].$contact[1].$contact[2].$contact[3].$contact[4];

        $souscript_dnaiss = explode('-',$request->souscript_dnaiss);

        $sous_dnaiss = $souscript_dnaiss[2].$souscript_dnaiss[1].$souscript_dnaiss[0];

        $souscripteur = Adherents::create([
            'nom' => $request->souscript_nom,
            'pnom' => $request->souscript_pnom,
            'civilite' => $request->souscript_civilite,
            'email' => $request->souscript_email,
            'date_naiss' => $sous_dnaiss,
            'num_cni' => $request->souscript_ncni,
            'lieu_naiss' => $request->souscript_lnaiss,
            'lieu_hab' => $request->souscript_lhab,
            'contact' => $request->souscript_contact,
            'contact_format' => $contact_format,
            'conseiller_diph' => $request->souscript_conseiller,
            'role' => 1,
            'valide' => 0,
            'status' => 0,
            'admin_id' => Auth::user()->id
        ]);

        //store bénéficiaire(s)
        $nb_benef = sizeof($request->benef_civilite);

        for ($i=0; $i < $nb_benef; $i++) {

            //Format date
            $ben_dnaiss = $this->formatDate($request->benef_dnaiss[$i]);

            Adherents::create([
                'nom' => $request->benef_nom[$i],
                'pnom' => $request->benef_pnom[$i],
                'civilite' => $request->benef_civilite[$i],
                'date_naiss' => $ben_dnaiss,
                'num_cni' => $request->benef_ncni[$i],
                'lieu_naiss' => $request->benef_lnaiss[$i],
                'lieu_hab' => $request->benef_lieu_hab[$i],
                'parent' => $souscripteur->id,
                'role' => 2,
                'valide' => 0,
                'status' => 1,
                'admin_id' => Auth::user()->id
            ]);
        }

        //store ayants-droit
        $nb_ayant = sizeof($request->ayant_civilite);

        for ($j=0; $j < $nb_ayant; $j++) {
            AyantDroit::create([
                'nom' => $request->ayant_nom[$j],
                'pnom' => $request->ayant_pnom[$j],
                'civilite' => $request->ayant_civilite[$j],
                'contact' => $request->ayant_contact[$j],
                'priorite' => $j + 1,
                'id_adherent' => $souscripteur->id,
                'status' => 1,
            ]);
        }

        return redirect()->back()->with('message', 'L\'ajout s\'est déroulé avec succès. Veuillez consulter la liste des adhésions s\'il vous plaît')->with('type', 'bg-success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Le souscripteur
        $souscripteur = Adherents::find($id);
        if($souscripteur && $souscripteur->isBeneficiaire()){
            if($souscripteur->cas == 1){
                $beneficiaire = $souscripteur;
                return view('admin.adherent.cas',compact('beneficiaire'));
            }
            return redirect()->back();
        }

        //Les bénéficiaires
        $benefs = Adherents::where(['status'=>1,'role'=>2,'parent'=>$id])->orderBy('created_at', 'DESC')->get();

        //Les ayants-droit
        $ayants = AyantDroit::where(['status'=>1,'id_adherent'=>$id])->orderBy('created_at', 'DESC')->get();

        return view('admin.adherent.show',compact('souscripteur','benefs','ayants'));
    }

    public function transactionHistory($id){
        $souscripteur = Adherents::find($id);
        if($souscripteur && $souscripteur->isBeneficiaire()){
            if($souscripteur->cas == 1){
                $beneficiaire = $souscripteur;
                return view('admin.adherent.cas',compact('beneficiaire'));
            }
            return redirect()->back();
        }

        return view('admin.adherent.transactions_history', compact('souscripteur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($sous)
    {
        //
        $souscripteur = Adherents::find($sous);
        return view('admin.adherent.edit', compact('souscripteur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validatedData = Validator::make($request->all(),[

            'civilite' => 'required' ,
            'nom'=> 'required',
            'pnom' => 'required',
            'date_naiss' => 'required',
            'lieu_naiss' => 'required',
            'num_cni' => 'required|unique:adherents,num_cni,'.$id,
            'contact' => 'required',
            'email' => 'email',
            'lieu_hab'=> 'required',
            'souscript_conseiller' => 'required',
        ], [
            'civilite.required' => 'La civilité est un champ obligatoire.',
            'nom.required' => 'Le nom est un champ obligatoire.' ,
            'pnom.required' => 'Le prénom est un champ obligatoire.',
            'date_naiss.required' => 'La date de naissance doit être renseigné.',
            'lieu_naiss.required' => 'Le lieu de naissance est un champ obligatoire.',
            'num_cni.required' => 'Le numéro de CNI est un champ obligatoire.',
            'num_cni.unique'=> 'Un adhérent possède déjà ce numéro de CNI.',
            'contact.required' => 'Le contact est un champ obligatoire.',
            'email.email' => 'L\'adresse email n\'est pas correct.',
            'lieu_hab' => 'Le lieu de résidence est obligatoire.',
            'souscript_conseiller.required' => 'Le nom du conseiller diphita est obligatoire'
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput()->with('message', 'Une erreur est survenue veuillez reéssayer s\'il vous plaît !')->with('type', 'bg-danger');
        }
        else{
            $souscripteur = Adherents::find($id);

            $souscripteur->update([
                'civilite' => $request->civilite ,
                'nom'=> $request->nom,
                'pnom' => $request->pnom,
                'date_naiss' => $this->formatDate($request->date_naiss),
                'lieu_naiss' => $request->lieu_naiss,
                'num_cni' => $request->num_cni,
                'contact' => $request->contact,
                'email' => $request->email,
                'lieu_hab' => $request->lieu_hab,
                'conseiller_diph' => $request->souscript_conseiller,
            ]);

            return redirect()->back()->with('message', 'Les informations ont été mises à jour avec succèss !')->with('type', 'bg-success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function valider($id)
    {
        //Controle configuration

        if (DureeFincarences::where('status',1)->first() == null){
            return redirect()->back()->with('message', 'Vous devez configurer un délai de carence avant toute validation')->with('type', 'bg-danger');
        }

        /*if (DroitInscription::where('status',1)->first() == null){
            return redirect()->back()->with('message', 'Vous devez configurer le montant d\'inscription avant toute validation')->with('type', 'bg-danger');
        }

        if (TraitementKit::where('status',1)->first() == null){
            return redirect()->back()->with('message', 'Vous devez configurer le montant du Kits avant toute validation')->with('type', 'bg-danger');
        }

        if (CotisationAnnuelle::where('status',1)->first() == null){
            return redirect()->back()->with('message', 'Vous devez configurer le montant de la cotisation annuelle avant toute validation')->with('type', 'bg-danger');
        }*/


        $adhesion = Adherents::where('id',$id)->first();

        //Numero de contrat

        $cf_suffix = "CF-";

        $cf_order = $this->generate_order(Adherents::where(['valide'=>1,'role'=>1])->count());

        $num_contrat = $cf_suffix.$cf_order;

        //Numero de souscripteur a generer
        $suffix= "DIP";

        $date = (new \DateTime())->format("dmy");

        $order = $this->generate_order(Adherents::where('valide',1)->count());

        //$order = (int)($order + 1);

        //Récupère le mois et l'année actuel
        $current_month_year = Carbon::now()->format('Y-m');

        //Récupère la date du premier jour du mois en cours
        $first_day_month = Carbon::createFromFormat('Y-m-d', $current_month_year.'-01');

        //Récupère la date du 5ième jour du mois en cours
        $fifth_day_month = Carbon::createFromFormat('Y-m-d', $current_month_year.'-05');

        $num_adhe = $suffix.$date.'S'.$order;

        $adhesion->valide = 1;
        $adhesion->status = 1;

        if (!$adhesion->num_adhesion) {
            $adhesion->num_adhesion = $num_adhe;
            $adhesion->num_contrat = $num_contrat;
            $adhesion->date_adhesion = Carbon::now();
        }
        //Montant de cotisation
        $adhesion->droit_inscription_montant = Parameters::droitInscription();
        $adhesion->cot_annuelle_montant = Parameters::cotisationAnnuelle();
        $adhesion->kits_montant = Parameters::traitementKit();

        //$adhesion->date_fincarence = Carbon::create($adhesion->date_adhesion)->addMonths(DureeFincarences::where('status',1)->first()->duree);

        $dateAD = Carbon::create($adhesion->date_adhesion);
            // Si $day < 5 alors day = 05 mois en cours sinon 05 mois suivant
            $adhesion->date_debutcotisation = Carbon::create($dateAD->year, $dateAD->month + ($dateAD->day > 5 ?? 0) + 1, 5);

            $adhesion->date_fincarence = $dateAD->addMonths(Parameters::dureeFinCarrence() ?? 4);



        $adhesion->save();
        //Insérer cotisation
        $adhesion->firstCotisations();

        //Numéro des beneficiaires a génerer
        $beneficiaires = Adherents::where('parent',$id)->get();
        //dd($beneficiaires);
        foreach ($beneficiaires as $benef) {
            $no = $this->generate_order(Adherents::where('valide',1)->count());
            //$no = (int)($no + 1);
            if (!$benef->num_adhesion) {
                $benef->num_adhesion = $suffix.$date.'B'.$no;
                $benef->num_contrat = $num_contrat;
                $benef->date_adhesion = Carbon::now();
            }

            $benef->valide = 1;

            $benef->droit_inscription_montant = Parameters::droitInscription();
            $benef->cot_annuelle_montant = Parameters::cotisationAnnuelle();
            $benef->kits_montant = Parameters::traitementKit();
            $benef->date_fincarence = Carbon::create($benef->date_adhesion)->addMonths(DureeFincarences::where('status',1)->first()->duree);
            $benef->date_debutcotisation = $adhesion->date_debutcotisation;

            $benef->save();
            //Insérer cotisation
            $benef->firstCotisations();
        }


        // Envoyer un sms au concerné

        $this->sms_inscription_valider($num_adhe,$adhesion->contact_format,$adhesion->nom,$adhesion->pnom,$adhesion->civilite, $adhesion->date_debutcotisation, $adhesion->date_fincarence);


        return redirect()->back()->with('message', 'Validation réussie, l\'individu fait désormais partir des souscripteurs. Un sms lui a été envoyé.')->with('type', 'bg-success');
    }

    public function rejeter($id)
    {
        $adhesion = Adherents::where('id',$id)->first();

        $adhesion->valide = 2;

        $adhesion->save();

        // Envoyer un sms au concerné
        $this->sms_inscription_rejeter($adhesion->contact_format,$adhesion->nom,$adhesion->pnom,$adhesion->civilite);

        return redirect()->back()->with('message', 'Rejet réussie, l\'individu est désormais dans la liste des adhésions rejetées .Un sms lui a été envoyé.')->with('type', 'bg-danger');;
    }

    public function generate_order($nb){

        $nb = $nb +1;

        if ($nb < 10) {
            $no = "000".$nb;
        } elseif($nb < 100) {
            $no = "00".$nb;
        }elseif($nb < 1000) {
            $no = "0".$nb;
        }elseif($nb < 10000) {
            $no = $nb;
        }

        return $no;
    }

    public function sms_inscription_valider($num_adhe, $contact,$nom,$pnom,$civilite, $date_debutcotisation, $date_fincarence){


        $curl1 = curl_init();
        $datas= [
        'step' => NULL,
        'sender' => 'DIPHITA',
        'name' => 'Inscription validée avec succès',
        'campaignType' => 'SIMPLE',
        'recipientSource' => 'CUSTOM',
        'groupId' => NULL,
        'filename' => NULL,
        'saveAsModel' => false,
        'destination' => 'NAT',
        'message' => 'Félicitations '.$civilite.' '.$nom.' '.$pnom.', votre adhésion à notre chaine de solidarité Diphita Prévoyance s\'est effetuée avec succès. Votre numéro ID: '.$num_adhe.'. Fin de carence: '.ucwords((new Carbon($date_fincarence))->locale('fr')->isoFormat('DD/MM/YYYY')).'. Début de cotisation: '.ucwords((new Carbon($date_debutcotisation))->locale('fr')->isoFormat('DD/MM/YYYY')).'. La Fondation Diphita vous remercie pour la confiance !',
        'emailText' => NULL,
        'recipients' =>
        [
            [
            'phone' => $contact,
            ],
        ],
        'sendAt' => [],
        'dlrUrl' => 'http://dlr.my.domain.com',
        'responseUrl' => 'http://res.my.domain.com',
        ];

        curl_setopt_array($curl1, array(
        CURLOPT_URL => 'https://api.letexto.com/v1/campaigns',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>json_encode($datas),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer 7e8f4b3245f7d88054771d58a4739a',
            'Content-Type: application/json'
        ),
        CURLOPT_SSL_VERIFYHOST =>  false,
        CURLOPT_SSL_VERIFYPEER => false
        ));

        $response = curl_exec($curl1);
        $error = curl_error($curl1);
        curl_close($curl1);

        $campagne = json_decode($response);

        $curl = curl_init();
        if($campagne){
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.letexto.com/v1/campaigns/'.$campagne->id.'/schedules',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer 7e8f4b3245f7d88054771d58a4739a'
            ),
            CURLOPT_SSL_VERIFYHOST =>  false,
            CURLOPT_SSL_VERIFYPEER => false
            ));

            $response = curl_exec($curl);
            curl_close($curl);
        }


        return $response;
    }

    public function sms_inscription_rejeter($contact, $nom, $pnom, $civilite){

        $curl1 = curl_init();
        $datas= [
        'step' => NULL,
        'sender' => 'DIPHITA',
        'name' => 'Inscription rejeter',
        'campaignType' => 'SIMPLE',
        'recipientSource' => 'CUSTOM',
        'groupId' => NULL,
        'filename' => NULL,
        'saveAsModel' => false,
        'destination' => 'NAT',
        'message' => $civilite." ".$nom." ".$pnom." votre inscription à Diphita Prévoyance à échoué. Veuillez nous contactez au numéro suivant pour plus d'informations \n Tel: +225 01010101",
        'emailText' => NULL,
        'recipients' =>
        [
            [
            'phone' => $contact,
            ],
        ],
        'sendAt' => [],
        'dlrUrl' => 'http://dlr.my.domain.com',
        'responseUrl' => 'http://res.my.domain.com',
        ];

        curl_setopt_array($curl1, array(
        CURLOPT_URL => 'https://api.letexto.com/v1/campaigns',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>json_encode($datas),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer 7e8f4b3245f7d88054771d58a4739a',
            'Content-Type: application/json'
        ),
        CURLOPT_SSL_VERIFYHOST =>  false,
        CURLOPT_SSL_VERIFYPEER => false
        ));

        $response = curl_exec($curl1);
        $error = curl_error($curl1);
        curl_close($curl1);

        $campagne = json_decode($response);

        $curl = curl_init();
        if($campagne) {
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.letexto.com/v1/campaigns/'.$campagne->id.'/schedules',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer 7e8f4b3245f7d88054771d58a4739a'
            ),
            CURLOPT_SSL_VERIFYHOST =>  false,
            CURLOPT_SSL_VERIFYPEER => false
            ));

            $response = curl_exec($curl);

            curl_close($curl);

        }

        return $response;
    }

    public function adhesion_valider_liste(){

        $adhesions = Adherents::where(['valide'=>1,'role'=>1])->orderBy('created_at', 'DESC')->get();

        return view('client.adhesion.valider',compact('adhesions'));

    }

    public function adhesion_rejeter_liste(){

        $adhesions = Adherents::where(['valide'=>2,'role'=>1])->orderBy('created_at', 'DESC')->get();

        return view('client.adhesion.rejeter',compact('adhesions'));

    }

    public function formulaire_print($id){

        $adherent = Adherents::find($id);

        return view('admin.adherent.formulaire_print',compact('adherent'));
    }

    public function bloquer($id){

        $update_adherent = Adherents::where(['id'=>$id,'status'=>1])->update(['status' => 0]);

        if ($update_adherent) {
            return redirect()->back()->with('message', 'Compte désactivé avec succès')->with('type', 'bg-success');
        } else {
            return redirect()->back()->with('message', 'Une erreur c\'est produite')->with('type', 'bg-danger');
        }
    }

    public function debloquer($id){

        $update_adherent = Adherents::where(['id'=>$id,'status'=>0])->update(['status' => 1]);

        if ($update_adherent) {
            return redirect()->back()->with('message', 'Compte activé avec succès')->with('type', 'bg-success');
        } else {
            return redirect()->back()->with('message', 'Une erreur c\'est produite')->with('type', 'bg-danger');
        }


    }

    public function formatDate($date){
        $benef_dnaiss = explode('-',$date);
        $date_format = $benef_dnaiss[2].$benef_dnaiss[1].$benef_dnaiss[0];
        return $date_format;
    }

    public function create_beneficiaire(Request $request, $sous){

        return view('admin.adherent.beneficiaire.create',compact('sous'));

    }

    public function sms_add_new_benef(Adherents $benef){
        $curl1 = curl_init();
        $datas= [
        'step' => NULL,
        'sender' => 'DIPHITA',
        'name' => 'Rajout d\'un bénéficiaire',
        'campaignType' => 'SIMPLE',
        'recipientSource' => 'CUSTOM',
        'groupId' => NULL,
        'filename' => NULL,
        'saveAsModel' => false,
        'destination' => 'NAT',
        'message' => "Cher souscripteur, votre rajout de bénéficiaire ".$benef->nom_pnom()." s'est effectué avec succès. ID: ".$benef->num_adhesion.". Fin de carence: ".ucwords((new Carbon($benef->date_fincarence))->locale('fr')->isoFormat('DD/MM/YYYY')).". Début de cotisation: ".ucwords((new Carbon($benef->date_debutcotisation))->locale('fr')->isoFormat('DD/MM/YYYY')).".",
        'emailText' => NULL,
        'recipients' =>
        [
            [
            'phone' => $benef->souscripteur()->contact_format,
            ],
        ],
        'sendAt' => [],
        'dlrUrl' => 'http://dlr.my.domain.com',
        'responseUrl' => 'http://res.my.domain.com',
        ];

        curl_setopt_array($curl1, array(
        CURLOPT_URL => 'https://api.letexto.com/v1/campaigns',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>json_encode($datas),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer 7e8f4b3245f7d88054771d58a4739a',
            'Content-Type: application/json'
        ),
        CURLOPT_SSL_VERIFYHOST =>  false,
        CURLOPT_SSL_VERIFYPEER => false
        ));

        $response = curl_exec($curl1);
        $error = curl_error($curl1);
        curl_close($curl1);

        $campagne = json_decode($response);

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.letexto.com/v1/campaigns/'.$campagne->id.'/schedules',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer 7e8f4b3245f7d88054771d58a4739a'
        ),
        CURLOPT_SSL_VERIFYHOST =>  false,
        CURLOPT_SSL_VERIFYPEER => false
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function store_beneficiaire(Request $request, $sous){

        $sous_parent = Adherents::find($sous);

        $validatedData = Validator::make($request->all(),[

            'civilite' => 'required' ,
            'nom'=> 'required',
            'pnom' => 'required',
            'date_naiss' => 'required',
            'lieu_naiss' => 'required',
            'num_cni' => 'required|unique:adherents,num_cni',
            'lieu_hab' => 'required'
        ], [
            'civilite.required' => 'La civilité est un champ obligatoire.',
            'nom.required' => 'Le nom est un champ obligatoire.' ,
            'pnom.required' => 'Le prénom est un champ obligatoire.',
            'date_naiss.required' => 'La date de naissance doit être renseigné.',
            'lieu_naiss.required' => 'Le lieu de naissance est un champ obligatoire.',
            'num_cni.required' => 'Le numéro de CNI est un champ obligatoire.',
            'num_cni.unique' => 'Un adhérent possède déjà ce numéro de CNI.',
            'lieu_hab' => 'Le lieu de résidence est obligatoire.'
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput()->with('message', 'Une erreur est survenue veuillez reéssayer s\'il vous plaît !')->with('type', 'bg-danger');
        }
        else{

            $no = $this->generate_order(Adherents::where('valide',1)->count());
            $suffix= "DIP";
            $date = (new \DateTime())->format("dmy");

             //Récupère le mois et l'année actuel
            $current_month_year = Carbon::now()->format('Y-m');

            //Récupère la date du premier jour du mois en cours
            $first_day_month = Carbon::createFromFormat('Y-m-d', $current_month_year.'-01');

            //Récupère la date du 5ième jour du mois en cours
            $fifth_day_month = Carbon::createFromFormat('Y-m-d', $current_month_year.'-05');

            //Vérifie si la date d'aujourd'hui est entre le 1er et le 5 du mois en cours
            $dateAD = Carbon::now();
            // Si $day < 5 alors day = 05 mois en cours sinon 05 mois suivant

            $souscripteur = Adherents::create([
                'civilite' => $request->civilite ,
                'nom'=> $request->nom,
                'pnom' => $request->pnom,
                'date_naiss' => $this->formatDate($request->date_naiss),
                'lieu_naiss' => $request->lieu_naiss,
                'num_cni' => $request->num_cni,
                'num_adhesion'=> $suffix.$date.'B'.$no,
                'num_contrat' => $sous_parent->num_contrat,
                'lieu_hab' =>  $request->lieu_hab,
                'parent' => $sous,
                'date_adhesion' => $dateAD,
                'date_fincarence' => $dateAD->addMonths(Parameters::dureeFinCarrence() ?? 4),
                'date_debutcotisation'=> Carbon::create($dateAD->year, $dateAD->month + ($dateAD->day > 5 ?? 0) + 1, 5),
                'role' => 2,
                'valide' => 1,
                'status' => 1,
                'droit_inscription_montant' => Parameters::droitInscription(),
                'cot_annuelle_montant' => Parameters::cotisationAnnuelle(),
                'kits_montant' => Parameters::traitementKit(),
                'admin_id' => Auth::user()->id
            ]);

            $souscripteur->firstCotisations();

            $this->sms_add_new_benef($souscripteur);


        }

        return redirect()->route('admin.adhesion.show',['id'=>$sous])->with('message', 'Un bénéficiaire vient d\'être ajouté')->with('type', 'bg-success');
    }

    public function edit_beneficiaire($benef){
        //
        $beneficiaire = Adherents::find($benef);
        return view('admin.adherent.beneficiaire.edit', compact('beneficiaire'));
    }

    public function update_beneficiaire(Request $request, $benef){

        $beneficiaire = Adherents::find($benef);

        $validatedData = Validator::make($request->all(),[

            'civilite' => 'required' ,
            'nom'=> 'required',
            'pnom' => 'required',
            'date_naiss' => 'required',
            'lieu_naiss' => 'required',
            'num_cni' => 'required|unique:adherents,num_cni,'.$benef,
            'lieu_hab' => 'required'
        ], [
            'civilite.required' => 'La civilité est un champ obligatoire.',
            'nom.required' => 'Le nom est un champ obligatoire.' ,
            'pnom.required' => 'Le prénom est un champ obligatoire.',
            'date_naiss.required' => 'La date de naissance doit être renseigné.',
            'lieu_naiss.required' => 'Le lieu de naissance est un champ obligatoire.',
            'num_cni.required' => 'Le numéro de CNI est un champ obligatoire.',
            'num_cni.unique' => 'Un adhérent possède déjà ce numéro de CNI.',
            'lieu_hab' => 'Le lieu de résidence est obligatoire.'
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput()->with('message', 'Une erreur est survenue veuillez reéssayer s\'il vous plaît !')->with('type', 'bg-danger');
        }
        else{

            $beneficiaire->update([
                'civilite' => $request->civilite ,
                'nom'=> $request->nom,
                'pnom' => $request->pnom,
                'date_naiss' => $this->formatDate($request->date_naiss),
                'lieu_naiss' => $request->lieu_naiss,
                'num_cni' => $request->num_cni,
                'lieu_hab' => $request->lieu_hab
            ]);
        }

        return redirect()->route('admin.adhesion.show',['id'=>$beneficiaire->parent])->with('message', 'Le bénéficiaire vient d\'être mis à jour')->with('type', 'bg-success');
    }

    public function create_ayantdroit(Request $request, $sous){

        return view('admin.adherent.ayantdroit.create',compact('sous'));
    }

    public function store_ayantdroit(Request $request, $sous){

        $souscripteur = Adherents::find($sous);

        $validatedData = Validator::make($request->all(),[

            'civilite' => 'required' ,
            'nom'=> 'required',
            'pnom' => 'required',
            'contact' => 'required'
        ], [
            'civilite.required' => 'La civilité est un champ obligatoire.',
            'nom.required' => 'Le nom est un champ obligatoire.' ,
            'pnom.required' => 'Le prénom est un champ obligatoire.',
            'contact.required' => 'Le contact est un champ obligatoire.',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput()->with('message', 'Une erreur est survenue veuillez reéssayer s\'il vous plaît !')->with('type', 'bg-danger');
        }
        else{

            $ayantdroit = AyantDroit::create([
                'civilite' => $request->civilite ,
                'nom'=> $request->nom,
                'pnom' => $request->pnom,
                'contact' => $request->contact,
                'priorite' => $souscripteur->total_ayant_droit() + 1,
                'id_adherent'=> $sous
            ]);
        }

        return redirect()->route('admin.adhesion.show',['id'=>$sous])->with('message', 'Un ayant-droit vient d\'être ajouté avec succès')->with('type', 'bg-success');
    }

    public function edit_ayantdroit($ayant){
        //
        $ayant = AyantDroit::find($ayant);

        return view('admin.adherent.ayantdroit.edit', compact('ayant'));
    }

    public function update_ayantdroit(Request $request, $ayant){

        $ayant = AyantDroit::find($ayant);

        $validatedData = Validator::make($request->all(),[

            'civilite' => 'required' ,
            'nom'=> 'required',
            'pnom' => 'required',
            'contact' => 'required'
        ], [
            'civilite.required' => 'La civilité est un champ obligatoire.',
            'nom.required' => 'Le nom est un champ obligatoire.' ,
            'pnom.required' => 'Le prénom est un champ obligatoire.',
            'contact.required' => 'Le contact est un champ obligatoire.',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput()->with('message', 'Une erreur est survenue veuillez reéssayer s\'il vous plaît !')->with('type', 'bg-danger');
        }
        else{
            $ayant->update([
                'civilite' => $request->civilite ,
                'nom'=> $request->nom,
                'pnom' => $request->pnom,
                'contact' => $request->contact,
            ]);
        }

        return redirect()->route('admin.adhesion.show',['id'=>$ayant->id_adherent])->with('message', 'L\'ayant-droit vient d\'être mis à jour')->with('type', 'bg-success');
    }

    public function remove_ayantdroit($ayant){

        $ayant = AyantDroit::find($ayant);

        $ayant->update([
            'status'=> 0
        ]);

        return redirect()->back()->with('message', 'Vous avez supprimé un ayant-droit')->with('type', 'bg-success');
    }

    public function remove_beneficiaire($benef){

        $adherent = Adherents::find($benef);

        $adherent->update([
            'status'=> 0
        ]);

        return redirect()->back()->with('message', 'Vous avez supprimé un bénéficiaire')->with('type', 'bg-success');
    }

    public function paiementCotisation(Request $request){
        $request->validate([
            'montant' => 'required|numeric',
            'id_adherent' => 'required|exists:adherents,id',
            'id_cotisation' => 'required|exists:cotisations,id',
        ]);
        $cotis = AdherentHasCotisations::whereIdAdherent($request->id_adherent)->whereIdCotisation($request->id_cotisation)->first();
        // dd($cotis);
        if($cotis && !$cotis->reglee){
            $cotisation = $cotis->cotisation;
            $souscripteur = $cotis->souscripteur;
            $identifiant = $cotisation->code_deces ?? $cotisation->annee_cotis;
            Reglement::create([
                'id_adherent' => $souscripteur->id,
                'id_cotisation' => $cotisation->id,
                'montant' => $request->montant,
                'type' => 'Paiement de cotisation',
                'description' => "Cotisation $cotisation->type : $identifiant"
            ]);
        }

        return back();
    }


    public function refresh(){
        $beneficiaires = Adherents::selectAll();
        foreach ($beneficiaires as $beneficiaire) {
            $beneficiaire->firstCotisations();
        }
    }




}
