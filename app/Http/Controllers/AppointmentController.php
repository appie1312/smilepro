<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    // Deze had je al: statistieken + misschien later lijst
    public function index()
    {
        $totalAppointments    = Appointment::count();
        $todayAppointments    = Appointment::whereDate('date', today())->count();
        $upcomingAppointments = Appointment::whereDate('date', '>=', today())->count();

        $last7Days = Appointment::select(
            DB::raw('DATE(date) as day'),
            DB::raw('COUNT(*) as total')
        )
            ->whereDate('date', '>=', now()->subDays(6)->toDateString())
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        return view('appointments.index', compact(
            'totalAppointments',
            'todayAppointments',
            'upcomingAppointments',
            'last7Days'
        ));
    }

    // Management: tabel met alle afspraken
    public function manage()
    {
        // beveiliging: alleen praktijkmanagement/admin
        if (!auth()->check() || auth()->user()->rolename !== 'admin') {
            abort(403, 'Alleen praktijkmanagement kan afspraken beheren.');
        }

        $appointments = Appointment::orderBy('datum')
            ->orderBy('tijd')
            ->paginate(10);

        return view('appointments.manage', compact('appointments'));
    }

    // Afspraak verwijderen
    public function destroy(Appointment $appointment)
    {
        if (!auth()->check() || auth()->user()->rolename !== 'admin') {
            abort(403, 'Alleen praktijkmanagement kan afspraken beheren.');
        }

        $appointment->delete();

        return redirect()
            ->route('appointments.manage')
            ->with('status', 'Afspraak is verwijderd.');
    }


    // Alleen voor management – bv. dashboard beheren
    public function managementDashboard()
    {
        // Hier kun je later beheer-functies plaatsen
        return view('management.dashboard');
    }



    public function myAppointments()
    {
        $user = auth()->user();

        // alleen Tandarts en Mondhygienis
        if (! in_array($user->rolename, ['Tandarts', 'Mondhygienis'])) {
            abort(403, 'Alleen behandelaars kunnen hun eigen afspraken zien.');
        }

        // Find the employee record for this user
        $employee = $user->person?->employee;
        if (!$employee) {
            abort(403, 'Geen medewerker record gevonden.');
        }

        $appointments = Appointment::where('employee_id', $employee->id)
            ->orderBy('datum')
            ->orderBy('tijd')
            ->get();

        return view('appointments.my', compact('appointments'));
    }
}
