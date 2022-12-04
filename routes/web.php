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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('petugas_peralatan')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\PetugasPeralatanLoginController::class, 'showLoginForm'])->name('petugas_peralatan.login');
    Route::post('/login', [App\Http\Controllers\Auth\PetugasPeralatanLoginController::class, 'login'])->name('petugas_peralatan.login.submit');
    Route::post('/logout', [App\Http\Controllers\Auth\PetugasPeralatanLoginController::class, 'logout'])->name('petugas_peralatan.logout');
    Route::get('/dashboard', [App\Http\Controllers\PetugasPeralatanController::class, 'index'])->name('petugas_peralatan.dashboard');
    Route::get('/', [App\Http\Controllers\PetugasPeralatanController::class, 'index'])->name('petugas_peralatan.dashboard');
});

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::resource('users', \App\Http\Controllers\UserController::class)
    ->middleware('auth');

Route::resource('barangs', \App\Http\Controllers\BarangController::class);

// pdf
Route::get('mpdf', [App\Http\Controllers\BarangController::class, 'createPDF'])->name('mpdf');

// jobs & queues for TestQueueEmail
Route::get('queue', [App\Http\Controllers\TestQueueEmails::class, 'sendTestEmails'])->name('queue.index');
