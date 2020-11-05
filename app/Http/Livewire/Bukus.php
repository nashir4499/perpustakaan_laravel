<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Buku;
use App\Models\Kategori;

class Bukus extends Component
{
    public $bukus;
    public $bukuId, $nama, $kategoriId, $deskripsi, $jumlah, $stok, $rusak; //seperti setstate
    // public $bukuIdSort, $namaSort, $kategoriIdSort, $jumlahSort, $stokSort, $rusakSort; //seperti setstate
    public $sortNama = null; //seperti setstate
    public $sort = 'asc'; //seperti setstate
    public $cari;
    public $kategoris;

    public function render()
    {
        if ($this->cari) {
            $this->bukus = Buku::where('nama', 'LIKE', "%$this->cari%")
                ->orWhere('deskripsi', 'LIKE', "%$this->cari%")
                ->orWhere('kategoris_id', 'LIKE', "%$this->cari%")
                ->get();
        } else if ($this->sortNama !== null) {
            $this->bukus = Buku::orderBy("$this->sortNama", "$this->sort")->get();
        } else {
            $this->bukus = Buku::all();
        }
        $this->kategoris = Kategori::all();
        // dump($this->bukus = Buku::with('kategori')->get());
        // $this->bukus = Buku::with('kategori')->get();
        // $this->bukus = Buku::find();
        return view('livewire.bukus');
    }

    public function sorting($nama, $sort)
    {
        $this->sortNama = $nama;
        $this->sort = $sort;
    }

    public function resetInputs()
    {
        $this->bukuId = null;
        $this->nama = null;
        $this->kategoriId = null;
        $this->deskripsi = null;
        $this->jumlah = null;
        $this->stok = null;
        $this->rusak = null;
    }

    public function store()
    {
        // dd('dasdasdasd');
        $this->validate([
            'bukuId' => 'required',
            'nama' => 'required',
            'kategoriId' => 'required',
            'deskripsi' => 'required',
            'jumlah' => 'required',
        ]);

        Buku::updateOrCreate(['id' => $this->bukuId], [
            'id' => $this->bukuId,
            'nama' => $this->nama,
            'kategoris_id' => $this->kategoriId,
            'deskripsi' => $this->deskripsi,
            'jumlah' => $this->jumlah,
            'stok' => $this->stok,
            'rusak' => $this->rusak
        ]);

        session()->flash('info', $this->bukuId ? 'Buku Berhasil Diedit' : 'Buku Berhasil Ditambah');

        $this->resetInputs();

        $this->emit('userStore'); // Close model to using to jquery
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $this->bukuId = $id;
        $this->nama = $buku->nama;
        $this->kategoriId = $buku->kategoris_id;
        $this->deskripsi = $buku->deskripsi;
        $this->jumlah = $buku->jumlah;
        $this->stok = $buku->stok;
        $this->rusak = $buku->rusak;
    }

    public function delete($id)
    {
        Buku::find($id)->delete();
    }
}
