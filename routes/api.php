<?php

use App\Http\Controllers\Api\ApplicationsController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\OpportunityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', [AuthController::class, 'profile'])->middleware('auth:sanctum');


/**
 * Manage Authentication Methods
 * 
 */
Route::controller(AuthController::class)
    ->group(function () {
        Route::post('/signup', 'signup');
        Route::post('/login', 'login');
        Route::post('/logout', 'logout')
            ->middleware('auth:sanctum');
    });

/**
 * Manage opportunities
 */
Route::apiResource('opportunities', OpportunityController::class);
Route::controller(OpportunityController::class)
    ->group(function () {

        Route::post('opportunities/{id}/publish', 'publish')
            ->middleware('auth:sanctum');
        Route::post('opportunities/{id}/unpublish', 'unpublish')
            ->middleware('auth:sanctum');
    });

/**
 * Manage applications
 */

Route::controller(ApplicationsController::class)
    ->group(function () {
        Route::get('/applications', 'index');
        Route::post('/opportunities/{opportunity}/applications', 'store');
    });
