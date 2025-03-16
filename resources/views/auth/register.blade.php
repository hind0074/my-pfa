@extends("layouts.auth")

@section("title", "Inscription")

@section("style")
<style>
    .form-signup {
        max-width: 330px;
        padding: 1rem;
        margin: auto;
    }
</style>
@endsection

@section("content")
<main class="form-signup text-center">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <img class="mb-4" src="{{ asset('assets/img/logo.png') }}" alt="Logo" width="72" height="72">
        <h1 class="h3 mb-3 fw-normal">Créer un compte</h1>

        <div class="form-floating">
            <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom" required>
            <label for="name">Nom complet</label>
        </div>

        <div class="form-floating">
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
            <label for="email">Adresse Email</label>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
            <label for="password">Mot de passe</label>
        </div>

        <div class="form-floating">
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmez le mot de passe" required>
            <label for="password_confirmation">Confirmez le mot de passe</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">S'inscrire</button>
        <p class="mt-3 mb-3 text-muted">&copy; 2024</p>

        <p>Déjà un compte ? <a href="{{ route('login.post') }}">Connectez-vous ici</a></p>
    </form>
</main>
@endsection

@section("script")
<script>
    console.log("Page d'inscription chargée !");
</script>
@endsection
