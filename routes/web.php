<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\LokasiCrud;
use App\Livewire\KategoriCrud;
use App\Livewire\BarangCrud;
use App\Livewire\MutasiCrud;
use App\Livewire\PenghapusanCrud;
use App\Livewire\laporanBarang;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    Route::get('/lokasi', LokasiCrud::class)->name('lokasi');
});
Route::get('/penghapusan', PenghapusanCrud::class)->name('penghapusan');
Route::get('/kategori', KategoriCrud::class)->name('kategori');
Route::get('/barang', BarangCrud::class)->name('barang');
Route::get('/mutasi', MutasiCrud::class)->name('mutasi');
Route::get('/laporan-barang', LaporanBarang::class)->name('laporan');


require __DIR__.'/auth.php';
