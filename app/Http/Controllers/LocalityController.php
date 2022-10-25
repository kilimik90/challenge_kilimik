<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Locality;
use Illuminate\Support\Facades\Redis;


class LocalityController extends Controller
{

  public function zip_codes($zip_code)
  {
    $use_redis = config('app.use_redis');
    if($use_redis){
      $data = Redis::get($zip_code);
      if(isset($data)){
        return json_decode($data);
      }else{
        $data = Locality::getLocalityData($zip_code);
        if(isset($data['zip_code'])){
          Redis::set($zip_code, json_encode($data));
        }
        return $data;
      }
    }else{
      $data = Locality::getLocalityData($zip_code);
      return $data;
    }
  }
}
