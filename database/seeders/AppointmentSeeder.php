<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\User;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        // 1 patient
        $patientId = User::where('rolename', 'Patient')->value('id')
            ?? User::first()->id;

        // 1 behandelaar (eerst Mondhygienis, anders Tandarts)
        $dentistId = User::where('rolename', 'Mondhygienis')->value('id')
            ?? User::where('rolename', 'Tandarts')->value('id')
            ?? User::first()->id;

        $data = [
            [
                'patient_id'        => $patientId,
                'dentist_id'        => $dentistId,
                'customer_name'     => 'Mohammad',
                'appointment_time'  => '10:00',
                'appointment_date'  => '2025-12-01',
                'date'              => '2025-12-01 10:00:00',
                'with_whom'         => 'Tanderts',
                'phone'             => '06*******',
                'address'           => 'Mijdrecht',
            ],
            [
                'patient_id'        => $patientId,
                'dentist_id'        => $dentistId,
                'customer_name'     => 'Odi',
                'appointment_time'  => '10:30',
                'appointment_date'  => '2025-12-02',
                'date'              => '2025-12-02 10:30:00',
                'with_whom'         => 'Tanderts',
                'phone'             => '06*******',
                'address'           => 'Mijdrecht',
            ],
            [
                'patient_id'        => $patientId,
                'dentist_id'        => $dentistId,
                'customer_name'     => 'Simon',
                'appointment_time'  => '11:00',
                'appointment_date'  => '2025-12-03',
                'date'              => '2025-12-03 11:00:00',
                'with_whom'         => 'Mondhygienis',
                'phone'             => '06*******',
                'address'           => 'Mijdrecht',
            ],
            [
                'patient_id'        => $patientId,
                'dentist_id'        => $dentistId,
                'customer_name'     => 'Danile',
                'appointment_time'  => '11:30',
                'appointment_date'  => '2025-12-04',
                'date'              => '2025-12-04 11:30:00',
                'with_whom'         => 'Mondhygienis',
                'phone'             => '06*******',
                'address'           => 'Mijdrecht',
            ],
            [
                'patient_id'        => $patientId,
                'dentist_id'        => $dentistId,
                'customer_name'     => 'Munair',
                'appointment_time'  => '12:00',
                'appointment_date'  => '2025-12-07',
                'date'              => '2025-12-07 12:00:00',
                'with_whom'         => 'Tanderts',
                'phone'             => '06*******',
                'address'           => 'Mijdrecht',
            ],
        ];

        foreach ($data as $item) {
            Appointment::create($item);
        }
    }
}
