<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adherents;
use App\Models\AyantDroit;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $adhesion->save();

        //Numero des beneficiaires a generer
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

        $this->sms_inscription_valider($num_adhe,$adhesion->contact_format,$adhesion->nom,$adhesion->pnom,$adhesion->civilite);
        

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

    public function sms_inscription_valider($num_adhe, $contact,$nom,$pnom,$civilite){

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
        'message' => $titre.' '.$nom.' '.$pnom.' votre inscription à Diphita Prévoyance s\'est déroulée avec succès. Votre numéro d\'adhésion est : '.$num_adhe,
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
