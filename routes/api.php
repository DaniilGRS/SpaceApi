<?php

use App\Http\Controllers\api\AuthController as ApiAuthController;
use App\Http\Controllers\api\LunarMissionController;
use App\Http\Controllers\api\SpaceCraftController;
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

Route::post('/registration', [ApiAuthController::class, 'register']);
Route::post('/authorization', [ApiAuthController::class, 'login']);
Route::get('/logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/spacecraft', [SpaceCraftController::class, 'create']);
Route::delete('/spacecraft/{id}', [SpaceCraftController::class, 'destroy']);
Route::patch('/spacecraft/{id}', [SpaceCraftController::class, 'update']);
Route::get('/spacecraft/{id}', [SpaceCraftController::class, 'show']);

Route::post('/lunar-missions', [LunarMissionController::class, 'store']);
Route::get('/lunar-missions/{mission_id}', [LunarMissionController::class, 'show']);
Route::patch('/lunar-missions/{mission_id}', [LunarMissionController::class, 'update']);
Route::delete('/lunar-missions/{mission_id}', [LunarMissionController::class, 'destroy']);