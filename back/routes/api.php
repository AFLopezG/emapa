<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::resource('maquinaria',App\Http\Controllers\MaquinariaController::class);
Route::resource('equipo',App\Http\Controllers\EquipoController::class);
Route::resource('actividad',App\Http\Controllers\ActivityController::class);
Route::resource('trabajo',App\Http\Controllers\TrabajoController::class);
Route::resource('mantenimiento',App\Http\Controllers\MantenimientoController::class);
Route::resource('inventario',App\Http\Controllers\InventarioController::class);
Route::resource('compra',App\Http\Controllers\CompraController::class);
Route::get('listUser',[App\Http\Controllers\UserController::class,'listUser']);
Route::get('listEq',[App\Http\Controllers\EquipoController::class,'listEq']);
Route::get('listCrono',[App\Http\Controllers\TrabajoController::class,'listCrono']);
Route::get('listReg',[App\Http\Controllers\ActivityController::class,'listReg']);
Route::get('listPlan/{fecha}',[App\Http\Controllers\TrabajoController::class,'listPlan']);
Route::post('listAvance',[App\Http\Controllers\TrabajoController::class,'listAvance']);
Route::get('listEqTip',[App\Http\Controllers\EquipoController::class,'listEqTip']);

Route::post('regRevision',[App\Http\Controllers\TrabajoController::class,'regRevision']);
Route::get('filtroEqTip/{ubicacion}',[App\Http\Controllers\EquipoController::class,'filtroEqTip']);
Route::post('estadistica',[App\Http\Controllers\TrabajoController::class,'estadistica']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
