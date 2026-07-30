<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;

class TrackingController extends Controller
{
    private const LOCALES = ['fr', 'hr'];

    public function index(Request $request): View
    {
        $this->applyLocale($request);

        return view('tracking.index', ['searched' => false, 'result' => null]);
    }

    public function track(Request $request): View
    {
        $this->applyLocale($request);

        $validated = $request->validate([
            'tracking_number' => ['required', 'string', 'max:100'],
            'first_name' => ['required', 'string', 'max:100'],
        ]);

        $package = Package::whereRaw('LOWER(tracking_number) = ?', [mb_strtolower(trim($validated['tracking_number']))])
            ->whereRaw('LOWER(first_name) = ?', [mb_strtolower(trim($validated['first_name']))])
            ->first();

        return view('tracking.index', [
            'searched' => true,
            'result' => $package,
        ]);
    }

    public function setLocale(Request $request, string $locale): RedirectResponse
    {
        if (in_array($locale, self::LOCALES, true)) {
            $request->session()->put('locale', $locale);
        }

        return redirect()->route('home');
    }

    private function applyLocale(Request $request): void
    {
        $locale = $request->session()->get('locale')
            ?? $request->getPreferredLanguage(self::LOCALES)
            ?? 'fr';

        $request->session()->put('locale', $locale);

        App::setLocale($locale);
    }
}
