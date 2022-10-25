<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adherents;
use App\Models\Assistance;
use App\Models\Caisse;
use App\Models\Cotisation;
use App\Models\Depense;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use stdClass;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $souscripteurs = Adherents::selectAll(true);
        $beneficiaires = Adherents::selectAll();
        $caisse = Caisse::first();
        $cotisation_exp = Cotisation::selectAll('exceptionnelles', false)->last();
        $cotisation_an = Cotisation::selectAll('annuelles')->last();

        $assistances = Assistance::to_assist();

        $data = new stdClass();
        $data->nbre_souscripteurs = $souscripteurs->count();
        $data->nbre_beneficiaires = $beneficiaires->count();
        $data->nbre_cas_assistes = Assistance::nbre_assisted();
        $data->nbre_cas_a_assister = Assistance::nbre_to_assist();
        $data->point_cas_a_assister = Assistance::montant_to_assist();
        $data->point_caisse = $caisse->solde();
        $data->point_depense = Depense::getMontant();
        return view('admin.home.index', compact('data', 'cotisation_exp', 'cotisation_an', 'assistances'));
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
