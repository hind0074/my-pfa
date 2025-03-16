@extends('layouts.app')

@section('title', 'Détails du Produit')

@section('content')
    <div class="container mt-4">
        <h1>Détails du Produit</h1>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $produit->nom }}</h3>
                <p class="card-text"><strong>Prix:</strong> {{ $produit->prix }} MAD</p>
                <p class="card-text"><strong>Catégorie:</strong> {{ $produit->categorie->nom }}</p>
                <p class="card-text"><strong>Stock:</strong> {{ $produit->stock }}</p>
                <a href="{{ route('produits.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>
@endsection
