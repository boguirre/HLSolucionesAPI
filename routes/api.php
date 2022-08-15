<?php

use App\Http\Controllers\API\AreaController;
use App\Http\Controllers\API\EspecialistaController;
use App\Http\Controllers\API\IncidenteController;
use App\Http\Controllers\API\MarcaController;
use App\Http\Controllers\API\ModeloController;
use App\Http\Controllers\API\SeguimientoController;
use App\Http\Controllers\API\SeguimientoEspController;
use App\Http\Controllers\API\ServicioController;
use App\Http\Controllers\API\ServicioEspController;
use App\Http\Controllers\API\SubAreaController;
use App\Http\Controllers\API\VehiculoController;
use App\Http\Controllers\Auth\AuthController;
use App\Models\Seguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('seguimiento', SeguimientoController::class);
    Route::apiResource('especializado', SeguimientoEspController::class);
    Route::apiResource('vehiculo', VehiculoController::class);
    Route::post('updateVehiculo', [VehiculoController::class, 'updateVehiculo']);
    Route::apiResource('incidente', IncidenteController::class);
    Route::get('servicios', [IncidenteController::class, 'servicios']);
    Route::apiResource('marca', MarcaController::class);
    Route::apiResource('modelo', ModeloController::class);
    Route::get('byMarcas', [ModeloController::class, 'marcas']);
    Route::apiResource('area', AreaController::class);
    Route::apiResource('servicio', ServicioController::class);
    Route::apiResource('servicioesp', ServicioEspController::class);
    Route::apiResource('subarea', SubAreaController::class);
    Route::apiResource('especialista', EspecialistaController::class);
});
