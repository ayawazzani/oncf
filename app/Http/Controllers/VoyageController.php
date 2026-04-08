<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;

class VoyageController extends Controller
{
    public function accueil()
    {
        $villesDepart = Voyage::distinct()->pluck('villeDepart');
        $villesArrivee = Voyage::distinct()->pluck('villeDarrivee');

        return view('welcome', compact('villesDepart', 'villesArrivee'));
    }

    public function formRecherche()
    {
        $villesDepart = Voyage::distinct()->pluck('villeDepart');
        $villesArrivee = Voyage::distinct()->pluck('villeDarrivee');

        return view('rechercher', compact('villesDepart', 'villesArrivee'));
    }

    public function resultatRecherche(Request $request)
    {
        $vd = $request->ville_depart;
        $va = $request->ville_arrivee;

        $villesDepart = Voyage::distinct()->pluck('villeDepart');
        $villesArrivee = Voyage::distinct()->pluck('villeDarrivee');

        $voyages = Voyage::where('villeDepart', $vd)
            ->where('villeDarrivee', $va)
            ->get();

        return view('rechercher', compact('voyages', 'villesDepart', 'villesArrivee', 'vd', 'va'));
    }
}