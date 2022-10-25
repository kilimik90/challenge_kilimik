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

    public $replaceA = ['Á','É','Í','Ó','Ú','Ñ'];
    public $replaceB = ['A','E','I','O','U','?'];

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
            ['name' => Str::replace($this->replaceA,$this->replaceB,Str::upper($row['d_estado']))]
        );
        //creo municipalities
        $fe = Municipality::updateOrCreate(
            ['key' => (int)$row['c_mnpio']],
            ['name' => Str::replace($this->replaceA,$this->replaceB,Str::upper($row['d_mnpio'])),'federal_entity_id' => (int)$row['c_estado']]
        );
        //creo localities
        $fe = Locality::updateOrCreate(
            ['zip_code' => $row['d_codigo']],
            [
              'locality' => Str::replace($this->replaceA,$this->replaceB,Str::upper(isset($row['d_ciudad'])?$row['d_ciudad']:'')),'federal_entity_id' => (int)$row['c_estado'],
              'municipality_id' => (int)$row['c_mnpio']
            ]
        );
        //creo el settlements
        $fe = Settlement::create(
            [
              'name' => Str::replace($this->replaceA,$this->replaceB,Str::upper($row['d_asenta'])),'zone_type' => Str::replace($this->replaceA,$this->replaceB,Str::upper($row['d_zona'])) ,
              'locality_id' => $row['d_codigo'],
              'federal_entity_id'=>(int)$row['c_estado'],
              'settlement_type_id'=>(int)$row['c_tipo_asenta'],
              'municipality_id'=>(int)$row['c_mnpio'],
              'key' => (int)$row['id_asenta_cpcons']
            ]
        );

        return $st;
    }
}
