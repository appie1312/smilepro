<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OmzetController;
use App\Http\Controllers\InvoiceController;

Route::middleware(['auth'])->group(function () {

    // --- AFSPRAKEN ---
    Route::get('/appointments', [AppointmentController::class, 'index'])
        ->name('appointments.index');

    Route::get('/mijn-afspraken', [AppointmentController::class, 'myAppointments'])
        ->name('appointments.my');

    // Management: afspraken beheren (Deze waren weggevallen)
    Route::get('/management/appointments', [AppointmentController::class, 'manage'])
        ->name('appointments.manage');

    Route::delete('/management/appointments/{appointment}', [AppointmentController::class, 'destroy'])
        ->name('appointments.destroy');

    // --- FACTUREN (INVOICES) - DEZE ONTBRAKEN ---
    // Dit herstelt de foutmelding "Route [invoices.manage] not defined"
    Route::get('/invoices/create', [InvoiceController::class, 'create'])
        ->name('invoices.create')
        ->middleware('role:praktijkmanagement');

    Route::post('/invoices', [InvoiceController::class, 'store'])
        ->name('invoices.store')
        ->middleware('role:praktijkmanagement');
        
    Route::get('/invoices/manage', [InvoiceController::class, 'manage'])
        ->name('invoices.manage')
        ->middleware('role:praktijkmanagement');

    // Resource voor admin/algemeen (zorgt voor edit/update/destroy routes)
    Route::resource('invoices', InvoiceController::class);

    // --- MEDEWERKERS & BESCHIKBAARHEID ---

    // 1. Overzicht & Inzien (Voor iedereen)
    Route::get('/medewerkers', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/medewerkers/{employee}/beschikbaarheid', [EmployeeController::class, 'showAvailability'])->name('employees.availability');
    
    // Medewerkers aanmaken
    Route::get('/medewerkers/toevoegen', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/medewerkers', [EmployeeController::class, 'store'])->name('employees.store');

    // Medewerkers wijzigen & verwijderen
    Route::get('/medewerkers/{employee}/bewerken', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/medewerkers/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/medewerkers/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

    // Beschikbaarheid aanmaken
    Route::get('/beschikbaarheid/toevoegen', [EmployeeController::class, 'createAvailability'])->name('employees.availability.create');
    Route::post('/beschikbaarheid', [EmployeeController::class, 'storeAvailability'])->name('employees.availability.store');

    // Beschikbaarheid wijzigen & verwijderen
    Route::get('/beschikbaarheid/{availability}/bewerken', [EmployeeController::class, 'editAvailability'])->name('employees.availability.edit');
    Route::put('/beschikbaarheid/{availability}', [EmployeeController::class, 'updateAvailability'])->name('employees.availability.update');
    Route::delete('/beschikbaarheid/{availability}', [EmployeeController::class, 'destroyAvailability'])->name('employees.availability.destroy');
});

// --- OVERIGE ROUTES ---

// Alleen Praktijkmanagement / admin dashboard check
Route::get('/management-dashboard', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    if (auth()->user()->rolename !== 'admin') {
        abort(403, 'Geen toegang — Alleen praktijkmanagement mag dit zien.');
    }
    return view('dashboard_beheren');
})->name('management.dashboard');


// Na login overzicht (landing)
Route::middleware(['auth'])->group(function () {
    Route::get('/overzicht', [DashboardController::class, 'overzicht'])->name('overzicht');

    Route::get('/dashboard-beheren', [DashboardController::class, 'beheren'])
        ->middleware('praktijkmanagement')
        ->name('dashboard.beheren');

    Route::get('/omzet', [OmzetController::class, 'index'])
        ->middleware('praktijkmanagement')
        ->name('omzet.index');
});


Route::get('/', function () {
    return view('welcome');
});

// Rol-specifieke routes
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

// Facturen overzicht voor patient
Route::get('/facturen', [InvoiceController::class, 'index'])
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