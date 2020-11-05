<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Laporan;
use PDF;


class Laporans extends Component
{
    public $kategoris;
    public $juli, $agustus, $september, $oktober, $november, $desember, $januari, $februari, $maret, $april, $mei, $juni;
    public $laporans;
    public $laporan;
    public $date;
    public $update = false;

    // public $tahunSebelumnya = strtotime("-1 year");

    public function render()
    {
        date_default_timezone_set("Asia/Jakarta") .
            //     // $date = date('Y-m-d h:i:sa');
            //     // "2020-10-29 08:32:51pm"
            $this->date = date('Y-m-30');
        if ($this->date === date('Y-m-d')) {
            $this->update = true;
        };

        // dd($this->date === date('Y-m-d'));
        $this->kategoris = Kategori::all();
        $this->laporans = Laporan::all();

        $this->juli = $this->cekBlnChart("07");
        $this->agustus = $this->cekBlnChart("08");
        $this->september = $this->cekBlnChart("09");
        $this->oktober = $this->cekBlnChart("10");
        $this->november = $this->cekBlnChart("11");
        $this->desember = $this->cekBlnChart("12");
        $this->januari = $this->cekBlnChart("01");
        $this->februari = $this->cekBlnChart("02");
        $this->maret = $this->cekBlnChart("03");
        $this->april = $this->cekBlnChart("04");
        $this->mei = $this->cekBlnChart("05");
        $this->juni = $this->cekBlnChart("06");
        // dd($this->oktober = $this->cekBlnChart(10));

        return view('livewire.laporans');
    }


    public function cekBlnChart($bulan)
    {
        $tgl = date("Y-$bulan-");
        $laporanBulan = Laporan::where('created_at', 'LIKE', "%$tgl%")->get();
        return $laporanBulan;
    }

    public function nilai($cek)
    {
        $cek = Buku::where('kategoris_id', $cek)->sum('jumlah');
        return $cek;
    }

    public function store()
    {
        $cek = date('Y-m-');
        $this->laporan = Laporan::where('created_at', 'LIKE', "%$cek%")->count();
        // dd($this->laporan);
        // dd($this->laporan !== 0);
        if ($this->laporan !== 0) {
            session()->flash('info', 'Laporan Telah Di Update');
        } else {
            foreach ($this->kategoris as $kategori) {
                Laporan::create([
                    'nama' => $kategori->nama,
                    'kategoris_id' => $kategori->id,
                    'nilai' => $this->nilai($kategori->id),
                ]);
            }

            Laporan::create([
                'nama' => 'baik',
                'nilai' => Buku::sum('jumlah') - Buku::sum('rusak'),
            ]);
            Laporan::create([
                'nama' => 'rusak',
                'nilai' => Buku::sum('rusak'),
            ]);
            Laporan::create([
                'nama' => 'jumlah',
                'nilai' => Buku::sum('jumlah'),
            ]);

            session()->flash('info', 'Laporan Berhasil Di Update');

            $this->date = 0;
            $this->update = false;
        }
    }

    public function cetak_pdf()
    {
        $date = date('Y-m-d');
        $laporan = Laporan::all();
        $kategoris = Kategori::all();
        $juli = $this->cekBlnChart("07");
        $agustus = $this->cekBlnChart("08");
        $september = $this->cekBlnChart("09");
        $oktober = $this->cekBlnChart("10");
        $november = $this->cekBlnChart("11");
        $desember = $this->cekBlnChart("12");
        $januari = $this->cekBlnChart("01");
        $februari = $this->cekBlnChart("02");
        $maret = $this->cekBlnChart("03");
        $april = $this->cekBlnChart("04");
        $mei = $this->cekBlnChart("05");
        $juni = $this->cekBlnChart("06");

        $pdf = PDF::loadView(
            'laporanpdf',
            [
                'laporan' => $laporan,
                'kategoris' => $kategoris,
                'juli' => $juli,
                'agustus' => $agustus,
                'september' => $september,
                'oktober' => $oktober,
                'november' => $november,
                'desember' => $desember,
                'januari' => $januari,
                'februari' => $februari,
                'maret' => $maret,
                'april' => $april,
                'mei' => $mei,
                'juni' => $juni
            ]
        )->setPaper('letter', 'landscape');

        return $pdf->stream("Laporan-$date.pdf");

        //return view('email.sample', $data);
    }
}
