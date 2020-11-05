<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Peminjaman;
use App\Models\Buku;

class Peminjamans extends Component
{

    public $peminjamans;
    public $pinjamanId, $bukus_id, $members_id, $waktu_pengembalian, $ket_pengembalian, $waktu_peminjaman;
    public $cari;
    public $sortNama = null; //seperti setstate
    public $sort = 'asc'; //seperti setstate
    public $ketPeng = null;

    public function render()
    {
        if ($this->cari) {
            $this->peminjamans = Peminjaman::where('bukus_id', 'LIKE', "%$this->cari%")
                ->orWhere('members_id', 'LIKE', "%$this->cari%")
                ->orWhere('waktu_pengembalian', 'LIKE', "%$this->cari%")
                ->orWhere('ket_pengembalian', 'LIKE', "%$this->cari%")
                ->orWhere('created_at', 'LIKE', "%$this->cari%")
                ->get();
        } else if ($this->sortNama !== null) {
            $this->peminjamans = Peminjaman::orderBy("$this->sortNama", "$this->sort")->get();
        } else if ($this->ketPeng !== null) {
            $this->peminjamans = Peminjaman::where('ket_pengembalian', "$this->ketPeng")->get();
        } else {
            // $this->peminjamans = Peminjaman::paginate(10);
            $this->peminjamans = Peminjaman::all();
        }
        return view('livewire.peminjamans');
    }

    public function sorting($nama, $sort)
    {
        $this->sortNama = $nama;
        $this->sort = $sort;
    }

    public function ketPengembalian($ket)
    {
        $this->ketPeng = $ket;
    }

    public function resetInputs()
    {
        $this->pinjamanId = null;
        $this->bukus_id = null;
        $this->members_id = null;
        $this->waktu_pengembalian = null;
        $this->ket_pengembalian = null;
        $this->waktu_peminjaman = null;
    }

    public function status($nilai)
    {
        $this->sort = $nilai;
        // $this->peminjamans = Peminjaman::orderBy('ket_pengembalian', 'asc')->get();
    }

    public function store()
    {
        // dd('dasdasdasd');
        $this->validate([
            'bukus_id' => 'required',
            'members_id' => 'required',
            'waktu_pengembalian' => 'required',
            'ket_pengembalian' => 'required',
            'waktu_peminjaman' => 'required',
        ]);

        Peminjaman::updateOrCreate(['id' => $this->pinjamanId], [
            'bukus_id' => $this->bukus_id,
            'members_id' => $this->members_id,
            'waktu_pengembalian' => $this->waktu_pengembalian,
            'ket_pengembalian' => $this->ket_pengembalian,
            'created_at' => $this->waktu_peminjaman,
        ]);

        session()->flash('info', $this->pinjamanId ? 'Peminjaman Berhasil Diedit' : 'Peminjaman Berhasil Dilakukan');

        $this->resetInputs();

        // $this->emit('userStore'); // Close model to using to jquery
    }

    public function edit($id)
    {
        $pinjaman = Peminjaman::findOrFail($id);
        $this->pinjamanId = $id;
        $this->bukus_id = $pinjaman->bukus_id;
        $this->members_id = $pinjaman->members_id;
        $this->waktu_pengembalian = $pinjaman->waktu_pengembalian;
        $this->ket_pengembalian = $pinjaman->ket_pengembalian;
        $this->waktu_peminjaman = $pinjaman->created_at;
    }

    public function delete($id)
    {
        $pinjaman = Peminjaman::findOrFail($id);
        if ($pinjaman->ket_pengembalian === 0) {
            $stokBuku = Buku::find($pinjaman->bukus_id);
            $stokBuku->stok = $stokBuku->stok + 1;
            $stokBuku->save();
            Peminjaman::find($id)->delete();
        } else {
            Peminjaman::find($id)->delete();
        }
    }
}
