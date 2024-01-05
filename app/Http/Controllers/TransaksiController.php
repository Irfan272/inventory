<?php

namespace App\Http\Controllers;

use App\Models\Retur;
use App\Models\Sales;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Pelanggan;
use App\Models\BarangMasuk;
use App\Models\ReturDetail;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\BarangMasukDetail;
use App\Models\BarangKeluarDetail;
use Illuminate\Routing\Controller;

class TransaksiController extends Controller
{
    public function indexBarangMasuk(){
        $barangmasuk = BarangMasuk::with('Supplier')->orderBy('tanggal_masuk', 'desc')->get();
        return view('admin.transaksi.barang_masuk.index', compact('barangmasuk'));
    }

    private function generate_unique_no_po()
    {
        $prefix = 'NP'; // Awalan untuk nomor PO (opsional)
        $date = date('Ymd'); // Format tanggal saat ini (YYYYMMDD)
        $last_po = BarangMasuk::max('id'); // Mendapatkan ID terakhir dari tabel Pembelian
    
        $seq_number = $last_po ? ($last_po + 1) : 1; // Nomor urut berdasarkan ID terakhir
        $no_po = "{$prefix}-{$date}-{$seq_number}";
    
        return $no_po;
    }

    public function createBarangMasuk(){
        $supplier = Supplier::all();
        $barang = Barang::all();
        $no_po = $this->generate_unique_no_po();
        return view('admin.transaksi.barang_masuk.create', compact('supplier', 'barang', 'no_po'));
    }

  
    

    public function storeBarangMasuk(Request $request){

        $no_po = $this->generate_unique_no_po();

        $request->validate([
            // 'no_po' => 'required'
            'id_supplier' => 'required|exists:suppliers,id',
            'tanggal_masuk' => 'required|date', 
            'id_barang.*' => 'required|exists:barangs,id',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        $barangmasuk = BarangMasuk::create([
            'id_supplier' => $request->id_supplier,
            'tanggal_masuk' => $request->tanggal_masuk,
            'no_po' => $request->no_po,
        ]);

        foreach($request->id_barang as $key => $idBarang){
            $barang = Barang::find($idBarang);
                // Hapus karakter non-numerik dari harga
                $harga = preg_replace("/[^0-9]/", "", $request->harga[$key]);
            BarangMasukDetail::create([
                'id_barangmasuk' => $barangmasuk->id,
                'id_barang' => $idBarang,
                'jumlah' => $request->jumlah[$key],
                'satuan' => $request->satuan,
                'harga' => intval($harga), // Konversi menjadi integer
            ]);

            // update stok barang 
            $barang->stok += $request->jumlah[$key];
            $barang->save();
        }
        return redirect('/admin/barang_masuk')->with('status', 'Data berhasil ditambah.');
    }

    public function editBarangMasuk($id){
        $supplier = Supplier::all();
        $barang = Barang::all();
        $barangmasuk = BarangMasuk::findOrFail($id);

        $pembelianBarang = $barangmasuk->BarangMasukDetail;

        return view('admin.transaksi.barang_masuk.edit', compact('supplier', 'barang', 'barangmasuk', 'pembelianBarang'));
    }

    public function updateBarangMasuk(Request $request, $id) {
        $request->validate([
            'id_supplier' => 'required|exists:suppliers,id',
            'tanggal_masuk' => 'required|date', 
            'id_barangmasukdetail.*' => 'required|exists:barang_masuk_details,id', // Ubah bagian ini sesuai nama tabel yang sesuai
            'jumlah.*' => 'required|integer|min:1',
        ]);
    
        $barangmasuk = BarangMasuk::findOrFail($id);
    
        // Simpan nomor PO yang sudah ada sebelumnya
        $no_po = $barangmasuk->no_po;
    
        // Update data pembelian
        $barangmasuk->id_supplier = $request->id_supplier;
        $barangmasuk->tanggal_masuk = $request->tanggal_masuk;
        $barangmasuk->save();
    
        // Menghapus data lama di BarangMasukDetail yang di-marked untuk dihapus
        if ($request->has('id_barangmasukdetail')) {
        foreach ($request->id_barangmasukdetail as $key => $idBarangMasukDetail) {
            if ($idBarangMasukDetail !== 'new') {
                BarangMasukDetail::where('id_barangmasuk', $barangmasuk->id)
                    ->where('id', $idBarangMasukDetail)
                    ->delete();
            }
        }
    }
    
        // Menghandle detail pembelian_barangs yang sudah ada dan yang baru dimasukkan
        foreach ($request->id_barang as $key => $idBarang) {
            $barangmasukDetail = BarangMasukDetail::where('id_barangmasuk', $barangmasuk->id)
                                    ->where('id_barang', $idBarang)
                                    ->first();
    
            if ($barangmasukDetail) {
                // Jika detail pembelian_barangs sudah ada, lakukan update
                $barangmasukDetail->jumlah = $request->jumlah[$key];
                $barangmasukDetail->satuan = $request->satuan[$key];
                $barangmasukDetail->harga = $request->harga[$key];
                $barangmasukDetail->save();
            } else {
                // Jika detail pembelian_barangs belum ada, tambahkan sebagai data baru
                BarangMasukDetail::create([
                    'id_barangmasuk' => $barangmasuk->id,
                    'id_barang' => $idBarang,
                    'jumlah' => $request->jumlah[$key],
                    'satuan' => $request->satuan[$key],
                    'harga' => $request->harga[$key],
                ]);
    
                // Update stok barang
                $barang = Barang::find($idBarang);
                $barang->stok += $request->jumlah[$key];
                $barang->save();
            }
        }
    
        // Kembalikan nomor PO yang sudah ada sebelumnya
        $barangmasuk->no_po = $no_po;
        $barangmasuk->save();
    
        return redirect('/admin/barang_masuk')->with('success', 'Transaksi barang masuk berhasil diubah.');
    }
    
    
    
    
    
    public function viewBarangMasuk($id){
        $supplier = Supplier::all();
        $barang = Barang::all();
        $barangmasuk = BarangMasuk::findOrFail($id);

        $pembelianBarang = $barangmasuk->BarangMasukDetail;

        return view('admin.transaksi.barang_masuk.view', compact('supplier', 'barang', 'barangmasuk', 'pembelianBarang'));
    }

    public function deleteBarangMasuk($id) {
        BarangMasuk::destroy($id);
        return redirect('/admin/barang_masuk')->with('status', 'Data berhasil dihapus.');
    }



    // Barang Keluar
    public function indexBarangKeluar(){
        $barangkeluar = BarangKeluar::with('Sales')->orderBy('tanggal_keluar', 'desc')->get();
        return view('admin.transaksi.barang_keluar.index', compact('barangkeluar'));
    }

    private function generate_unique_no_po_keluar()
    {
        $prefix = 'PO'; // Awalan untuk nomor PO (opsional)
        $date = date('Ymd'); // Format tanggal saat ini (YYYYMMDD)
        $last_po = BarangKeluar::max('id'); // Mendapatkan ID terakhir dari tabel Pembelian
    
        $seq_number = $last_po ? ($last_po + 1) : 1; // Nomor urut berdasarkan ID terakhir
        $no_po = "{$prefix}-{$date}-{$seq_number}";
    
        return $no_po;
    }

    public function createBarangKeluar(){
        $sales = Sales::all();
        $barang = Barang::all();
        $no_po = $this->generate_unique_no_po_keluar();
        return view('admin.transaksi.barang_keluar.create', compact('sales', 'barang', 'no_po'));
    }

  
    

    public function storeBarangKeluar(Request $request){

        $no_po = $this->generate_unique_no_po_keluar();

        $request->validate([
            // 'no_po' => 'required'
            'id_sales' => 'required|exists:sales,id',
            'tanggal_keluar' => 'required|date', 
            'id_barang.*' => 'required|exists:barangs,id',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        $barangkeluar = BarangKeluar::create([
            'id_sales' => $request->id_sales,
            'tanggal_keluar' => $request->tanggal_keluar,
            'no_po' => $no_po,
        ]);

        foreach($request->id_barang as $key => $idBarang){
            $barang = Barang::find($idBarang);

            $harga = preg_replace("/[^0-9]/", "", $request->harga[$key]);

            BarangKeluarDetail::create([
                'id_barangkeluar' => $barangkeluar->id,
                'id_barang' => $idBarang,
                'jumlah' => $request->jumlah[$key],
                'satuan' => $request->satuan,
                'harga' => intval($harga), // Konversi menjadi integer
            ]);

            // update stok barang 
            $barang->stok -= $request->jumlah[$key];
            $barang->save();
        }
        return redirect('/admin/barang_keluar')->with('status', 'Data berhasil ditambah.');
    }

    public function editBarangKeluar($id){
        $sales = Sales::all();
        $barang = Barang::all();
        $barangkeluar = BarangKeluar::findOrFail($id);

        $pembelianBarang = $barangkeluar->BarangKeluarDetail;

        return view('admin.transaksi.barang_keluar.edit', compact('sales', 'barang', 'barangkeluar', 'pembelianBarang'));
    }

    public function updateBarangKeluar(Request $request, $id) {
        $request->validate([
            'id_sales' => 'required|exists:sales,id',
            'tanggal_keluar' => 'required|date', 
            'id_barangkeluardetail.*' => 'required|exists:barang_keluar_details,id', // Ubah bagian ini sesuai nama tabel yang sesuai
            'jumlah.*' => 'required|integer|min:1',
        ]);
    
        $barangkeluar = BarangKeluar::findOrFail($id);
    
        // Simpan nomor PO yang sudah ada sebelumnya
        $no_po = $barangkeluar->no_po;
    
        // Update data pembelian
        $barangkeluar->id_sales = $request->id_sales;
        $barangkeluar->tanggal_keluar = $request->tanggal_keluar;
        $barangkeluar->save();
    
        // Menghapus data lama di BarangkeluarDetail yang di-marked untuk dihapus
        if ($request->has('id_barangkeluardetail')) {
        foreach ($request->id_barangkeluardetail as $key => $idBarangKeluarDetail) {
            if ($idBarangKeluarDetail !== 'new') {
                BarangKeluarDetail::where('id_barangkeluar', $barangkeluar->id)
                    ->where('id', $idBarangKeluarDetail)
                    ->delete();
            }
        }
    }
    
        // Menghandle detail pembelian_barangs yang sudah ada dan yang baru diKeluarkan
        foreach ($request->id_barang as $key => $idBarang) {
            $barangkeluarDetail = BarangKeluarDetail::where('id_barangkeluar', $barangkeluar->id)
                                    ->where('id_barang', $idBarang)
                                    ->first();
    
            if ($barangkeluarDetail) {
                // Jika detail pembelian_barangs sudah ada, lakukan update
                $barangkeluarDetail->jumlah = $request->jumlah[$key];
                $barangkeluarDetail->satuan = $request->satuan[$key];
                $barangkeluarDetail->harga = $request->harga[$key];
                $barangkeluarDetail->save();
            } else {
                // Jika detail pembelian_barangs belum ada, tambahkan sebagai data baru
                BarangKeluarDetail::create([
                    'id_barangkeluar' => $barangkeluar->id,
                    'id_barang' => $idBarang,
                    'jumlah' => $request->jumlah[$key],
                    'satuan' => $request->satuan[$key],
                    'harga' => $request->harga[$key],
                ]);
    
                // Update stok barang
                $barang = Barang::find($idBarang);
                $barang->stok += $request->jumlah[$key];
                $barang->save();
            }
        }
    
        // Kembalikan nomor PO yang sudah ada sebelumnya
        $barangkeluar->no_po = $no_po;
        $barangkeluar->save();
    
        return redirect('/admin/barang_keluar')->with('success', 'Transaksi barang keluar berhasil diubah.');
    }
    
    
    
    
    
    public function viewBarangKeluar($id){
        $sales = Sales::all();
        $barang = Barang::all();
        $barangkeluar = BarangKeluar::findOrFail($id);

        $pembelianBarang = $barangkeluar->BarangKeluarDetail;

        return view('admin.transaksi.barang_keluar.view', compact('sales', 'barang', 'barangkeluar', 'pembelianBarang'));
    }

    public function deleteBarangKeluar($id) {
        BarangKeluar::destroy($id);
        return redirect('/admin/barang_keluar')->with('status', 'Data berhasil dihapus.');
    }



    // Barang Retur
    public function indexBarangRetur(){
        $retur = Retur::with('Sales', 'ReturDetail')->orderBy('tanggal_retur', 'desc')->get();

        
        return view('admin.transaksi.barang_retur.index', compact('retur'));
    }

    private function generate_unique_no_po_retur()
    {
        $prefix = 'NR'; // Awalan untuk nomor PO (opsional)
        $date = date('Ymd'); // Format tanggal saat ini (YYYYMMDD)
        $last_po = Retur::max('id'); // Mendapatkan ID terakhir dari tabel Pembelian
    
        $seq_number = $last_po ? ($last_po + 1) : 1; // Nomor urut berdasarkan ID terakhir
        $no_retur = "{$prefix}-{$date}-{$seq_number}";
    
        return $no_retur;
    }



    public function createBarangRetur(){
        $sales = Sales::all();
        $barang = Barang::all();
        $no_retur = $this->generate_unique_no_po_retur();
        return view('admin.transaksi.barang_retur.create', compact('sales', 'barang', 'no_retur'));
    }

  
    

    public function storeBarangRetur(Request $request){

        $no_retur = $this->generate_unique_no_po_retur();

        $request->validate([
            // 'no_po' => 'required'
            'id_sales' => 'required|exists:sales,id',
            'tanggal_retur' => 'required|date', 
            'id_barang.*' => 'required|exists:barangs,id',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        $barangretur = Retur::create([
            'id_sales' => $request->id_sales,
            'tanggal_retur' => $request->tanggal_retur,
            'no_retur' => $no_retur,
        ]);

        foreach($request->id_barang as $key => $idBarang){
            // $barang = Barang::find($idBarang);
            $harga = preg_replace("/[^0-9]/", "", $request->harga[$key]);
            ReturDetail::create([
                'id_retur' => $barangretur->id,
                'id_barang' => $idBarang,
                'jumlah' => $request->jumlah[$key],
                'satuan' => $request->satuan,
                'harga' => intval($harga), // Konversi menjadi integer
            ]);

            // // update stok barang 
            // $barang->stok -= $request->jumlah[$key];
            // $barang->save();
        }
        return redirect('/admin/barang_retur')->with('status', 'Data berhasil ditambah.');
    }

    public function editBarangRetur($id){
        $sales = Sales::all();
        $barang = Barang::all();
        $retur = Retur::findOrFail($id);

        $pembelianBarang = $retur->ReturDetail;

        return view('admin.transaksi.barang_retur.edit', compact('sales', 'barang', 'retur', 'pembelianBarang'));
    }

    public function updateBarangRetur(Request $request, $id) {
        $request->validate([
            'id_sales' => 'required|exists:sales,id',
            'tanggal_retur' => 'required|date', 
            'id_returdetail.*' => 'required|exists:retur_details,id', // Ubah bagian ini sesuai nama tabel yang sesuai
            'jumlah.*' => 'required|integer|min:1',
        ]);
    
        $retur = Retur::findOrFail($id);
    
        // Simpan nomor PO yang sudah ada sebelumnya
        $no_retur = $retur->no_retur;
    
        // Update data pembelian
        $retur->id_sales = $request->id_sales;
        $retur->tanggal_retur = $request->tanggal_retur;
        $retur->save();
    
        // Menghapus data lama di returDetail yang di-marked untuk dihapus
        if ($request->has('id_returdetail')) {
        foreach ($request->id_returdetail as $key => $idReturDetail) {
            if ($idReturDetail !== 'new') {
                ReturDetail::where('id_retur', $retur->id)
                    ->where('id', $idReturDetail)
                    ->delete();
            }
        }
    }
    
        // Menghandle detail pembelian_barangs yang sudah ada dan yang baru direturkan
        foreach ($request->id_barang as $key => $idBarang) {
            $returDetail = returDetail::where('id_retur', $retur->id)
                                    ->where('id_barang', $idBarang)
                                    ->first();
    
            if ($returDetail) {
                // Jika detail pembelian_barangs sudah ada, lakukan update
                $returDetail->jumlah = $request->jumlah[$key];
                $returDetail->satuan = $request->satuan[$key];
                $returDetail->harga = $request->harga[$key];
                $returDetail->save();
            } else {
                // Jika detail pembelian_barangs belum ada, tambahkan sebagai data baru
                returDetail::create([
                    'id_retur' => $retur->id,
                    'id_barang' => $idBarang,
                    'jumlah' => $request->jumlah[$key],
                    'satuan' => $request->satuan[$key],
                    'harga' => $request->harga[$key],
                ]);
    
                // Update stok barang
                $barang = Barang::find($idBarang);
                $barang->stok += $request->jumlah[$key];
                $barang->save();
            }
        }
    
        // Kembalikan nomor PO yang sudah ada sebelumnya
        $retur->no_retur = $no_retur;
        $retur->save();
    
        return redirect('/admin/barang_retur')->with('success', 'Transaksi barang retur berhasil diubah.');
    }
    
    
    
    
    
    public function viewBarangRetur($id){
        $sales = Sales::all();
        $barang = Barang::all();
        $retur = retur::findOrFail($id);

        $pembelianBarang = $retur->returDetail;

        return view('admin.transaksi.barang_retur.view', compact('sales', 'barang', 'retur', 'pembelianBarang'));
    }

    public function deleteBarangRetur($id) {
        Retur::destroy($id);
        return redirect('/admin/barang_retur')->with('status', 'Data berhasil dihapus.');
    }



    public function cetakBarang(){
        $barang = Barang::all();
        return view('admin.laporan.cetak-barang', compact('barang'));
    }

    public function cetakBarangDetail($nama_barang){
        // dd($nama_peralatan);
        // $nama_peralatan = $request->input('nama_peralatan');
        $cetakBarang = Barang::where('nama_barang', $nama_barang)->get();
        $cetakBarang = Barang::where('nama_barang', $nama_barang)->get()->first();

        // $riwayat = Barang::with('perawatan', 'pengajuan')->get();
        // dd([$cetakRiwayat]);
        return view('admin.laporan.cetak-barang-detail', compact('cetakBarang', 'cetakBarang'));
    }

    public function cetakBarangMasuk(){
        return view('admin.laporan.cetak-barang-masuk');
    }
    public function cetakBarangMasukPertanggal($tanggal_awal, $tanggal_akhir){
        $tanggal_mulai = Carbon::parse($tanggal_awal)->format('d-m-Y');
        $tanggal_terakhir = Carbon::parse($tanggal_akhir)->format('d-m-Y');
        
        $cetakBarangMasuk = BarangMasuk::with('BarangMasukDetail')->whereBetween('tanggal_masuk', [$tanggal_awal, $tanggal_akhir])->get();
        // dd($cetakBarangMasuk);
        $total = $cetakBarangMasuk->count();
        $tanggal_cetak = Carbon::today()->startOfDay()->format('d-m-Y');

        return view('admin.laporan.cetak-barang-masuk-detail', compact('cetakBarangMasuk', 'total', 'tanggal_mulai', 'tanggal_terakhir', 'tanggal_cetak'));
    }

    public function cetakBarangKeluar(){
        return view('admin.laporan.cetak-barang-keluar');
    }
    public function cetakBarangKeluarPertanggal($tanggal_awal, $tanggal_akhir){
        $tanggal_mulai = Carbon::parse($tanggal_awal)->format('d-m-Y');
        $tanggal_terakhir = Carbon::parse($tanggal_akhir)->format('d-m-Y');
        
        $cetakBarangKeluar = BarangKeluar::with('BarangKeluarDetail')->whereBetween('tanggal_keluar', [$tanggal_awal, $tanggal_akhir])->get();
        // dd($cetakBarangkeluar);
        $total = $cetakBarangKeluar->count();
        $tanggal_cetak = Carbon::today()->startOfDay()->format('d-m-Y');

        return view('admin.laporan.cetak-barang-keluar-detail', compact('cetakBarangKeluar', 'total', 'tanggal_mulai', 'tanggal_terakhir', 'tanggal_cetak'));
    }

    public function cetakBarangRetur(){
        return view('admin.laporan.cetak-barang-retur');
    }
    public function cetakBarangReturPertanggal($tanggal_awal, $tanggal_akhir){
        $tanggal_mulai = Carbon::parse($tanggal_awal)->format('d-m-Y');
        $tanggal_terakhir = Carbon::parse($tanggal_akhir)->format('d-m-Y');
        
        $cetakBarangRetur = Retur::with('ReturDetail')->whereBetween('tanggal_retur', [$tanggal_awal, $tanggal_akhir])->get();
        // dd($cetakBarangretur);
        $total = $cetakBarangRetur->count();
        $tanggal_cetak = Carbon::today()->startOfDay()->format('d-m-Y');

        return view('admin.laporan.cetak-barang-retur-detail', compact('cetakBarangRetur', 'total', 'tanggal_mulai', 'tanggal_terakhir', 'tanggal_cetak'));
    }



}
