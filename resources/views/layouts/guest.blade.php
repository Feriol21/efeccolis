@extends('layouts.base')

@section('content')
<div class="guest-shell">
    <a href="{{ route('home') }}" class="brand guest-brand">
        <span class="brand-mark">@include('partials.brand-icon')</span>
        <span class="brand-name">Suivi Colis</span>
    </a>

    <div class="guest-card">
        @yield('guest-card')
    </div>
</div>
@endsection
