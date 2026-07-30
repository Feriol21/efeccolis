@extends('layouts.admin')

@section('title', 'Modifier ' . $package->tracking_number)

@section('header')
    <a href="{{ route('admin.packages.index') }}" class="admin-back">&larr; Retour aux colis</a>
    <h2 class="admin-title" style="font-family:ui-monospace,Consolas,monospace">{{ $package->tracking_number }}</h2>
@endsection

@section('admin-content')
<div class="card" style="max-width:560px">
    <form method="POST" action="{{ route('admin.packages.update', $package) }}">
        @include('admin.packages._form', ['submitLabel' => 'Mettre à jour'])
    </form>
</div>
@endsection
