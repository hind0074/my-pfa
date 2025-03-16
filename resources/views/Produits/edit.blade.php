@extends('layouts.app')

@section('title', 'Modifier un Produit')

@section('content')
    <div class="container mt-4">
        <h1>Modifier le Produit</h1>

        <form action="{{ route('produits.update', $produit->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du Produit</label>
                <input type="text" name="nom" id="nom" class="form-control" value="{{ $produit->nom }}" required>
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix</label>
                <input type="number" name="prix" id="prix" class="form-control" value="{{ $produit->prix }}" required>
            </div>
            <div class="mb-3">
                <label for="categorie_id" class="form-label">Catégorie</label>
                <select name="categorie_id" id="categorie_id" class="form-control" required>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}" {{ $produit->categorie_id == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ $produit->stock }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
@endsection
