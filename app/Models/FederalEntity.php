<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FederalEntity extends Model
{
    use HasFactory;
    protected $table = 'federal_entities';
    protected $primaryKey = 'key';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
      'key',
      'name',
      'code'
    ];

    protected $casts = [
        'key' => 'integer',
        'name' => 'string',
        'code' => 'integer'
    ];

    public static $rules = [
        'key' => 'required',
        'name' => 'required'
    ];

    public function localities()
    {
        return $this->hasMany(Locality::class,'federal_entity_id','key');
    }

    public function municipalities()
    {
        return $this->hasMany(Municipality::class,'federal_entity_id','key');
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class,'federal_entity_id','key');
    }

}
