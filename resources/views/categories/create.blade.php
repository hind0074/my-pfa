@extends('layouts.app')

@section('title', 'Ajouter une catégorie')

@section('content')
    <div class="container mt-4">
        <h1>Ajouter une catégorie</h1>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du catégorie</label>
                <input type="text" name="nom" id="nom" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
@endsection
