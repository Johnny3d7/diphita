<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CotisationAnnuelle;
use App\Models\CotisationExceptionnelle;
use App\Models\DroitInscription;
use App\Models\DureeFincarences;
use App\Models\TraitementKit;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function droitInscription()
    {
        //
        $montant_actuel = DroitInscription::where('status',1)->first();

        $montant_story = DroitInscription::orderBy('created_at', 'DESC')->get();

        return view('admin.configuration.DroitInscription.index',compact('montant_story','montant_actuel'));
    }

    public function droitInscriptionStore(Request $request){

        $validatedData = $request->validate([
            "montant" => "required|integer",
        ], [
            "montant.required" => "Le champ montant est obligatoire",
            "montant.integer" => "La valeur du champ montant doit être un nombre"
        ]);

            
            foreach (DroitInscription::where('status',1)->get() as $cotisation) {
                $cotisation->status = 0;
                $cotisation->save();
            }

        
            $montant = DroitInscription::create([
                'montant' => $request->montant,
                'status' => 1,
            ]);


        return redirect()->back()->with('message', 'Le montant a été mis à jour')->with('type', 'bg-success');
    }

    public function cotisationAnnuelle()
    {
        //
        $montant_actuel = CotisationAnnuelle::where('status',1)->first();

        $montant_story = CotisationAnnuelle::orderBy('created_at', 'DESC')->get();

        return view('admin.configuration.CotisationAnnuelle.index',compact('montant_story','montant_actuel'));
    }

    public function cotisationAnnuelleStore(Request $request){

        $validatedData = $request->validate([
            "montant" => "required|integer",
        ], [
            "montant.required" => "Le champ montant est obligatoire",
            "montant.integer" => "La valeur du champ montant doit être un nombre"
        ]);

            //dd(CotisationAnnuelle::where('status',1)->get());
            foreach (CotisationAnnuelle::where('status',1)->get() as $cotisation) {
                $cotisation->status = 0;
                $cotisation->save();
            }

        
        $montant = CotisationAnnuelle::create([
            'montant' => $request->montant,
            'status' => 1,
        ]);

        return redirect()->back()->with('message', 'Le montant a été mis à jour')->with('type', 'bg-success');
    }

    public function cotisationExcept()
    {
        //
        $montant_actuel = CotisationExceptionnelle::where('status',1)->first();

        $montant_story = CotisationExceptionnelle::orderBy('created_at', 'DESC')->get();

        return view('admin.configuration.CotisationExcept.index',compact('montant_story','montant_actuel'));
    }

    public function cotisationExceptionnelleStore(Request $request){

        $validatedData = $request->validate([
            "montant" => "required|integer",
        ], [
            "montant.required" => "Le champ montant est obligatoire",
            "montant.integer" => "La valeur du champ montant doit être un nombre"
        ]);

            
            foreach (CotisationExceptionnelle::where('status',1)->get() as $cotisation) {
                $cotisation->status = 0;
                $cotisation->save();
            }

        
        $montant = CotisationExceptionnelle::create([
            'montant' => $request->montant,
            'status' => 1,
        ]);

        return redirect()->back()->with('message', 'Le montant a été mis à jour')->with('type', 'bg-success');
    }

    public function traitementKit()
    {
        //
        $montant_actuel = TraitementKit::where('status',1)->first();

        $montant_story = TraitementKit::orderBy('created_at', 'DESC')->get();

        return view('admin.configuration.TraitementKit.index',compact('montant_story','montant_actuel'));
    }

    public function traitementKitStore(Request $request){

        $validatedData = $request->validate([
            "montant" => "required|integer",
        ], [
            "montant.required" => "Le champ montant est obligatoire",
            "montant.integer" => "La valeur du champ montant doit être un nombre"
        ]);

            
            foreach (TraitementKit::where('status',1)->get() as $cotisation) {
                $cotisation->status = 0;
                $cotisation->save();
            }

        
        $montant = TraitementKit::create([
            'montant' => $request->montant,
            'status' => 1,
        ]);

        return redirect()->back()->with('message', 'Le montant a été mis à jour')->with('type', 'bg-success');
    }


    public function dureeFincarence()
    {
        //
        $duree_actuel = DureeFincarences::where('status',1)->first();

        $duree_story = DureeFincarences::orderBy('created_at', 'DESC')->get();

        return view('admin.configuration.DureeCarence.index',compact('duree_story','duree_actuel'));
    }

    public function dureeFincarenceStore(Request $request){

        $validatedData = $request->validate([
            "duree" => "required|integer",
        ], [
            "duree.required" => "Le champ duree est obligatoire",
            "duree.integer" => "La valeur du champ duree doit être un nombre"
        ]);

            
            foreach (DureeFincarences::where('status',1)->get() as $duree) {
                $duree->status = 0;
                $duree->save();
            }

        
        $montant = DureeFincarences::create([
            'duree' => $request->duree,
            'status' => 1,
        ]);

        return redirect()->back()->with('message', 'La durée de carence a été mise à jour.')->with('type', 'bg-success');
    }
}
