<?php

use App\Http\Controllers\BarangController;
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

Route::get('/laravel_welcome', function () {
    return view('welcome');
});


Route::get('/halaman_utama', function () {
    return view('main');
});

Route::resource('barang', BarangController::class);

Route::get('/', [BarangController::class, 'index'])->name('barang');
Route::get('/barangv2', [BarangController::class, 'indexv2'])->name('barangv2');

Route::post('/barang/update/',[BarangController::class, 'updateBarang'])->name('barang.updatebarang');
