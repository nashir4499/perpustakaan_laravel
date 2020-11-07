@section('title', 'Petugas')
@if (Auth::user()->current_team_id===1)
    
<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            List Peugas
        </h1>
        <button wire:click.prevent="tambah()" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
            Tambah
        </button>
        <!-- Modals -->
        @include('livewire/create-petugas')
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
                        <h2><b>Tabel Petugas</b></h2>
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
                                    <th class="sorting_asc" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending">No</th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="ID: activate to sort column ascending">ID
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
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email
                                        @if ($sort==="asc")
                                            <button wire:click.prevent="sorting('email','desc')"><i class="fas fa-sort"></i></button></th>
                                        @else
                                            <button wire:click.prevent="sorting('email','asc')"><i class="fas fa-sort"></i></button></th>
                                        @endif
                                    </th>
                                    {{-- <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Foto: activate to sort column ascending">Foto</th> --}}
                                    {{-- <th class="sorting" tabindex="0" aria-controls="datatables-basic" rowspan="1" colspan="1"  aria-label="Opsi: activate to sort column ascending">Opsi</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($petugas as $ptgs)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1 dtr-control">{{$loop->iteration}}</td>
                                        <td>{{$ptgs->id}}</td>
                                        <td>{{$ptgs->name}}</td>
                                        <td>{{$ptgs->email}}</td>
                                        {{-- <td><img src="{{ asset("storage/app/$ptgs->foto") }}"></td> --}}
                                        {{-- <td><img src="{{ asset("/storage/$ptgs->foto") }}" width="50"></td> --}}
                                        <td>
                                            {{-- <a href="{{route('ptgsPdf')}}" class="badge badge-warning">Cetak</a> --}}
                                            {{-- <button wire:click="edit({{$ptgs->id}})" type="button" class="badge badge-primary" data-toggle="modal" data-target="#exampleModal">Edit</button>
                                            <button onclick="confirm('Yakin Ingin Menghapus {{$ptgs->name}}?') || event.stopImmediatePropagation()" wire:click="delete({{$ptgs->id}})" type="button" class="badge badge-danger">Delete</button> --}}
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

@else
<script>
    window.location='/dashboard';
</script>
@endif
