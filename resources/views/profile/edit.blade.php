@extends('layouts.admin')

@section('title', 'Profil')

@section('header')
    <h2 class="admin-title">Profil</h2>
    <p class="admin-subtitle">Gère les informations de ton compte administrateur.</p>
@endsection

@section('admin-content')
@if ($status === 'profile-updated')
    <div class="alert alert-success">Profil mis à jour avec succès.</div>
@elseif ($status === 'password-updated')
    <div class="alert alert-success">Mot de passe mis à jour avec succès.</div>
@endif

<div class="card" style="max-width:480px">
    <h3 style="margin-top:0">Informations du compte</h3>
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <div class="field">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email') <p class="error">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>

<div class="card" style="max-width:480px">
    <h3 style="margin-top:0">Changer le mot de passe</h3>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <div class="field">
            <label for="current_password">Mot de passe actuel</label>
            <input type="password" id="current_password" name="current_password" autocomplete="current-password">
            @error('current_password') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="password">Nouveau mot de passe</label>
            <input type="password" id="password" name="password" autocomplete="new-password">
            @error('password') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
