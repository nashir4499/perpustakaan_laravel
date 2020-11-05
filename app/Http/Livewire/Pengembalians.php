<?php

namespace App\Http\Livewire;

use App\Models\Pengembalian;
use Livewire\Component;

class Pengembalians extends Component
{
    public $pengembalians;
    public $kembaliId, $bukus_id, $members_id, $deskripsi, $denda, $tenggat_pengembalian, $waktu_pengembalian;
    public $cari;
    public $sortNama = null; //seperti setstate
    public $sort = 'asc'; //seperti setstate


    public function render()
    {
        if ($this->cari) {
            $this->pengembalians = Pengembalian::where('bukus_id', 'LIKE', "%$this->cari%")
                ->orWhere('members_id', 'LIKE', "%$this->cari%")
                ->orWhere('deskripsi', 'LIKE', "%$this->cari%")
                ->orWhere('denda', 'LIKE', "%$this->cari%")
                ->orWhere('tenggat_pengembalian', 'LIKE', "%$this->cari%")
                ->orWhere('created_at', 'LIKE', "%$this->cari%")
                ->get();
        } else if ($this->sortNama !== null) {
            $this->pengembalians = Pengembalian::orderBy("$this->sortNama", "$this->sort")->get();
        } else {
            $this->pengembalians = Pengembalian::all();
        }
        return view('livewire.pengembalians');
    }

    public function sorting($nama, $sort)
    {
        $this->sortNama = $nama;
        $this->sort = $sort;
    }

    public function resetInputs()
    {
        $this->kembaliId = null;
        $this->bukus_id = null;
        $this->members_id = null;
        $this->deskripsi = null;
        $this->denda = null;
        $this->tenggat_pengembalian = null;
        $this->waktu_pengembalian = null;
    }

    public function store()
    {
        // dd('dasdasdasd');
        $this->validate([
            'bukus_id' => 'required',
            'members_id' => 'required',
            'deskripsi' => 'required',
            'tenggat_pengembalian' => 'required',
            'waktu_pengembalian' => 'required',
        ]);

        Pengembalian::updateOrCreate(['id' => $this->kembaliId], [
            'bukus_id' => $this->bukus_id,
            'members_id' => $this->members_id,
            'deskripsi' => $this->deskripsi,
            'denda' => $this->denda,
            'tenggat_pengembalian' => $this->tenggat_pengembalian,
            'created_at' => $this->waktu_pengembalian,
        ]);

        session()->flash('info', $this->kembaliId ? 'Pengembalian Berhasil Diedit' : 'Pengembalian Berhasil Dilakukan');

        $this->resetInputs();

        // $this->emit('userStore'); // Close model to using to jquery
    }

    public function edit($id)
    {
        $kembali = Pengembalian::findOrFail($id);
        $this->kembaliId = $id;
        $this->bukus_id = $kembali->bukus_id;
        $this->members_id = $kembali->members_id;
        $this->deskripsi = $kembali->deskripsi;
        $this->denda = $kembali->denda;
        $this->tenggat_pengembalian = $kembali->tenggat_pengembalian;
        $this->waktu_pengembalian = $kembali->created_at;
    }

    public function delete($id)
    {
        Pengembalian::find($id)->delete();
    }
}
