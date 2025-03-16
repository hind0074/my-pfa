@extends('layouts.app')

@section('title', 'Détails de l\'utilisateur')

@section('content')
    <div class="container mt-4">
        <h1>Détails de l'utilisateur</h1>
        
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $user->name }}</h3>
                <p class="card-text"><strong>Email :</strong> {{ $user->email }}</p>
                <p class="card-text"><strong>Créé le :</strong> {{ $user->created_at->format('d/m/Y') }}</p>
                <a href="{{ route('users.index') }}" class="btn btn-primary">Retour</a>
            </div>
        </div>
    </div>
@endsection
