@extends('layouts.base')

@section('title', __('tracking.badge'))

@section('content')
@php
    $steps = \App\Enums\PackageStatus::cases();
    $currentIndex = $result ? array_search($result->status, $steps, true) : -1;
    $locale = app()->getLocale();
@endphp

<div class="page page-public" style="background:var(--bg)">
    <div class="container" style="padding-top:40px;padding-bottom:24px">
        <div class="public-header">
            <a href="{{ route('home') }}" class="brand">
                <span class="brand-mark">@include('partials.brand-icon')</span>
                <span class="brand-name">Suivi Colis</span>
            </a>

            <div class="lang-switch">
                <a href="{{ route('locale.set', 'fr') }}" class="{{ $locale === 'fr' ? 'active' : '' }}">FR</a>
                <a href="{{ route('locale.set', 'hr') }}" class="{{ $locale === 'hr' ? 'active' : '' }}">HR</a>
            </div>
        </div>

        @if (! $searched)
            <h1 class="page-title">{{ __('tracking.title') }}</h1>
            <p class="page-subtitle">{{ __('tracking.subtitle') }}</p>

            <div class="card">
                <form method="POST" action="{{ route('tracking.track') }}">
                    @csrf
                    <div class="field">
                        <label for="tracking_number">{{ __('tracking.tracking_label') }}</label>
                        <input
                            type="text"
                            id="tracking_number"
                            name="tracking_number"
                            placeholder="{{ __('tracking.tracking_placeholder') }}"
                            value="{{ old('tracking_number') }}"
                            required
                        >
                        @error('tracking_number') <p class="error">{{ $message }}</p> @enderror
                    </div>

                    <div class="field">
                        <label for="first_name">{{ __('tracking.first_name_label') }}</label>
                        <input
                            type="text"
                            id="first_name"
                            name="first_name"
                            placeholder="{{ __('tracking.first_name_placeholder') }}"
                            value="{{ old('first_name') }}"
                            required
                        >
                        @error('first_name') <p class="error">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">{{ __('tracking.submit') }}</button>
                </form>
            </div>
        @endif

        @if ($searched && ! $result)
            <div class="alert alert-danger">
                <p class="alert-danger-title">{{ __('tracking.not_found_title') }}</p>
                <p class="alert-danger-body">{{ __('tracking.not_found_body') }}</p>
            </div>

            <div class="actions-center">
                <a href="{{ route('home') }}" class="btn btn-secondary btn-pill">&larr; {{ __('tracking.back') }}</a>
            </div>
        @endif

        @if ($result)
            <div class="card">
                <div class="result-header">
                    <div>
                        <p class="eyebrow">{{ __('tracking.package_label') }}</p>
                        <p class="value value-mono">{{ $result->tracking_number }}</p>
                    </div>
                    <span class="badge badge-{{ $result->status->value }}">{{ $result->status->label() }}</span>
                </div>

                <div class="detail-grid">
                    <div>
                        <p class="eyebrow">{{ __('tracking.name_label') }}</p>
                        <p class="value">{{ $result->first_name }} {{ $result->last_name }}</p>
                    </div>
                    <div>
                        <p class="eyebrow">{{ __('tracking.address_label') }}</p>
                        <p class="value" style="font-weight:500">{{ $result->address }}</p>
                    </div>
                </div>

                <ol class="timeline">
                    @foreach ($steps as $index => $step)
                        <li class="timeline-step {{ $index <= $currentIndex ? 'done' : '' }} {{ $index === $currentIndex ? 'current' : '' }}">
                            <span class="timeline-dot">
                                @if ($index <= $currentIndex)
                                    <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
                                @else
                                    {{ $index + 1 }}
                                @endif
                            </span>
                            <span class="timeline-label">{{ $step->label() }}</span>
                        </li>
                    @endforeach
                </ol>

                @if ($result->message)
                    <div class="message-box">
                        <p class="eyebrow">{{ __('tracking.message_title') }}</p>
                        <p>{{ $result->message }}</p>
                    </div>
                @endif
            </div>

            <div class="actions-center">
                <a href="{{ route('home') }}" class="btn btn-secondary btn-pill">&larr; {{ __('tracking.back') }}</a>
            </div>
        @endif
    </div>

    <p class="public-footer">&copy; {{ now()->year }} Suivi Colis &mdash; {{ __('tracking.footer') }}</p>
</div>
@endsection
