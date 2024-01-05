@extends('admin.layout.master')

@section('title', 'Edit Data Pelanggan')

@section('content')
     <!-- page content -->
     <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Pelanggan</h3>
                </div>

              
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        
                        <div class="x_content">
                            @foreach ($pelanggan as $e)
                                
                            <form class="" action="/admin/pelanggan/update/{{ $e->id }}" method="post" novalidate>
                                @csrf
                                @method('PATCH')
                                <span class="section">Edit Data Pelanggan</span>
                              
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Nama Sales<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ $e->nama }}" class="@error('nama') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="nama" required="required" />
                                        @error('nama')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>
                                </div>
                           
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Alamat<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ $e->alamat }}" class="@error('alamat') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="alamat" required="required" />
                                        @error('alamat')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">No Telepone<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ $e->not_hp }}" class="@error('not_hp') parsley-error @enderror form-control" data-validate-length-range="6" data-validate-words="2" name="not_hp" required="required" />
                                        @error('not_hp')
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
                                            <a href="/admin/pelanggan" class="btn btn-danger">Batal</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection