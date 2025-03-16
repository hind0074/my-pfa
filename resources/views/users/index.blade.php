@extends('layouts.app')

@section('title', 'Utilisateurs')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-3">Utilisateurs</h1>

        <a href="{{ route('users.create') }}" class="btn btn-success mb-3">Créer un utilisateur</a>

        <ul class="list-group">
            @foreach($users as $user)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <span>{{ $user->name }} </span>
                    </div>
                    <div>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
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
