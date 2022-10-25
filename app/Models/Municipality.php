<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;
    protected $table = 'municipalities';
    protected $primaryKey = 'key';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
      'key',
      'name',
      'federal_entity_id'
    ];

    protected $casts = [
        'key' => 'integer',
        'name' => 'string',
        'federal_entity_id' => 'integer'
    ];

    public static $rules = [
        'key' => 'required',
        'name' => 'required',
        'federal_entity_id' => 'integer'
    ];

    public function federalEntity()
    {
        return $this->belongsTo(FederalEntity::class,'federal_entity_id');
    }

    public function settlements()
    {
        return $this->hasMany(Settlement::class,'municipality_id','key');
    }

    public function localities()
    {
        return $this->hasMany(Locality::class,'municipality_id','key');
    }
}
