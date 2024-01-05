<!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Laporan</title>
            <style>
                @page {
                    size: A4;
                    margin: 0;
                }

                body {
                    margin: 2cm;
                }

                h1 {
                    text-align: center;
                    margin-bottom: 20px;
                }

                p {
                    text-align: center;
                    margin-bottom: 20px;
                }

                .logo {
                    height: 80px;
                    width: auto;
                    display: block;
                    text-align: left;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }

                th,
                td {
                    border: 1px solid #000;
                    padding: 8px;
                    text-align: center;
                }

                .wrap-text {
                    word-wrap: break-word;
                    white-space: normal;
                }

                .page-break {
                    page-break-after: always;
                }
            </style>
        </head>

      <body>


            <header>
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR1MT641Rsmo35-95u5wLtg7XVrIvcQH_01EJATVxumWY-Y5quX45SBusZa8isxwAhB8xo"
                    alt="Logo Perusahaan" class="logo">
                <h1 class="wrap-text">Laporan Barang Keluar</h1>
            </header>

            <main>
                {{-- <p>Berikut ini merupakan hasil penilaian untuk penentuan perpanjangan kontrak kerja Pegawai Tidak Tetap (PTT) :</p> --}}
                <p class="text-center">Range tanggal: {{ $tanggal_mulai }} s/d {{ $tanggal_terakhir }}</p>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Keluar</th>
                            <th>Nama Sales</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
        

        <tr>
            @foreach ($cetakBarangKeluar as $index => $barangKeluar)
            @if ($barangKeluar->BarangKeluarDetail)
                @foreach ($barangKeluar->BarangKeluarDetail as $barangKeluarDetail)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$barangKeluar->tanggal_keluar}}</td>
                        <td>{{$barangKeluar->Sales->nama}}</td>
                        <td>{{ $barangKeluarDetail->Barang->nama_barang }}</td>
                        <td>{{ $barangKeluarDetail->jumlah }}</td>
                        <td>{{ $barangKeluarDetail->satuan }}</td>
                        <td>Rp {{ number_format($barangKeluarDetail->harga, 2,',', '.' )  }}</td>
                    </tr>
                @endforeach
            @endif
        @endforeach
        </tr>

     
                    </tbody>
                </table>

           
              
        </main>
        
        <script>
            window.onload = function () {
                window.print();
            };
        </script>
        
        {{-- @if (!$loop->last)
            <div class="page-break"></div>
        @endif --}}


</body>

</html>