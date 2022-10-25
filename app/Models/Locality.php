<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locality extends Model
{
    use HasFactory;
    protected $table = 'localities';
    protected $primaryKey = 'zip_code';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
      'zip_code',
      'locality',
      'federal_entity_id',
      'municipality_id'
    ];

    protected $casts = [
        'zip_code' => 'string',
        'locality' => 'string',
        'federal_entity_id' => 'integer',
        'municipality_id' => 'integer'
    ];

    public static $rules = [
        'zip_code' => 'required|max:20',
        'locality' => 'required',
        'federal_entity_id' => 'required',
        'municipality_id' => 'required'
    ];

    public function federalEntity()
    {
        return $this->belongsTo(FederalEntity::class,'federal_entity_id');
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class,'municipality_id');
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class,'locality_id','zip_code');
    }

    public function makeResponse(){

    }

    public static function getLocalityData($zip_code){
      $locality = Locality::where('zip_code',$zip_code)
        ->with(['municipality','federalEntity','settlements','settlements.settlementType'])->first();
      if(isset($locality)){
        return $data = [
          'zip_code'=>$locality->zip_code,
          'locality'=>$locality->locality,
          'federal_entity'=>[
            'key'=>$locality->federalEntity->key,
            'name'=>$locality->federalEntity->name,
            'code'=>$locality->federalEntity->code,
          ],
          'settlements'=>$locality->settlements->makeHidden(['locality_id','federal_entity_id','settlement_type_id','municipality_id','settlement_type']),
          'municipality'=>$locality->municipality->makeHidden(['federal_entity_id'])
        ];
    }
    return [];
  }
}
