<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->rolename !== 'admin') {
            abort(403, 'Alleen praktijkmanagement kan facturen aanmaken.');
        }

        // Get patients (users with role patient?)
        $patients = User::where('rolename', 'patient')->get();

        return view('invoices.create', compact('patients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->rolename !== 'admin') {
            abort(403, 'Alleen praktijkmanagement kan facturen aanmaken.');
        }

        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|string',
            'due_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Invoice::create($request->all());

        return redirect()->back()->with('success', 'Factuur aangemaakt.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
