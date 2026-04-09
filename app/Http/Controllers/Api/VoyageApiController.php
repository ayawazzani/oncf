<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voyage;
use Illuminate\Http\Request;

class VoyageApiController extends Controller
{
    public function search(Request $request)
    {
        $villesDepart = Voyage::distinct()->pluck('villeDepart');
        $villesArrivee = Voyage::distinct()->pluck('villeDarrivee');

        $villeDepart = $request->query('ville_depart');
        $villeArrivee = $request->query('ville_arrivee');

        $voyages = [];

        if ($villeDepart && $villeArrivee) {
            $voyages = Voyage::where('villeDepart', $villeDepart)
                ->where('villeDarrivee', $villeArrivee)
                ->get();
        }

        return response()->json([
            'villesDepart' => $villesDepart,
            'villesArrivee' => $villesArrivee,
            'voyages' => $voyages,
        ]);
    }
}