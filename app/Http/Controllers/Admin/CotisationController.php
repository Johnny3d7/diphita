<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cotisation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CotisationController extends Controller
{
    public function getInfos(Request $request)
    {
        $cotisation = Cotisation::find($request->cotisation_id);
        if($cotisation){
            $results = new Collection();
            $souscripteurs = $request->filter && in_array($request->filter, ["Regle", "Non Regle"]) ? $cotisation->souscripteurs($request->filter) : $cotisation->souscripteurs();
            foreach($souscripteurs as $souscripteur){
                $results->add([
                    'cotisation_type' => $cotisation->type,
                    'cotisation_identifiant' => $cotisation->code_deces ?? $cotisation->annee_cotis,
                    'identifiant' => $souscripteur->num_adhesion,
                    'nom_prenoms' => $souscripteur->nom_pnom(),
                    'nbre_benef' => $souscripteur->psCotisation($cotisation)->nbre_benef,
                    'date_paiement' => $cotisation->date_payement($souscripteur) ? date_format(date_create($cotisation->date_payement($souscripteur)), 'd/m/Y') : '-',
                    'montant' => $cotisation->reglements($souscripteur)->sum('montant'),
                    'etat' => $souscripteur->isReglee($cotisation) ? "A Jour" : "Non A Jour",
                ]);
            }
            // dd($results);
            return ['data' => $results];
        }
        return null;
    }

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
}
