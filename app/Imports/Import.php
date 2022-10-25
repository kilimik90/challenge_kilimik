<?php

namespace App\Imports;

use App\Models\SettlementType;
use App\Models\FederalEntity;
use App\Models\Locality;
use App\Models\Municipality;
use App\Models\Settlement;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Support\Str;


class Import implements ToModel,WithHeadingRow
{

    public function model(array $row)
    {

        //creo settlement_types
        $st = SettlementType::updateOrCreate(
            ['key' => (int)$row['c_tipo_asenta']],
            ['name' => $row['d_tipo_asenta']]
        );
        //creo federal_entities
        $fe = FederalEntity::updateOrCreate(
            ['key' => (int)$row['c_estado']],
            ['name' => Str::upper($row['d_estado'])]
        );
        //creo municipalities
        $fe = Municipality::updateOrCreate(
            ['key' => (int)$row['c_mnpio']],
            ['name' => Str::upper($row['d_mnpio']),'federal_entity_id' => (int)$row['c_estado']]
        );
        //creo localities
        $fe = Locality::updateOrCreate(
            ['zip_code' => $row['d_codigo']],
            [
              'locality' => Str::upper(isset($row['d_ciudad'])?$row['d_ciudad']:'undefined'),'federal_entity_id' => (int)$row['c_estado'],
              'municipality_id' => (int)$row['c_mnpio']
            ]
        );
        //creo el settlements
        $fe = Settlement::updateOrCreate(
            ['key' => (int)$row['id_asenta_cpcons']],
            [
              'name' => Str::upper($row['d_asenta']),'zone_type' => Str::upper($row['d_zona']),
              'locality_id' => $row['d_codigo'],
              'federal_entity_id'=>(int)$row['c_estado'],
              'settlement_type_id'=>(int)$row['c_tipo_asenta'],
              'municipality_id'=>(int)$row['c_mnpio']
            ]
        );

        return $st;
    }
}
