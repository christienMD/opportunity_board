<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;



Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

Route::controller(AuthController::class)
      ->name('auth.')
      ->group(function () {
          Route::get('/signup', [AuthController::class, 'signup'])->name('signup'); // show the sign up form
          
          Route::post('/users', [AuthController::class, 'store'])->name('store'); // register users
          
          Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); // log users out
          
          Route::get('/login', [AuthController::class, 'login'])->name('login'); // show login form
          
          Route::post('/users/authenticate', [AuthController::class, 'authenticate'])->name('authenticate'); // log users in
      });

Route::controller(CompanyController::class)
      ->prefix('opportunities')
      ->name('company.')
      ->group( function () {
          
          Route::get('/company/home', 'home')->name('index');
          
          Route::get('/create', 'create')->name('create'); // show the create form
          
          Route::post('', 'store')->name('store'); // save in the database
          
          Route::get('/{id}/publish', 'publish')->name('publish'); // publish opportunity
          
          Route::get('/{id}/unpublish', 'unpublish')->name('unpublish'); // publish opportunity
          
          Route::get('/{id}/delete', 'delete')->name('delete'); // delete an opportunity
          
          Route::get('/{opportunity}/edit', 'edit'); // showing the edit opportunity
          
          Route::put('/{opportunity}', 'update'); // update opp
          
        });

/**
 * This route group handles the student application process for opportunities.
 * 
 * - GET /opportunities/{id}/apply
 *   Route::apply()
 *   Shows the application form for a specific opportunity.
 * 
 * - POST /opportunities/{id}/apply
 *   Route::submit()
 *   Submits the application form for a specific opportunity.
 * 
 * - GET /opportunities/application/success
 *   Route::success()
 *   Shows the application success page.
 */
Route::controller(StudentController::class)
      ->prefix('opportunities')
      ->name('student.')
      ->group( function () { 
          Route::get('/students/home', 'index')->name('index');
        
          Route::get('/{id}/apply', 'apply')->name('apply'); // showing the application form
          
          Route::post('/{id}/apply', 'submit')->name('submit'); // send application form
          
          Route::get('/application/success', 'success')->name('success'); // show the application success page
      });

