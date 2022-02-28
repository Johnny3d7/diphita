<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Versement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VersementController extends Controller
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
        // return response()->json($request->all());
        //
        $validatedData = Validator::make($request->all(),[
            
            "montant" => "required",
        ], [
            "montant.required" => "Le montant du versement est obligatoire",
        ]);

        if ($validatedData->fails()) {
            if($request->api) {
                return response()->json([
                    'status' => 'error',
                    'message' => sprintf(' ', $validatedData->errors())
                ]);
            }
            return redirect()->back()->with('message', 'L\'enregistrement du versement a échoué')->with('type', 'bg-danger');
        }else{
            if($request->montant < 0 || (($request->montant % 50) != 0)){
                if($request->api) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Le montant doit être multiple de 50 et supérieur à 50 FCFA'
                    ]);
                }
                return redirect()->back()->with('message', 'L\'enregistrement du versement a échoué')->with('type', 'bg-danger');
            }
            // $versement = Versement::create([
            //         "montant" => $request->montant,
            //         "id_adherent" => $request->id_adherent
            //     ]);
            if($request->api) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'L\'enregistrement du versement à été un succès'
                ]);
            }
            return redirect()->back()->with('message', 'L\'enregistrement du versement à été un succès')->with('type', 'bg-success');;
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
