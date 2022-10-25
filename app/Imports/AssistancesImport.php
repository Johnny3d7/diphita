<?php

namespace App\Imports;

use App\Helpers\Functions;
use App\Models\Adherents;
use App\Models\Assistance;
use App\Models\Cotisation;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AssistancesImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // Tableau de valeurs par defaut pour ecuperer le resultat de traitement
        $results = [
            "msg" => '',
            "errs" => [],
            "warns" => [],
            "data" => []
        ];

        $nb_success = $nb_error = $nb_warning = 0;

        foreach ($collection as $key => $row)
        {
            try{
                // Création d'une Request en vue de la validation des informations renseignées dans chaque ligne
                $request2 = new Request([
                    // 'valide' => 1, // Valider d'office
                    'benef' => $row['idbeneficiaire'] ? Functions::trimInsideString($row['idbeneficiaire']) : null,
                    'date_deces' => isset($row['date_de_deces']) ? Functions::dateFromExcel($row['date_de_deces']) : null,
                    'lieu_deces' => $row['lieu_de_deces'] ?? null,
                    'date_obseques' => isset($row['date_des_obseques']) ? Functions::dateFromExcel($row['date_des_obseques']) : null,
                    'date_assistance' => isset($row['date_dassistance']) ? Functions::dateFromExcel($row['date_dassistance']) : null,
                    'moyen_assistance' => $row['moyen_dassistance'] ?? null,
                    'code_deces' => Cotisation::whereCodeDeces($row['code_deces'])->first()->code_deces ?? null
                ]);

                // Validation des données de $request2
                $singleValidator = Validator::make($request2->all(), [
                    'benef' => 'required|exists:adherents,num_adhesion',
                    'date_deces' => 'required',
                    'lieu_deces' => 'required',
                    'date_obseques' => 'required',
                ],[
                    "benef.required" => "Veuillez entrer l'ID bénéficiaire",
                    "benef.exists" => "Aucun bénéficiaire ne possède cet id",
                    "date_deces.required" => "Veuillez entrer la date de décès",
                    "lieu_deces.required" => "Veuillez entrer le lieu de décès",
                    "date_obseques.required" => "Veuillez entrer la date des obsèques",
                ]);
                if($singleValidator->fails()){ // Si la validation échoue ou retourne une erreur
                    // dd($singleValidator->fails(), $request2->all());
                    array_push($results["errs"], [
                        "title" => "Erreur à la ligne ".($key+1),
                        "msg" => $singleValidator->errors()->all(),
                    ]);
                    $nb_error ++;
                } else { // S'il n'y a aucune erreur de validation
                    try { // Essayer d'enregistrer et relever les éventuelles erreurs
                        $beneficiaire = Adherents::whereNumAdhesion($request2->benef)->first();
                        if($beneficiaire){
                            if($cas = Assistance::whereIdBenef($beneficiaire->id)->first()){
                                // dd($row['code_deces']);
                                array_push($results["warns"], [
                                    "title" => "Avertissement à la ligne ".($key+1),
                                    "msg" => ["Cas déjà assisté pour le bénéficiaire ".$beneficiaire->num_adhesion],
                                ]);
                                $nb_warning ++;
                            } else {
                                $beneficiaire->update(["cas" => 1]);
                                $request2->merge([
                                    "id_benef" => $beneficiaire->id,
                                    "id_souscripteur" => $beneficiaire->isBeneficiaire() ? $beneficiaire->souscripteur()->id : $beneficiaire->id,
                                    "valide" => 1,
                                    "assiste" => $request2->date_assistance ? 1 : 0,
                                ]);
                                $cas = Assistance::create($request2->all());
                                array_push($results["data"], $cas);
                                $nb_success ++;
                            }
                        }
                    } catch (\Throwable $th) { // En cas d'une quelconque erreur
                        array_push($results["errs"], [
                            "title" => "Erreur à la ligne ".($key+1),
                            "msg" => [$th->getMessage()],
                        ]);
                        $nb_error ++;
                    }
                }
            } catch (\Throwable $th) { // Cas d'une erreur survenue avant la validation : Cas de la date d'Excel
                array_push($results["errs"], [
                    "title" => "Erreur à la ligne ".($key+1),
                    "msg" => ["Veuillez vérifier le format des différentes dates ".$th->getMessage()],
                ]);
                $nb_error ++;
            }
        }

        // Stocker toutes les informations dans la variable de resultat
        $results["msg"] = "$nb_success cas d'assistance importés avec succès. ".($nb_error ? " $nb_error erreurs." : '').($nb_warning ? " $nb_warning avertissements." : '');
        /* Mettre la variable de resultat dans la session de l'utilisateur pour y avoir accès n'importe où tant que la session est active ou que la variable n'a pas été supprimée de la session */
        session(['resultsCas' => $results]);
    }
}
