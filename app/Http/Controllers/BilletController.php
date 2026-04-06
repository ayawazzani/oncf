<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;

class BilletController extends Controller
{
    public function show()
    {
        $commandeId = session()->get('last_commande_id');
        $cart = session()->get('last_cart', []);
        $voyageurs = session()->get('last_voyageurs', []);

        if (!$commandeId || empty($cart)) {
            return redirect()->route('voyage.form')->with('error', 'Aucun billet à afficher.');
        }

        return view('billets', compact('commandeId', 'cart', 'voyageurs'));
    }
}