<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\KepalaGudangController;

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
    return view('auth.login');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::middleware(['auth','CheckRole:admin'])->group(function (){
Route::get('/admin/dashboard', [App\Http\Controllers\MasterDataController::class, 'dashboard']);

// Akun
Route::get('/admin/akun', [App\Http\Controllers\MasterDataController::class, 'akun']);
Route::get('/admin/akun/create', [App\Http\Controllers\MasterDataController::class, 'create']);
Route::post('/admin/akun/store', [App\Http\Controllers\MasterDataController::class, 'store']);
Route::get('/admin/akun/edit/{id}', [App\Http\Controllers\MasterDataController::class, 'edit']);
Route::patch('/admin/akun/update/{id}', [App\Http\Controllers\MasterDataController::class, 'update']);
Route::delete('/admin/akun/delete/{id}', [App\Http\Controllers\MasterDataController::class, 'delete']);


// Barang
Route::get('/admin/barang', [App\Http\Controllers\MasterDataController::class, 'indexBarang']);
Route::get('/admin/barang/create', [App\Http\Controllers\MasterDataController::class, 'createBarang']);
Route::post('/admin/barang/store', [App\Http\Controllers\MasterDataController::class, 'storeBarang']);
Route::get('/admin/barang/edit/{id}', [App\Http\Controllers\MasterDataController::class, 'editBarang']);
Route::patch('/admin/barang/update/{id}', [App\Http\Controllers\MasterDataController::class, 'updateBarang']);
Route::delete('/admin/barang/delete/{id}', [App\Http\Controllers\MasterDataController::class, 'deleteBarang']);

// Pelanggan
Route::get('/admin/sales', [App\Http\Controllers\MasterDataController::class, 'indexSales']);
Route::get('/admin/sales/create', [App\Http\Controllers\MasterDataController::class, 'createSales']);
Route::post('/admin/sales/store', [App\Http\Controllers\MasterDataController::class, 'storeSales']);
Route::get('/admin/sales/edit/{id}', [App\Http\Controllers\MasterDataController::class, 'editSales']);
Route::patch('/admin/sales/update/{id}', [App\Http\Controllers\MasterDataController::class, 'updateSales']);
Route::delete('/admin/sales/delete/{id}', [App\Http\Controllers\MasterDataController::class, 'deleteSales']);

// Supplier

// Pelanggan
Route::get('/admin/supplier', [App\Http\Controllers\MasterDataController::class, 'indexSupplier']);
Route::get('/admin/supplier/create', [App\Http\Controllers\MasterDataController::class, 'createSupplier']);
Route::post('/admin/supplier/store', [App\Http\Controllers\MasterDataController::class, 'storeSupplier']);
Route::get('/admin/supplier/edit/{id}', [App\Http\Controllers\MasterDataController::class, 'editSupplier']);
Route::patch('/admin/supplier/update/{id}', [App\Http\Controllers\MasterDataController::class, 'updateSupplier']);
Route::delete('/admin/supplier/delete/{id}', [App\Http\Controllers\MasterDataController::class, 'deleteSupplier']);


// Transaksi
// Barang Masuk
Route::get('/admin/barang_masuk', [App\Http\Controllers\TransaksiController::class, 'indexBarangMasuk']);
Route::get('/admin/barang_masuk/create', [App\Http\Controllers\TransaksiController::class, 'createBarangMasuk']);
Route::post('/admin/barang_masuk/store', [App\Http\Controllers\TransaksiController::class, 'storeBarangMasuk']);
Route::get('/admin/barang_masuk/edit/{id}', [App\Http\Controllers\TransaksiController::class, 'editBarangMasuk']);
Route::put('/admin/barang_masuk/update/{id}', [App\Http\Controllers\TransaksiController::class, 'updateBarangMasuk']);
Route::delete('/admin/barang_masuk/delete/{id}', [App\Http\Controllers\TransaksiController::class, 'deleteBarangMasuk']);
Route::get('/admin/barang_masuk/view/{id}', [App\Http\Controllers\TransaksiController::class, 'viewBarangMasuk']);

// Barang Keluar
Route::get('/admin/barang_keluar', [App\Http\Controllers\TransaksiController::class, 'indexBarangKeluar']);
Route::get('/admin/barang_keluar/create', [App\Http\Controllers\TransaksiController::class, 'createBarangKeluar']);
Route::post('/admin/barang_keluar/store', [App\Http\Controllers\TransaksiController::class, 'storeBarangKeluar']);
Route::get('/admin/barang_keluar/edit/{id}', [App\Http\Controllers\TransaksiController::class, 'editBarangKeluar']);
Route::put('/admin/barang_keluar/update/{id}', [App\Http\Controllers\TransaksiController::class, 'updateBarangKeluar']);
Route::delete('/admin/barang_keluar/delete/{id}', [App\Http\Controllers\TransaksiController::class, 'deleteBarangKeluar']);
Route::get('/admin/barang_keluar/view/{id}', [App\Http\Controllers\TransaksiController::class, 'viewBarangKeluar']);

// Barang Retur
Route::get('/admin/barang_retur', [App\Http\Controllers\TransaksiController::class, 'indexBarangRetur']);
Route::get('/admin/barang_retur/create', [App\Http\Controllers\TransaksiController::class, 'createBarangRetur']);
Route::post('/admin/barang_retur/store', [App\Http\Controllers\TransaksiController::class, 'storeBarangRetur']);
Route::get('/admin/barang_retur/edit/{id}', [App\Http\Controllers\TransaksiController::class, 'editBarangRetur']);
Route::put('/admin/barang_retur/update/{id}', [App\Http\Controllers\TransaksiController::class, 'updateBarangRetur']);
Route::delete('/admin/barang_retur/delete/{id}', [App\Http\Controllers\TransaksiController::class, 'deleteBarangRetur']);
Route::get('/admin/barang_retur/view/{id}', [App\Http\Controllers\TransaksiController::class, 'viewBarangRetur']);

// Laporan Barang
Route::get('/admin/cetak-barang', [App\Http\Controllers\TransaksiController::class, 'cetakBarang']);
Route::get('/admin/cetak-barang-detail/{nama_barang}', [App\Http\Controllers\TransaksiController::class, 'cetakBarangDetail']);

// Laporan Barang Masuk
Route::get('/admin/cetak-barang-masuk', [App\Http\Controllers\TransaksiController::class, 'cetakBarangMasuk']);
Route::get('/admin/cetak-barang-masuk-pertanggal/{tanggal_awal}/{tanggal_akhir}', [App\Http\Controllers\TransaksiController::class, 'cetakBarangMasukPertanggal']);

// Laporan Barang Keluar
Route::get('/admin/cetak-barang-keluar', [App\Http\Controllers\TransaksiController::class, 'cetakBarangKeluar']);
Route::get('/admin/cetak-barang-keluar-pertanggal/{tanggal_awal}/{tanggal_akhir}', [App\Http\Controllers\TransaksiController::class, 'cetakBarangKeluarPertanggal']);

// Laporan Barang Retur
Route::get('/admin/cetak-barang-retur', [App\Http\Controllers\TransaksiController::class, 'cetakBarangRetur']);
Route::get('/admin/cetak-barang-retur-pertanggal/{tanggal_awal}/{tanggal_akhir}', [App\Http\Controllers\TransaksiController::class, 'cetakBarangReturPertanggal']);
});



Route::middleware(['auth','CheckRole:kepala gudang'])->group(function (){
    
    Route::get('/kepala_gudang/dashboard', [App\Http\Controllers\KepalaGudangController::class, 'dashboard']);

    // Transaksi
    // Barang Masuk
    Route::get('/kepala_gudang/barang_masuk', [App\Http\Controllers\KepalaGudangController::class, 'indexBarangMasuk']);
  Route::get('/kepala_gudang/barang_masuk/view/{id}', [App\Http\Controllers\KepalaGudangController::class, 'viewBarangMasuk']);
    
    // Barang Keluar
    Route::get('/kepala_gudang/barang_keluar', [App\Http\Controllers\KepalaGudangController::class, 'indexBarangKeluar']);
    Route::get('/kepala_gudang/barang_keluar/view/{id}', [App\Http\Controllers\KepalaGudangController::class, 'viewBarangKeluar']);
    
    // Barang Retur
    Route::get('/kepala_gudang/barang_retur', [App\Http\Controllers\KepalaGudangController::class, 'indexBarangRetur']);
     Route::get('/kepala_gudang/barang_retur/view/{id}', [App\Http\Controllers\KepalaGudangController::class, 'viewBarangRetur']);
    
    // Laporan Barang
    Route::get('/kepala_gudang/cetak-barang', [App\Http\Controllers\KepalaGudangController::class, 'cetakBarang']);
    Route::get('/kepala_gudang/cetak-barang-detail/{nama_barang}', [App\Http\Controllers\KepalaGudangController::class, 'cetakBarangDetail']);
    
    // Laporan Barang Masuk
    Route::get('/kepala_gudang/cetak-barang-masuk', [App\Http\Controllers\KepalaGudangController::class, 'cetakBarangMasuk']);
    Route::get('/kepala_gudang/cetak-barang-masuk-pertanggal/{tanggal_awal}/{tanggal_akhir}', [App\Http\Controllers\TransaksiController::class, 'cetakBarangMasukPertanggal']);
    
    // Laporan Barang Keluar
    Route::get('/kepala_gudang/cetak-barang-keluar', [App\Http\Controllers\KepalaGudangController::class, 'cetakBarangKeluar']);
    Route::get('/kepala_gudang/cetak-barang-keluar-pertanggal/{tanggal_awal}/{tanggal_akhir}', [App\Http\Controllers\TransaksiController::class, 'cetakBarangKeluarPertanggal']);
    
    // Laporan Barang Retur
    Route::get('/kepala_gudang/cetak-barang-retur', [App\Http\Controllers\KepalaGudangController::class, 'cetakBarangRetur']);
    Route::get('/kepala_gudang/cetak-barang-retur-pertanggal/{tanggal_awal}/{tanggal_akhir}', [App\Http\Controllers\TransaksiController::class, 'cetakBarangReturPertanggal']);
    });