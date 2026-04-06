<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Voyage;

class VoyageSeeder extends Seeder
{
    public function run(): void
    {
        Voyage::insert([
            [
                'code_voyage' => 'ONCF001',
                'heureDepart' => '08:00:00',
                'villeDepart' => 'Rabat',
                'heureDarrivee' => '09:30:00',
                'villeDarrivee' => 'Casablanca',
                'prixVoyage' => 80.00,
            ],
            [
                'code_voyage' => 'ONCF002',
                'heureDepart' => '10:00:00',
                'villeDepart' => 'Casablanca',
                'heureDarrivee' => '12:00:00',
                'villeDarrivee' => 'Marrakech',
                'prixVoyage' => 120.00,
            ],
            [
                'code_voyage' => 'ONCF003',
                'heureDepart' => '14:00:00',
                'villeDepart' => 'Tanger',
                'heureDarrivee' => '18:00:00',
                'villeDarrivee' => 'Rabat',
                'prixVoyage' => 150.00,
            ]
        ]);
    }
}