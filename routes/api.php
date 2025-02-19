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



//_____________________________________________________________________________________________________________________
//_____________________________________________________________________________________________________________________
//Route::middleware('auth:sanctum')->get('/authentification', function (Request $request) { return $request->user(); });
//Route::apiResource("/user/register", \App\Http\Controllers\api\UserAPIController::class);

Route::post('/user/login', [\App\Http\Controllers\api\UserAPIController::class, 'login']);
Route::post('/user/register', [\App\Http\Controllers\api\UserAPIController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/user/logout', [\App\Http\Controllers\api\UserAPIController::class, 'logout']);
    Route::get('/user', [\App\Http\Controllers\api\UserAPIController::class, 'user']);
});

/*
POSTMAN
http://localhost:8000/api/user/register --> pour l'enregistrement
http://localhost:8000/api/user/login --> pour se connecter
*/



//_____________________________________________________________________________________________________________________

