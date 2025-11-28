<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mondhygienist', [App\Http\Controllers\MondhygienistController::class, 'index'])
    ->name('mondhygienist.index')
    ->middleware(['auth', 'role:mondhygienist']);

Route::get('/assistent', [App\Http\Controllers\AssistentController::class, 'index'])
    ->name('assistent.index')
    ->middleware(['auth', 'role:assistent']);

Route::get('/praktijkmanagement', [App\Http\Controllers\PraktijkmanagementController::class, 'index'])
    ->name('praktijkmanagement.index')
    ->middleware(['auth', 'role:praktijkmanagement']);

Route::get('/tandarts', [App\Http\Controllers\TandartsController::class, 'index'])
    ->name('tandarts.index')
    ->middleware(['auth', 'role:tandarts']);

Route::get('/patient', [App\Http\Controllers\PatientController::class, 'index'])
    ->name('patient.index')
    ->middleware(['auth', 'role:patient']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
