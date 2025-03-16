@extends('layouts.app')

@section('title', 'Créer un Utilisateur')

@section('content')
    <h1>Créer un nouvel utilisateur</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nom" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
@endsection
