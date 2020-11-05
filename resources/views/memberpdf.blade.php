<!DOCTYPE html>
<html style="margin: 0; padding: 0">
<head>
    <title>Cover</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
     {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
     {{-- <style type="text/css" media="all">
        .rowAtas {
            background:yellow;
            border-style: solid;
            border-radius: 50%;

            }
        .rowBawah {background:blue;}
    </style> --}}
    <link rel="stylesheet" href="{{public_path('css/pdf.css')}}">

</head>
<body>
    <div class="container-fluid mt-3" style="max-width: 40rem;">
		<div class="row mb-n5 pb-0 no-gutters rowAtas" style="background-color: chartreuse">
			<div class="col-sm-2 mb-n3 pb-0 rowAtasKiri text-center">
                <img src="{{public_path('Logo.png')}}" width="95%" class="mt-3"/>
			</div>
			<div class="col-sm-10 mb-n3 pb-0 text-center offset-2 rowAtasKanan">
				<h5>KARTU PERPUSTAKAAN</h5>
				<h3><b>SMPN 1 BANYURESMI GARUT</b></h3>
				<h6>Jl. H. Hasan Arif, Karyamukti, Kec. Banyuresmi, Kabupaten Garut, Jawa Barat 44191</h6>
            </div>
        </div>
        <div class="row mt-n5 pt-0 no-gutters rowBawah">
            <div class="col-sm-4 rowBawahKiri text-center">
                <img src="{{ public_path("storage/$member->foto") }}" alt="" width="90%" height="250px">
            </div>
            <div class="col-sm-8 offset-4 mt-n4 rowBawahKanan" style="padding-left: 10px">
                <table class="mt-n4">
                    <tr>
                        <td><b>ID Anggota</b></td>
                        <td>: {{$member->id}}</td>
                    </tr>
                    <tr>
                        <td><b>Nama</b></td>
                        <td>: {{$member->nama}}</td>
                    </tr>
                    <tr>
                        <td><b>Tanggal Lahir </b></td>
                        <td>: {{$member->tgl_lahir}}</td>
                    </tr>
                    <tr>
                        <td><b>Kelas</b></td>
                        <td>: {{$member->kelas}}</td>
                    </tr>
                        <tr>
                        <td><b>Alamat</b></td>
                        <td>: {{$member->alamat}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  </body>
</html>
