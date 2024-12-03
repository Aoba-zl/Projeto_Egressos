<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewsController;

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

Route::get('/', [ViewsController::class , 'index'])->name('home');
Route::get('index', [ViewsController::class, 'index'])->name('home');

Route::get('homemoderador', [ViewsController::class, 'homeModerador'])->name('home_moderador');
Route::get('visualizarPerfil', [ViewsController::class, 'visualizarPerfil'])->name('visualizarPerfil');

Route::get('login', [ViewsController::class, 'login'])->name('login');

Route::get('cadastro', [ViewsController::class, 'cadastro'])->name('cadastro');
Route::get('cadastro2', [ViewsController::class, 'cadastro2'])->name('cadastro2');

Route::get('buscaDeAlunos', [ViewsController::class, 'buscaDeAlunos'])->name('buscaDeAlunos');

Route::get('avaliacao', [ViewsController::class, 'avaliacao'])->name('avaliacao');

Route::get('novaSenha', [ViewsController::class, 'novaSenha'])->name('novaSenha');
Route::get('redefinirSenha', [ViewsController::class, 'redefinirSenha'])->name('redefinirSenha');

Route::get('updateEgress', [ViewsController::class, 'updateEgress'])->name('updateEgress');
