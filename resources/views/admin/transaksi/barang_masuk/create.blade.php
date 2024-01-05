@extends('admin.layout.master')

@section('title', 'Input Data Barang Masuk')

@section('content')


<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Form Barang Masuk</h3>
            </div>

          
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    
                    <div class="x_content">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                        <form action="/admin/barang_masuk/store" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="supplier_id">PO Barang Masuk</label>
                                <input type="hidden" value="{{$no_po}}" name="no_po" id="no_po" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="supplier_id">Supplier:</label>
                                <select name="id_supplier" id="id_supplier" class="form-control" required>
                                    <option value="">Pilih Supplier</option>
                                    @foreach($supplier as $s)
                                        <option value="{{ $s->id }}">{{ $s->nama_supplier }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_masuk">Tanggal Masuk:</label>
                                <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" required>
                            </div>
                            <hr>
                            <h4>Detail Barang Masuk:</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="id_barang[]" class="form-control selectpicker" data-live-search="true">
                                                <option value="">Pilih Produk</option>
                                                @foreach($barang as $product)
                                                    <option value="{{ $product->id }}">{{ $product->kd_barang }} | {{ $product->nama_barang }}, </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="number" name="jumlah[]"  class="form-control " min="1" required></td>
                                        <td><input type="text" name="satuan" class="form-control" value="Dus" readonly required></td>
                                        <td><input type="text" name="harga[]" class="form-control input-harga" min="1" required></td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary" id="addRow">Tambah Baris</button>
                            <button type="submit" class="btn btn-success">Simpan Barang Masuk</button>
                            <a href="/admin/barang_masuk" class="btn btn-danger" >Batal</a>
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
                '<td><select name="id_barang[]" class="form-control ">' +
                '<option value="">Pilih Produk</option>' +
                '@foreach($barang as $product)' +
                '<option value="{{ $product->id }}">{{ $product->kd_barang }} | {{ $product->nama_barang }}</option>' +
                '@endforeach' +
                '</select></td>' +
                '<td><input type="number" name="jumlah[]" class="form-control" min="1" required></td>' +
                '<td><input type="text" name="satuan" value="Dus" class="form-control" readonly required></td>' +
                ' <td><input type="text" name="harga[]" class="form-control input-harga" min="1" required></td>' +
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
