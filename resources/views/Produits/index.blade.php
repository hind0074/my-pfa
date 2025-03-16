@extends('layouts.app')

@section('title', 'Liste des Produits')

@section('content')
    <div class="container mt-4">
        <h1>Liste des Produits</h1>
        <a href="{{ route('produits.create') }}" class="btn btn-success mb-3">Ajouter un Produit</a>

        <ul class="list-group">
            @foreach ($produits as $produit)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $produit->nom }} ({{ $produit->categorie->nom }})</span>
                    <div>
                        <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
