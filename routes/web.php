<?php

use App\Http\Controllers\Admin\PackageController as AdminPackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TrackingController::class, 'index'])->name('home');
Route::post('/suivi', [TrackingController::class, 'track'])->name('tracking.track');
Route::get('/langue/{locale}', [TrackingController::class, 'setLocale'])->name('locale.set');

Route::get('/dashboard', function () {
    return redirect()->route('admin.packages.index');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('packages', AdminPackageController::class)->except(['show']);
    });
});

require __DIR__.'/auth.php';
