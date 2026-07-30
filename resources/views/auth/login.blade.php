@extends('layouts.guest')

@section('title', 'Connexion')

@section('guest-card')
<h1 class="guest-heading">Espace administrateur</h1>

@if ($status)
    <div class="alert alert-success">{{ $status }}</div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="field">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="username" autofocus required>
        @error('email') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div class="field">
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" autocomplete="current-password" required>
        @error('password') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div class="field checkbox-row">
        <input type="checkbox" id="remember" name="remember">
        <label for="remember" style="margin:0">Se souvenir de moi</label>
    </div>

    <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
</form>
@endsection
