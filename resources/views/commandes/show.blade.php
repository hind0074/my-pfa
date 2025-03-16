@extends('layouts.app')

@section('title', 'Détails de la Commande')

@section('content')
    <div class="container mt-4">
        <h1>Détails de la Commande</h1>

        <div class="card">
            <div class="card-body">
                <!-- Affichage des détails de la commande -->
                <h3 class="card-title">Commande #{{ $commande->id }}</h3>
                <p class="card-text"><strong>Client:</strong> {{ $commande->client->name }}</p> <!-- Affichage du nom du client -->
                <p class="card-text"><strong>Date:</strong> {{ $commande->created_at->format('d/m/Y') }}</p> <!-- Affichage de la date de la commande -->
                <p class="card-text"><strong>Total:</strong> {{ number_format($commande->total, 2) }} MAD</p> <!-- Affichage du total -->

                <h4>Produits de la Commande</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix unitaire</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commande->produits as $produit)
                            <tr>
                                <td>{{ $produit->nom }}</td> <!-- Affichage du nom du produit -->
                                <td>{{ $produit->pivot->quantite }}</td> <!-- Affichage de la quantité -->
                                <td>{{ number_format($produit->pivot->prix, 2) }} MAD</td> <!-- Affichage du prix unitaire -->
                                <td>{{ number_format($produit->pivot->quantite * $produit->pivot->prix, 2) }} MAD</td> <!-- Calcul du total pour ce produit -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <a href="{{ route('commandes.index') }}" class="btn btn-secondary mt-3">Retour à la liste des commandes</a>
    </div>
@endsection
