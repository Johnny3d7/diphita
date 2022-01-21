<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Depense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $depenses = Depense::where(['status' => 1])->get();

        return view('admin.depense.index', compact('depenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.depense.create');
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

        $validatedData = Validator::make($request->all(),[
            
            'lib' => 'required' ,
            'montant'=> 'required',
            'date_depense' => 'required',
            'id_ordonnateur' => 'required',
        ], [
            "montant.required" => "Le montant de la dépense est obligatoire.",
            'lib.required' => 'La description est un champ obligatoire.' ,
            'date_depense.required' => 'La date de la dépense est un champ obligatoire.',
            'id_ordonnateur.required' => 'Sélectionnez un ordonnateur s\'il vous plaît.',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        else{
            $depense = Depense::create([
                'lib' => $request->lib,
                'montant' => $request->montant,
                'date_depense' => $this->formatDate($request->date_depense),
                'observation' => $request->observation,
                'id_ordonnateur' => $request->id_ordonnateur,
            ]);
            
            return redirect()->back()->with('message', 'L\'enregistrement de la dépense à été un succès.')->with('type', 'bg-success');;
        }
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
        $depense = Depense::find($id);

        return view('admin.depense.edit', compact('depense'));
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
            
            'lib' => 'required' ,
            'montant'=> 'required',
            'date_depense' => 'required',
            'id_ordonnateur' => 'required',
        ], [
            "montant.required" => "Le montant de la dépense est obligatoire.",
            'lib.required' => 'La description est un champ obligatoire.' ,
            'date_depense.required' => 'La date de la dépense est un champ obligatoire.',
            'id_ordonnateur.required' => 'Sélectionnez un ordonnateur s\'il vous plaît.',
        ]);

        if ($validatedData->fails()) {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        else{
            $depense = Depense::find($id);

            $depense->update([
                'lib' => $request->lib,
                'montant' => $request->montant,
                'date_depense' => $this->formatDate($request->date_depense),
                'observation' => $request->observation,
                'id_ordonnateur' => $request->id_ordonnateur,
            ]);
            
            return redirect()->back()->with('message', 'La dépense a été modifiée avec un succès.')->with('type', 'bg-success');
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
        $depense = Depense::find($id);
        $depense->status = 0;
        $depense->save();
        
        return redirect()->back()->with('message', 'La dépense a été supprimée avec un succès.')->with('type', 'bg-success');
    }

    public function formatDate($date){
        $date1 = explode('-',$date);
        $date_format = $date1[2].$date1[1].$date1[0];
        return $date_format;
    }
}
