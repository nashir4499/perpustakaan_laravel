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
                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            @if ($tbh == 0)
                                <input wire:model="petugasId" type="text" class="form-control" placeholder="ID" disabled>
                                @error('petugasId') <span class="text-danger">{{ $message }}</span>@enderror    
                            @else    
                                <input wire:model="petugasId" type="text" class="form-control" placeholder="ID">
                                @error('petugasId') <span class="text-danger">{{ $message }}</span>@enderror
                            @endif
                        </div>
                        <div class="form-group col-sm-8">
                            <input type="text" class="form-control" placeholder="Nama Petugas" wire:model="nama" >
                            @error('nama') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    @if (session()->has('idNotNull'))
                        <div class="alert alert-danger" style="margin-top:10px;">
                            {{ session('idNotNull') }}
                        </div>
                    @endif
                        <div class="form-group">
                            <input wire:model="email" type="email" class="form-control" placeholder="Email">
                            @error('email') <span class="text-danger">{{ $message }}</span>@enderror
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
