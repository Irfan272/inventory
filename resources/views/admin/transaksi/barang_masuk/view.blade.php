@extends('admin.layout.master')

@section('title', 'View Barang Masuk')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>View Barang Masuk</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form action="/admin/barang_masuk/update/{{ $barangmasuk->id }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="id_supplier">Pemasok:</label>
                                <select name="id_supplier" disabled id="id_supplier" class="form-control" required>
                                    <option value="">Pilih Pemasok</option>
                                    @foreach($supplier as $supplier)
                                        <option value="{{ $supplier->id }}" {{ $barangmasuk->id_supplier == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->nama_supplier }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_pembelian">Tanggal Masuk:</label>
                                <input type="date" name="tanggal_masuk" readonly id="tanggal_masuk" class="form-control" value="{{ $barangmasuk->tanggal_masuk }}" required>
                            </div>

                            <hr>
                            <h4>Detail Barang Masuk:</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pembelianBarang as $key => $pembelianDetail)
                                        <tr>
                                            <td>
                                                <select name="id_barang[]" class="form-control" disabled>
                                                    <option value="">Pilih Produk</option>
                                                    @foreach($barang as $brg)
                                                    <option value="{{ $brg->id }}" {{ $brg->id == $pembelianDetail->id_barang ? 'selected' : '' }}>
                                                        {{ $brg->nama_barang }}
                                                    </option>
                                                @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="jumlah[{{ $key }}]" readonly class="form-control" min="1" value="{{ $pembelianDetail->jumlah }}" required>
                                            </td>
                                            <td>
                                                <input type="text" name="satuan[{{ $key }}]" readonly class="form-control" value="{{ $pembelianDetail->satuan }}" readonly required>
                                            </td>
                                            <td>
                                                <input type="number" name="harga[{{ $key }}]" readonly class="form-control" min="1" value="{{ $pembelianDetail->harga }}" required>
                                            </td>
                                            {{-- <td>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- <button type="button" class="btn btn-primary" id="addRow">Tambah Baris</button>
                            <button type="submit" class="btn btn-success">Update Pembelian</button> --}}
                            <a href="/admin/barang_masuk" class="btn btn-danger">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('addRow').addEventListener('click', function() {
        var row = '<tr>' +
            '<td><select name="id_barang[]" class="form-control">' +
            '<option value="">Pilih Produk</option>' +
            '@foreach($barang as $product)' +
            '<option value="{{ $product->id }}">{{ $product->nama_barang }}</option>' +
            '@endforeach' +
            '</select></td>' +
            '<td><input type="number" name="jumlah[]" class="form-control" min="1" required></td>' +
            '<td><input type="text" name="satuan[]" value="Pcs" class="form-control" readonly required></td>' +
            '<td><input type="number" name="harga[]" class="form-control" min="1" required></td>' +
            '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>' +
            '</tr>';

        document.querySelector('table tbody').insertAdjacentHTML('beforeend', row);
    });

    function removeRow(button) {
        var row = button.closest('tr');
        row.remove();
    }
    document.addEventListener("DOMContentLoaded", function () {
    var inputHargaElements = document.querySelectorAll(".input-harga");
    inputHargaElements.forEach(function (inputHarga) {
        inputHarga.addEventListener("input", function (e) {
            formatRupiah(e.target);
        });
    });
});

function formatRupiah(inputElement) {
    var value = inputElement.value;
    var numberString = value.replace(/\D/g, ''); // Menghapus karakter non-numerik
    var formattedNumber = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0, maximumFractionDigits: 0 }).format(numberString);
    inputElement.value = formattedNumber;
}
</script>
@endsection
