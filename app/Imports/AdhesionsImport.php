<?php
namespace App\Imports;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AdhesionsImport implements WithMultipleSheets, WithHeadingRow, WithChunkReading, ShouldQueue
{
    public $id;

    // use WithConditionalSheets;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    // public function conditionalSheets(): array
    public function sheets(): array
    {
        return [
            'Bénéficiaires' => new BeneficiairesImport($this->id),
            'Souscripteurs' => new SouscripteursImport(),
            'AyantDroit' => new AyantDroitsImport(),
        ];
    }

    public function chunkSize(): int
    {
        return 100;
    }

}
