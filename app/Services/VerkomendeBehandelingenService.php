<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class VerkomendeBehandelingenService
{
    public function ophalenVerkomendeBehandelingen()
    {
        return DB::table('appointments as a')
            ->join('people as p', 'p.user_id', '=', 'a.dentist_id')
            ->where('a.date', '>=', now()->toDateString())
            ->where('a.is_actief', 1)
            ->select(
                'a.date',
                'a.status',
                'a.opmerking',
                'p.voornaam',
                'p.tussenvoegsel',
                'p.achternaam'
            )
            ->selectRaw("'10:00' as tijd")
            ->selectRaw("'Afspraak' as afspraak")
            ->selectRaw("'Controle' as behandeling")
            ->orderBy('a.date')
            ->get();
    }
}
