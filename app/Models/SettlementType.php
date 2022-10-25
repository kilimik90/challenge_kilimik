<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettlementType extends Model
{
    use HasFactory;
    protected $table = 'settlement_types';
    protected $primaryKey = 'key';
    public $incrementing = false;
    public $timestamps = false;

    protected $visible = ['name'];

    protected $fillable = [
      'key',
      'name'
    ];

    protected $casts = [
        'key' => 'integer',
        'name' => 'string'
    ];

    public static $rules = [
        'key' => 'required',
        'name' => 'required',
    ];

    public function settlements()
    {
        return $this->hasMany(Settlement::class,'settlement_type_id','key');
    }
}
