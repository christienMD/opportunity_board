<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\OpportunityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)
     ->group(function () {
         Route::post('/signup' , 'signup');
         Route::post('/login' , 'login');
         Route::post('/logout' , 'logout')
               ->middleware('auth:sanctum');
});


Route::apiResource('opportunities' , OpportunityController::class);
