<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\StudentHomeController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
Route::get('/students/home', [StudentHomeController::class, 'home'])->name('student_home');

Route::get('/signup', [AuthController::class, 'signup'])->name('auth.signup'); // show the sign up form

Route::post('/users', [AuthController::class, 'store'])->name('auth.store'); // register users

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout'); // log users out

Route::get('/login', [AuthController::class, 'login'])->name('auth.login'); // show login form

Route::post('/users/authenticate', [AuthController::class, 'authenticate'])->name('auth.authenticate'); // log users in


Route::get('/company/home', [CompanyController::class, 'home'])->name('company_home');

Route::post('/opportunities', [CompanyController::class, 'save'])->name('company.save'); // save opportunities in the database

Route::get('/opportunities/create', [CompanyController::class, 'create'])->name('company.create'); // show the create form

Route::post('/opportunities/{id}/publish', [CompanyController::class, 'publishOpportunity'])->name('publishOpportunity');

