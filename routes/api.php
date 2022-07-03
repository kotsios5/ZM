<?php

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

Route::prefix('v1')->group(function() {
    // Route::apiResource('locations', \App\Http\Controllers\V1\LocationController::class);
    // Route::get('locations/{latitude}/{longitude}/{radius}', [\App\Http\Controllers\V1\LocationController::class, 'getLocations']);
    Route::post('locations', [\App\Http\Controllers\V1\LocationController::class, 'getLocations']);
});
