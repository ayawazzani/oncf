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
                'heureDepart' => '06:30:00',
                'villeDepart' => 'Tanger',
                'heureDarrivee' => '08:40:00',
                'villeDarrivee' => 'Casablanca',
                'prixVoyage' => 150.00,
            ],
            [
                'code_voyage' => 'ONCF002',
                'heureDepart' => '07:00:00',
                'villeDepart' => 'Tanger',
                'heureDarrivee' => '09:10:00',
                'villeDarrivee' => 'Rabat',
                'prixVoyage' => 110.00,
            ],
            [
                'code_voyage' => 'ONCF003',
                'heureDepart' => '08:00:00',
                'villeDepart' => 'Casablanca',
                'heureDarrivee' => '10:30:00',
                'villeDarrivee' => 'Marrakech',
                'prixVoyage' => 120.00,
            ],
            [
                'code_voyage' => 'ONCF004',
                'heureDepart' => '09:00:00',
                'villeDepart' => 'Rabat',
                'heureDarrivee' => '11:20:00',
                'villeDarrivee' => 'Fès',
                'prixVoyage' => 95.00,
            ],
            [
                'code_voyage' => 'ONCF005',
                'heureDepart' => '10:15:00',
                'villeDepart' => 'Fès',
                'heureDarrivee' => '12:30:00',
                'villeDarrivee' => 'Meknès',
                'prixVoyage' => 45.00,
            ],
            [
                'code_voyage' => 'ONCF006',
                'heureDepart' => '11:00:00',
                'villeDepart' => 'Casablanca',
                'heureDarrivee' => '12:15:00',
                'villeDarrivee' => 'El Jadida',
                'prixVoyage' => 55.00,
            ],
            [
                'code_voyage' => 'ONCF007',
                'heureDepart' => '12:00:00',
                'villeDepart' => 'Casablanca',
                'heureDarrivee' => '14:20:00',
                'villeDarrivee' => 'Kénitra',
                'prixVoyage' => 70.00,
            ],
            [
                'code_voyage' => 'ONCF008',
                'heureDepart' => '13:00:00',
                'villeDepart' => 'Kénitra',
                'heureDarrivee' => '15:10:00',
                'villeDarrivee' => 'Tanger',
                'prixVoyage' => 105.00,
            ],
            [
                'code_voyage' => 'ONCF009',
                'heureDepart' => '14:00:00',
                'villeDepart' => 'Rabat',
                'heureDarrivee' => '16:40:00',
                'villeDarrivee' => 'Oujda',
                'prixVoyage' => 180.00,
            ],
            [
                'code_voyage' => 'ONCF010',
                'heureDepart' => '15:00:00',
                'villeDepart' => 'Oujda',
                'heureDarrivee' => '17:10:00',
                'villeDarrivee' => 'Fès',
                'prixVoyage' => 90.00,
            ],
            [
                'code_voyage' => 'ONCF011',
                'heureDepart' => '16:00:00',
                'villeDepart' => 'Marrakech',
                'heureDarrivee' => '18:15:00',
                'villeDarrivee' => 'Casablanca',
                'prixVoyage' => 120.00,
            ],
            [
                'code_voyage' => 'ONCF012',
                'heureDepart' => '17:00:00',
                'villeDepart' => 'Marrakech',
                'heureDarrivee' => '19:30:00',
                'villeDarrivee' => 'Rabat',
                'prixVoyage' => 135.00,
            ],
            [
                'code_voyage' => 'ONCF013',
                'heureDepart' => '18:00:00',
                'villeDepart' => 'Meknès',
                'heureDarrivee' => '20:00:00',
                'villeDarrivee' => 'Casablanca',
                'prixVoyage' => 80.00,
            ],
            [
                'code_voyage' => 'ONCF014',
                'heureDepart' => '19:00:00',
                'villeDepart' => 'Fès',
                'heureDarrivee' => '21:30:00',
                'villeDarrivee' => 'Rabat',
                'prixVoyage' => 100.00,
            ],
            [
                'code_voyage' => 'ONCF015',
                'heureDepart' => '20:00:00',
                'villeDepart' => 'Casablanca',
                'heureDarrivee' => '22:20:00',
                'villeDarrivee' => 'Tanger',
                'prixVoyage' => 150.00,
            ],
        ]);
    }
}