<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BarangController extends Controller
{
    public function index(){
        $barang = Barang::all();
        return view('admin.master_data.barang.index', compact('barang'));
    }

    public function create(){
        return view('admin.master_data.barang.create');
    }

    public function store(Request $request){
        $validasiData = $request->validate([
            'kd_barang' => 'required',
            'nama_barang' => 'required',
            'stok' => 'required|integer',
            'qty' => 'required|string',
        ]);
        Barang::create($validasiData);

        return redirect('/admin/barang')->with('status', 'Data berhasil ditambah.');
    }

    public function edit($id){
        $barang = Barang::where('id', $id)->get();

        return view('admin.master_data.barang.edit', compact('barang'));
    }

    public function update(Request $request, $id){
        $validasiData = $request->validate([
            'kd_barang' => 'required',
            'nama_barang' => 'required',
            'stok' => 'required|integer',
            'qty' => 'required|string',
            
        ]);

        if($request->file('foto')){
            $validasiData['foto'] = $request->file('foto')->store('post-images');
        }
        Barang::where('id', $id)->update($validasiData);

        return redirect('/admin/barang')->with('status', 'Data berhasil diedit.');
    }

    public function delete($id) {
        Barang::destroy($id);
        return redirect('/admin/barang')->with('status', 'Data berhasil dihapus.');
    }
}
