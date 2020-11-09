@section('title', 'Dashboard')
<div class="container-fluid">
    <div class="header text-center">
        <h1 class="header-title">
            Perpustakaan SMPN 1 Banyuresmi Garut
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
    @if (Auth::user()->current_team_id===1)

    <div class="row">
        <div class="col-sm 6">
            <div class="card">
                <div class="card-header">
                    <h2><b>Peminjaman Buku</b></h2>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="buku">Buku</label>
                                <input wire:model="bukusId" type="text" id="buku" class="form-control" placeholder="Kode Buku">
                                @error('bukusId') <span class="text-danger">{{ $message }}</span>@enderror
                                <input wire:model="bNama" type="text" id="buku" class="form-control" placeholder="Nama Buku" disabled>
                                @error('bNama') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="buku">Member</label>
                                <input wire:model="membersId" type="text" class="form-control" placeholder="ID Member">
                                @error('membersId') <span class="text-danger">{{ $message }}</span>@enderror
                                <input wire:model="mNama" type="text" class="form-control" placeholder="Nama Member" disabled>
                                @error('mNama') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="waktu_pengembalian">Tenggat Pengembalian</label>
                            <input wire:model="waktu_pengembalian" id="waktu_pengembalian" type="date" class="form-control">
                            @error('waktu_pengembalian') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <button  wire:click.prevent="store()" type="submit" class="btn btn-success">Pinjam</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm 6">
            <div class="card">
                <div class="card-header">
                    <h2><b>Pengembalian Buku</b></h2>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="buku">Member</label>
                                <input wire:model="membersIdKembali" type="text" class="form-control" placeholder="ID Member">
                                @error('membersIdKembali') <span class="text-danger">{{ $message }}</span>@enderror
                                <input wire:model="mNamaKembali" type="text" class="form-control" placeholder="Nama Member" disabled>
                                @error('mNamaKembali') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="buku">Buku</label>
                                {{-- <input wire:model="bNama" type="text" id="buku" class="form-control" placeholder="Nama Buku" disabled>
                                @error('bNama') <span class="text-danger">{{ $message }}</span>@enderror --}}
                                <select wire:model="pinjamanId" class="form-control" id="pinjamanId">
                                    <option selected>Choose...</option>
                                    @foreach ($peminjam as $peminjam)
                                        <option value={{$peminjam->id}} >{{$peminjam->buku->nama}}</option>
                                    @endforeach
                                </select>
                                @error('pinjamanId') <span class="text-danger">{{ $message }}</span>@enderror
                                <input type="text" id="buku" class="form-control" value="{{$pinjamanId!=0? $satuPeminjam->bukus_id:"Kode Buku"}}" disabled>
                                {{-- <input wire:model="bukusId" type="text" id="buku" class="form-control" placeholder="ID Buku" disabled>
                                @error('bukusId') <span class="text-danger">{{ $message }}</span>@enderror --}}
                            </div>
                        </div>
                        <div class="form-row">
                        <div class="col-sm-5">
                            <label for="waktu_pengembalian2">Tenggat Pengembalian</label>
                        </div>
                        <div class="form-check col-sm-4">
                            <input class="form-check-input" wire:model="radioKembali" type="radio" name="exampleRadios" id="exampleRadios1" value="1">
                            <label class="form-check-label" for="exampleRadios1">
                              Pengembalian
                            </label>
                          </div>
                          <div class="form-check col-sm-3">
                            <input class="form-check-input" wire:model="radioKembali" type="radio" name="exampleRadios" id="exampleRadios2" value="0">
                            <label class="form-check-label" for="exampleRadios2">
                              Perpanjang
                            </label>
                          </div>
                        </div>
                        <div class="form-group">
                            {{-- <label for="waktu_pengembalian2">Tenggat Pengembalian</label> --}}
                            @if ($radioKembali==1)
                            <input id="waktu_pengembalian2" type="text" class="form-control" value="{{$pinjamanId!=0? $satuPeminjam->waktu_pengembalian:"Tenggat Pengembalian"}}" disabled>
                            @else
                            <input wire:model="perpanjangWaktu" id="perpanjangWaktu" type="date" class="form-control">
                            @error('perpanjangWaktu') <span class="text-danger">{{ $message }}</span>@enderror
                            @endif
                            {{-- <input wire:model="waktu_pengembalian" id="waktu_pengembalian" type="date" class="form-control">
                            @error('waktu_pengembalian') <span class="text-danger">{{ $message }}</span>@enderror --}}
                        </div>
                        @if ($pinjamanId!=0)
                            @if ($satuPeminjam->waktu_pengembalian >= date('Y-m-d'))
                                <button  wire:click.prevent="storePengembalian(1)" type="submit" class="btn btn-success">Dikembalikan</button>
                            @else
                                <button  wire:click.prevent="storePengembalian(2)" type="submit" class="btn btn-warning">Terlambat</button>
                            @endif
                                <button  wire:click.prevent="storePengembalian(3)" type="submit" class="btn btn-danger">Rusak</button>
                            @if ($radioKembali==0)
                                <button  wire:click.prevent="perpanjang()" type="submit" class="btn btn-primary float-right">Perpanjang</button>
                            @endif
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row"><div class="col-sm 6">
        <div class="card">
            <div class="card-header">
                <h2><b>Peminjaman Buku</b></h2>
            </div>
            <div class="card-body">
                {!! $pinjamChart->container() !!}
            </div>
        </div>
    </div>

    @if (session()->has('gagal'))
        {{-- <div class="alert alert-danger" style="margin-top:10px;">
            {{ session('gagal') }}
        </div> --}}
        <script>
            alert('Stok Buku Kosong');
        </script>
    @endif
</div>

@livewireScripts
<script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
        {!! $pinjamChart->script() !!}
    @else
    <div class="row">
        <div class="col-sm-10 offset-1">
            <div class="card">
                <div class="card-header text-center">
                    <h1 style="font-size: 30px"><b>Selamat Datang</b></h1>
                </div>
                <div class="card-body text-center">
                    <p class="tulisan">Selamat datang di Sistem Informasi Perpustakaan SMP Negeri 1 Banyuresmi. <br> Dengan adanya sistem informasi ini diharapkan para siswa dapat menambah wawasan dengan buku-buku yang ada di perpustakaan SMP Negeri 1 Banyuresmi.</p>
                </div>
            </div>
        </div>
    </div>

</div>
    @endif
