@section('title', 'Kategori')
@if (Auth::user()->current_team_id===1)
    
<div class="container">
    <div class="header">
        <h1 class="header-title">
            List Kategori
        </h1>
        @if (session()->has('info'))
            <div class="alert alert-success" style="margin-top:10px;">
                {{ session('info') }}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header row">
                    <div class="col-sm-6">
                        <b>Tabel Kategori</b>
                    </div>
                    <div class="col-sm-6">
                        <form class="form-inline d-flex justify-content-center md-form form-sm mt-0 search">
                            <i class="fas fa-search" aria-hidden="true"></i>
                            <input wire:model="cari" class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search" aria-label="Search">
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table id="datatables-basic" class="table table-striped dataTable dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-basic_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending">No</th>
                                <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-label="Nama: activate to sort column ascending">Nama
                                    @if ($sort==="asc")
                                        <button wire:click.prevent="sorting('nama','desc')"><i class="fas fa-sort"></i></button></th>
                                    @else
                                        <button wire:click.prevent="sorting('nama','asc')"><i class="fas fa-sort"></i></button></th>
                                    @endif
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-label="Opsi: activate to sort column ascending">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategoris as $kategori)
                                <tr role="row" class="odd">
                                    <td class="sorting_1 dtr-control">{{$loop->iteration}}</td>
                                    <td>{{$kategori->nama}}</td>
                                    <td>
                                        <button wire:click="edit({{$kategori->id}})" type="button" class="badge badge-primary" data-toggle="modal" data-target="#exampleModal">Edit</button>
                                        <button onclick="confirm('Yakin Ingin Menghapus {{$kategori->nama}}?') || event.stopImmediatePropagation()" wire:click="delete({{$kategori->id}})" type="button" class="badge badge-danger">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <b>Tambah Kategori</b>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <input wire:model="ketId" type="hidden" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Kategori</label>
                            <input wire:model="nama" type="text" class="form-control" id="nama" placeholder="Nama Kategori">
                            @error('nama') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        @if ($ubah)
                        <div class="float-right">
                            <button wire:click.prevent="resetInputs()" type="button" class="btn btn-secondary ">Reset</button>
                            <button wire:click.prevent="store()" type="button" class="btn btn-primary ">Ubah</button>
                        </div>
                        @else
                            <button wire:click="store()" type="button" class="btn btn-success float-right">Tambah</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@else
<script>
        window.location='/dashboard';
</script>
@endif
