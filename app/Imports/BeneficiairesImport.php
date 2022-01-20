<?php

namespace App\Imports;

use App\Models\Adherents;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BeneficiairesImport implements ToCollection, WithHeadingRow
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
                    'role' => 2, // Bénéficiaire
                    'valide' => 1, // Valider d'office
                    'num_adhesion' => $row['idbeneficiaire'] ?? null,
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
                ]);

                // Validation des données de $request2
                $singleValidator = Validator::make($request2->all(), [
                    'num_adhesion' => 'required|unique:adherents',
                    'civilite' => 'required',
                    'nom' => 'required',
                    'email' => 'unique:adherents',
                    'num_cni' => 'required|unique:adherents',
                    'contact' => 'required|unique:adherents',
                ],[
                    "num_adhesion.required" => "Veuillez entrer l'ID bénéficiaire",
                    "num_adhesion.unique" => "Un bénéficiaire possède déjà cet id",
                    "civilite.required" => "Veuillez entrer la civilité",
                    "nom.required"  => "Veuillez entrer le nom et le(s) prénom(s)",
                    "email.unique"  => "Un bénéficiaire possède déjà cet email",
                    "num_cni.required"  => "Veuillez entrer le numero cni",
                    "num_cni.unique"  => "Un bénéficiaire possède déjà ce numero cni",
                    "contact.required"  => "Veuillez entrer le contact",
                    "contact.unique"  => "Un bénéficiaire possède déjà ce contact",
                ]);

                if($singleValidator->fails()){ // Si la validation échoue ou retourne une erreur
                    // Vérification que l'erreur est due à un doublon alors retourner un simple avertissement   
                    $exists = Adherents::whereNumAdhesion($request2->num_adhesion)->whereNom($request2->nom)->wherePnom($request2->pnom)->whereEmail($request2->email)->whereNumCni($request2->num_cni)->whereContact($request2->contact)->first();
                    if($exists){
                        array_push($results["warns"], [
                            "title" => "Avertissement à la ligne ".($key+1),
                            "msg" => ["Bénéficiaire déjà existant"],
                        ]);
                        $nb_warning ++;
                    } else { // C'est bien une erreur et non un doublon
                        array_push($results["errs"], [
                            "title" => "Erreur à la ligne ".($key+1),
                            "msg" => $singleValidator->errors()->all(),
                        ]);
                        $nb_error ++;
                    }
                } else { // S'il n'y a aucune erreur de validation
                    try { // Essayer d'enregistrer et relever les éventuelles erreurs
                        $beneficiaire = Adherents::create($request2->all());
                        array_push($results["data"], $beneficiaire);
                        $nb_success ++;
                    } catch (\Throwable $th) { // En cas d'une quelconque erreur
                        array_push($results["errs"], [
                            "title" => "Erreur à la ligne ".($key+1),
                            "msg" => $th->getMessage(),
                        ]);
                        $nb_error ++;
                    }
                }
            } catch (\Throwable $th) { // Cas d'une erreur survenue avant la validation : Cas de la date d'Excel
                array_push($results["errs"], [
                    "title" => "Erreur à la ligne ".($key+1),
                    "msg" => ["La date de naissance doit être au format date ".$th->getMessage()],
                ]);
                $nb_error ++;
            }
        }

        // Stocker toutes les informations dans la variable de resultat
        $results["msg"] = "$nb_success bénéficiaires importés avec succès. ".($nb_error ? " $nb_error erreurs." : '').($nb_warning ? " $nb_warning avertissements." : '');
        /* Mettre la variable de resultat dans la session de l'utilisateur pour y avoir accès n'importe où tant que la session est active ou que la variable n'a pas été supprimée de la session */
        session(['resultsBenef' => $results]);
    }
}
