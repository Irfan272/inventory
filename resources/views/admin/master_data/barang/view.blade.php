@extends('admin.layout.master')

@section('title', 'View Data Guru')

@section('content')
     <!-- page content -->
     <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Guru</h3>
                </div>

              
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        
                        <div class="x_content">
                            
                            <span class="section">View Data Guru</span>

                            @foreach ($guru as $g)

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">NIP<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ $g->NIP }}" disabled readonly class="form-control" data-validate-length-range="6" data-validate-words="2" name="nip" required="required" />
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Nama Lengkap<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ ucwords($g->nama_lengkap) }}" disabled readonly name="nama" class="form-control" class='optional' data-validate-length-range="5,15" type="text" /></div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Email<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ ucwords($g->email) }}" disabled readonly class="form-control" name="email" class='email' required="required" type="email" /></div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Tempat Lahir<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ ucwords($g->tempat_lahir) }}" disabled readonly class="form-control" class='optional' name="tempat_lahir" data-validate-length-range="5,15" type="text" /></div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Tanggal Lahir<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ ucwords($g->tanggal_lahir) }}" disabled readonly class="form-control" class='date' type="date" name="tgl_lahir" required='required'></div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Agama<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ ucwords($g->agama) }}" disabled readonly class="form-control" class='optional' name="agama" data-validate-length-range="5,15" type="text" /></div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Alamat<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <textarea readonly disabled required="required" name='alamat' style="width: 100%">{{ $g->alamat }}</textarea></div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">No. Telepon<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ ucwords($g->no_telpon) }}" disabled readonly class="form-control" type="tel" class='tel' name="telpon" required='required' data-validate-length-range="8,20" /></div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Jenis Kelamin<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ ucwords($g->jenis_kelamin) }}" disabled readonly class="form-control" type="tel" class='tel' name="telpon" required='required' data-validate-length-range="8,20" /></div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Pendidikan Terakhir<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ ucwords($g->pendidikan_terakhir) }}" disabled readonly class="form-control" type="tel" class='tel' name="telpon" required='required' data-validate-length-range="8,20" /></div>
                                </div>
                          
                                <div class="ln_solid">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <a href="/admin/guru" class="btn btn-primary">Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection