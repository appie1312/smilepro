<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
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