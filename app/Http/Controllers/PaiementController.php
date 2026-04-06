<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Billet;

class PaiementController extends Controller
{
    public function formVoyageurs()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Le panier est vide.');
        }

        $totalBillets = 0;
        $totalPrix = 0;

        foreach ($cart as $item) {
            $totalBillets += $item['qte'];
            $totalPrix += $item['prix'] * $item['qte'];
        }

        $premierVoyage = reset($cart);

        return view('voyageurs', compact('cart', 'totalBillets', 'totalPrix', 'premierVoyage'));
    }

    public function storeVoyageurs(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Le panier est vide.');
        }

        $totalBillets = 0;
        foreach ($cart as $item) {
            $totalBillets += $item['qte'];
        }

        $rules = [];
        for ($i = 0; $i < $totalBillets; $i++) {
            $rules["voyageurs.$i.nom"] = 'required|string|max:255';
            $rules["voyageurs.$i.prenom"] = 'required|string|max:255';
            $rules["voyageurs.$i.passport"] = 'required|string|max:255';
        }

        $rules['numero_carte'] = 'required|string|max:30';
        $rules['date_expiration'] = 'required|string|max:10';
        $rules['cvv'] = 'required|string|max:4';

        $request->validate($rules);

        session()->put('voyageurs', $request->voyageurs);
        session()->put('payment_infos', [
            'numero_carte' => $request->numero_carte,
            'date_expiration' => $request->date_expiration,
            'cvv' => $request->cvv,
        ]);

        return redirect()->route('paiement.process');
    }

    public function processPaiement()
    {
        $cart = session()->get('cart', []);
        $voyageurs = session()->get('voyageurs', []);

        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Le panier est vide.');
        }

        if (empty($voyageurs)) {
            return redirect()->route('voyageurs.form')->with('error', 'Veuillez saisir les informations des voyageurs.');
        }

        $clientId = 1;

        $commande = Commande::create([
            'id_client' => $clientId,
            'date_comm' => now()->toDateString(),
        ]);

        foreach ($cart as $idVoyage => $item) {
            Billet::create([
                'id_voyage' => $idVoyage,
                'id_commande' => $commande->id,
                'qte' => $item['qte'],
            ]);
        }

        session()->put('last_commande_id', $commande->id);
        session()->put('last_cart', $cart);
        session()->put('last_voyageurs', $voyageurs);

        session()->forget('cart');
        session()->forget('voyageurs');
        session()->forget('payment_infos');

        return redirect()->route('billets.show');
    }
}