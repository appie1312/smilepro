<?php

// database/seeders/OmzetSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OmzetSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('omzetten')->insert([
            [
                'omschrijving' => 'Omzet per klant',
                'klant_naam' => 'Patient A',
                'datum' => '2025-12-01',
                'bedrag' => 3500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'omschrijving' => 'Omzet heel jaar',
                'klant_naam' => 'Patient B',
                'datum' => '2025-12-15',
                'bedrag' => 4500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
