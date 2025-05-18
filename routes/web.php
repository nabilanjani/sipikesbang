<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UmpegController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('auth/login');
});

Route::get('/register', function () {
    return view('auth/register');
});

//Admin
//Dashboard
Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/arsip', [DashboardController::class, 'arsip'])->name('admin.arsip');
    Route::get('/admin/kelola', [AdminController::class, 'index'])->name('admin.kelola');
    Route::post('/admin/approve/{id}', [AdminController::class, 'approve'])->name('admin.dashboard.approve');
    Route::post('/admin/pending/{id}', [AdminController::class, 'pending'])->name('admin.dashboard.pending');
    Route::get('/admin/generate-pdf', [AdminController::class, 'generatePDF'])->name('admin.generate-pdf');

    //Kelola
    Route::get('/admin/kelola', [AdminController::class, 'index'])->name('admin.kelola');
    Route::get('/admin/kelola/search', [AdminController::class, 'search'])->name('admin.kelola.search');
    Route::post('/admin/kelola', [AdminController::class, 'store'])->name('admin.kelola.store');
    Route::delete('/admin/kelola/{item}', [AdminController::class, 'destroy'])->name('admin.kelola.destroy');
    Route::get('/admin/kelola/{id}/edit', [AdminController::class, 'edit'])->name('admin.kelola.edit');
    Route::put('/admin/kelola/{id}', [AdminController::class, 'update'])->name('admin.kelola.update');
});

Route::middleware(['auth', 'umpeg'])->group(function(){
    //Umpeg Dashboard
    Route::get('/umpeg/dashboard', [UmpegController::class, 'index'])->name('umpeg.dashboard');
    Route::post('/umpeg/dashboard', [UmpegController::class, 'pengajuan'])->name('umpeg.dashboard.pengajuan');
    Route::get('/umpeg/dashboard/search', [UmpegController::class, 'search'])->name('umpeg.dashboard.search');

    //Riwayat
    Route::get('/umpeg/riwayat', [UmpegController::class, 'riwayat'])->name('umpeg.riwayat');
    Route::delete('/umpeg/riwayat/{id}', [UmpegController::class, 'delete'])->name('umpeg.riwayat.delete');
    Route::get('/umpeg/riwayat/{id}', [UmpegController::class, 'showTransactionDetails'])->name('umpeg.riwayat.details');
});


Route::middleware(['auth', 'staf'])->group(function(){
    //Staf
    Route::get('/staf/dashboard', [HomeController::class, 'stafDashboard'])->name('staf.dashboard');
    Route::get('/staf/search', [HomeController::class, 'search'])->name('staf.dashboard.search');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
