<?php

use App\Http\Controllers\PlatformController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//-------------------- Platform -----------------------------------
Route::get('/platform',[PlatformController::class,'index'])->name('platform.index');
Route::post('/platform',[PlatformController::class,'store'])->name('platform.store');
Route::put('/platform',[PlatformController::class,'update'])->name('platform.update');
Route::delete('/platform',[PlatformController::class,'destroy'])->name('platform.destroy');
//-----------------------------------------------------------------