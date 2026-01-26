<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\User;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        $dentists = User::whereIn('rolename', ['Tandarts', 'Mondhygienis'])->pluck('id');

        $dates = [
            '2026-01-27 09:00:00',
            '2026-01-27 10:30:00',
            '2026-01-28 11:00:00',
            '2026-01-28 13:30:00',
            '2026-01-29 14:00:00',
            '2026-01-30 15:30:00',
            '2026-02-01 09:15:00',
            '2026-02-02 10:45:00',
        ];

        foreach ($dates as $i => $date) {
            Appointment::create([
                'dentist_id' => $dentists[$i % $dentists->count()],
                'date'       => $date,
                'status'     => 'Bevestigd',
                'is_actief'  => 1,
                'opmerking'  => 'Controle afspraak',
            ]);
        }
    }
}
