<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            List Buku
        </h1>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
            Tambah
        </button>
        <!-- Modals -->
        @include('livewire/create-buku')
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
                    <div class="col-sm-6">
                        <h2><b>Tabel Buku</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <form class="form-inline d-flex justify-content-center md-form form-sm mt-0 search">
                            <i class="fas fa-search" aria-hidden="true"></i>
                            <input wire:model="cari" class="form-control form-control-sm ml-3 w-50" type="text" placeholder="Search" aria-label="Search">
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-basic" class="table table-striped dataTable dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-basic_info">
                            <thead>
                                <tr role="row">
                                    {{-- <button wire:click="sorting(nama)" type="button">V</button> --}}
                                    <th class="sorting_asc" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending">No</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Kode Buku: activate to sort column ascending">Kode Buku
                                        @if ($sort==="asc")
                                            <button wire:click.prevent="sorting('id','desc')"><i class="fas fa-sort"></i></button></th>
                                        @else
                                            <button wire:click.prevent="sorting('id','asc')"><i class="fas fa-sort"></i></button></th>
                                        @endif
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Nama: activate to sort column ascending">Nama
                                        @if ($sort==="asc")
                                            <button wire:click.prevent="sorting('nama','desc')"><i class="fas fa-sort"></i></button></th>
                                        @else
                                            <button wire:click.prevent="sorting('nama','asc')"><i class="fas fa-sort"></i></button></th>
                                        @endif
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-label="Kategori: activate to sort column ascending">Kategori
                                        @if ($sort==="asc")
                                            <button wire:click.prevent="sorting('kategoris','desc')"><i class="fas fa-sort"></i></button></th>
                                        @else
                                            <button wire:click.prevent="sorting('kategoris','asc')"><i class="fas fa-sort"></i></button></th>
                                        @endif
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Deskripsi: activate to sort column ascending">Deskripsi</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Jumlah: activate to sort column ascending">Jumlah
                                        @if ($sort==="asc")
                                            <button wire:click.prevent="sorting('jumlah','desc')"><i class="fas fa-sort"></i></button></th>
                                        @else
                                            <button wire:click.prevent="sorting('jumlah','asc')"><i class="fas fa-sort"></i></button></th>
                                        @endif
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Stok Tersedia: activate to sort column ascending">Stok Tersedia
                                        @if ($sort==="asc")
                                            <button wire:click.prevent="sorting('stok','desc')"><i class="fas fa-sort"></i></button></th>
                                        @else
                                            <button wire:click.prevent="sorting('stok','asc')"><i class="fas fa-sort"></i></button></th>
                                        @endif
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Rusak: activate to sort column ascending">Rusak
                                        @if ($sort==="asc")
                                            <button wire:click.prevent="sorting('rusak','desc')"><i class="fas fa-sort"></i></button></th>
                                        @else
                                            <button wire:click.prevent="sorting('rusak','asc')"><i class="fas fa-sort"></i></button></th>
                                        @endif
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-label="Opsi: activate to sort column ascending">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bukus as $buku)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1 dtr-control">{{$loop->iteration}}</td>
                                        <td>{{$buku->id}}</td>
                                        <td>{{$buku->nama}}</td>
                                        <td>{{$buku->kategori->nama}}</td>
                                        <td>{{$buku->deskripsi}}</td>
                                        <td>{{$buku->jumlah}}</td>
                                        <td>{{$buku->stok}}</td>
                                        <td>{{$buku->rusak}}</td>
                                        <td>
                                            <button wire:click="edit({{$buku->id}})" type="button" class="badge badge-primary" data-toggle="modal" data-target="#exampleModal">Edit</button>
                                            <button onclick="confirm('Yakin Ingin Menghapus {{$buku->nama}}?') || event.stopImmediatePropagation()" wire:click="delete({{$buku->id}})" type="button" class="badge badge-danger">Delete</button>

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

