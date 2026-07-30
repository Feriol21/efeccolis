@extends('layouts.admin')

@section('title', 'Nouveau colis')

@section('header')
    <a href="{{ route('admin.packages.index') }}" class="admin-back">&larr; Retour aux colis</a>
    <h2 class="admin-title">Nouveau colis</h2>
@endsection

@section('admin-content')
<div class="card" style="max-width:560px">
    <form method="POST" action="{{ route('admin.packages.store') }}">
        @include('admin.packages._form', ['submitLabel' => 'Enregistrer le colis'])
    </form>
</div>
@endsection
