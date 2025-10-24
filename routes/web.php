<?php

use App\Http\Controllers\barang\barangController;
use Livewire\Volt\Volt;
use Laravel\Fortify\Features;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\role\roleController;
use App\Http\Controllers\user\userController;
use App\Http\Controllers\satuan\satuanController;
use App\Http\Controllers\vendor\vendorController;

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('welcome', function() {
    return view('welcome');
});

Route::get('datauser', [userController::class, 'getuser'])
    ->middleware(['auth', 'verified'])
    ->name('datauser');

Route::get('datarole', [roleController::class, 'getrole'])
    ->middleware(['auth', 'verified'])
    ->name('datarole');

Route::get('datasatuan', [satuanController::class, 'getsatuan'])
    ->middleware(['auth', 'verified'])
    ->name('datasatuan');

Route::get('databarang', [barangController::class, 'getBarang'])
    ->middleware(['auth', 'verified'])
    ->name('databarang');

Route::get('datavendor', [vendorController::class, 'getVendor'])
    ->middleware(['auth', 'verified'])
    ->name('datavendor');

Route::get('pengadaan', function(){
    return view('admin.pengadaan');
})->name('pengadaan');

Route::get('create-user', [userController::class, 'createUser'])
    -> middleware(['auth', 'verified'])
    -> name('create-user');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
