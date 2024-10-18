<?php

use App\Http\Controllers\AcademicFormationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EgressController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ImageController;
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
//----------------------- Academic Formation ----------------------
Route::post('/acad-formation',[AcademicFormationController::class,'store']);
Route::get('/acad-formation',[AcademicFormationController::class,'index']);
Route::get('/acad-formation/{id}',[AcademicFormationController::class,'show']);
Route::put('/acad-formation/{id}',[AcademicFormationController::class,'update']);

//-----------------------------------------------------------------
//----------------------- EGRESSES -----------------------------------
Route::get('all-egresses',[EgressController::class,'index']);
Route::get('egresses', [EgressController::class, 'searchByName']);
Route::get('egresses/{id}', [EgressController::class, 'show']);
Route::get('egresses-random', [EgressController::class, 'getRandom']);

Route::get('/egresses', [EgressController::class , 'index']);;
Route::post('/egresses', [EgressController::class , 'store']);
Route::put('/egresses/{egress}', [EgressController::class , 'update']);
Route::delete('/egresses/{egress}', [EgressController::class , 'disable']);

Route::get('/storage/uploads/{image_path}', [ImageController::class , 'image']);
//-----------------------------------------------------------------
//----------------------- FEEDBACK -----------------------------------
Route::get('/feedback',[FeedbackController::class,'index'])->name('feedback.index');
Route::post('/feedback',[FeedbackController::class,'store'])->name('feedback.store');
Route::get('/feedback/{id}',[FeedbackController::class,'show'])->name('feedback.show');
Route::put('/feedback',[FeedbackController::class,'update'])->name('feedback.update');
//-------------------- Company ------------------------------------
Route::get('/company/search', [CompanyController::class, 'searchByName']);
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
Route::get('/institution/search', [InstitutionController::class, 'searchByName']);
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
Route::get('/course/search', [CourseController::class, 'searchByName']);

//-----------------------------------------------------------------
//------------------------Contact----------------------------------
Route::get('/contact',[ContactController::class,'index']);
Route::post('/contact',[ContactController::class,'store']);
Route::put('/contact',[ContactController::class,'update']);
Route::delete('/contact',[ContactController::class,'destroy']);

//-----------------------------------------------------------------
//----------------------- USERS -----------------------------------
Route::post('login',[UserController::class,'login']);
Route::post('/new-user', [UserController::class, 'store']);
Route::put('/user/{id}', [UserController::class, 'update']);

//-----------------------------------------------------------------


/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/
//-----------------------------------------------------------------
//-----------------------  -----------------------------------
