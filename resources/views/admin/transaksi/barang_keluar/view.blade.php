@extends('admin.layout.master')

@section('title', 'Edit Data Pembelian')

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
                <h3>View Barang Keluar</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_content">

                        <form action="/admin/barang_keluar/update/{{ $barangkeluar->id }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="id_sales">Sales:</label>
                                <select name="id_sales" disabled id="id_sales" class="form-control" required>
                                    <option value="">Pilih Sales</option>
                                    @foreach($sales as $sales)
                                        <option value="{{ $sales->id }}" {{ $barangkeluar->id_sales == $sales->id ? 'selected' : '' }}>
                                            {{ $sales->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_pembelian">Tanggal keluar:</label>
                                <input type="date" name="tanggal_keluar" readonly id="tanggal_keluar" class="form-control" value="{{ $barangkeluar->tanggal_keluar }}" required>
                            </div>

                            <hr>
                            <h4>Detail Barang keluar:</h4>
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
                            <a href="/admin/barang_keluar" class="btn btn-danger">Batal</a>
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
            '<td><input type="text" name="satuan[]" value="Dus" class="form-control" readonly required></td>' +
            '<td><input type="number" name="harga[]" class="form-control" min="1" required></td>' +
            '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus</button></td>' +
            '</tr>';

        document.querySelector('table tbody').insertAdjacentHTML('beforeend', row);
    });

    function removeRow(button) {
        var row = button.closest('tr');
        row.remove();
    }
</script>
@endsection
