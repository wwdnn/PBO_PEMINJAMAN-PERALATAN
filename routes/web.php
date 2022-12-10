<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

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
Auth::routes();

Route::get('/', function () { return view('home'); })->middleware('guest');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// URL for Peminjam Peralatan
// Route::get('login-peminjam', function () { return view('auth.userLogin'); })->name('login-peminjam')->middleware('guest');
Route::get('login-peminjaman', function(){
    return view('auth.loginUser');
})->name('login-peminjam')->middleware('guest');

Route::post('/login-peminjam', [\App\Http\Controllers\UserController::class, 'login']);
Route::post('/logout-peminjam', [\App\Http\Controllers\UserController::class, 'logout']);
Route::get('/dashboard-user', [\App\Http\Controllers\PageUserController::class, 'index'])->middleware('auth');
Route::get('detail-barang/{id}', [\App\Http\Controllers\PinjamController::class, 'index'])->middleware('auth');
Route::post('pinjam-barang/{id}', [\App\Http\Controllers\PinjamController::class, 'pinjam']);
Route::get('cart-peminjaman', [\App\Http\Controllers\PinjamController::class, 'cart'])->middleware('auth');
Route::delete('cart-peminjaman/{id}', [\App\Http\Controllers\PinjamController::class, 'delete']);
Route::get('konfirmasi-pinjaman', [\App\Http\Controllers\PinjamController::class, 'konfirmasi'])->middleware('auth');


// URL for Search Barang
Route::get('/search', [\App\Http\Controllers\PageUserController::class, 'search'])->name('search')->middleware('auth');

// URL for Petugas Peralatan 
Route::prefix('petugas_peralatan')->group(function () {
    Route::get('/login-petugas', [App\Http\Controllers\Auth\PetugasPeralatanLoginController::class, 'showLoginForm'])->name('petugas_peralatan.login');
    Route::post('/login-petugas', [App\Http\Controllers\Auth\PetugasPeralatanLoginController::class, 'login'])->name('petugas_peralatan.login.submit');
    Route::post('/logout-petugas', [App\Http\Controllers\Auth\PetugasPeralatanLoginController::class, 'logout'])->name('petugas_peralatan.logout');
    Route::get('/dashboard', [App\Http\Controllers\PetugasPeralatanController::class, 'index'])->name('petugas_peralatan.dashboard');
    
    Route::get('pengembalian-barang', [App\Http\Controllers\PengembalianController::class, 'pengembalian'])->name('petugas_peralatan.pengembalian');
    Route::get('pengembalian-detail/{id}', [App\Http\Controllers\PengembalianController::class, 'detailPengembalian'])->name('petugas_peralatan.detailPengembalian');
    Route::post('pengembalian-barang/{id}/{id_barang}', [App\Http\Controllers\PengembalianController::class, 'pengembalianBarang'])->name('petugas_peralatan.pengembalianBarang');
});


// pdf
Route::get('mpdf', [App\Http\Controllers\BarangController::class, 'createPDF'])->name('mpdf');

// jobs & queues for TestQueueEmail
Route::get('queue', [App\Http\Controllers\TestQueueEmails::class, 'sendTestEmails'])->name('queue.index');




