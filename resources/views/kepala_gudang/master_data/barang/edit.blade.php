@extends('admin.layout.master')

@section('title', 'Edit Data Barang')

@section('content')
     <!-- page content -->
     <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Barang</h3>
                </div>

              
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        
                        <div class="x_content">
                            @foreach ($barang as $b)
                            <form class="" enctype="multipart/form-data" action="/admin/barang/update/{{ $b->id }}" method="post" novalidate>
                               @csrf
                               @method('PATCH')

                               <span class="section">Edit Data Barang</span>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Kode Barang<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ $b->kd_barang }}" class="@error('kd_barang') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="kd_barang" required="required" />
                                        @error('kd_barang')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror  
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Nama Barang<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ $b->nama_barang }}" name="nama_barang" class="@error('nama_barang') parsley-error @enderror form-control" class='optional' data-validate-length-range="5,15" type="text" />
                                        @error('nama_barang')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror  
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Stok<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ $b->stok }}" name="stok" class="@error('stok') parsley-error @enderror form-control" class='optional' data-validate-length-range="5,15" type="number" />
                                        @error('stok')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror  
                                    </div>
                                </div>
                           
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Satuan<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ $b->satuan }}" readonly name="satuan" class="@error('satuan') parsley-error @enderror form-control" class='optional' data-validate-length-range="5,15" type="text" />
                                        @error('satuan')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror  


                                    </div>
                                </div>                    

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Harga<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ $b->harga }}" name="harga" class="@error('harga') parsley-error @enderror form-control" class='optional' data-validate-length-range="5,15" type="number" />
                                        @error('harga')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror  
                                    </div>
                                </div>                          

            
                          
                                <div class="ln_solid">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type='submit' class="btn btn-primary">Submit</button>
                                            <a href="/admin/barang" class="btn btn-danger">Batal</a>
                                        </div>
                                    </div>
                                </div>
                                
                                   
                               @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection