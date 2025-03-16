<?php

namespace App\Http\Controllers;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\Client; 

use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commandes = Commande::all();
        return view('commandes.index', compact('commandes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produits = Produit::all(); // Charger tous les produits
        $clients = Client::all();   // Charger tous les clients pour le formulaire
        return view('commandes.create', compact('produits', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validation des champs
    $request->validate([
        'client_id' => 'required|exists:clients,id', // Assurez-vous que le client existe
        'produits' => 'required|array', // Assurez-vous qu'il y a des produits
        'produits.*' => 'exists:produits,id', // Assurez-vous que les produits existent dans la table des produits
        'quantites' => 'required|array', // Assurez-vous que les quantités sont présentes
        'quantites.*' => 'integer|min:1', // Les quantités doivent être des entiers et supérieures ou égales à 1
    ]);

    // Créer une nouvelle commande
    $commande = Commande::create([
        'client_id' => $request->client_id,
        'total' => 0, // Vous pouvez calculer un total ici si vous le souhaitez
    ]);

    // Ajouter les produits à la commande avec les quantités et prix via la table pivot
    $total = 0;
    foreach ($request->produits as $index => $produit_id) {
        $quantite = $request->quantites[$index];
        $produit = Produit::findOrFail($produit_id);
        
        // Calcul du prix total du produit dans la commande
        $prix = $produit->prix;
        $totalProduit = $quantite * $prix;
        $total += $totalProduit;
        //dim le stock
        $produit->decrement('stock', $quantite);
        // Ajouter le produit à la commande avec la quantité et le prix dans la table pivot
        $commande->produits()->attach($produit_id, [
            'quantite' => $quantite,
            'prix' => $prix,
        ]);
    }

    // Mettre à jour le total de la commande après avoir ajouté tous les produits
    $commande->update(['total' => $total]);

    return redirect()->route('commandes.index')->with('success', 'Commande créée avec succès !');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Récupérer la commande avec les produits associés (via la relation many-to-many)
    $commande = Commande::with('produits')->findOrFail($id);

    return view('commandes.show', compact('commande'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    $commande = Commande::findOrFail($id);
    $produits = Produit::all();
    $clients = Client::all();

    return view('commandes.edit', compact('commande', 'produits', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $commande = Commande::findOrFail($id);
    
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'produits' => 'required|array',
            'quantites' => 'required|array',
        ]);
    
        // Remettre le stock des anciens produits
        foreach ($commande->produits as $produit) {
            $produit->increment('stock', $produit->pivot->quantite);
        }
    
        $total = 0;
    
        $produitsData = collect($request->produits)->mapWithKeys(function ($produit_id, $index) use ($request, &$total) {
            $produit = Produit::find($produit_id);
            $quantite = $request->quantites[$index];
    
            if ($produit->stock < $quantite) {
                return back()->withErrors(['error' => "Stock insuffisant pour le produit {$produit->nom}"]);
            }
    
            $prix = $produit->prix;
            $subtotal = $quantite * $prix;
            $total += $subtotal;
    
            //  Mettre à jour le stock
            $produit->decrement('stock', $quantite);
    
            return [
                $produit_id => [
                    'quantite' => $quantite,
                    'prix' => $prix,
                ]
            ];
        });
    
        // Mettre à jour les produits de la commande
        $commande->produits()->sync($produitsData);
    
        // Mettre à jour la commande
        $commande->update([
            'client_id' => $request->client_id,
            'total' => $total,
        ]);
    
        return redirect()->route('commandes.index')->with('success', 'Commande mise à jour avec succès');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $commande = Commande::findOrFail($id);
        $commande->delete();
        return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès');
    }
}
