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
        
            [
                'omschrijving' => 'Omzet per kwartaal',
                'klant_naam' => 'Patient C',
                'datum' => '2025-11-20',
                'bedrag' => 2750.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'omschrijving' => 'Omzet per maand',
                'klant_naam' => 'Patient D',
                'datum' => '2025-10-10',
                'bedrag' => 1500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'omschrijving' => 'Omzet per dienst',
                'klant_naam' => 'Patient E',
                'datum' => '2025-09-05',
                'bedrag' => 2000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
