@extends('layouts.app')

@section('title', 'Modifier utilisateur')

@section('content')
<div class="container mt-4">
    <h1>Modifier l'utilisateur</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe (optionnel)</label>
            <input type="password" name="password" id="password" class="form-control" value="">
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
       

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
