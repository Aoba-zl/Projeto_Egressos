<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//-------------------- Company ------------------------------------
Route::get('/company',[CompanyController::class,'index'])->name('company.index');
Route::get('/company/{id}',[CompanyController::class,'show'])->name('company.show');
Route::post('/company',[CompanyController::class,'store'])->name('company.store');
Route::put('/company',[CompanyController::class,'update'])->name('company.update');
Route::delete('/company',[CompanyController::class,'destroy'])->name('company.destroy');
//-----------------------------------------------------------------
Route::post('new-user', [UserController::class, 'store']);

