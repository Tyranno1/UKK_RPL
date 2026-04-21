<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::middleware(['auth', 'ceklevel:siswa'])->group(function () {
    Route::get('/siswa/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::get('/siswa/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
    Route::post('/siswa/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    Route::get('/siswa/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/siswa/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
});

Route::middleware(['auth', 'ceklevel:admin,petugas'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/pengaduan', [AdminController::class, 'pengaduanIndex'])->name('admin.pengaduan.index');
    Route::get('/admin/pengaduan/{id}', [AdminController::class, 'pengaduanShow'])->name('admin.pengaduan.show');
    Route::post('/admin/pengaduan/{id}/tanggapan', [AdminController::class, 'tanggapanStore'])->name('admin.tanggapan.store');
    Route::put('/admin/pengaduan/{id}/tanggapan', [AdminController::class, 'tanggapanUpdate'])->name('admin.tanggapan.update');
    Route::post('/admin/pengaduan/{id}/selesai', [AdminController::class, 'selesai'])->name('admin.selesai');
    Route::post('/admin/pengaduan/{id}/tolak', [AdminController::class, 'tolak'])->name('admin.tolak');

    Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::get('/admin/kategori/create', [KategoriController::class, 'create'])->name('admin.kategori.create');
    Route::post('/admin/kategori', [KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::get('/admin/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
    Route::put('/admin/kategori/{id}', [KategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('/admin/kategori/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');

    Route::get('/admin/pengguna/create', [AdminController::class, 'penggunaCreate'])->name('admin.pengguna.create');
    Route::post('/admin/pengguna', [AdminController::class, 'penggunaStore'])->name('admin.pengguna.store');
    Route::get('/admin/pengguna', [AdminController::class, 'penggunaIndex'])->name('admin.pengguna.index');
    Route::get('/admin/pengguna/{id}/edit', [AdminController::class, 'penggunaEdit'])->name('admin.pengguna.edit');
    Route::put('/admin/pengguna/{id}', [AdminController::class, 'penggunaUpdate'])->name('admin.pengguna.update');
    Route::delete('/admin/pengguna/{id}', [AdminController::class, 'penggunaDestroy'])->name('admin.pengguna.destroy');
});

require __DIR__.'/auth.php';