<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    use HasFactory;
    protected $table = 'settlements';
    protected $primaryKey = 'key';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
      'key',
      'name',
      'zone_type',
      'locality_id',
      'federal_entity_id',
      'settlement_type_id',
      'municipality_id'
    ];

    protected $casts = [
        'key' => 'integer',
        'name' => 'string',
        'zone_type' => 'string',
        'locality_id' => 'string',
        'federal_entity_id' => 'integer',
        'settlement_type_id' => 'integer',
        'municipality_id' => 'integer',
    ];

    public static $rules = [
        'key' => 'required',
        'name' => 'required',
        'zone_type' => 'required',
        'locality_id' => 'required',
        'federal_entity_id' => 'required',
        'settlement_type_id' => 'required',
        'municipality_id' => 'required',
    ];

    protected $visible = ['key','name','zone_type','settlementType'];

    public function locality()
    {
        return $this->belongsTo(Locality::class,'locality_id');
    }

    public function settlementType()
    {
        return $this->belongsTo(SettlementType::class,'settlement_type_id');
    }

    public function federalEntity()
    {
        return $this->belongsTo(FederalEntity::class,'federal_entity_id');
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class,'municipality_id');
    }

}
