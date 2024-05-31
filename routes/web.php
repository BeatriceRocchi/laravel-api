<?php

use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\TechnologiesController;
use App\Http\Controllers\Admin\TypesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rotte pubbliche
Route::get('/', [PageController::class, 'index'])->name('home');

// Rotte admin
Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('home');

        // Rotte CRUD
        Route::resource('projects', ProjectsController::class);
        Route::resource('technologies', TechnologiesController::class);
        Route::resource('types', TypesController::class);

        // Rotte custom
        Route::get('projects-type', [TypesController::class, 'projectsByType'])->name('projects-type');
        Route::get('order-by/{direction}/{column}/{toSearch}', [ProjectsController::class, 'orderBy'])->name('order-by');
        Route::get('filter-by', [ProjectsController::class, 'filterBy'])->name('filter-by');
        Route::get('type-filter/{type}', [TypesController::class, 'typeFilter'])->name('type-filter');
        Route::get('tech-filter/{technology}', [TechnologiesController::class, 'techFilter'])->name('tech-filter');
    });

// Rotte authentication
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
