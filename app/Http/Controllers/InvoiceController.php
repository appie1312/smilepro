<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Patient;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
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

    public function create()
    {
        $patients = Patient::with('person')->whereHas('person')->where('is_actief', true)->get();

        return view('invoices.create', [
            'patients' => $patients,
            'title' => 'Nieuwe Factuur Aanmaken'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:unpaid,paid,overdue',
            'due_date' => 'required|date|after:today',
            'description' => 'nullable|string|max:255',
        ]);

        Invoice::create($request->only(['patient_id', 'amount', 'status', 'due_date', 'description']));

        return redirect()->route('praktijkmanagement.index')->with('success', 'Factuur succesvol aangemaakt.');
    }

    public function manage()
    {
        $invoices = Invoice::with('patient.person')->orderBy('created_at', 'desc')->get();

        return view('invoices.manage', [
            'invoices' => $invoices,
            'title' => 'Alle Facturen'
        ]);
    }

    public function edit(Invoice $invoice)
    {
        $patients = Patient::with('person')->whereHas('person')->where('is_actief', true)->get();

        return view('invoices.edit', [
            'invoice' => $invoice,
            'patients' => $patients,
            'title' => 'Factuur Bewerken'
        ]);
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:unpaid,paid,overdue',
            'due_date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ]);

        $invoice->update($request->only(['patient_id', 'amount', 'status', 'due_date', 'description']));

        return redirect()->route('invoices.manage')->with('success', 'Factuur succesvol bijgewerkt.');
    }
}
