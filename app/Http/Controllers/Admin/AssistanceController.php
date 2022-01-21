<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\AssistancesImport;
use App\Models\Adherents;
use App\Models\Assistance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class AssistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.assistance.index');
    }

        /**
     * Show the form for importing datas.
     *
     * @return \Illuminate\Http\Response
     */
    public function importation()
    {
        return view('admin.assistance.importation');
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
            return redirect()->back()->withErrors($fileValidator->errors()->all());
        } else {
            try {
                $import = new AssistancesImport;
                $collection = Excel::import($import, $request->file('csv'));
    
                return redirect()->back();
            } catch (\Throwable $th) {
                return redirect()->back()->withErrors(['csv' => "Fichier incompatible avec les exigences de l'importation : ".$th->getMessage()]);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $adherent = Adherents::where('id',$id)->first();

        return view('admin.assistance.create',compact('adherent'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSous(Adherents $souscripteur)
    {
        return view('admin.assistance.create', compact('souscripteur'));
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
            
            "souscript_num" => "required",
            "benef_num" => "required",
            "date_assistance" => "required|date_format:d-m-Y",
            "moyen_assistance" => "required",
            "lieu_deces" => "required",
            "date_deces" => "required|date_format:d-m-Y",
            "date_obseques" => "required|date_format:d-m-Y",
        ], [
            "souscript_num.required" => "Le numéro d'identification du souscripteur est obligatoire",
            "benef_num.required" => "Le numéro d'identification du bénéficiaire est obligatoire",
            "date_assistance.required" => "La date d'assistance est obligatoire",
            "date_assistance.date_format" => "Format de date d'assistance incorrect",
            "moyen_assistance.required" => "Moyen d'assistance est obligatoire",
            "date_deces.date_format" => "Format de date de décès incorrect",
            "date_deces.required" => "La date de décès est obligatoire",
            "date_obseques.date_format" => "Format de date des obsèques incorrect",
            "date_obseques.required" => "La date des obsèques est obligatoire",
            "lieu_deces.required" => "Le lieu de décès est obligatoire"
        ]);
        //$validatedData = $request->validate();
        if ($validatedData->fails()) {
            //dd($validatedData->errors()->all());
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        else{
            $assistance = Assistance::create([
                'id_benef' => $request->benef_id,
                'date_deces'=> $this->formatDate($request->date_deces),
                'lieu_deces'=>$request->lieu_deces,
                'date_obseques'=> $this->formatDate($request->date_obseques),
                'date_assistance'=> $this->formatDate($request->date_assistance),
                'moyen_assistance'=> $request->moyen_assistance,
                'enfant_defunt'=> $request->enfant_defunt,
                'enfant_contact'=> $request->enfant_contact,
                'proche_defunt'=> $request->proche_defunt,
                'proche_contact'=> $request->proche_contact,
                'id_souscripteur'=> $request->souscript_id
            ]);
        }

        return redirect()->back()->with('message', 'L\'enregistrement du cas s\'est déroulée avec succès ')->with('type', 'bg-success');
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
        $assistance = Assistance::find($id);

        return view('admin.assistance.show', compact('assistance'));
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
        $assistance = Assistance::find($id);

        return view('admin.assistance.edit', compact('assistance'));

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
        $assistance = Assistance::find($id);
        $assistance->status = 0;
        $assistance->save();
        
        return redirect()->back()->with('message', 'Assistance supprimée avec succès.')->with('type', 'bg-success');
    }

    public function valider($id)
    {
        //
        $assistance = Assistance::find($id);
        $assistance->valide = 1;
        $assistance->save();
        
        return redirect()->back()->with('message', 'Assistance validée avec succès.')->with('type', 'bg-success');
    }

    public function rejeter($id)
    {
        //
        $assistance = Assistance::find($id);
        $assistance->valide = 2;
        $assistance->save();

        $adherent = Adherents::find($assistance->beneficiaire->id);
        $adherent->cas = 1;
        $adherent->save();
        
        return redirect()->back()->with('message', 'Assistance est passée au statut rejeté.')->with('type', 'bg-success');
    }

    public function assister($id)
    {
        //
        $assistance = Assistance::find($id);
        $assistance->assiste = 1;
        $assistance->save();
        
        return redirect()->back()->with('message', 'Cas assisté avec succés. Le montant actuel de la caisse est de .')->with('type', 'bg-success');
    }

    public function formatDate($date){
        $date1 = explode('-',$date);
        $date_format = $date1[2].$date1[1].$date1[0];
        return $date_format;
    }

    public function assistance_sous($id){
        $souscripteur = Adherents::find($id);
        $assistances = Assistance::where(['status'=> 1,'id_souscripteur' => $id])->get();

        return view('admin.assistance.assistance_sous',compact('assistances','souscripteur'));
    }
}
