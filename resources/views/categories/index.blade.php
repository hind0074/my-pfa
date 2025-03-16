@extends('layouts.app')

@section('title', 'Liste des Catégories')

@section('content')
    <div class="container mt-4">
        <h1>Liste des Catégories</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Ajouter une Catégorie</a>

        <ul class="list-group">
            @foreach ($categories as $categorie)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $categorie->nom }}</span>
                    <div>
                        <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" class="d-inline">
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
