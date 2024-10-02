<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PlatformController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//-----------------------------------------------------------------
//----------------------- FEEDBACK -----------------------------------
Route::get('/feedback',[FeedbackController::class,'index'])->name('feedback.index');
Route::post('/feedback',[FeedbackController::class,'store'])->name('feedback.store');
Route::get('/feedback/{id}',[FeedbackController::class,'show'])->name('feedback.show');
Route::put('/feedback',[InstitutionController::class,'update'])->name('feedback.update');
//-------------------- Company ------------------------------------
Route::get('/company',[CompanyController::class,'index'])->name('company.index');
Route::get('/company/{id}',[CompanyController::class,'show'])->name('company.show');
Route::post('/company',[CompanyController::class,'store'])->name('company.store');
Route::put('/company',[CompanyController::class,'update'])->name('company.update');
Route::delete('/company',[CompanyController::class,'destroy'])->name('company.destroy');
//-----------------------------------------------------------------
//-------------------- Instituicao --------------------------------
Route::get('/institution',[InstitutionController::class,'index'])->name('institution.index');
Route::post('/institution',[InstitutionController::class,'store'])->name('institution.store');
Route::put('/institution',[InstitutionController::class,'update'])->name('institution.update');
Route::delete('/institution',[InstitutionController::class,'destroy'])->name('institution.delete');
//-----------------------------------------------------------------
//-------------------- Platform -----------------------------------
//                      !! Travar para apenas admin dps
Route::get('/platform',[PlatformController::class,'index'])->name('platform.index');
Route::post('/platform',[PlatformController::class,'store'])->name('platform.store');
Route::put('/platform',[PlatformController::class,'update'])->name('platform.update');
Route::delete('/platform',[PlatformController::class,'destroy'])->name('platform.destroy');
//-----------------------------------------------------------------
//--------------------- Courses -----------------------------------
Route::get('/course',[CourseController::class,'index'])->name('course.index');
Route::post('/course',[CourseController::class,'store'])->name('course.store');
Route::put('/course',[CourseController::class,'update'])->name('course.update');
Route::delete('/course',[CourseController::class,'destroy'])->name('course.delete');
//-----------------------------------------------------------------
//----------------------- USERS -----------------------------------
Route::post('login',[UserController::class,'login']);
Route::post('/new-user', [UserController::class, 'store']);

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
//-----------------------------------------------------------------
//-----------------------  -----------------------------------