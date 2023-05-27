<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DroneController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProvinceController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Authenticate route
Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    
    // Province routes
    Route::resource('provinces', ProvinceController::class);
    
    // Farmer routes
    Route::resource('farms', FarmController::class);

    // Drone routes
    Route::resource('drones', DroneController::class);

    Route::get('drones/{drone_id}/location', [DroneController::class, 'getLocationBy']);

    Route::put('drones/{drone_id}/instructions/{instruction_id}', [DroneController::class, 'updateDroneInstruction']);

    // Map routes
    Route::resource('maps', MapController::class);

    Route::get('maps/farms/{farm_id}', [MapController::class, 'getMapsBy']);

    // Plan routes
    Route::resource('plans', PlanController::class);

    // Instruction routes
    Route::resource('instructions', InstructionController::class);

    Route::get('instructions/drones/{drone_id}/', [InstructionController::class, 'getInstructionsBy']);
});