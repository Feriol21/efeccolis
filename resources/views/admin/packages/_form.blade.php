@csrf
@isset($package)
    @method('PUT')
@endisset

<div class="field-row">
    <div class="field">
        <label for="first_name">Prénom du client</label>
        <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $package->first_name ?? '') }}" required>
        @error('first_name') <p class="error">{{ $message }}</p> @enderror
    </div>

    <div class="field">
        <label for="last_name">Nom du client</label>
        <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $package->last_name ?? '') }}" required>
        @error('last_name') <p class="error">{{ $message }}</p> @enderror
    </div>
</div>

<div class="field">
    <label for="tracking_number">Numéro de colis</label>
    <input type="text" id="tracking_number" name="tracking_number" value="{{ old('tracking_number', $package->tracking_number ?? '') }}" required>
    @error('tracking_number') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="address">Adresse de livraison</label>
    <input type="text" id="address" name="address" value="{{ old('address', $package->address ?? '') }}" required>
    @error('address') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="status">Statut</label>
    <select id="status" name="status">
        @foreach ($statuses as $status)
            <option value="{{ $status['value'] }}" @selected(old('status', $package->status->value ?? $statuses[0]['value']) === $status['value'])>
                {{ $status['label'] }}
            </option>
        @endforeach
    </select>
    @error('status') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="message">Message affiché au client <span class="optional">(optionnel)</span></label>
    <textarea id="message" name="message" rows="4">{{ old('message', $package->message ?? '') }}</textarea>
    @error('message') <p class="error">{{ $message }}</p> @enderror
</div>

<button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
