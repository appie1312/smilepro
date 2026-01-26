<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnhappyVerkomendeBehandelingenSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('Appointment')->truncate();
    }
}
