<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

Route::middleware(['auth'])->group(function () {

    Route::get('/appointments', [AppointmentController::class, 'index'])
        ->name('appointments.index');

    Route::get('/mijn-afspraken', [AppointmentController::class, 'myAppointments'])
        ->name('appointments.my');

    // Management: afspraken beheren (alleen praktijkmanagement/admin)
    Route::get('/management/appointments', [AppointmentController::class, 'manage'])
        ->name('appointments.manage');

    Route::delete('/management/appointments/{appointment}', [AppointmentController::class, 'destroy'])
        ->name('appointments.destroy');
});

Route::get('/mijn-afspraken', [AppointmentController::class, 'myAppointments'])
    ->name('appointments.my');



// Alleen Praktijkmanagement / admin
// Alleen Praktijkmanagement / admin mag dit
Route::get('/management-dashboard', function () {
        // Zorg dat user ingelogd is
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Check rolnaam (admin / praktijkmanagement)
        if (auth()->user()->rolename !== 'admin') {
            abort(403, 'Geen toegang — Alleen praktijkmanagement mag dit zien.');
        }

        return 'Welkom Praktijkmanager!';
    })->name('management.dashboard');




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
    ->middleware(['auth', 'role:patient,praktijkmanagement']);

    

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
