@extends("layouts.auth")

@section("title", "Connexion")

@section("style")
<style>
    .form-signin {
        max-width: 330px;
        padding: 1rem;
        margin: auto;
    }
</style>
@endsection

@section("content")
<main class="form-signin text-center">
    <form method="POST" action="{{ route('login.post') }}">
        @csrf
        <img class="mb-4" src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="72" height="72">
        <h1 class="h3 mb-3 fw-normal">Veuillez vous connecter</h1>

        <div class="form-floating">
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
            <label for="email">Adresse Email</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
            <label for="password">Mot de passe</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Se connecter</button>
        <p class="mt-3 mb-3 text-muted">&copy; 2024</p>
    </form>
</main>
@endsection

@section("script")
<script>
    console.log("Page de connexion chargée !");
</script>
@endsection
