<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
//use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ImportInputData implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            0 => null,
            1 => new Import(),
        ];
    }
}
