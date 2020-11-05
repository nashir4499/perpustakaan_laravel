<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Member;
use PDF;

class Members extends Component
{
    use WithFileUploads;
    public $members;
    public $memberId, $nama, $kelas, $tgl_lahir, $alamat, $foto, $status, $noKelas;
    public $cari;
    public $sortNama = null; //seperti setstate
    public $sort = 'asc'; //seperti setstate

    public function render()
    {
        if ($this->cari) {

            $this->members = Member::where('nama', 'LIKE', "%$this->cari%")
                // $this->members = Member::where('status', 1)
                // ->orWhere('nama', 'LIKE', "%$this->cari%")
                ->orWhere('kelas', 'LIKE', "%$this->cari%")
                ->orWhere('tgl_lahir', 'LIKE', "%$this->cari%")
                ->orWhere('alamat', 'LIKE', "%$this->cari%")
                ->get();
        } else if ($this->sortNama !== null) {
            $this->members = Member::orderBy("$this->sortNama", "$this->sort")->where('status', 1)->get();
        } else {
            $this->members = Member::where('status', 1)->get();
        }
        return view('livewire.members');
    }

    public function sorting($nama, $sort)
    {

        $this->sortNama = $nama;
        $this->sort = $sort;
        // dd($this->bukus = Buku::orderBy("$nilai", 'desc')->get());
        // $this->bukus = Buku::orderBy("$nilai", 'desc')->get();
    }

    public function resetInputs()
    {
        $this->memberId = null;
        $this->nama = null;
        $this->kelas = null;
        $this->tgl_lahir = null;
        $this->alamat = null;
        $this->status = null;
        $this->noKelas = null;
        $this->foto = null;
    }

    public function store()
    {
        // dd('dasdasdasd');
        $this->validate([
            'memberId' => 'required',
            'nama' => 'required',
            'kelas' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,svg,jpg,gif|max:1024', // 1MB Max
            'noKelas' => 'required',
        ]);

        $namaFoto = $this->foto->storeAs('foto_member', "foto$this->memberId.png", 'public');

        Member::updateOrCreate(['id' => $this->memberId], [
            'id' => $this->memberId,
            'nama' => $this->nama,
            'kelas' => $this->kelas,
            'tgl_lahir' => $this->tgl_lahir,
            'alamat' => $this->alamat,
            'foto' => $namaFoto,
            'status' => 1,
        ]);

        session()->flash('info', $this->memberId ? 'Member Berhasil Diedit' : 'Member Berhasil Ditambah');

        $this->resetInputs();

        $this->emit('userStore'); // Close model to using to jquery
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $this->memberId = $id;
        $this->nama = $member->nama;
        $this->noKelas = substr("$member->kelas", 0, 1);
        $this->kelas = $member->kelas;
        $this->tgl_lahir = $member->tgl_lahir;
        $this->alamat = $member->alamat;
        $this->foto = $member->foto;
        $this->status = $member->status;
    }

    public function delete($id)
    {
        $idMember = Member::find($id);
        $idMember->status = 0;
        $idMember->save();
    }

    public function cetakKartuPdf()
    {
        $date = date('Y-m-d');
        $member = Member::findOrFail(1706067);
        $ukuran = array(0, 0, 865, 539);

        // $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        // $pdf = PDF::loadView('memberpdf', ['member' => $member])->setPaper('letter', 'landscape');
        $pdf = PDF::loadView('memberpdf', ['member' => $member])->setPaper($ukuran, 'landscape');

        return $pdf->stream("Kartu-$member->id.pdf");

        //return view('email.sample', $data);
    }
}
