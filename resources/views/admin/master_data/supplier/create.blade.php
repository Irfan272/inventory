@extends('admin.layout.master')

@section('title', 'Input Data Supplier')

@section('content')
     <!-- page content -->
     <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Supplier</h3>
                </div>

              
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        
                        <div class="x_content">
                            <form class="" action="/admin/supplier/store" method="post" novalidate>
                               @csrf
                                <span class="section">Input Data Supplier</span>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Kode Supplier<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ old('kd_supplier') }}" class="@error('kd_supplier') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="kd_supplier" required="required" />
                                        @error('kd_supplier')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Nama Supplier<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ old('nama_supplier') }}" class="@error('nama_supplier') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="nama_supplier" required="required" />
                                        @error('nama_supplier')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Alamat<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ old('alamat') }}" class="@error('alamat') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="alamat" required="required" />
                                        @error('alamat')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">No Telpon<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ old('no_telpon') }}" class="@error('no_telpon') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="no_telpon" required="required" />
                                        @error('no_telpon')
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
                                            <a href="/admin/supplier" class="btn btn-danger">Batal</a>
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