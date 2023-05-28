@extends('template.app')

@section('title', 'Pernyatan Garansi')

@section('content')
    <style>
        /* Header */
        .header {

            width: 100%;
            text-align: center;

            padding: 10px 0;
        }


        .company-logo {
            width: 100%;
            height: 120px;
            margin-bottom: 10px;

        }




        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .tandatangan {
            float: right;
            text-align: center;
        }

        .terbilang::before {
            content: "(";
        }

        .terbilang::after {
            content: ")";
        }
    </style>
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Pernyataan Garansi</h1>

        <div class="row">
            <div class="col-12">


                <div class="card">
                    <div class="card-header">
                        Kop Perusahaan
                    </div>
                    <div class="card-body">
                        <div class="header" style="background: grey;">
                            {{-- <img src="{{ $kopsurat }}" alt="Kop Surat" style="object-fit: cover;" class="company-logo" width="200px"> --}}
                            Kop Surat
                        </div>
                        <main>
                            <h4 style="font-family: Arial; font-size: 16px; font-weight: bold; text-align:center;">SURAT
                                PERNYATAAN</h4>
                            <h5 style="font-family: Arial; font-size: 14px; font-weight: bold; text-align:center;">
                                (JAMINAN GARANSI)</h5>
                            <div class="isi" style="margin-top: 5px; margin-left: 50px;">
                                <br>
                                <p>Yang bertanda tangan dibawah ini:</p>
                                <form action="{{ route('vendor.pernyataan.garansi.update', $id) }}" method="POST">
                                    @csrf
                                    <table style="width: 90%;">
                                        <tr>
                                            <td style="width: 25%;">Nama</td>
                                            <td style="width: 5%;">:</td>
                                            <td style="border-bottom: 2px dotted black;">
                                                <input type="text" name="nama" placeholder="Masukkan nama" class="form-control" value="{{ $data->nama }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;">
                                                <input type="text" name="jabatan" placeholder="Masukkan jabatan" class="form-control" value="{{ $data->jabatan }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bertindak untuk</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;">
                                                <input type="text" name="bertindak_untuk"
                                                    placeholder="Masukkan bertindak untuk" class="form-control" value="{{ $data->nama_perusahaan }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>dan atas nama</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;">
                                                <input type="text" name="atas_nama" placeholder="Masukkan atas nama" class="form-control" value="{{ $data->atas_nama }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;">
                                                <input type="text" name="alamat" placeholder="Masukkan alamat" class="form-control" value="{{ $data->alamat_perusahaan }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>No. Telepon/Fax</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;">
                                                <input type="text" name="telepon_fax"
                                                    placeholder="Masukkan no. telepon/fax" class="form-control" value="{{ $data->telepon_fax }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;">
                                                <input type="text" name="email" placeholder="Masukkan email" class="form-control" value="{{ $data->email_perusahaan }}">
                                            </td>
                                        </tr>
                                    </table>
                                    <br>
                                    <p>Menyatakan dengan sebenarnya bahwa setelah mengetahui pengadaan yang akan
                                        dilaksanakan oleh Tahun
                                        Anggaran 2022, maka dengan ini saya menyatakan bahwa Perusahaan kami berminat
                                        dan sanggup memberikan
                                        Jaminan Garansi Barang/Pekerjaan untuk pekerjaan:</p>
                                    <h5 style="font-family: Arial; font-size: 12px; font-weight: bold; text-align: center;">
                                        PEKERJAAN
                                        PENGADAAN {{ $data->nama_pekerjaan }}</h5>
                                    <div class="clearfix">
                                        <p style="float: left;">Sesuai RKS No.: <b>{{ $data->no_rks }}</b></p>
                                        <p style="float: right;">Tanggal: <b>{{ $data->tanggal_rks }}</b></p>
                                    </div>
                                    <p>Apabila dalam pelaksanaan pekerjaan kualitas dan hasil kinerja/performance tidak
                                        sesuai dengan yang
                                        dipersyaratkan, maka kami siap memperbaiki/meningkatkan performance tersebut.
                                    </p>
                                    <p>Segala biaya yang diperlukan untuk memperbaiki/meningkatkan performance tersebut
                                        adalah menjadi beban
                                        dan tanggung jawab kami.</p>
                                    <br>
                                    <p>Demikian Surat Pernyataan Jaminan Kualitas ini kami buat dengan penuh rasa
                                        tanggung jawab.</p>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </main>
                    </div>
                </div>

            </div>

        </div>
    @endsection
