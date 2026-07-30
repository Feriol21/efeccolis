@extends('layouts.base')

@section('content')
<div class="page">
    <nav class="admin-nav">
        <div class="container-wide admin-nav-inner">
            <a href="{{ route('admin.packages.index') }}" class="brand">
                <span class="brand-mark">@include('partials.brand-icon')</span>
                <span class="brand-name">Suivi Colis<small>Admin</small></span>
            </a>
            <div style="display:flex;align-items:center;gap:20px">
                <a href="{{ route('profile.edit') }}" class="btn-link">Profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-danger-link" style="color:var(--text-dim)">Déconnexion</button>
                </form>
            </div>
        </div>
    </nav>

    @hasSection('header')
        <div class="admin-header">
            <div class="container-wide">
                @yield('header')
            </div>
        </div>
    @endif

    <main class="admin-main">
        <div class="container-wide">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @yield('admin-content')
        </div>
    </main>
</div>
@endsection
