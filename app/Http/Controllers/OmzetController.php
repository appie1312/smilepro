<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class OmzetController extends Controller
{
    public function index()
    {
        // Stored procedure call:
        $omzetten = DB::select('CALL sp_get_omzetten()');

        // $omzetten is een array van stdClass objects
        return view('omzet.index', [
            'omzetten' => $omzetten,
        ]);
    }
}