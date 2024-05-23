<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

/**
 * Auth Controller.
 *
 * Manage Authentication
 */
Route::controller(AuthController::class)
    ->name('auth.')
    ->group(function () {
        Route::get('/signup', 'signup')->name('signup'); // show the sign up form

        Route::post('/users', 'store')->name('store'); // register users

        Route::post('/logout', 'logout')->name('logout'); // log users out

        Route::get('/login', 'login')->name('login'); // show login form

        Route::post('/users/authenticate', 'authenticate')->name('authenticate'); // log users in
    });

/**
 * Company Controller.
 *
 * Manage all company operations
 */
Route::get('/company/home', [CompanyController::class, 'index'])->name('company.index');
Route::controller(CompanyController::class)
    ->prefix('opportunities')
    ->name('company.')
    ->group(function () {

        Route::get('/create', 'create')->name('create'); // show the create form

        Route::post('/create', 'store')->name('store'); // save in the database

        Route::get('/{id}/publish', 'publish')->name('publish'); // publish opportunity

        Route::get('/{id}/unpublish', 'unpublish')->name('unpublish'); // publish opportunity

        Route::get('/{id}/delete', 'destroy')->name('delete'); // delete an opportunity

        Route::get('/{opportunity}/edit', 'edit'); // showing the edit opportunity

        Route::put('/{opportunity}', 'update'); // update opp

    });
Route::get('/opportunity/{id}', [CompanyController::class, 'show']);

/**
 * Student Controller.
 *
 * Manage all student operations
 */
Route::get('/students/home', [StudentController::class, 'index'])->name('student.index');
Route::controller(StudentController::class)
    ->prefix('opportunities')
    ->name('student.')
    ->group(function () {

        Route::get('/{id}/apply', 'apply')->name('apply'); // showing the application form

        Route::post('/{id}/submit', 'store')->name('submit'); // send application form

        Route::get('/application/success', 'success')->name('success'); // show the application success page
    });
