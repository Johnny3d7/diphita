<?php

namespace App\Imports;

use App\Helpers\Functions;
use App\Http\Controllers\Admin\AdherentController;
use App\Models\Adherents;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\BeforeImport;
use Maatwebsite\Excel\Row;

class BeneficiairesImport implements ToCollection, WithHeadingRow, WithEvents, WithChunkReading, ShouldQueue // OnEachRow,
{
    public $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // cache()->forget("beneficiaires");
        // cache()->forget("souscripteurs");
        // cache()->forget("ayantdroits");
        // cache()->forget("globalResult");


        // $array =& AdherentController::$globalResult["beneficiaires"];
        $array = cache('beneficiaires');
        $array["statut"] = "Traitement";
        $array["total"] = $collection->count();
        $this->updateCache($array);
        // Tableau de valeurs par defAdherentController::$globalResult["beneficiaires"]aut pour recuperer le resultat de traitement
        $results = [
            "msg" => '',
            "errs" => [],
            "warns" => [],
            "data" => []
        ];

        $nb_success = $nb_error = $nb_warning = 0;

        $status = [
            'title' => "Initialisation du traitement",
            'subtitle' => null,
            'status' => 'pending',
        ];
        // session(['statutAdherent' => $status]);

        foreach ($collection as $key => $row)
        {
            $courant =& $array["courant"];
            $courant['index'] = $key+1;
            $courant['statut'] = 'Demarrage';
            $this->updateCache($array);

            try{
                $courant['statut'] = 'Vérification des données';
                $this->updateCache($array);

                // Création d'une Request en vue de la validation des informations renseignées dans chaque ligne
                $request2 = new Request([
                    'role' => 2, // Bénéficiaire
                    'valide' => 1, // Valider d'office
                    'num_adhesion' => $row['idbeneficiaire'] ? Functions::trimInsideString($row['idbeneficiaire']) : null,
                    'civilite' => $row['civilite'] ?? null,
                    'nom' => $row['nomprenom'] ? trim(explode(' ', $row['nomprenom'])[0]) : null,
                    'pnom' => $row['nomprenom'] ? trim(substr($row['nomprenom'], strlen(explode(' ', $row['nomprenom'])[0]))) : null,
                    'email' => $row['email'] ?? null,
                    'num_cni' => $row['cni'] ?? null,
                    'admin_id' => 1,
                    'date_naiss' => isset($row['datenaissance']) ? Functions::dateFromExcel($row['datenaissance']) : null,
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
                    'num_cni' => 'required|unique:adherents',
                    // 'contact' => 'required',
                ],[
                    "num_adhesion.required" => "Veuillez entrer l'ID bénéficiaire",
                    "num_adhesion.unique" => "Un bénéficiaire possède déjà cet id",
                    "civilite.required" => "Veuillez entrer la civilité",
                    "nom.required"  => "Veuillez entrer le nom et le(s) prénom(s)",
                    "num_cni.required"  => "Veuillez entrer le numero cni",
                    "num_cni.unique"  => "Un bénéficiaire possède déjà ce numero cni",
                    // "contact.required"  => "Veuillez entrer le contact",
                ]);

                $courant['reference'] = $request2->num_adhesion ?? 'Undefined';
                $this->updateCache($array);
                if($singleValidator->fails()){ // Si la validation échoue ou retourne une erreur
                    // Vérification que l'erreur est due à un doublon alors retourner un simple avertissement
                    $exists = Adherents::whereNumAdhesion($request2->num_adhesion)->whereNom($request2->nom)->wherePnom($request2->pnom)->whereEmail($request2->email)->whereNumCni($request2->num_cni)->whereContact($request2->contact)->first();
                    if($exists){
                        $courant['statut'] = 'Donnée existante !';
                        $this->updateCache($array);

                        array_push($results["warns"], [
                            "title" => "Avertissement à la ligne ".($key+1),
                            "msg" => ["Bénéficiaire déjà existant"],
                        ]);
                        $nb_warning ++;
                    } else { // C'est bien une erreur et non un doublon
                        $courant['statut'] = 'Erreur de traitement !';
                        $this->updateCache($array);

                        array_push($results["errs"], [
                            "title" => "Erreur à la ligne ".($key+1),
                            "msg" => $singleValidator->errors()->all(),
                        ]);
                        $nb_error ++;
                    }
                } else { // S'il n'y a aucune erreur de validation
                    $courant['statut'] = 'Traitement ... !';
                    $this->updateCache($array);

                    try { // Essayer d'enregistrer et relever les éventuelles erreurs
                        $beneficiaire = Adherents::create($request2->all());
                        array_push($results["data"], $beneficiaire);
                        $nb_success ++;

                        $courant['statut'] = 'Donnée enregistrée !';
                        $this->updateCache($array);
                    } catch (\Throwable $th) { // En cas d'une quelconque erreur
                        $courant['statut'] = 'Erreur de traitement !';
                        $this->updateCache($array);
                        array_push($results["errs"], [
                            "title" => "Erreur à la ligne ".($key+1),
                            "msg" => $th->getMessage(),
                        ]);
                        $nb_error ++;
                    }
                }
            } catch (\Throwable $th) { // Cas d'une erreur survenue avant la validation : Cas de la date d'Excel
                $courant['statut'] = 'Erreur de traitement !';
                $this->updateCache($array);
                array_push($results["errs"], [
                    "title" => "Erreur à la ligne ".($key+1),
                    "msg" => ["La date de naissance doit être au format date ".$th->getMessage()],
                ]);
                $nb_error ++;
            }
            $courant['statut'] = 'Terminé';
            $this->updateCache($array);
        }
        $array["statut"] = "Finalisation";
        // Stocker toutes les informations dans la variable de resultat
        $results["msg"] = "$nb_success bénéficiaires importés avec succès. ".($nb_error ? " $nb_error erreurs." : '').($nb_warning ? " $nb_warning avertissements." : '');
        /* Mettre la variable de resultat dans la session de l'utilisateur pour y avoir accès n'importe où tant que la session est active ou que la variable n'a pas été supprimée de la session */
        session(['resultsBenef' => $results]);
        $array["results"] = $results;
        $array["statut"] = "Terminé";
        $this->updateCache($array);
        // dd($array);

    }

    private function updateCache($array){
        cache(['beneficiaires' => $array]);

        cache(['globalResult' => [
            "statut" => "En attente",
            "beneficiaires" => cache("beneficiaires"),
            "souscripteurs" => cache("souscripteurs"),
            "ayantdroits" => cache("ayantdroits")
            ]
        ]);
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {
                $totalRows = $event->getReader()->getTotalRows();

                if (filled($totalRows)) {
                    // cache()->forever("total_rows_{$this->id}", array_values($totalRows[0]));
                    cache()->forever("total_rows_{$this->id}", 0);
                    cache()->forever("start_date_{$this->id}", now()->unix());
                }

            },
            AfterImport::class => function (AfterImport $event) {
                cache(["end_date_{$this->id}" => now()], now()->addMinute());
                cache()->forget("total_rows_{$this->id}");
                cache()->forget("start_date_{$this->id}");
                cache()->forget("current_row_{$this->id}");

                cache(['globalResults' => [
                    "statut" => "terminé",
                    "beneficiaires" => cache("beneficiaires"),
                    "souscripteurs" => cache("souscripteurs"),
                    "ayantdroits" => cache("ayantdroits")
                    ]
                ]);
            },
        ];
    }

    public function onRow(Row $row)
    {
        dd($row);
        $rowIndex = $row->getIndex();
        $row      = array_map('trim', $row->toArray());
        cache()->forever("current_row_{$this->id}", $rowIndex);
        // sleep(0.2);

        try{
            // Création d'une Request en vue de la validation des informations renseignées dans chaque ligne
            $request2 = new Request([
                'role' => 2, // Bénéficiaire
                'valide' => 1, // Valider d'office
                'num_adhesion' => $row['idbeneficiaire'] ? Functions::trimInsideString($row['idbeneficiaire']) : null,
                'civilite' => $row['civilite'] ?? null,
                'nom' => $row['nomprenom'] ? trim(explode(' ', $row['nomprenom'])[0]) : null,
                'pnom' => $row['nomprenom'] ? trim(substr($row['nomprenom'], strlen(explode(' ', $row['nomprenom'])[0]))) : null,
                'email' => $row['email'] ?? null,
                'num_cni' => $row['cni'] ?? null,
                'admin_id' => 1,
                'date_naiss' => isset($row['datenaissance']) ? Functions::dateFromExcel($row['datenaissance']) : null,
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
                'num_cni' => 'required|unique:adherents',
                // 'contact' => 'required',
            ],[
                "num_adhesion.required" => "Veuillez entrer l'ID bénéficiaire",
                "num_adhesion.unique" => "Un bénéficiaire possède déjà cet id",
                "civilite.required" => "Veuillez entrer la civilité",
                "nom.required"  => "Veuillez entrer le nom et le(s) prénom(s)",
                "num_cni.required"  => "Veuillez entrer le numero cni",
                "num_cni.unique"  => "Un bénéficiaire possède déjà ce numero cni",
                // "contact.required"  => "Veuillez entrer le contact",
            ]);

            $courant['reference'] = $request2->num_adhesion ?? 'Undefined';
            if($singleValidator->fails()){ // Si la validation échoue ou retourne une erreur
                // Vérification que l'erreur est due à un doublon alors retourner un simple avertissement
                $exists = Adherents::whereNumAdhesion($request2->num_adhesion)->whereNom($request2->nom)->wherePnom($request2->pnom)->whereEmail($request2->email)->whereNumCni($request2->num_cni)->whereContact($request2->contact)->first();
                if($exists){
                    // $courant['statut'] = 'Donnée existante !';

                    /*array_push($results["warns"], [
                        "title" => "Avertissement à la ligne ".($key+1),
                        "msg" => ["Bénéficiaire déjà existant"],
                    ]);
                    $nb_warning ++;*/
                } else { // C'est bien une erreur et non un doublon
                    // $courant['statut'] = 'Erreur de traitement !';

                    /*array_push($results["errs"], [
                        "title" => "Erreur à la ligne ".($key+1),
                        "msg" => $singleValidator->errors()->all(),
                    ]);
                    $nb_error ++;*/
                }
            } else { // S'il n'y a aucune erreur de validation
                // $courant['statut'] = 'Traitement ... !';
                try { // Essayer d'enregistrer et relever les éventuelles erreurs
                    $beneficiaire = Adherents::create($request2->all());
                    /*array_push($results["data"], $beneficiaire);
                    $nb_success ++;*/

                    // $courant['statut'] = 'Donnée enregistrée !';
                } catch (\Throwable $th) { // En cas d'une quelconque erreur
                    // $courant['statut'] = 'Erreur de traitement !';

                    /*array_push($results["errs"], [
                        "title" => "Erreur à la ligne ".($key+1),
                        "msg" => $th->getMessage(),
                    ]);
                    $nb_error ++;*/
                }
            }
        } catch (\Throwable $th) { // Cas d'une erreur survenue avant la validation : Cas de la date d'Excel
            // $courant['statut'] = 'Erreur de traitement !';

            /*array_push($results["errs"], [
                "title" => "Erreur à la ligne ".($key+1),
                "msg" => ["La date de naissance doit être au format date ".$th->getMessage()],
            ]);
            $nb_error ++;*/
        }
        // $courant['statut'] = 'Terminé';
    }

}
