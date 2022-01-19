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
        /*Adherents::create([
            'role' => 2,
            'slug' => "CNI001-sahi-zoh-mondesir",
            'num_adhesion' => "Ad0001",
            'civilite' => "M",
            'nom' => "Sahi",
            'pnom' => "Zoh Mondesir",
            'email' => "sahidesir34@gmail.com",
            'num_cni' => "CNI0010",
            'date_naiss' => new DateTime(),
            'lieu_naiss' => "Bouaké",
            'lieu_hab' => "Abobo",
            'contact' => "077990452979",
            'cas' => 0,
        ]);*/
        $results = [
            "msg" => '',
            "errs" => [],
            "warns" => [],
            "data" => []
        ];

        $nb_success = $nb_error = $nb_warning = 0;
        
        foreach ($collection as $key => $row) 
        {
            $request2 = new Request([
                'role' => 2,
                // 'slug' => $row['cni'].$row['nomprenom'],
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

            if($singleValidator->fails()){   
                $exists = Adherents::whereNumAdhesion($request2->num_adhesion)->whereNom($request2->nom)->wherePnom($request2->pnom)->whereEmail($request2->email)->whereNumCni($request2->num_cni)->whereContact($request2->contact)->first();
                // dd($request2->num_adhesion, $request2->nom, $request2->pnom, $request2->email, $request2->num_cni, $request2->contact);
                if($exists){
                    array_push($results["warns"], [
                        "title" => "Avertissement à la ligne ".($key+1),
                        "msg" => ["Bénéficiaire déjà existant"],
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
                    $beneficiaire = Adherents::create($request2->all());
                    array_push($results["data"], $beneficiaire);
                    $nb_success ++;
                } catch (\Throwable $th) {
                    array_push($results["errs"], [
                        "title" => "Erreur à la ligne ".($key+1),
                        "msg" => $th->getMessage(),
                    ]);
                    $nb_error ++;
                }
            }
            
        }
        $results["msg"] = "$nb_success bénéficiaires importés avec succès. ".($nb_error ? " $nb_error erreurs." : '').($nb_warning ? " $nb_warning avertissements." : '');
        session(['resultsBenef' => $results]);
        // return $results;
    }
}
