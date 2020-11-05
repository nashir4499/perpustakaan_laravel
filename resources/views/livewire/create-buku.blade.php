<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buku</h5>
                <button wire:click.prevent="resetInputs()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input wire:model="bukuId" type="text" class="form-control" placeholder="ID Buku">
                        @error('bukuId') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nama Buku" wire:model="nama" >
                        @error('nama') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Kategori</label>
                        {{-- <input wire:model="kategoriId" type="number" class="form-control" placeholder="Kategori"> --}}
                        <select wire:model="kategoriId" class="form-control" id="kategoriId">
                            <option selected>Choose...</option>
                            @foreach ($kategoris as $kategori)
                                <option value={{$kategori->id}} >{{$kategori->nama }}</option>
                            @endforeach
                        </select>
                        @error('kategoriId') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <textarea wire:model="deskripsi" class="form-control" placeholder="Deskripsi" cols="30" rows="3"></textarea>
                        @error('deskripsi') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <input wire:model="jumlah" type="number" class="form-control" placeholder="Jumlah">
                            @error('jumlah') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <input wire:model="stok" type="number" class="form-control" placeholder="Stok">
                            @error('stok') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group col-sm-4">
                            <input wire:model="rusak" type="number" class="form-control" placeholder="Rusak">
                            @error('rusak') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button wire:click.prevent="resetInputs()" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button  wire:click.prevent="store()" type="submit" class="btn btn-success close-modal">Submit</button>
            </div>
        </div>
    </div>
</div>
