<?php

namespace Modules\SimpleForm\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Modules\SimpleForm\Entities\SimpleForm;

class ImportFile implements ToModel, WithChunkReading, ShouldQueue, WithStartRow
{
    use Importable;
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        return new SimpleForm([
            'first_name' => $row[0],
            'second_name' => $row[1],
            'family_name' => $row[2],
            'uid' => $row[3]
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
