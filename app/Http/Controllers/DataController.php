<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportInputData;
use Exception;

class DataController extends Controller
{
  /*  este enpoint recibe un xls de los obtenidos desde los obtenidos de la pagina de codigos
      postales y los inserta o actualiza en la base de datos.
  */

  public function saveFilePostalCodes(Request $request)
  {
    try{
      if ($request->hasFile('file')) {
        $input = $request->all()['file'];
        if($input->extension()=='xls'){
          Excel::import(new ImportInputData(), $input);
          return ['status'=>'success','message'=>'Archivo cargado con exito'];
        }
      }else{
        return ['error'=>'El input file es obligatorio y en formato xls.'];
      }
    }catch(Exception $e){
      return ['error'=>$e->getMessage()];
    }

  }
}
