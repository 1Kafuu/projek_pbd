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

Route::get('create-user',[userController::class, 'createUser'])
    ->middleware(['auth', 'verified'])
    ->name('create-user');

Route::post('store-user', [userController::class, 'storeUser'])
    ->middleware(['auth', 'verified'])
    ->name('store-user');

Route::delete('delete-user/{id}', [userController::class, 'deleteUser'])
    ->middleware(['auth', 'verified'])
    ->name('delete-user');

Route::put('update-user/{id}', [userController::class, 'updateUser'])
    ->middleware(['auth', 'verified'])
    ->name('update-user');

Route::get('datauser/{id}', [userController::class, 'getUserbyID'])
    ->middleware(['auth', 'verified'])
    ->name('getID');

Route::get('create-role', [roleController::class, 'createRole'])
    ->middleware(['auth', 'verified'])
    ->name('create-role');

Route::post('store-role', [roleController::class, 'storeRole'])
    ->middleware(['auth', 'verified'])
    ->name('store-role');

Route::delete('delete-role/{id}', [roleController::class, 'deleteRole'])
    ->middleware(['auth', 'verified'])
    ->name('delete-role');

Route::get('datarole/{id}', [roleController::class, 'getRolebyID'])
    ->middleware(['auth', 'verified'])
    ->name('getIDRole');

Route::put('update-role/{id}', [roleController::class, 'updateRole'])
    ->middleware(['auth', 'verified'])
    ->name('update-role');

Route::get('create-vendor', [vendorController::class, 'createVendor'])
    ->middleware(['auth', 'verified'])
    ->name('create-vendor');

Route::post('store-vendor', [vendorController::class, 'storeVendor'])
    ->middleware(['auth', 'verified'])
    ->name('store-vendor');

Route::delete('delete-vendor/{id}', [vendorController::class, 'deleteVendor'])
    ->middleware(['auth', 'verified'])
    ->name('delete-vendor');

Route::get('datavendor/{id}', [vendorController::class, 'getVendorbyID'])
    ->middleware(['auth', 'verified'])
    ->name('getIDVendor');

Route::put('update-vendor/{id}', [vendorController::class, 'updateVendor'])
    ->middleware(['auth', 'verified'])
    ->name('update-vendor');

Route::get('create-satuan', [satuanController::class, 'createSatuan'])
    ->middleware(['auth', 'verified'])
    ->name('create-satuan');

Route::post('store-satuan', [satuanController::class, 'storeSatuan'])
    ->middleware(['auth', 'verified'])
    ->name('store-satuan');

Route::delete('delete-satuan/{id}', [satuanController::class, 'deleteSatuan'])
    ->middleware(['auth', 'verified'])
    ->name('delete-satuan');

Route::get('datasatuan/{id}', [satuanController::class, 'getSatuanbyID'])
    ->middleware(['auth', 'verified'])
    ->name('getIDSatuan');

Route::put('update-satuan/{id}', [satuanController::class, 'updateSatuan'])
    ->middleware(['auth', 'verified'])
    ->name('update-satuan');

Route::get('create-barang', [barangController::class, 'createBarang'])
    ->middleware(['auth', 'verified'])
    ->name('create-barang');

Route::post('store-barang', [barangController::class, 'storeBarang'])
    ->middleware(['auth', 'verified'])
    ->name('store-barang');

Route::delete('delete-barang/{id}', [barangController::class, 'deleteBarang'])
    ->middleware(['auth', 'verified'])
    ->name('delete-barang');

Route::get('databarang/{id}', [barangController::class, 'getBarangbyID'])
    ->middleware(['auth', 'verified'])
    ->name('getIDBarang');

Route::put('update-barang/{id}', [barangController::class, 'updateBarang'])
    ->middleware(['auth', 'verified'])
    ->name('update-barang');

Route::get('create-margin', [marginPenjualanController::class, 'createMargin'])
    ->middleware(['auth', 'verified'])
    ->name('create-margin');
    
Route::post('store-margin', [marginPenjualanController::class, 'storeMargin'])
    ->middleware(['auth', 'verified'])
    ->name('store-margin');

Route::get('datamargin/{id}', [marginPenjualanController::class, 'getMarginbyID'])
    ->middleware(['auth', 'verified'])
    ->name('getIDMargin');

Route::put('update-margin/{id}', [marginPenjualanController::class, 'updateMargin'])
    ->middleware(['auth', 'verified'])
    ->name('update-margin');

Route::delete('delete-margin/{id}', [marginPenjualanController::class, 'deleteMargin'])
    ->middleware(['auth', 'verified'])
    ->name('delete-margin');

Route::get('detail-pengadaan/{id}', [pengadaanController::class, 'detailPengadaan'])
    ->middleware(['auth', 'verified'])
    ->name('detail-pengadaan');

Route::get('create-pengadaan', [pengadaanController::class, 'createPengadaan'])
    ->middleware(['auth', 'verified'])
    ->name('create-pengadaan');

Route::post('store-pengadaan', [pengadaanController::class, 'storePengadaan'])
    ->middleware(['auth', 'verified'])
    ->name('store-pengadaan');

Route::get('cancel-pengadaan/{id}', [pengadaanController::class, 'cancelPengadaan'])
    ->middleware(['auth', 'verified'])
    ->name('cancel-pengadaan');

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
