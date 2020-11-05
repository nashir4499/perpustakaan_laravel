<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            Peminjaman
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
                        <h2><b>Tabel Peminjaman</b></h2>
                    </div>
                    <div class="col-sm-4">
                        <form class="form-inline d-flex justify-content-center md-form form-sm mt-0 search">
                            <i class="fas fa-search" aria-hidden="true"></i>
                            <input wire:model="cari" class="form-control form-control-sm ml-3 w-50" type="text" placeholder="ID buku atau member" aria-label="Search">
                        </form>
                    </div>
                    <div class="col-sm-4">
                        @if ($ketPeng===0)
                        <button  wire:click.prevent="ketPengembalian(1)" type="submit" class="btn btn-secondary float-right">Sudah Kembali</button>
                        @else
                        <button  wire:click.prevent="ketPengembalian(0)" type="submit" class="btn btn-secondary float-right">Belum Kembali</button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-basic" class="table table-striped dataTable dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-basic_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending">No</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Buku: activate to sort column ascending">Buku</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-label="Member ID: activate to sort column ascending">Member ID
                                        @if ($sort==="asc")
                                            <button wire:click.prevent="sorting('members_id','desc')"><i class="fas fa-sort"></i></button></th>
                                        @else
                                            <button wire:click.prevent="sorting('members_id','asc')"><i class="fas fa-sort"></i></button></th>
                                        @endif
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Nama: activate to sort column ascending">Nama</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Tenggat Pengembalian: activate to sort column ascending">Tenggat Pengembalian
                                        @if ($sort==="asc")
                                            <button wire:click.prevent="sorting('waktu_pengembalian','desc')"><i class="fas fa-sort"></i></button></th>
                                        @else
                                            <button wire:click.prevent="sorting('waktu_pengembalian','asc')"><i class="fas fa-sort"></i></button></th>
                                        @endif
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Waktu Peminjaman: activate to sort column ascending">Waktu Peminjaman
                                        @if ($sort==="asc")
                                            <button wire:click.prevent="sorting('created_at','desc')"><i class="fas fa-sort"></i></button></th>
                                        @else
                                            <button wire:click.prevent="sorting('created_at','asc')"><i class="fas fa-sort"></i></button></th>
                                        @endif
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Pengembalian: activate to sort column ascending">Pengembalian
                                        @if ($sort==="asc")
                                            <button wire:click.prevent="sorting('ket_pengembalian','desc')"><i class="fas fa-sort"></i></button></th>
                                        @else
                                            <button wire:click.prevent="sorting('ket_pengembalian','asc')"><i class="fas fa-sort"></i></button></th>
                                        @endif
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Opsi: activate to sort column ascending">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($peminjamans as $pinjam)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1 dtr-control">{{$loop->iteration}}</td>
                                        <td>{{$pinjam->buku->nama}}</td>
                                        <td>{{$pinjam->members_id}}</td>
                                        <td>{{$pinjam->member->nama}}</td>
                                        <td>{{$pinjam->waktu_pengembalian}}</td>
                                        <td>{{$pinjam->created_at}}</td>
                                        <td>{{$pinjam->ket_pengembalian?'Sudah':'Belum'}}</td>
                                        <td>
                                            {{-- <button wire:click="edit({{$pinjam->id}})" type="button" class="badge badge-primary" data-toggle="modal" data-target="#exampleModal">Edit</button> --}}
                                            <button onclick="confirm('Yakin Ingin Menghapus Pinjaman {{$pinjam->member->nama}} Dengan Buku {{$pinjam->buku->nama}}?') || event.stopImmediatePropagation()" wire:click="delete({{$pinjam->id}})" type="button" class="badge badge-danger">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
	                    {{-- {{ $peminjamans->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

