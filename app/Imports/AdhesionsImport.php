<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AdhesionsImport implements WithMultipleSheets, WithHeadingRow
{
    public function sheets(): array
    {
        return [
            'Bénéficiaires' => new BeneficiairesImport(),
            'Souscripteurs' => new SouscripteursImport(),
            'AyantDroit' => new AyantDroitsImport(),
        ];
    }
}
