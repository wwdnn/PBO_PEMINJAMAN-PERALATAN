<?php

use Illuminate\Support\Facades\Route;
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
    return view('auth.userLogin');
});

Route::post('/', [\App\Http\Controllers\UserController::class, 'login']);
Route::get('/pageUser', [\App\Http\Controllers\PageUserController::class, 'index'])->name('pageUser');
Route::get('/pageUser/{id}', [\App\Http\Controllers\PageUserController::class, 'show'])->name('pageUser.show');
// Route::post('/pageUser/{id}', [\App\Http\Controllers\PageUserController::class, 'pinjam'])->name('pageUser.pinjam');
// Route::resource('pageUser','PageUserController');
