<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\TransactionController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // User Route
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Kendaraan Route
    Route::name("kendaraan.")->group(function () {
        Route::get("/vehicles", [VehicleController::class, "index"])->name("daftarKendaraan");
    });

    // Transaksi Route
    Route::name("transaksi.")->group(function () {
        Route::get("/transaksi", [TransactionController::class, "index"])->name("daftarTransaksi");
        Route::get("/transaksiTambah", [TransactionController::class, "create"])->name("peminjaman");

        Route::get("/transaksiStore", [TransactionController::class, "store"])->name("storeTransaksi");
        Route::get("/transaksiKembali/{id}", [TransactionController::class, "edit"])->name("pengembalian");
        Route::post("/transaksiUpdate", [TransactionController::class, "update"])->name("updateTransaksi");
    });

});

require __DIR__.'/auth.php';
