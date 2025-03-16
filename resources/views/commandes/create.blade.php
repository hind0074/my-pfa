@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Créer une Commande</h1>

    <form action="{{ route('commandes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="client_id" class="form-label">Client</label>
            <select name="client_id" class="form-control" required>
                <option value="">Sélectionner un client</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="produits" class="form-label">Produits</label>
            <select name="produits[]" class="form-control" multiple required>
                @foreach ($produits as $produit)
                    <option value="{{ $produit->id }}">{{ $produit->nom }} ({{ $produit->prix }} MAD)</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantites" class="form-label">Quantités</label>
            <input type="number" name="quantites[]" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Créer la Commande</button>
    </form>
</div>
@endsection
