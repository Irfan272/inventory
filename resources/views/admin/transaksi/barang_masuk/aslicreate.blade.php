@extends('admin.layout.master')

@section('title', 'Input Data Pembelian')

@section('content')
     <!-- page content -->
     <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Pembelian</h3>
                </div>

              
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        
                        <div class="x_content">
                            <form class="" action="/admin/pembelian/store" method="post" novalidate>
                               @csrf
                                <span class="section">Input Data Pembelian</span>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Nama Pembelian<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ old('nama_Pembelian') }}" class="@error('nama_Pembelian') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="nama_Pembelian" required="required" />
                                        @error('nama_Pembelian')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">NPSN<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <select name="id_distributor" id="id_distributor" class="form-control">
                                            <option disabled value="">Pilih Peralatan</option>
                                            @foreach ($barang as $data)
                                                <option value="{{$data->id}}">{{$data->nama_peralatan}}</option>
                                             @endforeach
                                        </select>
                                        @error('npsn')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Alamat<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <textarea class="@error('alamat') parsley-error @enderror" required="required" name='alamat' style="width: 100%">{{ old('alamat') }}</textarea>
                                        @error('alamat')
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
                                            <a href="/admin/pembelian" class="btn btn-danger">Batal</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection