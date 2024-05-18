<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
Route::get('/students/home', [StudentController::class, 'home'])->name('student_home');

Route::get('/signup', [AuthController::class, 'signup'])->name('auth.signup'); // show the sign up form

Route::post('/users', [AuthController::class, 'store'])->name('auth.store'); // register users

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout'); // log users out

Route::get('/login', [AuthController::class, 'login'])->name('auth.login'); // show login form

Route::post('/users/authenticate', [AuthController::class, 'authenticate'])->name('auth.authenticate'); // log users in


Route::get('/company/home', [CompanyController::class, 'home'])->name('company_home');

Route::get('/opportunities/create', [CompanyController::class, 'create'])->name('company.create'); // show the create form

Route::post('/opportunities', [CompanyController::class, 'save'])->name('company.save'); // save opportunities in the database

Route::get('/opportunities/{id}/publish', [CompanyController::class, 'publish'])->name('publish_opportunity'); // publish opportunity

Route::get('/opportunities/{id}/unpublish', [CompanyController::class, 'unpublish'])->name('unpublish_opportunity'); // publish opportunity

Route::get('/opportunities/{id}/delete', [CompanyController::class, 'delete'])->name('delete_opportunity'); // delete an opportunity

Route::get('/opportunities/{opportunity}/edit', [CompanyController::class, 'edit']); // showing the edit opportunity

Route::put('/opportunities/{opportunity}', [CompanyController::class, 'update']); // update opp

Route::get('/opportunities/{opportunityId}/apply', [StudentController::class, 'showApplyForm'])->name('application_form'); /// showing the application form

Route::post('/opportunities/{opportunityId}/apply', [StudentController::class, 'apply'])->name('application.submit'); // send application form

Route::get('/application/success', [StudentController::class, 'applicationSubmited'])->name('application_submitted'); // show the application success page
