<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;
use App\Http\Controllers\Masyarakat\DashboardController as MasyarakatDashboard;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PetugasController;
use App\Http\Controllers\Admin\RewardController;
use App\Http\Controllers\Admin\RedeemController;
use App\Http\Controllers\Admin\MitraController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LaporanExportController;

// ============================================================
// LANDING PAGE (Public)
// ============================================================
Route::get('/', function () {
    return view('pages.landing.index');
})->name('landing');

// ROUTE KHUSUS ISI HADIAH
Route::get('/seed-rewards', function () {
    try {
        Artisan::call('db:seed', ['--class' => 'AdminSeeder', '--force' => true]);
        return "✅ Katalog Hadiah Berhasil Diperbarui!";
    } catch (\Exception $e) {
        return "❌ Error: " . $e->getMessage();
    }
});

// ============================================================
// AUTH (Satu Pintu Untuk Semua Role)
// ============================================================
// Login tidak pakai middleware 'guest' — controller yang handle redirect jika sudah login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'registerStore'])->name('register.store');

// Fallback route 'home' yang dibutuhkan Laravel internal
Route::get('/home', function () {
    if (auth()->check()) {
        return match (auth()->user()->role) {
            'Admin Pusat' => redirect()->route('admin.dashboard'),
            'Petugas'     => redirect()->route('petugas.dashboard'),
            'Warga'       => redirect()->route('masyarakat.dashboard'),
            default       => redirect()->route('login'),
        };
    }
    return redirect()->route('login');
})->name('home');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// ============================================================
// PETUGAS ROUTES (Mobile Web)
// ============================================================
Route::prefix('petugas')->name('petugas.')->middleware('auth')->group(function () {
    Route::get('/', [PetugasDashboard::class, 'index'])->name('dashboard');

    // Tugas
    Route::get('/tugas', [\App\Http\Controllers\Petugas\TugasController::class, 'index'])->name('tugas.index');
    Route::get('/tugas/{laporan}', [\App\Http\Controllers\Petugas\TugasController::class, 'show'])->name('tugas.show');
    Route::post('/tugas/{laporan}/ambil', [\App\Http\Controllers\Petugas\TugasController::class, 'ambil'])->name('tugas.ambil');
    Route::post('/tugas/{laporan}/selesai', [\App\Http\Controllers\Petugas\TugasController::class, 'selesai'])->name('tugas.selesai');
    Route::get('/riwayat', [\App\Http\Controllers\Petugas\TugasController::class, 'riwayat'])->name('riwayat');

    // Profil
    Route::get('/profil', [\App\Http\Controllers\Petugas\ProfilController::class, 'index'])->name('profil');
    Route::post('/profil', [\App\Http\Controllers\Petugas\ProfilController::class, 'update'])->name('profil.update');
});

// ============================================================
// MASYARAKAT ROUTES (Mobile Web)
// ============================================================
Route::prefix('masyarakat')->name('masyarakat.')->middleware('auth')->group(function () {
    Route::get('/', [\App\Http\Controllers\Masyarakat\DashboardController::class, 'index'])->name('dashboard');

    // Laporan Sampah
    Route::get('/laporan',         [\App\Http\Controllers\Masyarakat\LaporanController::class, 'index']) ->name('laporan.index');
    Route::get('/laporan/buat',    [\App\Http\Controllers\Masyarakat\LaporanController::class, 'create'])->name('laporan.create');
    Route::post('/laporan',        [\App\Http\Controllers\Masyarakat\LaporanController::class, 'store']) ->name('laporan.store');
    Route::get('/laporan/{laporan}',[\App\Http\Controllers\Masyarakat\LaporanController::class, 'show'])  ->name('laporan.show');

    // Reward & Redeem
    Route::get('/reward',                           [\App\Http\Controllers\Masyarakat\RewardController::class, 'index'])  ->name('reward.index');
    Route::post('/reward/{reward}/redeem',          [\App\Http\Controllers\Masyarakat\RewardController::class, 'redeem']) ->name('reward.redeem');
    Route::get('/redeem/riwayat',                   [\App\Http\Controllers\Masyarakat\RewardController::class, 'riwayat'])->name('redeem.riwayat');

    // Profil
    Route::get('/profil',  [\App\Http\Controllers\Masyarakat\ProfilController::class, 'index']) ->name('profil');
    Route::post('/profil', [\App\Http\Controllers\Masyarakat\ProfilController::class, 'update'])->name('profil.update');
});

// ============================================================
// ADMIN ROUTES (Desktop Dashboard)
// ============================================================
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Verifikasi Laporan
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/{laporan}', [LaporanController::class, 'show'])->name('show');
        Route::post('/{laporan}/valid', [LaporanController::class, 'valid'])->name('valid');
        Route::post('/{laporan}/tolak', [LaporanController::class, 'tolak'])->name('tolak');
        Route::post('/{laporan}/selesai', [LaporanController::class, 'selesai'])->name('selesai');
    });

    // Manajemen Petugas
    Route::prefix('petugas')->name('petugas.')->group(function () {
        Route::get('/', [PetugasController::class, 'index'])->name('index');
        Route::get('/{petugas}', [PetugasController::class, 'show'])->name('show');
    });

    // Katalog Reward
    Route::prefix('reward')->name('reward.')->group(function () {
        Route::get('/', [RewardController::class, 'index'])->name('index');
        Route::post('/', [RewardController::class, 'store'])->name('store');
        Route::post('/{reward}/update', [RewardController::class, 'update'])->name('update');
        Route::delete('/{reward}', [RewardController::class, 'destroy'])->name('destroy');
    });

    // Approval Redeem
    Route::prefix('redeem')->name('redeem.')->group(function () {
        Route::get('/', [RedeemController::class, 'index'])->name('index');
        Route::post('/{redeem}/approve', [RedeemController::class, 'approve'])->name('approve');
        Route::post('/{redeem}/tolak', [RedeemController::class, 'tolak'])->name('tolak');
    });

    // Manajemen Mitra
    Route::prefix('mitra')->name('mitra.')->group(function () {
        Route::get('/', [MitraController::class, 'index'])->name('index');
        Route::post('/', [MitraController::class, 'store'])->name('store');
        Route::put('/{mitra}', [MitraController::class, 'update'])->name('update');
        Route::delete('/{mitra}', [MitraController::class, 'destroy'])->name('destroy');
        Route::post('/{mitra}/kontribusi', [MitraController::class, 'tambahKontribusi'])->name('kontribusi');
    });

    // Manajemen User
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    // Export Laporan & Transaksi
    Route::prefix('export')->name('export.')->group(function () {
        Route::get('/', [LaporanExportController::class, 'index'])->name('index');
        Route::get('/laporan', [LaporanExportController::class, 'exportLaporan'])->name('laporan');
        Route::get('/transaksi', [LaporanExportController::class, 'exportTransaksi'])->name('transaksi');
    });
});
