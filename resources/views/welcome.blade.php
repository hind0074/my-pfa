@extends('layouts.app')

@section('content')
    <div class="container mt-4 text-center">
        <h1 class="mb-4">Bienvenue sur notre application</h1>
        
        <a href="{{ route('users.index') }}" class="btn btn-primary">Voir les utilisateurs</a>
        <a href="{{ route('produits.index') }}" class="btn btn-primary">Voir les produits</a>
        <a href="{{ route('categories.index') }}" class="btn btn-primary">Voir les catégories</a>
        <a href="{{ route('commandes.index') }}" class="btn btn-primary">Voir les commandes</a>
    </div>
@endsection
