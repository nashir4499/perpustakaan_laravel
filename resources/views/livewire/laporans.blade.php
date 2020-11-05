<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            Laporan
        </h1>
        {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
            Tambah
        </button>
        <!-- Modals -->
        @include('livewire/create-member') --}}
        @if (session()->has('info'))
            <div class="alert alert-success" style="margin-top:10px;">
                {{ session('info') }}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-sm">
            <div class="card">
                <div class="card-header row">
                    <div class="col-sm-4">
                        <a href="{{route('laporanPdf')}}" class="btn btn-warning close-modal">Cetak PDF</a>
                    </div>
                    <div class="col-sm-4 text-center">
                        <h1><b>Laporan Keadaan Buku</b></h1>
                        <h1><b>Selama Tahun Ajaran {{date('Y',strtotime('-1 year'))}} - {{date('Y')}}</b></h1>
                    </div>
                    <div class="col-sm-4">
                        @if ($update==true)
                            <button  wire:click.prevent="store()" type="submit" class="btn btn-primary close-modal float-right">Update</button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-basic" class="table table-striped dataTable dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-basic_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="datatables-basic" rowspan="2" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending">Bulan</th>
                                    <th class="sorting text-center" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="8"  aria-label="Buku Perpustakaan: activate to sort column ascending">Buku Perpustakaan</th>
                                </tr>
                                <tr role="row">
                                    {{-- @foreach ($kategoris as $kategori)
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="{{$kategori->nama}}: activate to sort column ascending">{{$kategori->nama}}</th>
                                    @endforeach --}}
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-label="Paket: activate to sort column ascending">Paket</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-label="Pengayaan: activate to sort column ascending">Pengayaan</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-label="Cerpen: activate to sort column ascending">Cerpen</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-label="Referensi: activate to sort column ascending">Referensi</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-label="Surat Kabar: activate to sort column ascending">Surat Kabar</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-label="Buku Yang Baik: activate to sort column ascending">Buku Yang Baik</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-label="Buku Rusak: activate to sort column ascending">Buku Rusak</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-label="Jumlah: activate to sort column ascending">Jumlah</th>
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
                </div>
            </div>
        </div>
    </div>
</div>

