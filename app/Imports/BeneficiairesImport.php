<?php

namespace App\Imports;

use App\Models\Adherents;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class BeneficiairesImport implements ToCollection, WithHeadingRow
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
            $request2 = new Request([
                'num_adhesion' => $row['idbeneficiaire'],
                'civilite' => $row['civilite'],
                'nom' => $row['nomprenom'],
                'pnom' => $row['nomprenom'],
                'email' => $row['email'],
                'num_cni' => $row['cni'],
                'date_naiss' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['datenaissance'])),
                'lieu_naiss' => $row['lieunaissance'],
                'lieu_hab' => $row['lieuhabitation'],
                'contact' => $row['contact'],
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
                "num_adhesion.required" => "Veuillez entrer l'ID Bénéficiaire",
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
                array_push($results["errs"], [
                    "title" => "Erreur à la ligne ".($key+1),
                    "msg" => $singleValidator->errors()->all(),
                ]);
                $nb_error ++;
            } else {
                $beneficiaire = Adherents::create([
                    'role' => 2,
                    'num_adhesion' => $row['idbeneficiaire'],
                    'civilite' => $row['civilite'],
                    'nom' => $row['nomprenom'],
                    'pnom' => $row['nomprenom'],
                    'email' => $row['email'],
                    'num_cni' => $row['cni'],
                    'date_naiss' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['datenaissance'])),
                    'lieu_naiss' => $row['lieunaissance'],
                    'lieu_hab' => $row['lieuhabitation'],
                    'contact' => $row['contact'],
                    'cas' => (isset($row['Cas']) && $row['Cas'] == "Oui") ? 1 : 0,
                ]);
                $beneficiaire->save();
                array_push($results["data"], $beneficiaire);
                $nb_success ++;
            }
            
        }
        // dd(Adherents::all());
        $results["msg"] = "$nb_success bénéficiaires importés avec succès. ".($nb_error ? " $nb_error erreurs." : '').($nb_warning ? " $nb_warning avertissements." : '');
        dd($results);
        return $results;
    }
}
