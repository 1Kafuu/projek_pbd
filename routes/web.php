<?php

use App\Http\Controllers\retur\returController;
use Livewire\Volt\Volt;
use Laravel\Fortify\Features;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\role\roleController;
use App\Http\Controllers\user\userController;
use App\Http\Controllers\barang\barangController;
use App\Http\Controllers\margin_penjualan\marginPenjualanController;
use App\Http\Controllers\penerimaan\penerimaanController;
use App\Http\Controllers\satuan\satuanController;
use App\Http\Controllers\vendor\vendorController;
use App\Http\Controllers\pengadaan\pengadaanController;
use App\Http\Controllers\penjualan\penjualanController;

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

Route::get('pengadaan', [pengadaanController::class, 'getPengadaan'])
    ->middleware(['auth', 'verified'])
    ->name('pengadaan');

Route::get('penerimaan', [penerimaanController::class, 'getPenerimaan'])
    ->middleware(['auth', 'verified'])
    ->name('penerimaan');

Route::get('retur', [returController::class, 'getRetur'])
    ->middleware(['auth', 'verified'])
    ->name('retur');

Route::get('penjualan', [penjualanController::class, 'getPenjualan'])
    ->middleware(['auth', 'verified'])
    ->name('penjualan');

Route::get('margin', [marginPenjualanController::class, 'getMargin'])
    ->middleware(['auth', 'verified'])
    ->name('margin');


Route::post('store-user', [userController::class, 'storeUser'])
    ->middleware(['auth', 'verified'])
    ->name('store-user');

Route::delete('delete-user/{id}', [userController::class, 'deleteUser'])
    ->middleware(['auth', 'verified'])
    ->name('delete-user');

Route::put('update-user/{id}', [userController::class, 'updateUser'])
    ->middleware(['auth', 'verified'])
    ->name('update-user');

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
