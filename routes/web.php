<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Customer\ProfilController;
use App\Http\Controllers\Customer\PesananSayaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🌼 Halaman utama (katalog produk)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

// --- RUTE UNTUK CUSTOMER ---
    // Profil
    Route::middleware(['auth'])->group(function () {
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
    Route::post('/profil/update-password', [ProfilController::class, 'updatePassword'])->name('profil.updatePassword');

    // Pesanan
    Route::get('/pesanan-saya', [PesananSayaController::class, 'index'])->name('pesanan-saya.index');
    Route::get('/pesanan-saya/{pesanan}', [PesananSayaController::class, 'show'])->name('pesanan-saya.show');
});

// --- RUTE UNTUK ADMIN ---
Route::prefix('admin')->name('admin.')->group(function () {
    // Login tanpa auth
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Hanya bisa diakses jika sudah login admin
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('produk', ProdukController::class);
        Route::resource('pesanan', PesananController::class)->except(['create', 'store']);
        Route::resource('promo', PromoController::class);
        Route::resource('kategori', KategoriController::class)->except(['show']);
    });
});

// --- CATCH-ALL UNTUK VUE SPA (paling akhir) ---
Route::get('/{any}', function () {
    return view('app');
})->where('any', '^(?!api|admin).*$');


