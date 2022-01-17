<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\AdhesionsImport;
use App\Imports\SouscripteursImport;
use App\Models\Adherents;
use App\Models\AyantDroit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

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
        $souscripteurs = Adherents::where(['valide'=>1,'status'=>1,'role'=>1])->orderBy('created_at', 'DESC')->get();

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
        $beneficiaires = Adherents::where(['valide'=>1,'status'=>1])->orderBy('created_at', 'DESC')->get();

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
        //
        return view('admin.adherent.importation');
    }

    /**
     * Post method for importing datas.
     *
     * @return \Illuminate\Http\Response
     */
    public function importationPost(Request $request)
    {
        $fileValidator = \Validator::make($request->all(), [
            'csv' => 'required|max:5000|mimes:xlsx,xls,csv'
        ]);

        if($fileValidator->passes()){
            $results = [
                "msg" => '',
                "errs" => [],
                "warns" => [],
                "contrats" => []
            ];

            $collection = Excel::import(new AdhesionsImport, $request->file('csv'));
            dd('fgj');
            Excel::load($request->file('csv')->getRealPath(), function ($reader) use (&$results, $request) {
                $nb_success = $nb_error = $nb_warning = 0;
                dd($reader->toArray());
                // foreach ($reader->toArray() as $key => $row) {
                //     try {
                //         $risque_id = $row["risque"] ? $this->getRisqueId($row["risque"]) : null;
                //         $compagnie_id = $row["compagnie"] ? $this->getCompagnieId($row["compagnie"]) : null;
                //         $client_id = $row["client"]&&$row["type_client"]&&$row["cellulaire_client"] ? $this->getClientId($row["client"], $row["type_client"], $row["cellulaire_client"]) : null;
                //         $request2 = new Request([
                //             "date_emission" => $row["date_emission"],
                //             "numero_police" => $row["numero_police"],
                //             "type_contrat" => $row["type_contrat"] ?? "nouvelle affaire",
                //             "risque_nom" => $row["risque"],
                //             "risque_id" => $risque_id,
                //             "compagnie_nom" => $row["compagnie"],
                //             "compagnie_id" => $compagnie_id,
                //             "client_nom_prenom" => $row["client"],
                //             "client_type" => $row["type_client"],
                //             "client_cellulaire" => $row["cellulaire_client"],
                //             "client_id" => $client_id,
                //             "beneficiaire" => $row["beneficiaire"],
                //             "taux" => $row["risque"] == "SANTE" && $row["taux"] ? $row["taux"] : null,
                //             "effet" => $row["date_effet"],
                //             "echeance" => $row["date_echeance"],
                //             "duree" => ($row["date_effet"]&&$row["date_echeance"]) ? $row["date_effet"]->diff($row["date_echeance"])->days : '',
                //             "prime_nette" => $row["prime_nette"],
                //             "cout_police" => $row["cout_police"],
                //             "taxe" => $row["taxe"],
                //             "fga" => $row["fga"],
                //             "frais_accessoire" => $row["frais_accessoires"],
                //             "prime_ttc" => $row["prime_ttc"],
                //             "commission" => $row["commission"] ?? 0,
                //             "zone" => $row["zone"],
                //             "flotte" => $row["flotte"] ? "1" : null,
                //             "nom_flotte" => $row["flotte"],
                //             "attestation_id" => $row["numero_attestation"],
                //             "statut" => $row["statut"] ?? 0,
                //             "marque" => $row['marque'],
                //             "immatriculation" => $row['immatriculation'],
                //             "mise_circulation" => $row['mise_circulation'],
                //             "numero_chassis" => $row['numero_chassis'],
                //             "energie" => $row['energie'],
                //             "puissance" => $row['puissance'],
                //             "tonnage" => $row['tonnage'],
                //             "cylindre" => $row['cylindre'],
                //             "nbre_place" => $row['nbre_place'],
                //             "package" => $row['package'],
                //             "categorie" => $row['categorie'],
                //             "genre" => $row['genre'],
                //             "zone" => $row['zone'],
                //             "valeur_neuve" => $row['valeur_neuve'],
                //             "valeur_venale" => $row['valeur_venale'],
                //         ]);
                //         if($risque_id && $compagnie_id && $client_id){
                //             $request2->merge(['numero_emission' => $this->generateNumeroEmission($request2)]);
                //         }

                //     } catch (\Throwable $th) {
                //         $results["msg"] = "Erreur Système";
                //         array_push($results["errs"], [
                //             "title" => "Erreur sur le fichier",
                //             "msg" => ["Le fichier importé ne respecte pas les critères du fichier modèle ".$th->getMessage()]
                //         ]);
                //         return redirect()->back()->withErrors([
                //             'csv' => 'Le fichier importé ne respecte pas les critères du fichier modèle'
                //         ]);
                //     }

                //     $singleValidator = Validator::make($request2->all(), [
                //         "date_emission" => "required",
                //         "numero_police" => "required",
                //         "risque_nom" => "required",
                //         "risque_id" => "required",
                //         "compagnie_nom" => "required",
                //         "compagnie_id" => "required",
                //         "client_nom_prenom" => "required",
                //         "client_type" => "required",
                //         "client_cellulaire" => "required",
                //         "beneficiaire" => "required",
                //         "effet" => "required",
                //         "echeance" => "required",
                //         "prime_nette" => "required",
                //         "prime_ttc" => "required",
                //     ],[
                //         "date_emission.required" => "Veuillez entrer la date d'émission",
                //         "numero_police.required" => "Veuillez entrer le numero de police",
                //         "risque_nom.required"  => "Veuillez entrer le risque",
                //         "risque_id.required"  => "Ce risque n'existe pas dans la liste des risques",
                //         "compagnie_nom.required"  => "Veuillez entrer la compagnie",
                //         "compagnie_id.required"  => "Cette compagnie n'existe pas dans la liste des compagnies",
                //         "client_nom_prenom.required"  => "Veuillez entrer le client",
                //         "client_type.required"  => "Veuillez entrer le type du client",
                //         "client_cellulaire.required"  => "Veuillez entrer le cellulaire du client",
                //         "beneficiaire.required"  => "Veuillez entrer le bénéficiaire",
                //         "effet.required"  => "Veuillez entrer la date d'effet",
                //         "echeance.required"  => "Veuillez entrer la date d'échéance",
                //         "prime_nette.required"  => "Veuillez entrer la prime nette",
                //         "prime_ttc.required"  => "Veuillez entrer la prime TTC",
                //     ]);
                    
                //     if($singleValidator->passes()){
                //         $contrat = $contratExist = Contrat::where('numero_police',$request2->numero_police)
                //                                 ->where('effet',$request2->effet)
                //                                 ->where('type_contrat',$request2->type_contrat)
                //                                 ->where('date_emission',$request2->date_emission)
                //                                 ->first();
                //         if(!$contratExist){
                //             $contrat = Contrat::create($request2->except([
                //                 "risque_nom",
                //                 "compagnie_nom",
                //                 "client_nom_prenom",
                //                 "client_type",
                //                 "client_cellulaire",
                //                 "marque",
                //                 "immatriculation",
                //                 "mise_circulation",
                //                 "numero_chassis",
                //                 "energie",
                //                 "puissance",
                //                 "tonnage",
                //                 "cylindre",
                //                 "nbre_place",
                //                 "package",
                //                 "categorie",
                //                 "genre",
                //                 "zone",
                //                 "valeur_neuve",
                //                 "valeur_venale",
                //             ]));

                //             $contrat->avenant = $this->generateNumeroAvenant($request2);
    
                //         // To uncomment
                //             /*$query = Contrat::join('users', 'contrat.user_created_id', '=', 'users.id')
                //                             ->join('client', 'contrat.client_id', '=', 'client.id')
                //                             ->join('compagnie', 'contrat.compagnie_id', '=', 'compagnie.id')
                //                             ->join('risque', 'contrat.risque_id', '=', 'risque.id');
                //             $contract = $query->select('contrat.*', 'users.nom as nom_user', 'users.prenoms as prenom_user', 'client.nom as nom_client',
                //             'client.prenom as prenom_client', 'client.raison_sociale', 'risque.nom as nom_risque', 'compagnie.denomination as nom_compagnie')
                //                         ->where('contrat.id',$contrat->id)->first();
                //             array_push($results["contrats"], $contract);*/
                //             $nb_success ++;
                //         } else {
                //             array_push($results["warns"], [
                //                 "title" => "Avertissement à la ligne ".($key+1),
                //                 "msg" => ["Ce contrat existe déjà dans la base de donnée"],
                //             ]);
                //             $nb_warning ++;
                //         }

                //         $auto = Risque::whereNom('AUTOMOBILE')->first()->id;
                //         if($contrat->risque_id == $auto){
                //             $imm = $request2->immatriculation;
                //             if($imm){
                //                 //Création du véhicule
                //                 try{
                //                     $vehicule = Vehicule::whereImmatriculation($imm)->first();
                //                     if(!$vehicule){
                //                         $vehicule = Vehicule::create([
                //                             "marque" => $request2->marque,
                //                             "immatriculation" => $request2->immatriculation,
                //                             "mise_circulation" => $request2->mise_circulation,
                //                             "numero_chassis" => $request2->numero_chassis,
                //                             "energie" => $request2->energie,
                //                             "puissance" => $request2->puissance ? str_replace([",", " "], ["", ""], $request2->puissance) : null,
                //                             "tonnage" => $request2->tonnage ? str_replace([",", " "], ["", ""], $request2->tonnage) : null,
                //                             "cylindre" => $request2->cylindre ? str_replace([",", " "], ["", ""], $request2->cylindre) : null,
                //                             "nbre_place" => $request2->nbre_place ? str_replace([",", " "], ["", ""], $request2->nbre_place) : null,
                //                             "numero_emission" => $contrat->numero_emission,
                //                             "client_id" => $request2->client_id,
                //                             // "contrat_id" => $contrat->id
                //                         ]);
                //                     }
        
                //                     $package = VehiculeGarantie::whereEmissionId($contrat->id)->whereVehiculeId($vehicule->id)->first();
                //                     // dd(VehiculeGarantie::all());
                //                     if(!$package){
                //                         //Création du package
                //                         $package = VehiculeGarantie::create([
                //                             "vehicule_id" => $vehicule->id,
                //                             "emission_id" => $contrat->id,
                //                             "package_id" => Package::whereLibelle($request2->package)->first()->id,
                //                             "categorie" => $request2->categorie,
                //                             "genre" => $request2->genre,
                //                             "zone" => $request2->zone,
                //                             "valeur_neuve" => $request2->valeur_neuve ? str_replace([",", " "], ["", ""], $request2->valeur_neuve) : null,
                //                             "valeur_venale" => $request2->valeur_venale ? str_replace([",", " "], ["", ""], $request2->valeur_venale) : null,
                //                             "prime_nette" => str_replace([",", " "], ["", ""], $request2->prime_nette),
                //                             "prime_ttc" => str_replace([",", " "], ["", ""], $request2->prime_ttc)
                //                         ]);
                //                     }
                //                 } catch(\Throwable $e){
                //                     array_push($results["errs"], [
                //                         "title" => "Erreur à la ligne ".($key+1),
                //                         "msg" => "Veuillez renseigner correctement les caractéristiques du vehicule ".$e->getMessage(),
                //                     ]);
                //                     $nb_error ++;
                //                 }
                //             } else {
                //                 array_push($results["errs"], [
                //                     "title" => "Erreur à la ligne ".($key+1),
                //                     "msg" => "Veuillez renseigner l'immatriulation du vehicule",
                //                 ]);
                //                 $nb_error ++;
                //             }

                //             // dd(VehiculeGarantie::whereEmissionId($contrat->id)->first(), $package);
                //         }


                //     // To delete and uncomment on top
                //         $query = Contrat::join('users', 'contrat.user_created_id', '=', 'users.id')
                //                         ->join('client', 'contrat.client_id', '=', 'client.id')
                //                         ->join('compagnie', 'contrat.compagnie_id', '=', 'compagnie.id')
                //                         ->join('risque', 'contrat.risque_id', '=', 'risque.id');
                //         $contract = $query->select('contrat.*', 'users.nom as nom_user', 'users.prenoms as prenom_user', 'client.nom as nom_client',
                //         'client.prenom as prenom_client', 'client.raison_sociale', 'risque.nom as nom_risque', 'compagnie.denomination as nom_compagnie')
                //                     ->where('contrat.id',$contrat->id)->first();
                //         array_push($results["contrats"], $contract);
                //     // end to delete

                //     } else {
                //         array_push($results["errs"], [
                //             "title" => "Erreur à la ligne ".($key+1),
                //             "msg" => $singleValidator->errors()->all(),
                //         ]);
                //         $nb_error ++;
                //     }

                // }
                // $results["msg"] = "$nb_success contrats importés avec succès. ".($nb_error ? " $nb_error erreurs." : '').($nb_warning ? " $nb_warning avertissements (Contrat déjà existant)." : '');
                // foreach($results["errs"] as $errors){
                //     Log::info($errors["title"].' : '. implode($errors["msg"],';'));
                // }
            });
            return redirect()->back()->with(compact('results'));
        } else {
            return redirect()->back()->withErrors($validator->errors()->all());
        }

        dd($request->csv);
        //
        // return view('admin.adherent.importation');
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

        //dd($request->all());
        // Traiter le champ contact prévu pour les sms
        $contact = explode("-", substr($request->souscript_contact, 7, 14));
        $contact_format = "225".$contact[0].$contact[1].$contact[2].$contact[3].$contact[4];
        
        //dd(Adheregenerate_order(Adherents::count()));
        //store souscripteur
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

            $benef_dnaiss = explode('-',$request->benef_dnaiss[$i]);

            $ben_dnaiss = $benef_dnaiss[2].$benef_dnaiss[1].$benef_dnaiss[0];

            Adherents::create([
                'nom' => $request->benef_nom[$i],
                'pnom' => $request->benef_pnom[$i],
                'civilite' => $request->benef_civilite[$i],
                'date_naiss' => $ben_dnaiss,
                'num_cni' => $request->benef_ncni[$i],
                'lieu_naiss' => $request->benef_lnaiss[$i],
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
    public function edit($id)
    {
        //
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
        //
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
        $adhesion->date_fincarence = Carbon::now()->addMonths(4);

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
            $benef->date_fincarence = Carbon::now()->addMonths(4);
            $benef->save();
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
        'message' => 'Félicitations '.$titre.' '.$nom.' '.$pnom.' votre adhésion à notre chaîne de solidarité Diphita Prévoyance s\'est effetuée avec succès. Votre numéro ID: '.$num_adhe.'. Fin de carence: '.ucwords((new Carbon($date_fincarence))->locale('fr')->isoFormat('DD/MM/YYYY')).'. Début de cotisation: '.ucwords((new Carbon($date_debutcotisation))->locale('fr')->isoFormat('DD/MM/YYYY')),
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
    
}
