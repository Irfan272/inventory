@extends('kepala_gudang.layout.master')

@section('title', 'Data Barang Keluar')

@section('content')
    

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="top_tiles">
            <h1>Data Barang Keluar</h1>
          </div>

          <div class="col-md-12 col-sm-12 ">
              {{-- <a href="/admin/barang_keluar/create" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Input Data
                Barang Keluar</a> --}}
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

                  

                  <h2>Tabel Data <small>Barang Keluar</small></h2>
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
                        <th>No PO</th>
                        <th>Tanggal Keluar</th>                  
                        <th>Nama Sales</th>  
                        <th style="width: 25%">Action</th>
                      </tr>
                    </thead>


                    <tbody>
                      @foreach ($barangkeluar as $s)
                          
                      <tr >
                        <td >{{ $loop->iteration }}</td>
                        <td>{{$s->no_po}}</td>
                        <td>{{ $s->tanggal_keluar }}</td>                    
                        <td>{{ $s->Sales->nama }}</td>               

                        <td style="text-align: left">
                          <a href="/kepala_gudang/barang_keluar/view/{{ $s->id }}" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                          {{-- <a href="/admin/barang_keluar/edit/{{ $s->id }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                          <form action="/admin/barang_keluar/delete/{{$s->id}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </button>
                        </form> --}}
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