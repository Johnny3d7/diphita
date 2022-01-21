<?php

namespace App\Imports;

use App\Models\Adherents;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SouscripteursImport implements ToCollection, WithHeadingRow
{
    function getNumContrat($numeroAdhesion){
        // DIP100220S0010  ===> CF-00010
        return "CF-".substr($numeroAdhesion, 10);
    }
    
    function getDateAdhesion($numeroAdhesion){
        // DIP100220B0004  ===> 10/02/2020
        return new DateTime(substr($numeroAdhesion, 3, 2) .'-'. substr($numeroAdhesion, 5, 2) .'-20'. substr($numeroAdhesion, 7, 2));
    }

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
            $souscripteur = null; // initialisation pour une création ou une mise à jour des bénéficiaires
            try{
                // Création d'une Request en vue de la validation des informations renseignées dans chaque ligne
                $request2 = new Request([
                    'role' => 1, // Souscripteur
                    'valide' => 1, // Valider d'office
                    'num_adhesion' => $row['idsouscripteur'],
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
                    'beneficiaire1' => $row['beneficiaire1'] ?? null,
                    'beneficiaire2' => $row['beneficiaire2'] ?? null,
                    'beneficiaire3' => $row['beneficiaire3'] ?? null,
                    'beneficiaire4' => $row['beneficiaire4'] ?? null,
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
                    "num_adhesion.required" => "Veuillez entrer l'ID souscripteur",
                    "num_adhesion.unique" => "Un souscripteur possède déjà cet id",
                    "civilite.required" => "Veuillez entrer la civilité",
                    "nom.required"  => "Veuillez entrer le nom et le(s) prénom(s)",
                    "email.unique"  => "Un souscripteur possède déjà cet email",
                    "num_cni.required"  => "Veuillez entrer le numero cni",
                    "num_cni.unique"  => "Un souscripteur possède déjà ce numero cni",
                    "contact.required"  => "Veuillez entrer le contact",
                    "contact.unique"  => "Un souscripteur possède déjà ce contact",
                ]);

                if($singleValidator->fails()){ // Si la validation échoue ou retourne une erreur
                    // Vérification que l'erreur est due à un doublon alors retourner un simple avertissement
                    $souscripteur = $exists = Adherents::whereNumAdhesion($request2->num_adhesion)->whereNom($request2->nom)->wherePnom($request2->pnom)->whereEmail($request2->email)->whereNumCni($request2->num_cni)->whereContact($request2->contact)->first();
                    
                    if($exists){
                        array_push($results["warns"], [
                            "title" => "Avertissement à la ligne ".($key+1),
                            "msg" => ["Souscripteur déjà existant"],
                        ]);
                        $nb_warning ++;


                        if($souscripteur){
                            $msg = [];
                            // Retrouver tous les bénéficiaires du souscripteur par leur numero d'adhésion
                            for ($i=0; $i < 4; $i++) { 
                                $beneficiaire = $request2->{'beneficiaire'.$i}; // recuperer le champs bénéficiaire si renseigné
                                // dd('here', $beneficiaire, $souscripteur);
                                if($beneficiaire){
                                    $bene = Adherents::whereRole(2)->whereNumAdhesion($beneficiaire)->first(); // test de l'existance du bénéficiare dans la base de données
                                    if($bene){
                                        // Mise à jour du champs parent du bénéficiaire par l'ID du souscripteur
                                        $bene->update([
                                            "parent" => $souscripteur->id,
                                            "num_contrat" => $souscripteur->num_contrat
                                        ]);
                                    } else {
                                        array_push($msg,"Ce numereo ne correspond à aucun bénéficiaire");
                                    }
                                }
                            }
                            if(count($msg)){
                                array_push($results["warns"], [
                                    "title" => "Avertissement à la ligne ".($key+1),
                                    "msg" => $msg,
                                ]);
                                $nb_warning ++;
                            }
                        }


                    } else { // C'est bien une erreur et non un doublon
                        array_push($results["errs"], [
                            "title" => "Erreur à la ligne ".($key+1),
                            "msg" => $singleValidator->errors()->all(),
                        ]);
                        $nb_error ++;
                    }
                } else { // S'il n'y a aucune erreur de validation
                    try { // Essayer d'enregistrer et relever les éventuelles erreurs
                        $request2->merge([
                            "num_contrat" => $this->getNumContrat($request2->num_adhesion),
                            "date_adhesion" => $this->getDateAdhesion($request2->num_adhesion),
                        ]);
                        $souscripteur = Adherents::create($request2->all());
                        array_push($results["data"], $souscripteur);
                        $nb_success ++;

                        if($souscripteur){
                            $msg = [];
                            // Retrouver tous les bénéficiaires du souscripteur par leur numero d'adhésion
                            for ($i=0; $i < 4; $i++) { 
                                $beneficiaire = $request2->{'beneficiaire'.$i}; // recuperer le champs bénéficiaire si renseigné
                                if($beneficiaire){
                                    $bene = Adherents::whereRole(2)->whereNumAdhesion($beneficiaire)->first(); // test de l'existance du bénéficiare dans la base de données
                                    if($bene){
                                        // Mise à jour du champs parent du bénéficiaire par l'ID du souscripteur
                                        $bene->update([
                                            "parent" => $souscripteur->id,
                                            "num_contrat" => $souscripteur->num_contrat
                                        ]);
                                    } else {
                                        array_push($msg,"Ce numereo ne correspond à aucun bénéficiaire");
                                    }
                                }
                            }
                            if(count($msg)){
                                array_push($results["warns"], [
                                    "title" => "Avertissement à la ligne ".($key+1),
                                    "msg" => $msg,
                                ]);
                                $nb_warning ++;
                            }
                        }

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
            // dd($souscripteur, "YEs");
            if($souscripteur){
                $msg = [];
                // Retrouver tous les bénéficiaires du souscripteur par leur numero d'adhésion
                for ($i=0; $i < 4; $i++) { 
                    $beneficiaire = $request2->{'beneficiaire'.$i}; // recuperer le champs bénéficiaire si renseigné
                    if($beneficiaire){
                        $bene = Adherents::whereRole(2)->whereNumAdhesion($beneficiaire)->first(); // test de l'existance du bénéficiare dans la base de données
                        if($bene){
                            // Mise à jour du champs parent du bénéficiaire par l'ID du souscripteur
                            $bene->update([
                                "parent" => $souscripteur->id,
                                "num_contrat" => $souscripteur->num_contrat
                            ]);
                        } else {
                            array_push($msg,"Ce numereo ne correspond à aucun bénéficiaire");
                        }
                    }
                }
                if(count($msg)){
                    array_push($results["warns"], [
                        "title" => "Avertissement à la ligne ".($key+1),
                        "msg" => $msg,
                    ]);
                    $nb_warning ++;
                }
            }
        }
        // Stocker toutes les informations dans la variable de resultat
        $results["msg"] = "$nb_success souscripteurs importés avec succès. ".($nb_error ? " $nb_error erreurs." : '').($nb_warning ? " $nb_warning avertissements." : '');
        
        /* Mettre la variable de resultat dans la session de l'utilisateur pour y avoir accès n'importe où tant que la session est active ou que la variable n'a pas été supprimée de la session */
        session(['resultsSousc' => $results]);
    }
}
