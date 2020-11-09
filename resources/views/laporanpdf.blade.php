<!DOCTYPE html>
<html style="margin: 0; padding: 0">
<head>
    <title>Cover</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
     {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}

</head>
<body>
<div class='container-fluid'>
    <div class="text-center">
        <h5><b>Laporan Keadaan Buku</b></h5>
        <h5><b>Selama Tahun Ajaran {{date('Y',strtotime('-1 year'))}} - {{date('Y')}}</b></h5>
    </div>
    <table id="datatables-basic" class="table table-striped dataTable dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-basic_info">
        <thead>
            <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="datatables-basic" rowspan="2" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending">Bulan</th>
                <th class="sorting text-center" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="8"  aria-label="Buku Perpustakaan: activate to sort column ascending">Buku Perpustakaan</th>
            </tr>
            <tr role="row">
                @foreach ($kategoris as $kategori)

                {{-- <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="{{$kategori->nama}}: activate to sort column ascending">{{$kategori->nama}}</th> --}}
                @endforeach
                <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-label="Paket: activate to sort column ascending">Paket</th>
                <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-label="Pengayaan: activate to sort column ascending">Pengayaan</th>
                <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Cerpen: activate to sort column ascending">Cerpen</th>
                <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Referensi: activate to sort column ascending">Referensi</th>
                <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Surat Kabar: activate to sort column ascending">Surat Kabar</th>
                <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Buku Yang Baik: activate to sort column ascending">Buku Yang Baik</th>
                <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Buku Rusak: activate to sort column ascending">Buku Rusak</th>
                <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Jumlah: activate to sort column ascending">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr role="row" class="odd">
                <td>Juli</td>
                    @foreach ($juli as $laporan)
                    <td class="text-center">{{$laporan->nilai}}</td>
                    @endforeach
            </tr>
            <tr role="row" class="odd">
                <td>Agustus</td>
                    @foreach ($agustus as $laporan)
                    <td class="text-center">{{$laporan->nilai}}</td>
                    @endforeach
            </tr>
            <tr role="row" class="odd">
                <td>September</td>
                    @foreach ($september as $laporan)
                    <td class="text-center">{{$laporan->nilai}}</td>
                    @endforeach
            </tr>
            <tr role="row" class="odd">
                <td>Oktober</td>
                    @foreach ($oktober as $laporan)
                    <td class="text-center">{{$laporan->nilai}}</td>
                    @endforeach
            </tr>
            <tr role="row" class="odd">
                <td>November</td>
                    @foreach ($november as $laporan)
                    <td class="text-center">{{$laporan->nilai}}</td>
                    @endforeach
            </tr>
            <tr role="row" class="odd">
                <td>Desember</td>
                    @foreach ($desember as $laporan)
                    <td class="text-center">{{$laporan->nilai}}</td>
                    @endforeach
            </tr>
            <tr role="row" class="odd">
                <td>Januari</td>
                    @foreach ($januari as $laporan)
                    <td class="text-center">{{$laporan->nilai}}</td>
                    @endforeach
            </tr>
            <tr role="row" class="odd">
                <td>Februari</td>
                    @foreach ($februari as $laporan)
                    <td class="text-center">{{$laporan->nilai}}</td>
                    @endforeach
            </tr>
            <tr role="row" class="odd">
                <td>Maret</td>
                    @foreach ($maret as $laporan)
                    <td class="text-center">{{$laporan->nilai}}</td>
                    @endforeach
            </tr>
            <tr role="row" class="odd">
                <td>April</td>
                    @foreach ($april as $laporan)
                    <td class="text-center">{{$laporan->nilai}}</td>
                    @endforeach
            </tr>
            <tr role="row" class="odd">
                <td>Mei</td>
                    @foreach ($mei as $laporan)
                    <td class="text-center">{{$laporan->nilai}}</td>
                    @endforeach
            </tr>
            <tr role="row" class="odd">
                <td>Juni</td>
                    @foreach ($juni as $laporan)
                    <td class="text-center">{{$laporan->nilai}}</td>
                    @endforeach
            </tr>
        </tbody>
    </table>
</div>
</body>
</html>
