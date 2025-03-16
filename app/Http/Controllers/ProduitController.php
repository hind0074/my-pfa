<?php

namespace App\Http\Controllers;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::with('categorie')->get();
        return view('produits.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('produits.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'stock' => 'required|integer',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        Produit::create($request->all());
        return redirect()->route('produits.index')->with('success', 'Produit ajouté.');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        return view('produits.show', compact('produit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        $categories = Categorie::all(); // Récupérer toutes les catégories pour le formulaire
        return view('produits.edit', compact('produit', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $produit = Produit::findOrFail($id);
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'stock' => 'required|integer',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $produit->update([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'stock' => $request->stock,
            'categorie_id' => $request->categorie_id,
        ]);

        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();
        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
    }
}
