<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Member</h5>
                <button wire:click.prevent="resetInputs()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input wire:model="memberId" type="text" class="form-control" placeholder="ID">
                        @error('memberId') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nama Anggota" wire:model="nama" >
                        @error('nama') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    {{-- <div class="form-group">
                        <input type="text" class="form-control" placeholder="Kelas" wire:model="kelas" >
                        @error('kelas') <span class="text-danger">{{ $message }}</span>@enderror
                    </div> --}}
                    <label for="exampleFormControlSelect1">Pilih Kelas</label>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            {{-- <input wire:model="kategoriId" type="number" class="form-control" placeholder="Kategori"> --}}
                            <select wire:model="noKelas" class="form-control" id="noKelas">
                                <option selected>Choose...</option>
                                <option value="7" >7</option>
                                <option value="8" >8</option>
                                <option value="9" >9</option>
                            </select>
                            @error('noKelas') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group col-sm-6">
                            {{-- <input wire:model="kategoriId" type="number" class="form-control" placeholder="Kategori"> --}}
                            <select wire:model="kelas" class="form-control" id="kategoriId">
                                <option selected>Choose...</option>
                                @if ($noKelas!==null)
                                    <option value="{{$noKelas}}A" >A</option>
                                    <option value="{{$noKelas}}B" >B</option>
                                    <option value="{{$noKelas}}C" >C</option>
                                    <option value="{{$noKelas}}D" >D</option>
                                    <option value="{{$noKelas}}E" >E</option>
                                    <option value="{{$noKelas}}F" >F</option>
                                    <option value="{{$noKelas}}G" >G</option>
                                    <option value="{{$noKelas}}H" >H</option>
                                    <option value="{{$noKelas}}I" >I</option>
                                @endif
                            </select>
                            @error('kelas') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" placeholder="Tanggal Lahir" wire:model="tgl_lahir" >
                        @error('tgl_lahir') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <textarea wire:model="alamat" class="form-control" placeholder="Alamat" cols="30" rows="3"></textarea>
                        @error('alamat') <span class="text-danger">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" wire:model="foto" >
                        @error('foto') <span class="text-danger">{{ $message }}</span>@enderror
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
