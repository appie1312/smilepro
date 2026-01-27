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

    // --- LEZEN (Voor iedereen) ---

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

    // --- BEHEREN (Alleen Management) ---
    // Helper functie om toegang te checken
    private function checkAccess() {
        $role = strtolower(trim(auth()->user()->rolename));
        if ($role !== 'praktijkmanagement' && $role !== 'admin') {
            abort(403, 'Geen toegang');
        }
    }

    public function create()
    {
        $this->checkAccess();
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $this->checkAccess();
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

        return redirect()->route('employees.index')->with('success', "Medewerker {$validated['name']} toegevoegd.");
    }

    public function edit(User $employee)
    {
        $this->checkAccess();
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, User $employee)
    {
        $this->checkAccess();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $employee->id,
            'rolename' => 'required|in:' . implode(',', self::EMPLOYEE_ROLES),
        ]);

        $employee->update($validated);
        return redirect()->route('employees.index')->with('success', 'Medewerker bijgewerkt.');
    }

    public function destroy(User $employee)
    {
        $this->checkAccess();
        if (Auth::id() === $employee->id) {
            return redirect()->route('employees.index')->with('error', 'Je kunt jezelf niet verwijderen.');
        }
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Medewerker verwijderd.');
    }

    public function createAvailability()
    {
        $this->checkAccess();
        $employees = User::whereIn('rolename', self::EMPLOYEE_ROLES)->orderBy('name')->get();
        return view('employees.create-availability', ['employees' => $employees]);
    }

    public function storeAvailability(Request $request)
    {
        $this->checkAccess();
        $validated = $request->validate([
            'user_id'   => 'required|exists:users,id',
            'date_from' => 'required|date',
            'date_to'   => 'required|date|after_or_equal:date_from',
            'time_from' => 'required',
            'time_to'   => 'required|after:time_from',
            'status'    => 'required|in:Aanwezig,Afwezig,Verlof,Ziek',
            'comment'   => 'nullable|string',
        ]);

        EmployeeAvailability::create($validated);
        return redirect()->route('employees.availability', $validated['user_id'])->with('success', 'Beschikbaarheid toegevoegd.');
    }

    public function editAvailability(EmployeeAvailability $availability)
    {
        $this->checkAccess();
        $employees = User::whereIn('rolename', self::EMPLOYEE_ROLES)->orderBy('name')->get();
        return view('employees.edit-availability', compact('availability', 'employees'));
    }

    public function updateAvailability(Request $request, EmployeeAvailability $availability)
    {
        $this->checkAccess();
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
        return redirect()->route('employees.availability', $availability->user_id)->with('success', 'Beschikbaarheid bijgewerkt.');
    }

    public function destroyAvailability(EmployeeAvailability $availability)
    {
        $this->checkAccess();
        $userId = $availability->user_id; 
        $availability->delete();
        return redirect()->route('employees.availability', $userId)->with('success', 'Beschikbaarheid verwijderd.');
    }
}