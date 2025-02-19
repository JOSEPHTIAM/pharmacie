<?php


use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Auth\LoginController;


// Routes d'authentification
Route::get('login', [\App\Http\Controllers\api\UserAPIController::class, 'showLoginForm'])->name('login');
Route::post('login', [\App\Http\Controllers\api\UserAPIController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\api\UserAPIController::class, 'logout'])->name('logout');

// Autres routes d'authentification si nécessaire
















