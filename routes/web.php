<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\PreinscritoController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\InfoseccionController;
use App\Http\Controllers\DiaController;
use App\Http\Controllers\ConfInscripcionController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// 'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class)->names('users');
    Route::resource('alumnos', AlumnoController::class)->names('alumnos');
    Route::resource('docentes', DocenteController::class)->names('docentes');
    Route::resource('preinscritos', PreinscritoController::class)->names('preinscritos')->except('store', 'create', 'destroy');
    Route::resource('masters', MasterController::class)->names('masters');
    Route::resource('plans', PlanController::class)->names('plans');
    Route::resource('periodos', PeriodoController::class)->names('periodos');
    Route::resource('infoseccions', InfoseccionController::class)->names('infoseccions');
    Route::resource('dias', DiaController::class)->except('show', 'index', 'edit');
    Route::resource('conf-inscripcions', ConfInscripcionController::class)->names('conf-inscripcions')->except('show');
    Route::resource('inscripcions', InscripcionController::class)->names('inscripcions')->except('show', 'edit', 'create');
    Route::get('/about', fn () => Inertia::render('About'))->name('about');

    Route::get('inscribir/{cedula}', [InscripcionController::class, 'inscribir'])->name('inscribir');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
