@extends('layouts.app')

@section('title', 'Liste des Commandes')

@section('content')
    <div class="container mt-4">
        <h1>Liste des Commandes</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commandes as $commande)
                            <tr>
                                <td>{{ $commande->id }}</td>
                                <td>{{ $commande->client->name }}</td> <!-- Affichage du nom du client -->
                                <td>{{ number_format($commande->total, 2) }} MAD</td> <!-- Affichage du total -->
                                <td>
                                  <a href="{{ route('commandes.show', $commande->id) }}" class="btn btn-info btn-sm">Voir</a>
                                  <a href="{{ route('commandes.edit', $commande->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                  <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                  </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Lien pour créer une nouvelle commande -->
        <div class="mt-3">
            <a href="{{ route('commandes.create') }}" class="btn btn-primary">Ajouter une nouvelle commande</a>
        </div>
    </div>
@endsection
