<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Patient;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    // Toon facturen van de ingelogde patiënt
    public function index()
    {
        $user = auth()->user();
        $patient = $user->person->patient ?? null;

        if (!$patient) {
            return view('invoices.index', [
                'invoices' => collect(),
                'title' => 'Mijn Facturen'
            ]);
        }

        $invoices = $patient->invoices()->orderBy('created_at', 'desc')->get();

        return view('invoices.index', [
            'invoices' => $invoices,
            'title' => 'Mijn Facturen'
        ]);
    }

    // Toon formulier voor nieuwe factuur
    public function create()
    {
        $patients = Patient::with('person')->whereHas('person')->where('is_actief', true)->get();

        return view('invoices.create', [
            'patients' => $patients,
            'title' => 'Nieuwe Factuur Aanmaken'
        ]);
    }

    // Sla nieuwe factuur op
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:unpaid,paid,overdue',
            'due_date' => 'required|date|after:today',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            Invoice::create($request->only(['patient_id', 'amount', 'status', 'due_date', 'description']));

            return redirect()->route('praktijkmanagement.index')->with('success', 'Factuur succesvol aangemaakt.');
        } catch (\Exception $e) {
            return back()->with('error', 'Er is een fout opgetreden bij het aanmaken van de factuur: ' . $e->getMessage());
        }
    }

    // Toon overzicht van alle facturen voor praktijkmanagement
    public function manage()
    {
        $invoices = Invoice::with('patient.person')->orderBy('created_at', 'desc')->get();

        return view('invoices.manage', [
            'invoices' => $invoices,
            'title' => 'Alle Facturen'
        ]);
    }

    // Toon formulier om factuur te bewerken
    public function edit(Invoice $invoice)
    {
        $patients = Patient::with('person')->whereHas('person')->where('is_actief', true)->get();

        return view('invoices.edit', [
            'invoice' => $invoice,
            'patients' => $patients,
            'title' => 'Factuur Bewerken'
        ]);
    }

    // Werk factuur bij
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:unpaid,paid,overdue',
            'due_date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            $invoice->update($request->only(['patient_id', 'amount', 'status', 'due_date', 'description']));

            return redirect()->route('invoices.manage')->with('success', 'Factuur succesvol bijgewerkt.');
        } catch (\Exception $e) {
            return back()->with('error', 'Er is een fout opgetreden bij het bijwerken van de factuur: ' . $e->getMessage());
        }
    }

    // Verwijder factuur
    public function destroy(Invoice $invoice)
    {
        try {
            $invoice->delete();

            return redirect()->route('invoices.manage')->with('success', 'Factuur succesvol verwijderd.');
        } catch (\Exception $e) {
            return back()->with('error', 'Er is een fout opgetreden bij het verwijderen van de factuur: ' . $e->getMessage());
        }
    }
}
