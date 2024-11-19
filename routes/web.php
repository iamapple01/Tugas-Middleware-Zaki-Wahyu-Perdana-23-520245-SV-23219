<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BukuController;
use App\Models\Buku;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/consume-api', function () {
    return view('consume-api');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/post', [PostController::class, 'index']);

Route::get('/buku', [BukuController::class, 'index'])->name('buku');

Route::get('/create', [BukuController::class, 'create'])->name('create');

Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');

Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

Route::post('/buku/{id}/update', [BukuController::class, 'update'])->name('buku.update');

Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');

Route::post('/upload', [BukuController::class, 'upload'])->name('buku.upload');

Route::controller(LoginRegisterController::class)->group(function() {
   Route::get('/register', 'register')->name('register');
   Route::post('/store', 'store')->name('store');
   Route::get('/login', 'login')->name('login');
   Route::post('/authenticate', 'authenticate')->name('authenticate');
   Route::get('/dashboard', 'dashboard')->name('dashboard');
   Route::post('/logout', 'logout')->name('logout');
});

