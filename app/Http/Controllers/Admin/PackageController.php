<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PackageStatus;
use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PackageController extends Controller
{
    public function index(): View
    {
        return view('admin.packages.index', [
            'packages' => Package::latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.packages.create', [
            'statuses' => PackageStatus::options(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tracking_number' => ['required', 'string', 'max:100', 'unique:packages,tracking_number'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::enum(PackageStatus::class)],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        Package::create($validated);

        return redirect()->route('admin.packages.index')->with('success', 'Colis enregistré avec succès.');
    }

    public function edit(Package $package): View
    {
        return view('admin.packages.edit', [
            'package' => $package,
            'statuses' => PackageStatus::options(),
        ]);
    }

    public function update(Request $request, Package $package): RedirectResponse
    {
        $validated = $request->validate([
            'tracking_number' => ['required', 'string', 'max:100', Rule::unique('packages', 'tracking_number')->ignore($package->id)],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::enum(PackageStatus::class)],
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        $package->update($validated);

        return redirect()->route('admin.packages.index')->with('success', 'Colis mis à jour avec succès.');
    }

    public function destroy(Package $package): RedirectResponse
    {
        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Colis supprimé.');
    }
}
