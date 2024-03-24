<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParticipantController;

Route::post('auth/register', [AuthController::class, 'create']);
Route::post('auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::prefix('postgraduate/')->group(function(){
        Route::resource('participants', ParticipantController::class);
        Route::get('logout', [AuthController::class, 'logout']);
    });
});

