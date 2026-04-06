<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'id_voyage' => 'required|exists:voyages,id',
            'qte' => 'required|integer|min:1'
        ]);

        $voyage = Voyage::findOrFail($request->id_voyage);

        $cart = session()->get('cart', []);

        if (isset($cart[$voyage->id])) {
            $cart[$voyage->id]['qte'] += $request->qte;
        } else {
            $cart[$voyage->id] = [
                'code_voyage' => $voyage->code_voyage,
                'villeDepart' => $voyage->villeDepart,
                'villeDarrivee' => $voyage->villeDarrivee,
                'prix' => $voyage->prixVoyage,
                'qte' => $request->qte
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.show')->with('success', 'Voyage ajouté au panier avec succès.');
    }

    public function show()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_voyage' => 'required',
            'qte' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->id_voyage])) {
            $cart[$request->id_voyage]['qte'] = $request->qte;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.show')->with('success', 'Quantité mise à jour.');
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->id_voyage])) {
            unset($cart[$request->id_voyage]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.show')->with('success', 'Voyage supprimé du panier.');
    }
}