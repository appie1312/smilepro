<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VerkomendeBehandelingenService;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function verkomendeBehandelingen(\App\Services\VerkomendeBehandelingenService $service)
    {
        $rows = $service->ophalenVerkomendeBehandelingen();

        if ($rows->isEmpty()) {
            return view('dashboard.verkomende-behandelingen', [
                'rows' => [],
                'message' => 'Er zijn op dit moment geen verkomende behandelingen',
            ]);
        }

        return view('dashboard.verkomende-behandelingen', [
            'rows' => $rows,
            'message' => null,
        ]);
    }


    public function overzicht(Request $request)
    {
        // dit is de pagina waar je “naar een ander overzicht word geleid” na login
        return view('overzicht');
    }

    public function beheren(Request $request)
    {
        return view('dashboard_beheren');
    }
}
