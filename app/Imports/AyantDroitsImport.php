<?php

namespace App\Imports;

use App\Models\Adherents;
use App\Models\AyantDroit;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AyantDroitsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $results = [
            "msg" => '',
            "errs" => [],
            "warns" => [],
            "data" => []
        ];

        $nb_success = $nb_error = $nb_warning = 0;
        
        foreach ($collection as $key => $row) 
        {
            try {
                $request2 = new Request([
                    'civilite' => $row['civilite'] ?? null,
                    'nom' => $row['nomprenom'] ? trim(explode(' ', $row['nomprenom'])[0]) : null,
                    'pnom' => $row['nomprenom'] ? trim(substr($row['nomprenom'], strlen(explode(' ', $row['nomprenom'])[0]))) : null,
                    'email' => $row['email'] ?? null,
                    'num_cni' => $row['cni'] ?? null,
                    'date_naiss' => isset($row['datenaissance']) ? Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['datenaissance'])) : null,
                    'lieu_naiss' => $row['lieunaissance'] ?? null,
                    'lieu_hab' => $row['lieuhabitation'] ?? null,
                    'contact' => $row['contact'] ?? null,
                    'cas' => (isset($row['cas']) && $row['cas'] == "Oui") ? 1 : 0,
                    'adherent' => $row['idsouscripteur'] ?? null,
                ]);
                //code...
                
                $singleValidator = Validator::make($request2->all(), [
                    'civilite' => 'required',
                    'nom' => 'required',
                    'email' => 'unique:ayantdroits',
                    'contact' => 'required|unique:ayantdroits',
                    'adherent' => 'required|exists:adherents,num_adhesion',
                ],[
                    "civilite.required" => "Veuillez entrer la civilité",
                    "nom.required"  => "Veuillez entrer le nom et le(s) prénom(s)",
                    "email.unique"  => "Un ayant droit possède déjà cet email",
                    "contact.required"  => "Veuillez entrer le contact",
                    "contact.unique"  => "Un ayant droit possède déjà ce contact",
                    "adherent.required"  => "Veuillez entrer le numero du souscripteur",
                    "adherent.exists"  => "Le souscripteur ne fait pas partie de la base de données",
                ]);
    
                if($singleValidator->fails()){
                    $exists = AyantDroit::whereNom($request2->nom)->wherePnom($request2->pnom)->whereEmail($request2->email)->whereContact($request2->contact)->first();
                    if($exists){
                        array_push($results["warns"], [
                            "title" => "Avertissement à la ligne ".($key+1),
                            "msg" => ["Ayant droit déjà existant"],
                        ]);
                        $nb_warning ++;
                    } else {
                        array_push($results["errs"], [
                            "title" => "Erreur à la ligne ".($key+1),
                            "msg" => $singleValidator->errors()->all(),
                        ]);
                        $nb_error ++;
                    }
                } else {
                    try {
                        $adherent = Adherents::whereNumAdhesion($request2->adherent)->first();
                        $request2->merge([
                            'priorite' => count($adherent->ayants) + 1,
                            'id_adherent' => $adherent->id
                        ]);
                        $ayantdroit = AyantDroit::create($request2->all());
                        array_push($results["data"], $ayantdroit);
                        $nb_success ++;
                    } catch (\Throwable $th) {
                        array_push($results["errs"], [
                            "title" => "Erreur à la ligne ".($key+1),
                            "msg" => $th->getMessage(),
                        ]);
                        $nb_error ++;
                    }
                }
            } catch (\Throwable $th) {
                array_push($results["errs"], [
                    "title" => "Erreur à la ligne ".($key+1),
                    "msg" => ["La date de naissance doit être au format date ".$th->getMessage()],
                ]);
                $nb_error ++;
            }
            
        }
        $results["msg"] = "$nb_success ayant droit importés avec succès. ".($nb_error ? " $nb_error erreurs." : '').($nb_warning ? " $nb_warning avertissements." : '');
        session(['resultsAyant' => $results]);
    }
}
