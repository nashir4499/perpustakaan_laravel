<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Bukus;
use App\Http\Livewire\Kategoris;
use App\Http\Livewire\Members;
use App\Http\Livewire\Peminjamans;
use App\Http\Livewire\Pengembalians;
use App\Http\Livewire\Laporans;
use App\Http\Livewire\Homes;
use App\Http\Livewire\Petugas;
use App\Http\Controllers\LaporanPdfController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/buku', Bukus::class)->name('buku');
    Route::get('/kategori', Kategoris::class)->name('kategori');
    Route::get('/member', Members::class)->name('member');
    Route::get('/petugas', Petugas::class)->name('petugas');
    Route::get('/peminjaman', Peminjamans::class)->name('peminjaman');
    Route::get('/pengembalian', Pengembalians::class)->name('pengembalian');
    Route::get('/laporan', Laporans::class)->name('laporan');
    Route::get('/dashboard', Homes::class)->name('dashboard');
    Route::get('/laporan/pdf', [Laporans::class, 'cetak_pdf'])->name('laporanPdf');
    // Route::get('/member/pdf/{id}', [Members::class, 'cetak_pdf'])->name('memberPdf');
    Route::get('/member/pdf', [Members::class, 'cetakKartuPdf'])->name('memberPdf');
});
