<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EmployeeAvailability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    // De rollen zoals ze in jouw database staan
    const EMPLOYEE_ROLES = ['Assistent', 'Mondhygiënist', 'Tandarts', 'Praktijkmanagement'];

    /**
     * Toon medewerkersoverzicht.
     */
    public function index()
    {
        $employees = User::whereIn('rolename', self::EMPLOYEE_ROLES)
            ->select('id', 'name', 'rolename', 'email')
            ->orderBy('name')
            ->get();

        return view('employees.index', [
            'employees' => $employees,
            'hasEmployees' => $employees->isNotEmpty(),
        ]);
    }

    /**
     * Formulier nieuwe medewerker.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Opslaan nieuwe medewerker.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'rolename' => 'required|in:' . implode(',', self::EMPLOYEE_ROLES),
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'rolename' => $validated['rolename'],
            'password' => Hash::make('welkom123'),
        ]);

        return redirect()->route('employees.index')
            ->with('success', "Medewerker {$validated['name']} is succesvol toegevoegd.");
    }

    /**
     * Toon beschikbaarheid van een specifieke medewerker.
     */
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

    /**
     * AANGEPAST: Formulier voor beschikbaarheid toevoegen.
     * Nu sturen we ook de lijst met medewerkers mee naar de view.
     */
    public function createAvailability()
    {
        // Haal alle medewerkers op zodat je er eentje kunt kiezen in de dropdown
        $employees = User::whereIn('rolename', self::EMPLOYEE_ROLES)
            ->orderBy('name')
            ->get();

        return view('employees.create-availability', [
            'employees' => $employees
        ]);
    }

    /**
     * AANGEPAST: Sla beschikbaarheid op voor de GEKOZEN gebruiker.
     */
    public function storeAvailability(Request $request)
    {
        $validated = $request->validate([
            'user_id'   => 'required|exists:users,id', // Dit veld komt nu uit het formulier
            'date_from' => 'required|date',
            'date_to'   => 'required|date|after_or_equal:date_from',
            'time_from' => 'required',
            'time_to'   => 'required|after:time_from',
            'status'    => 'required|in:Aanwezig,Afwezig,Verlof,Ziek',
            'comment'   => 'nullable|string',
        ]);

        EmployeeAvailability::create([
            'user_id'   => $validated['user_id'], // Gebruik de gekozen medewerker ID
            'date_from' => $validated['date_from'],
            'date_to'   => $validated['date_to'],
            'time_from' => $validated['time_from'],
            'time_to'   => $validated['time_to'],
            'status'    => $validated['status'],
            'comment'   => $validated['comment'],
        ]);

        // We sturen de gebruiker terug naar het overzicht van de medewerker waarvoor net is ingevuld
        $targetUser = User::find($validated['user_id']);
        
        return redirect()->route('employees.availability', $targetUser)
            ->with('success', 'Beschikbaarheid succesvol toegevoegd.');
    }

    public function editAvailability(EmployeeAvailability $availability)
{
    if (auth()->user()->rolename !== 'Praktijkmanagement' && auth()->user()->rolename !== 'admin') {
        abort(403, 'Geen toegang');
    }
    $employees = User::whereIn('rolename', self::EMPLOYEE_ROLES)->orderBy('name')->get();
    return view('employees.edit-availability', compact('availability', 'employees'));
}

public function updateAvailability(Request $request, EmployeeAvailability $availability)
{
    if (auth()->user()->rolename !== 'Praktijkmanagement' && auth()->user()->rolename !== 'admin') {
        abort(403, 'Geen toegang');
    }
    // Validatie en update logic (zie vorig antwoord)
    $validated = $request->validate([
        'user_id'   => 'required|exists:users,id',
        'date_from' => 'required|date',
        'date_to'   => 'required|date|after_or_equal:date_from',
        'time_from' => 'required',
        'time_to'   => 'required|after:time_from',
        'status'    => 'required|in:Aanwezig,Afwezig,Verlof,Ziek',
        'comment'   => 'nullable|string',
    ]);

    $availability->update($validated);

    return redirect()->route('employees.availability', $availability->user_id)
        ->with('success', 'Beschikbaarheid succesvol bijgewerkt.');
}
}