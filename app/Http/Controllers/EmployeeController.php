<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmployeeAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    const EMPLOYEE_ROLES = ['Assistent', 'Mondhygiënist', 'Tandarts', 'Praktijkmanagement'];

    // --- BESTAANDE METHODES (Overzicht) ---

    public function index()
    {
        $employees = User::whereIn('role', self::EMPLOYEE_ROLES)
            ->select('id', 'name', 'role', 'specialization', 'is_active')
            ->orderBy('name')
            ->get();

        return view('employees.index', [
            'employees' => $employees,
            'hasEmployees' => $employees->isNotEmpty(),
        ]);
    }

    public function showAvailability(User $employee)
    {
        $availabilities = $employee->availabilities()
            ->orderBy('date_from')
            ->orderBy('time_from')
            ->get();

        return view('employees.availability', [
            'employee' => $employee,
            'availabilities' => $availabilities,
            'hasAvailability' => $availabilities->isNotEmpty(),
        ]);
    }

    // --- NIEUWE SCENARIO 1: MEDEWERKER TOEVOEGEN ---

    /**
     * Toon formulier om nieuwe medewerker toe te voegen.
     */
    public function create()
    {
        // Alleen praktijkmanagement mag dit (in een echte app check je hier rechten)
        return view('employees.create');
    }

    /**
     * Sla de nieuwe medewerker op in de database.
     */
    public function store(Request $request)
    {
        // 1. Validatie (Unhappy path: Ontbrekende data)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:' . implode(',', self::EMPLOYEE_ROLES),
            'specialization' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Dit veld is verplicht.',
            'email.unique' => 'Dit e-mailadres is al in gebruik.',
            'role.required' => 'Selecteer een medewerkertype.',
        ]);

        // 2. Aanmaken (Happy path)
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'specialization' => $validated['specialization'],
            'password' => Hash::make('welkom123'), // Standaard wachtwoord
            'is_active' => true,
        ]);

        // 3. Feedback en redirect
        return redirect()->route('employees.index')
            ->with('success', "Medewerker {$validated['name']} is succesvol toegevoegd.");
    }

    // --- NIEUWE SCENARIO 2: BESCHIKBAARHEID INSTELLEN ---

    /**
     * Toon formulier voor eigen beschikbaarheid.
     */
    public function createAvailability()
    {
        return view('employees.create-availability');
    }

    /**
     * Sla de beschikbaarheidsregel op.
     */
    public function storeAvailability(Request $request)
    {
        // 1. Validatie (Unhappy path: Ongeldige tijden)
        $validated = $request->validate([
            'date_from' => 'required|date',
            'date_to'   => 'required|date|after_or_equal:date_from',
            'time_from' => 'required',
            'time_to'   => 'required|after:time_from', // Zorgt dat eindtijd na starttijd ligt
            'status'    => 'required|in:Aanwezig,Afwezig,Verlof,Ziek',
            'comment'   => 'nullable|string',
        ], [
            'time_to.after' => "De 'Tijd tot en met' moet later zijn dan de 'Tijd vanaf'.",
            'date_to.after_or_equal' => "De einddatum mag niet voor de startdatum liggen.",
        ]);

        // 2. Opslaan (Happy path)
        EmployeeAvailability::create([
            'user_id' => Auth::id(), // Koppel aan de ingelogde gebruiker
            'date_from' => $validated['date_from'],
            'date_to' => $validated['date_to'],
            'time_from' => $validated['time_from'],
            'time_to' => $validated['time_to'],
            'status' => $validated['status'],
            'comment' => $validated['comment'],
        ]);

        // 3. Redirect naar eigen overzicht
        return redirect()->route('employees.availability', Auth::user())
            ->with('success', 'Nieuwe beschikbaarheidsregel is succesvol toegevoegd.');
    }
}