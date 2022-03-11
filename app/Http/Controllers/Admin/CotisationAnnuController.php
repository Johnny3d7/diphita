<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adherents;
use App\Models\Cotisation;
use Illuminate\Http\Request;

class CotisationAnnuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // foreach (Adherents::selectAll(true) as $adherent) {
        //     $adherent->update(['valide' => false]);
        // }
        $cotisations = Cotisation::selectAll('annuelles')->sortByDesc('annee_cotis');
        return view("admin.cotisation.annuelles.index", compact('cotisations'));
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
        $cotisation = Cotisation::whereAnneeCotis($id)->first();
        return view("admin.cotisation.annuelles.show", compact('cotisation'));
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

    public function publier($annee){
        $cotisation = Cotisation::whereAnneeCotis($annee)->first();
        $cotisation->publier();
        return back();
    }
}
