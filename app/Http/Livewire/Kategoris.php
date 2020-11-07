<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class Kategoris extends Component
{
    public $kategoris;
    public $ubah = 0;
    public $katId, $nama;
    public $cari;
    public $sortNama = null; //seperti setstate
    public $sort = 'asc'; //seperti setstate

    public function render()
    {
        if ($this->cari) {
            $this->kategoris = Kategori::where('nama', 'LIKE', "%$this->cari%")->get();
        } else if ($this->sortNama !== null) {
            $this->kategoris = Kategori::orderBy("$this->sortNama", "$this->sort")->get();
        } else {
            $this->kategoris = Kategori::all();
        }
        return view('livewire.kategoris');
    }

    public function sorting($nama, $sort)
    {
        $this->sortNama = $nama;
        $this->sort = $sort;
    }

    public function resetInputs()
    {
        $this->katId = null;
        $this->nama = null;
        $this->ubah = false;
    }

    public function store()
    {
        // dd('dasdasdasd');
        $this->validate([
            'nama' => 'required',
        ]);

        Kategori::updateOrCreate(
            ['id' => $this->katId],
            ['nama' => $this->nama,]
        );

        session()->flash('info', $this->katId ? 'Kategori Berhasil Diedit' : 'Kategori Berhasil Ditambah');

        $this->resetInputs();
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        $this->katId = $id;
        $this->nama = $kategori->nama;
        $this->ubah = true;
    }

    public function delete($id)
    {
        Kategori::find($id)->delete();
    }
}
