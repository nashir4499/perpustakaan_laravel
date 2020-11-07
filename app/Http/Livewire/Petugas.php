<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Petugas extends Component
{
    public $petugas;
    public $tbh = 0;
    public $petugasId, $nama, $email;
    public $cari;
    public $sortNama = null; //seperti setstate
    public $sort = 'asc'; //seperti setstate

    public function render()
    {

        if ($this->cari) {

            $this->petugas = User::where('name', 'LIKE', "%$this->cari%")
                // $this->petugas = User::where('current_team_id', 1)
                // ->orWhere('nama', 'LIKE', "%$this->cari%")
                ->orWhere('email', 'LIKE', "%$this->cari%")
                ->get();
        } else if ($this->sortNama !== null) {
            $this->petugas = User::orderBy("$this->sortNama", "$this->sort")->where('current_team_id', 1)->get();
        } else {
            $this->petugas = User::where('current_team_id', 1)->get();
        }

        return view('livewire.petugas');
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
        $this->petugasId = null;
        $this->nama = null;
        $this->email = null;
        $this->tbh = 0;
    }

    public function tambah()
    {
        $this->tbh = 1;
    }

    public function store()
    {
        // dd('dasdasdasd');
        $this->validate([
            'petugasId' => 'required',
            'nama' => 'required',
            'email' => 'required',
        ]);

        // $namaFoto = $this->foto->storeAs('foto_member', "foto$this->petugasId.png", 'public');

        // Member::updateOrCreate(['id' => $this->petugasId], [
        //     'id' => $this->petugasId,
        //     'nama' => $this->nama,
        //     'kelas' => $this->kelas,
        //     'tgl_lahir' => $this->tgl_lahir,
        //     'alamat' => $this->alamat,
        //     'foto' => $namaFoto,
        //     'status' => 1,
        // ]);

        if ($this->tbh == 1) {
            $cek = User::find($this->petugasId);
            $pass = "petugas$this->petugasId";
            if ($cek === null) {
                // $namaFoto = $this->foto->storeAs('foto_member', "foto$this->petugasId.png", 'public');
                User::create([
                    'id' => $this->petugasId,
                    'name' => $this->nama,
                    'email' => $this->email,
                    'password' => Hash::make($pass),
                    'current_team_id' => 1,
                ]);

                session()->flash('info', $this->petugasId ? 'Member Berhasil Diedit' : 'Member Berhasil Ditambah');

                $this->resetInputs();

                $this->emit('userStore'); // Close model to using to jquery

            } else {
                session()->flash('idNotNull', 'Member ID yang dimasukan telah digunakan');
            }
        } else {
            // $namaFoto = $this->foto->storeAs('foto_member', "foto$this->petugasId.png", 'public');
            User::where('id', $this->petugasId)
                ->update([
                    'name' => $this->nama,
                    'email' => $this->email,
                ]);

            session()->flash('info', $this->petugasId ? 'Member Berhasil Diedit' : 'Member Berhasil Ditambah');

            $this->resetInputs();

            $this->emit('userStore'); // Close model to using to jquery
        }
    }

    public function edit($id)
    {
        $petugas = User::findOrFail($id);
        $this->petugasId = $id;
        $this->nama = $petugas->name;
        $this->email = $petugas->email;
    }

    public function delete($id)
    {
        User::find($id)->delete();
        // $idMember = Member::find($id);
        // $idMember->status = 0;
        // $idMember->save();
    }
}
