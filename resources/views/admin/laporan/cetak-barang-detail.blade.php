<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td,
        table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .wrap-text {
            word-wrap: break-word;
            white-space: normal;
        }
    </style>
    <title>Laporan Perawatan</title>
</head>

<body>
    <div class="container">
        <div class="logo">
            {{-- <h2>PT. PRIMA KONSTRUKSI UTAMA</h2> --}}
            <img src="{{asset('assets/images/logo/logo_pku.png')}}" alt="Logo" srcset="" style="width: 600px; height: 90px">
        </div>
        <div class="text-center mt-5">
            <h4 class="text-center mt-5">Laporan Barang</h4>
            <p>Nama Peralatan: {{ $barang->nama_barang }} </p>
        </div>
        <div class="content">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Barang</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Harga</th>
                     
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayat as $data) 
                        
                   @foreach ($data->perawatan as $perawatan)
                   @foreach ($data->pengajuan as $perbaikan)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        {{-- @foreach ($data->perawatan as $perawatan) --}}
                        <td class="wrap-text">{{$perawatan->tanggal_pekerjaan}}</td>
                        <td class="wrap-text">{{$perawatan->keterangan}}</td>
                        <td class="wrap-text">{{$perawatan->user->username}}</td>
                        <td class="wrap-text">{{$perawatan->status}}</td>
                        
                        {{-- @endforeach --}}
                    
                        <th class="wrap-text">{{$perbaikan->judul}}</th>
                        <td class="wrap-text">{{$perbaikan->tanggal_pekerjaan}}</td>\
                        <td class="wrap-text">{{$perbaikan->keterangan}}</td>
                        <td class="wrap-text">{{$perawatan->user->username}}</td>
                        <td class="wrap-text">{{$perawatan->status}}</td>
                     
                       
                        {{-- <td class="wrap-text">{{$data->prioritas}}</td>
                        <td class="wrap-text">{{$data->tanggal_pekerjaan}}</td>
                        <td class="wrap-text">{{$data->status}}</td> --}}
                        
                    </tr>
                  
                       @endforeach
                       @endforeach
                       @endforeach
                    <tr> 
                        <td></td>
                        <td class="text-center fw-bold" colspan="4">Total Perawatan : </td> 
                        <td class="text-center fw-bold" colspan="4">Total Perbaikan : </td>


                    </tr>
                  
                </tbody>
            </table>
        </div>

        <div class="text-end">
            {{-- <p>Serang, {{$tanggal_cetak}}</p> --}}
            <p class="text-decoration-underline me-5 mt-5 w-">Khairul</p>
            <p>Manager Maintenance</p>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>