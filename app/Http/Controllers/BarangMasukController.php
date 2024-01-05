<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Rfc4122\Validator;

class BarangMasukController extends Controller
{
    public function index(){
        $barang_masuk = BarangMasuk::all();

        return view('admin.master_data.penjualan.index', compact('barang_masuk'));
    }

    public function create(){
        $barang = Barang::all();

        return view('admin.master_data.penjualan.create', compact('barang'));
    }

    public function store(Request $request)
{
    // Validasi data yang dikirim dari form
    $validasiData = $request->validate([
        'transaksi.*.id_barang' => 'required',
        'transaksi.*.jumlah' => 'required|numeric|min:1',
        'transaksi.*.tanggal_masuk' => 'required|date',
    ]);

    // if ($validator->fails()) {
    //     return redirect()->route('barang_masuk.create')
    //         ->withErrors($validator)
    //         ->withInput();
    // }

    // Simpan data ke dalam database menggunakan model BarangMasuk
    // $transaksiBarangMasuk = $request->input('transaksi');
    BarangMasuk::create($validasiData);

    return redirect('/admin/barang_masuk')->with('success', 'Transaksi barang masuk berhasil ditambahkan.');
}
}
