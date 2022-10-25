<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\LocalityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::post('/saveFilePostalCodes',[DataController::class, 'saveFilePostalCodes']);
Route::get('/zip_codes/{zip_code}',[LocalityController::class, 'zip_codes']);
Route::get('/test',[LocalityController::class, 'test']);
