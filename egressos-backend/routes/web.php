<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\EgressController;
use App\Http\Controllers\AcademicFormationController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\ProfessionalProfileController;

Route::get('/', [HomeController::class , 'index'])->name('home');

Route::resource('graduates', EgressController::class);

Route::resource('assessments', AssessmentController::class);


Route::get('/users', [UserController::class , 'index'])
        ->name('user.index');
Route::get('/users/{user}', [UserController::class , 'show'])
        ->name('user.show');
Route::post('/users', [UserController::class , 'store'])
        ->name('user.store');
Route::put('/users/{user}', [UserController::class , 'update'])
        ->name('user.update');
Route::delete('/users/{user}', [UserController::class , 'destroy'])
        ->name('user.destroy');


Route::get('/academicformations', [AcademicFormationController::class , 'index'])
        ->name('academicformation.index');
Route::get('/academicformations/{academicformation}', [AcademicFormationController::class , 'show'])
        ->name('academicformation.show');
Route::post('/academicformations', [AcademicFormationController::class , 'store'])
        ->name('academicformation.store');
Route::put('/academicformations/{academicformation}', [AcademicFormationController::class , 'update'])
        ->name('academicformation.update');
Route::delete('/academicformations/{academicformation}', [AcademicFormationController::class , 'destroy'])
        ->name('academicformation.destroy');


Route::get('/addresses', [AddressController::class , 'index'])
        ->name('address.index');
Route::get('/addresses/{address}', [AddressController::class , 'show'])
        ->name('address.show');
Route::post('/addresses', [AddressController::class , 'store'])
        ->name('address.store');
Route::put('/addresses/{address}', [AddressController::class , 'update'])
        ->name('address.update');
Route::delete('/addresses/{address}', [AddressController::class , 'destroy'])
        ->name('address.destroy');


Route::get('/companies', [CompanyController::class , 'index'])
        ->name('company.index');
Route::get('/companies/{company}', [CompanyController::class , 'show'])
        ->name('company.show');
Route::post('/companies', [CompanyController::class , 'store'])
        ->name('company.store');
Route::put('/companies/{uscompanyer}', [CompanyController::class , 'update'])
        ->name('company.update');
Route::delete('/companies/{company}', [CompanyController::class , 'destroy'])
        ->name('company.destroy');


Route::get('/contacts/{contact}', [ContactController::class , 'index'])
        ->name('contact.index');
Route::get('/contacts/{contact}', [ContactController::class , 'show'])
        ->name('contact.show');
Route::post('/contacts', [ContactController::class , 'store'])
        ->name('contact.store');
Route::put('/contacts/{contact}', [ContactController::class , 'update'])
        ->name('contact.update');
Route::delete('/contacts/{contact}', [ContactController::class , 'destroy'])
        ->name('contact.destroy');


Route::get('/courses', [CourseController::class , 'index'])
        ->name('course.index');
Route::get('/courses/{course}', [CourseController::class , 'show'])
        ->name('course.show');
Route::post('/courses', [CourseController::class , 'store'])
        ->name('course.store');
Route::put('/courses/{course}', [CourseController::class , 'update'])
        ->name('course.update');
Route::delete('/courses/{course}', [CourseController::class , 'destroy'])
        ->name('course.destroy');


Route::get('/feedbacks', [FeedbackController::class , 'index'])
        ->name('feeback.index');
Route::get('/feedbacks/{feeback}', [FeedbackController::class , 'show'])
        ->name('feeback.show');
Route::post('/feedbacks', [FeedbackController::class , 'store'])
        ->name('feeback.store');
Route::put('/feedbacks/{feeback}', [FeedbackController::class , 'update'])
        ->name('feeback.update');
Route::delete('/feedbacks/{feeback}', [FeedbackController::class , 'destroy'])
        ->name('feeback.destroy');


Route::get('/institutions', [InstitutionController::class , 'index'])
        ->name('institution.index');
Route::get('/institutions/{institution}', [InstitutionController::class , 'show'])
        ->name('institution.show');
Route::post('/institutions', [InstitutionController::class , 'store'])
        ->name('institution.store');
Route::put('/institutions/{institution}', [InstitutionController::class , 'update'])
        ->name('institution.update');
Route::delete('/institutions/{institution}', [InstitutionController::class , 'destroy'])
        ->name('institution.destroy');


Route::get('/platforms', [PlatformController::class , 'index'])
        ->name('platform.index');
Route::get('/platforms/{platform}', [PlatformController::class , 'show'])
        ->name('platform.show');
Route::post('/platforms', [PlatformController::class , 'store'])
        ->name('platform.store');
Route::put('/platforms/{platform}', [PlatformController::class , 'update'])
        ->name('platform.update');
Route::delete('/platforms/{platform}', [PlatformController::class , 'destroy'])
        ->name('platform.destroy');


Route::get('/professionalprofiles', [ProfessionalProfileController::class , 'index'])
        ->name('professionalprofile.index');
Route::get('/professionalprofiles/{professionalprofile}', [ProfessionalProfileController::class , 'show'])
        ->name('professionalprofile.show');
Route::post('/professionalprofiles', [ProfessionalProfileController::class , 'store'])
        ->name('professionalprofile.store');
Route::put('/professionalprofiles/{professionalprofile}', [ProfessionalProfileController::class , 'update'])
        ->name('professionalprofile.update');
Route::delete('/professionalprofiles/{professionalprofile}', [ProfessionalProfileController::class , 'destroy'])
        ->name('professionalprofile.destroy');


