<?php

namespace App\Http\Controllers\Admin;

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
use App\Models\TraitementKit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Stmt\TryCatch;

class AdherentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //+
        // $souscripteurs = Adherents::selectAll(true)->orderBy('created_at', 'DESC')->get();
        $souscripteurs = Adherents::selectAll(true)->sortByDesc('created_at');

        return view('admin.adherent.index',compact('souscripteurs'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function beneficiaires()
    {
        //
        // $beneficiaires = Adherents::selectAll()->orderBy('created_at', 'DESC')->get();
        $beneficiaires = Adherents::selectAll()->sortByDesc('created_at');

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
        $fileValidator = Validator::make($request->all(), [
            'csv' => 'required|max:5000|mimes:xlsx,xls,csv'
        ]);

        if($fileValidator->fails()){
            return redirect()->back()->withErrors($fileValidator);
        } else {
            try {
                $import = new AdhesionsImport;
                $collection = Excel::import($import, $request->file('csv'));

                $adherents = session('resultsSousc')['data'];
                if(count($adherents) > 0){
                    foreach ($adherents as $adherent) { // Select all souscripteurs created
                        $cotisations = Cotisation::where('annee_cotis', '>=', Carbon::create($adherent->date_adhesion)->year)->orWhere('date_annonce', '>=', Carbon::create($adherent->date_debutcotisation))->get();
                        if($cotisations){
                            foreach ($cotisations as $cotisation) { // Select all souscripteurs and create items
                                $ligne = AdherentHasCotisations::whereIdAdherent($adherent->id)->whereIdCotisation($cotisation->id);
                                if($ligne) {
                                    $ligne->update([
                                        'nbre_benef' => $adherent->total_benef_life() + 1,
                                        'montant' => $cotisation->montant * ($adherent->total_benef_life() + 1),
                                        'reglee' => false,
                                        'parcouru' => false,
                                    ]);
                                }
                            }
                        }
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
            "souscript_civilite" => "required|integer",
            "souscript_nom" => "required",
            "souscript_pnom" => "required",
            "souscript_lhab" => "required",
            "souscript_lnaiss" => "required",
            "souscript_dnaiss" => "required",
            "souscript_email" => "required|email|unique:adherents,email",
            "souscript_contact" => "required|unique:adherents,contact",
            "souscript_ncni" => "required|unique:adherents,num_cni",
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
            'role' => 1,
            'valide' => 0,
            'status' => 0,
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
            } else {
                return redirect()->back();
            }

            dd('Ceci est un bénéficiaire');
        }

        //Les bénéficiaires
        $benefs = Adherents::where(['status'=>1,'role'=>2,'parent'=>$id])->orderBy('created_at', 'DESC')->get();
        
        //Les ayants-droit
        $ayants = AyantDroit::where(['status'=>1,'id_adherent'=>$id])->orderBy('created_at', 'DESC')->get();

        return view('admin.adherent.show',compact('souscripteur','benefs','ayants'));
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
            'lieu_hab'=> 'required'
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
            'lieu_hab' => 'Le lieu de résidence est obligatoire.'
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
                'lieu_hab' => $request->lieu_hab
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


        //Récupère le mois et l'année actuel
        $current_month_year = Carbon::now()->format('Y-m');

        //Récupère la date du premier jour du mois en cours
        $first_day_month = Carbon::createFromFormat('Y-m-d', $current_month_year.'-01');

        //Récupère la date du 5ième jour du mois en cours
        $fifth_day_month = Carbon::createFromFormat('Y-m-d', $current_month_year.'-05');


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

        $num_adhe = $suffix.$date.'S'.$order;
        
        $adhesion->valide = 1;
        $adhesion->status = 1;
        $adhesion->num_adhesion = $num_adhe;
        $adhesion->num_contrat = $num_contrat;
        $adhesion->date_adhesion = Carbon::now();
        $adhesion->date_fincarence = Carbon::now()->addMonths(DureeFincarences::where('status',1)->first()->duree);
        
        
        //Vérifie si la date d'aujourd'hui est entre le 1er et le 5 du mois en cours
        if (Carbon::now()->between($first_day_month, $fifth_day_month)) {
            $adhesion->date_debutcotisation = Carbon::createFromFormat('Y-m-d', $current_month_year.'-25');
        } else {
            $adhesion->date_debutcotisation = Carbon::createFromFormat('Y-m-d', $current_month_year.'-25')->addMonth();
        }

        $adhesion->save();

        //Numéro des beneficiaires a génerer
        $beneficiaires = Adherents::where('parent',$id)->get();
        //dd($beneficiaires);
        foreach ($beneficiaires as $benef) {
            $no = $this->generate_order(Adherents::where('valide',1)->count());
            //$no = (int)($no + 1);
            $benef->num_adhesion = $suffix.$date.'B'.$no;
            $benef->valide = 1;
            $benef->num_contrat = $num_contrat;
            $benef->date_adhesion = Carbon::now();
            $benef->date_fincarence = Carbon::now()->addMonths(DureeFincarences::where('status',1)->first()->duree);
            $benef->date_debutcotisation = $adhesion->date_debutcotisation;
            $benef->save();
        }

        //Insérer cotisation

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
            $no = "0000".$nb; 
        } elseif($nb < 100) {
            $no = "000".$nb;
        }elseif($nb < 1000) {
            $no = "00".$nb;
        }elseif($nb < 10000) {
            $no = "0".$nb;
        }elseif($nb < 100000) {
            $no = $nb;
        }

        return $no;
    }

    public function sms_inscription_valider($num_adhe, $contact,$nom,$pnom,$civilite, $date_debutcotisation, $date_fincarence){

        if ($civilite == 1) {
            $titre = "M.";
        } elseif($civilite == 2) {
            $titre = "Mme";
        }elseif($civilite == 3) {
            $titre = "Mlle";
        }
        

        $curl1 = curl_init();
        $datas= [
        'step' => NULL,
        'sender' => 'DIPHITA',
        'name' => 'Inscription valider avec succès',
        'campaignType' => 'SIMPLE',
        'recipientSource' => 'CUSTOM',
        'groupId' => NULL,
        'filename' => NULL,
        'saveAsModel' => false,
        'destination' => 'NAT',
        'message' => 'Félicitations '.$titre.' '.$nom.' '.$pnom.' votre adhésion à notre chaine de solidarité Diphita Prévoyance s\'est effetuée avec succès. Votre numéro ID: '.$num_adhe.'. Fin de carence: '.ucwords((new Carbon($date_fincarence))->locale('fr')->isoFormat('DD/MM/YYYY')).'. Début de cotisation: '.ucwords((new Carbon($date_debutcotisation))->locale('fr')->isoFormat('DD/MM/YYYY')),
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

    public function sms_inscription_rejeter($contact, $nom, $pnom, $civilite){

        if ($civilite == 1) {
            $titre = "M.";
        } elseif($civilite == 2) {
            $titre = "Mme";
        }elseif($civilite == 3) {
            $titre = "Mlle";
        }

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
        'message' => $titre." ".$nom." ".$pnom." votre inscription à Diphita Prévoyance à échoué. Veuillez nous contactez au numéro suivant pour plus d'informations \n Tel: +225 01010101",
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
        'message' => "Cher souscripteur, votre rajout de bénéficiaire ".$benef->nom_pnom()." s'est effectué avec succès. ID: ".$benef->num_adhesion." Fin de carence: ".ucwords((new Carbon($benef->date_fincarence))->locale('fr')->isoFormat('DD/MM/YYYY'))." Début de cotisation: ".ucwords((new Carbon($benef->date_debutcotisation))->locale('fr')->isoFormat('DD/MM/YYYY')),
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
            if (Carbon::now()->between($first_day_month, $fifth_day_month)) {
                $date_debutcotisation = Carbon::createFromFormat('Y-m-d', $current_month_year.'-25');
            } else {
                $date_debutcotisation = Carbon::createFromFormat('Y-m-d', $current_month_year.'-25')->addMonth();
            }

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
                'date_adhesion' => Carbon::now(),
                'date_fincarence' => Carbon::now()->addMonths(DureeFincarences::where('status',1)->first()->duree),
                'date_debutcotisation'=> $date_debutcotisation,
                'role' => 2,
                'valide' => 1,
                'status' => 1,
            ]);

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

    

   

    
}
