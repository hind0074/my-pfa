@extends('layouts.app')

@section('title', 'Modifier une Catégorie')

@section('content')
    <div class="container mt-4">
        <h1>Modifier la Catégorie</h1>

        <form action="{{ route('categories.update', $categorie->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nom" class="form-label">Nom de la Catégorie</label>
                <input type="text" name="nom" id="nom" class="form-control" value="{{ $categorie->nom }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
@endsection
