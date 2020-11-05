<?php

namespace App\Http\Livewire;

use App\Charts\PinjamChart;
use Livewire\Component;
use App\Models\Buku;
use App\Models\Member;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use DateTime;
use Illuminate\Support\Facades\Date;

class Homes extends Component
{
    public $bukus, $members, $peminjamans, $pengembalian, $peminjam;

    public $bukusId, $bNama;
    public $membersId, $mNama;

    public $membersKembali;
    public $membersIdKembali, $mNamaKembali;

    public $satuPeminjam, $pinjamanId, $waktu_pengembalian;
    public $radioKembali = 1;
    public $perpanjangWaktu;

    // public $pinjamChart;

    public function render()
    {
        // $this->bukus = Buku::all();
        $this->bukus = Buku::find($this->bukusId);
        $this->cekData();

        $this->members = Member::find($this->membersId);
        $this->cekData();

        $this->membersKembali = Member::find($this->membersIdKembali);
        $this->cekData();

        $this->peminjam = Peminjaman::where('ket_pengembalian', 0)->where('members_id', $this->membersIdKembali)->get();
        $this->satuPeminjam = Peminjaman::find($this->pinjamanId);

        // dd(date('Y-9'));



        $pinjamChart = new PinjamChart;
        $pinjamChart->labels(['Juli', 'Agustus', 'Septemeber', 'Oktober', 'November', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni']);
        $pinjamChart->dataset('Users by trimester', 'line', [$this->cekBlnChart("07"), $this->cekBlnChart("08"), $this->cekBlnChart("09"), $this->cekBlnChart("10"), $this->cekBlnChart("11"), $this->cekBlnChart("12"), $this->cekBlnChart("01"), $this->cekBlnChart("02"), $this->cekBlnChart("03"), $this->cekBlnChart("04"), $this->cekBlnChart("05"), $this->cekBlnChart("06")]);

        return view('livewire.homes', compact('pinjamChart'));
    }

    public function cekBlnChart($bulan)
    {
        $tgl = date("Y-$bulan-");
        $pinjamTgl = Peminjaman::where('created_at', 'LIKE', "%$tgl%")->count();
        return $pinjamTgl;
    }

    public function cekData()
    {
        if ($this->bukus) {
            $this->bNama = $this->bukus->nama;
        } else {
            $this->bNama = null;
        }

        if ($this->members) {
            $this->mNama = $this->members->nama;
        } else {
            $this->mNama = null;
        }
        if ($this->membersKembali) {
            $this->mNamaKembali = $this->membersKembali->nama;
        } else {
            $this->mNamaKembali = null;
        }
    }

    public function resetInputs()
    {
        $this->bukusId = null;
        $this->membersId = null;
        $this->membersIdKembali = null;
        $this->bNama = null;
        $this->mNama = null;
        $this->mNamaKembali = null;
        $this->waktu_pengembalian = null;
        $this->pinjamanId = null;
        $this->perpanjangWaktu = null;
    }

    public function store()
    {
        $this->validate([
            'bukusId' => 'required',
            'membersId' => 'required',
            'bNama' => 'required',
            'mNama' => 'required',
            'waktu_pengembalian' => 'required',
            // 'waktu_peminjaman' => 'required',
        ], [
            'bNama.required' => 'ID Yang Dimasukan Tidak Tersedia',
            'mNama.required' => 'ID Yang Dimasukan Tidak Tersedia',
        ]);

        $stokBuku = Buku::find($this->bukusId);
        if ($stokBuku->stok > 0) {

            $stokBuku->stok = $stokBuku->stok - 1;
            $stokBuku->save();

            Peminjaman::create([
                'bukus_id' => $this->bukusId,
                'members_id' => $this->membersId,
                'waktu_pengembalian' => $this->waktu_pengembalian,
                'ket_pengembalian' => 0,
                // 'create_at' => $this->waktu_peminjaman,
            ]);

            session()->flash('info', 'Peminjaman Berhasil Dilakukan');

            $this->resetInputs();
        } else {
            session()->flash('gagal', 'Stok Buku Kosong');
        }
    }

    public function storePengembalian($cek)
    {
        $this->validate([
            'membersIdKembali' => 'required',
            'mNamaKembali' => 'required',
            // 'bukusId' => 'required',
            // 'bNama' => 'required',
            'pinjamanId' => 'required',
            // 'waktu_pengembalian' => 'required',
            // 'waktu_peminjaman' => 'required',
        ], [
            'mNamaKembali.required' => 'ID Yang Dimasukan Tidak Tersedia',
            'pinjamanId.required' => 'Pilih Buku yang Dipinjam',
        ]);

        if ($cek === 1) {

            $stokBuku = Buku::find($this->satuPeminjam->bukus_id);
            $stokBuku->stok = $stokBuku->stok + 1;
            $stokBuku->save();

            $statusPinjam = Peminjaman::find($this->satuPeminjam->id);
            $statusPinjam->ket_pengembalian = 1;
            $statusPinjam->save();

            Pengembalian::create([
                'bukus_id' => $this->satuPeminjam->bukus_id,
                'members_id' => $this->membersIdKembali,
                'deskripsi' => "Dikembalikan",
                'denda' => "-",
                'tenggat_pengembalian' => $this->satuPeminjam->waktu_pengembalian,
            ]);
        } else if ($cek === 2) {
            $waktu = new DateTime();
            $tenggat = new DateTime($this->satuPeminjam->waktu_pengembalian);
            if ($tenggat->diff($waktu)->days >= 3) {
                $stokBuku = Buku::find($this->satuPeminjam->bukus_id);
                $stokBuku->stok = $stokBuku->stok + 1;
                $stokBuku->save();

                $statusPinjam = Peminjaman::find($this->satuPeminjam->id);
                $statusPinjam->ket_pengembalian = 1;
                $statusPinjam->save();

                Pengembalian::create([
                    'bukus_id' => $this->satuPeminjam->bukus_id,
                    'members_id' => $this->membersIdKembali,
                    'deskripsi' => "Telat Mengembalikan Lebih Dari 3 Hari",
                    'denda' => "1000",
                    'tenggat_pengembalian' => $this->satuPeminjam->waktu_pengembalian,
                ]);
            } else {
                $stokBuku = Buku::find($this->satuPeminjam->bukus_id);
                $stokBuku->stok = $stokBuku->stok + 1;
                $stokBuku->save();

                $statusPinjam = Peminjaman::find($this->satuPeminjam->id);
                $statusPinjam->ket_pengembalian = 1;
                $statusPinjam->save();

                Pengembalian::create([
                    'bukus_id' => $this->satuPeminjam->bukus_id,
                    'members_id' => $this->membersIdKembali,
                    'deskripsi' => "Telat Mengembalikan Kurang Dari 3 Hari",
                    'denda' => "-",
                    'tenggat_pengembalian' => $this->satuPeminjam->waktu_pengembalian,
                ]);
            }
        } else if ($cek === 3) {
            $stokBuku = Buku::find($this->satuPeminjam->bukus_id);
            $stokBuku->rusak = $stokBuku->rusak + 1;
            $stokBuku->save();

            $statusPinjam = Peminjaman::find($this->satuPeminjam->id);
            $statusPinjam->ket_pengembalian = 1;
            $statusPinjam->save();

            Pengembalian::create([
                'bukus_id' => $this->satuPeminjam->bukus_id,
                'members_id' => $this->membersIdKembali,
                'deskripsi' => "Buku Rusak",
                'denda' => "5000",
                'tenggat_pengembalian' => $this->satuPeminjam->waktu_pengembalian,
            ]);
        }


        session()->flash('info', 'Peminjaman Berhasil Dilakukan');

        $this->resetInputs();
    }

    public function perpanjang()
    {
        $peminjam = Peminjaman::find($this->pinjamanId);
        $peminjam->waktu_pengembalian = $this->perpanjangWaktu;
        $peminjam->save();
        $this->resetInputs();
    }
}
