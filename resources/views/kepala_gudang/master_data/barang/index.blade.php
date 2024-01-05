@extends('admin.layout.master')

@section('title', 'Data Barang')

@section('content')
    
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="top_tiles">
            <h1>Data Barang</h1>
          </div>

          <div class="col-md-12 col-sm-12 ">
              <a href="/admin/barang/create" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tambah Data
                  Barang</a>
              <div class="x_panel">
                <div class="x_title">
                  @if (session('status'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif
                  <h2>Tabel Data <small>Barang</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                          <div class="card-box table-responsive">
              
                  <table id="datatable" class="table table-striped table-bordered " style="width:100%">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th style="width: 30%">Action</th>
                      </tr>
                    </thead>


                    <tbody>
                      @foreach ($barang as $b)
                          
                      
                        <tr >
                        <td >{{ $loop->iteration }}</td>
                        <td>{{ $b->kd_barang }}</td>
                        <td>{{ $b->nama_barang }}</td>
                        <td>{{ $b->stok}}</td>
                        <td>{{ $b->satuan }}</td>
                        <td>Rp {{ number_format($b->harga, 2, ',', '.') }}</td>
                        <td style="text-align: left">
                          <a href="/admin/barang/view/{{ $b->id }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                          <a href="/admin/barang/edit/{{ $b->id }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                          <form action="/admin/barang/delete/{{$b->id}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </button>
                        </form>
                        </td>
                      </tr>
                      @endforeach
                      
                    </tbody>
                  </table>
                </div>
                </div>
            </div>
          </div>
              </div>
            </div>
@endsection