<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EmployeeController;

Route::middleware(['auth'])->group(function () {

    Route::get('/appointments', [AppointmentController::class, 'index'])
        ->name('appointments.index');

    Route::get('/mijn-afspraken', [AppointmentController::class, 'myAppointments'])
        ->name('appointments.my');

    // Overzicht
    Route::get('/medewerkers', [EmployeeController::class, 'index'])->name('employees.index');
    
    // SCENARIO 1: Nieuwe medewerker
    Route::get('/medewerkers/toevoegen', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/medewerkers', [EmployeeController::class, 'store'])->name('employees.store');

    // Beschikbaarheid inzien (bestaand)
    Route::get('/medewerkers/{employee}/beschikbaarheid', [EmployeeController::class, 'showAvailability'])
        ->name('employees.availability');

    // SCENARIO 2: Eigen beschikbaarheid toevoegen
    Route::get('/mijn-beschikbaarheid/toevoegen', [EmployeeController::class, 'createAvailability'])
        ->name('employees.availability.create');
    Route::post('/mijn-beschikbaarheid', [EmployeeController::class, 'storeAvailability'])
        ->name('employees.availability.store');
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

        return view('dashboard_beheren');
    })->name('management.dashboard');


// Na login overzicht (landing)
Route::middleware(['auth'])->group(function () {
    Route::get('/overzicht', [DashboardController::class, 'overzicht'])->name('overzicht');

    // Dashboard beheren (alleen praktijkmanagement)
    Route::get('/dashboard-beheren', [DashboardController::class, 'beheren'])
        ->middleware('praktijkmanagement')
        ->name('dashboard.beheren');

    // Omzet bekijken (alleen praktijkmanagement)
    Route::get('/omzet', [OmzetController::class, 'index'])
        ->middleware('praktijkmanagement')
        ->name('omzet.index');
});


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

Route::get('/facturen', [App\Http\Controllers\InvoiceController::class, 'index'])
    ->name('invoices.index')
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
