@extends('template.app')

@section('title', 'Pakta vendor')

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




        /* Main */
        main {
            /* font-family: "Times New Roman", Times, serif; */
            font-size: 12px;
        }

        .kop {
            width: 100%;
        }

        .kop table {
            width: 100%;
        }

        .kop th,
        .kop td {
            text-align: left;
            padding: 8px;
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



        /* Additional Styles for Laravel-DomPDF */
        @page {
            margin: 20px 100px;
            /* Adjust the margins as needed */
        }
    </style>
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Pakta Vendor</h1>

        <div class="row">
            <div class="col-12">


                <div class="card">
                    <div class="card-header">
                        Kop Surat
                    </div>
                    <div class="card-body">
                        <div class="header">
                            {{-- <img src="{{ $kopsurat }}" alt="Kop Surat" style="object-fit: cover;" class="company-logo" width="200px"> --}}
                            Kop Surat
                        </div>
                        <main>
                            {{-- <div class="kop clearfix">
                                <table style="float: left; width: 45%;">
                                    <tr>
                                        <td>Nomor:</td>
                                        <td>{{ $nomor }}</td>
                                    </tr>
                                    <tr>
                                        <td>Lampiran:</td>
                                        <td>{{ $lampiran }}</td>
                                    </tr>
                                    <tr>
                                        <td>Perihal:</td>
                                        <td>Penawaran Harga</td>
                                    </tr>
                                </table>
                                <table style="float: right; width: 45%; text-align:left;">
                                    <tr>
                                        <td colspan="2">
                                            {{ $tanggal }}
                                        </td>
                                    </tr>
                        
                        
                                    <tr>
                                        <td colspan="2">
                                            Kepada:<br>
                                            PELAKSANA PENGADAAN BARANG/JASA<br>
                                            <p style="margin-bottom: -10px;">{{ $namaPerusahaan }}</p><br>
                                            <p>{{ $alamatPerusahaan }}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div> --}}
                            <div class="isi" style="margin-top: 5px; margin-left: 50px;">
                                <h4 style="font-size: 14px; font-weight: bold; text-align:center;">PAKTA INTEGRITAS</h4>
                                <br>
                                <p>Saya yang bertandatangan di bawah ini, dalam rangka proses mengikuti Pengadaan
                                    Barang/Jasa untuk:</p>
                                <br>
                                <br>
                                <form method="POST" action="{{ route('vendor.paktavendor.update', $id) }}">
                                    @csrf
                                    <table style="width:90%;">
                                        <tr>
                                            <td style="width: 25%;">Pekerjaan</td>
                                            <td style="width: 5%;">:</td>
                                            <td style="border-bottom: 2px dotted black;"><input type="text"
                                                    name="pekerjaan" class="form-control" value="{{ $pekerjaan }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Tahun Anggaran</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;"><input type="text"
                                                    name="tahun_anggaran" class="form-control" value="{{ $tahun_anggaran }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;"><input type="text"
                                                    name="nama" class="form-control" value="{{ $nama }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;"><input type="text"
                                                    name="jabatan" class="form-control" value="{{ $jabatan }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Bertindak untuk</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;"><input type="text"
                                                    name="bertindak_untuk" class="form-control" value="{{ $nama_perusahaan }}"></td>
                                        </tr>
                                        <tr>
                                            <td>dan atas nama</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;"><input type="text"
                                                    name="atas_nama" class="form-control" value="{{ $atas_nama }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat:</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;"><input type="text"
                                                    name="alamat" class="form-control" value="{{ $alamat }}"></td>
                                        </tr>
                                        <tr>
                                            <td>No. Telepon/Fax:</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;"><input type="text"
                                                    name="telepon_fax" class="form-control" value="{{ $telepon_fax }}"></td>
                                        </tr>
                                        <tr>
                                            <td>Email:</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;"><input type="text"
                                                    name="email" class="form-control" value="{{ $email_perusahaan }}"></td>
                                        </tr>
                                    </table>

                                    <br>

                                    <ol>
                                        <p>Menyatakan dengan sebenarnya bahwa:</p>
                                        <li>Akan menaati peraturan tentang Pedoman Pengadaan Barang/Jasa PT PLN (Persero)
                                            berdasarkan
                                            Peraturan Direksi No. 0022.P/DIR/2020 tanggal 02 Maret 2020 dan perubahannya No.
                                            0156.P/DIR/2021
                                            tanggal 30 Agustus 2021 tentang Pedoman Pengadaan Barang/Jasa PT PLN (Persero).
                                        </li>

                                        <li>Dalam proses pengadaan ini berjanji akan melaksanakan secara bersih, transparan
                                            dan profesional
                                            dalam arti tidak akan melakukan persekongkolan/pengaturan/kerjasama dengan pihak
                                            PT PLN
                                            (Persero) UPK Timor yang dapat mengakibatkan terjadinya persaingan usaha tidak
                                            sehat. Dan
                                            apabila ditunjuk sebagai pemenang akan mengerahkan segala kemampuan dan sumber
                                            daya secara
                                            optimal untuk memberikan hasil kerja terbaik.</li>
                                        <br>
                                        <li>Apabila saya melanggar hal-hal yang telah saya nyatakan dalam PAKTA INTEGRITAS
                                            ini,
                                            saya bersedia dikenakan sanksi sesuai dengan ketentuan peraturan
                                            perundang-undangan yang
                                            berlaku.
                                        </li>
                                    </ol>

                                    <p>Pernyataan ini saya sampaikan dengan sebenar-benarnya, tanpa menyembunyikan fakta dan
                                        hal material
                                        apapun, dan dengan demikian saya bertanggung jawab sepenuhnya atas kebenaran dari
                                        hal-hal yang saya
                                        nyatakan di sini, demikian pula akan bersedia bertanggung jawab baik secara perdata
                                        maupun pidana,
                                        apabila laporan dan pernyataan ini tidak sesuai dengan kenyataan sebenarnya.</p>
                                    <br>
                                    <p>Demikian pernyataan ini dibuat untuk dapat digunakan sebagimana mestinya.</p>
                                    <br>

                                    {{-- <div class="tandatangan" style="margin-top: 30px;">
                                        <p style="font-weight:bold;">{{ $atasNama }}</p>

                                        <div
                                            style="display: inline-block; border: 1px solid black; width:40%; margin: auto;">
                                            {!! $barcode !!}
                                        </div>

                                        <p style="font-weight:bold;"><u>{{ strtoupper($nama) }}</u></p>
                                        <p style="font-weight:bold;">{{ $jabatan }}</p>
                                    </div> --}}

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </main>

                    </div>
                </div>


            </div>

        </div>
    @endsection
