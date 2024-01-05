<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Supplier;
use App\Models\Pelanggan;
use App\Models\Retur;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class MasterDataController extends Controller
{


    public function dashboard(){
        $total_barangmasuk = BarangMasuk::all()->count();
        $total_barangkeluar = BarangKeluar::all()->count();
        $total_retur = Retur::all()->count();

        $barangmasuk = BarangMasuk::all();
        $barangkeluar = BarangKeluar::all();
        $retur = Retur::all();

        return view('admin.dashboard', compact('total_barangmasuk','total_barangkeluar','total_retur', 'barangmasuk', 'barangkeluar', 'retur' ));
    }

    // Akun

    public function akun(){
        $akun = User::all();
        return view('admin.master_data.akun.index', compact('akun'));
    }

    public function create(){
        return view('admin.master_data.akun.create');
    }

    public function store(Request $request){
    $validasiData = $request->validate([
    'name' =>  'required|string|max:255',
    'email' =>  'required|string|max:255|unique:users',
    'password' =>  'required|string|max:20',
    'role' =>  'required|string|max:255',



    ]);
    $validasiData['password'] = Hash::make($validasiData['password']);

    User::create($validasiData);



    return redirect('/admin/akun')->with('status', 'Data berhasil ditambah.');
}

public function edit($id){
    $akun = User::where('id',$id)->get();
 
    return view('admin.master_data.akun.edit', compact('akun'));
} 

public function update(Request $request, $id){
    $validasiData = $request->validate([


        'name' =>  'required|string|max:255',
        'email' =>  'required|string|max:255|',
        'password' =>  'required|string|max:20',
        'role' =>  'required|string|max:255',  
        ]);
        $validasiData['password'] = Hash::make($validasiData['password']);
        User::where('id', $id)->update($validasiData);

        return redirect('/admin/akun');
}

public function delete($id){
    User::destroy($id);
    return back();
}

    // End Akun


    // Barang
    public function indexBarang(){
        $barang = Barang::all();

        $notifications = [];

    foreach ($barang as $item) {
        if ($item->stok < 10) {
            $notifications[] = "Stok barang {$item->nama_barang} tersisa kurang dari 10 Dus, Harap segera Order";
        }

        if ($item->stok > 50) {
            $notifications[] = "Stok barang {$item->nama_barang} terlalu banyak";
        }
    }

    // Menyimpan pesan notifikasi dalam sesi
    session()->flash('notifications', $notifications);
    
        return view('admin.master_data.barang.index', compact('barang'));
    }

    public function createBarang(){
        return view('admin.master_data.barang.create');
    }

    public function storeBarang(Request $request){
        $validasiData = $request->validate([
            'kd_barang' => 'required',
            'nama_barang' => 'required',
            'stok' => 'required|integer',
            'satuan' => 'required|string',
            'harga' => 'required',
        ]);
        // $stok = 0;

        // $validasiData['stok'] = $stok;

        Barang::create($validasiData);

        return redirect('/admin/barang')->with('status', 'Data berhasil ditambah.');
    }

    public function editBarang($id){
        $barang = Barang::where('id', $id)->get();

        return view('admin.master_data.barang.edit', compact('barang'));
    }

    public function updateBarang(Request $request, $id){
        $validasiData = $request->validate([
            'kd_barang' => 'required',
            'nama_barang' => 'required',
            'stok' => 'required|integer',
            'satuan' => 'required|string',
            'harga' => 'required',
        ]);

        Barang::where('id', $id)->update($validasiData);

        return redirect('/admin/barang')->with('status', 'Data berhasil diedit.');
    }

    public function deleteBarang($id) {
        Barang::destroy($id);
        return redirect('/admin/barang')->with('status', 'Data berhasil dihapus.');
    }

    // End Barang

    // Pelanggan

    public function indexSales(){
        $sales = Sales::all();
        return view('admin.master_data.sales.index', compact('sales'));
    }

    public function createSales(){
        return view('admin.master_data.sales.create');
    }

    public function storeSales(Request $request){
        $validasiData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'not_hp' => 'required',
        ]);
        // $stok = 0;

        // $validasiData['stok'] = $stok;

        Sales::create($validasiData);

        return redirect('/admin/sales')->with('status', 'Data berhasil ditambah.');
    }

    public function editSales($id){
        $sales = Sales::where('id', $id)->get();

        return view('admin.master_data.sales.edit', compact('sales'));
    }

    public function updateSales(Request $request, $id){
        $validasiData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'not_hp' => 'required',
        ]);

        Sales::where('id', $id)->update($validasiData);

        return redirect('/admin/sales')->with('status', 'Data berhasil diedit.');
    }

    public function deleteSales($id) {
        Sales::destroy($id);
        return redirect('/admin/sales')->with('status', 'Data berhasil dihapus.');
    }
    // End Pelanggan 

    // Supplier

    public function indexSupplier(){
        $supplier = Supplier::all();
        return view('admin.master_data.supplier.index', compact('supplier'));
    }

    public function createSupplier(){
        return view('admin.master_data.supplier.create');
    }

    public function storeSupplier(Request $request){
        $validasiData = $request->validate([
            'kd_supplier' => 'required',
            'nama_supplier' => 'required',
            'alamat' => 'required|string',
            'no_telpon' => 'required|string',
        ]);
        // $stok = 0;

        // $validasiData['stok'] = $stok;

        Supplier::create($validasiData);

        return redirect('/admin/supplier')->with('status', 'Data berhasil ditambah.');
    }

    public function editSupplier($id){
        $supplier = Supplier::where('id', $id)->get();

        return view('admin.master_data.supplier.edit', compact('supplier'));
    }

    public function updateSupplier(Request $request, $id){
        $validasiData = $request->validate([
            'kd_supplier' => 'required',
            'nama_supplier' => 'required',
            'alamat' => 'required|string',
            'no_telpon' => 'required|string',
        ]);

        Supplier::where('id', $id)->update($validasiData);

        return redirect('/admin/supplier')->with('status', 'Data berhasil diedit.');
    }

    public function deleteSupplier($id) {
        Supplier::destroy($id);
        return redirect('/admin/supplier')->with('status', 'Data berhasil dihapus.');
    }

    // End Supplier


}
