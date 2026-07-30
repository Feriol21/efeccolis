@extends('layouts.admin')

@section('title', 'Colis')

@section('header')
    <div class="admin-header-row">
        <div>
            <h2 class="admin-title">Colis</h2>
            <p class="admin-subtitle">Gérez et suivez l'état des livraisons de vos clients.</p>
        </div>
        <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">+ Nouveau colis</a>
    </div>
@endsection

@section('admin-content')
@php
    $statuses = \App\Enums\PackageStatus::cases();
@endphp

<div class="stat-grid">
    @foreach ($statuses as $status)
        <div class="stat-card">
            <span class="stat-dot" style="background:var(--status-{{ $status->value }})"></span>
            <span class="stat-label">{{ $status->label() }}</span>
            <p class="stat-count">{{ $packages->where('status', $status)->count() }}</p>
        </div>
    @endforeach
</div>

<div class="table-wrap">
    <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>Numéro</th>
                    <th>Client</th>
                    <th>Statut</th>
                    <th>Message</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($packages as $package)
                    <tr>
                        <td class="mono">{{ $package->tracking_number }}</td>
                        <td>{{ $package->first_name }} {{ $package->last_name }}</td>
                        <td>
                            <span class="badge badge-{{ $package->status->value }}">{{ $package->status->label() }}</span>
                        </td>
                        <td class="{{ $package->message ? '' : 'muted' }}" style="max-width:260px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                            {{ $package->message ?: '—' }}
                        </td>
                        <td class="row-actions">
                            <a href="{{ route('admin.packages.edit', $package) }}" class="btn-link">Modifier</a>
                            <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" style="margin-left:16px" onsubmit="return confirm('Supprimer le colis {{ $package->tracking_number }} ? Cette action est irréversible.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger-link">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="table-empty">Aucun colis enregistré pour le moment.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
