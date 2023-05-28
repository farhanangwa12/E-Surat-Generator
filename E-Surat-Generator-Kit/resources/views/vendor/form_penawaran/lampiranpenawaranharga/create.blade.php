@extends('template.app')

@section('title', 'Lampiran Penawaran Harga')

@section('content')
    <style>
        body {
            font-family: Times New Roman;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
        }

        h1 {
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
        }

        table {
            border-collapse: collapse;
            margin: 20px auto;
            width: 100%;
        }

        table tr.blue {
            background-color: #bdffff;
        }


        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
        }

        .square {
            width: 40px;
            height: 40px;
            background-color: black;
            margin-left: auto;
            margin-right: auto;
        }

        .bold {
            font-weight: bold;
        }

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }

        table.tandatangan {
            border-collapse: collapse;

        }

        table.tandatangan td,
        table.tandatangan th {
            border: none;
        }
    </style>
    <div class="card w-100">
        <div class="card-header">
            <h5 class="card-title">Create Form Penawaran Harga</h5>
        </div>
        <form action="{{ route(lampiranpenawaranharga/update/{id}, $formPenawaranHarga->id_kontrakkerja) }}" method="post"
            enctype="multipart/form-data">

            @csrf
            <div class="card-body">
                <div class="header mb-3">
                    <div class="form-group">
                        <label for="kopsurat">Masukkan gambar kopsurat
                            dengan ketentuan panjang 120px
                        </label>

                        <input type="file" name="kopsurat" class="form-control" placeholder="Kopsurat"
                            accept=".jpg, .jpeg, .png">
                    </div>



                </div>
                <main>
                    <div class="kop clearfix">
                        <table style="float: left; width: 45%;">
                            <tr>
                                <td>Nomor:</td>
                                <td><input type="text" name="nomor" class="form-control"
                                        placeholder="Masukkan nomor surat" value="{{ $data['nomor'] }}"></td>
                            </tr>
                            <tr>
                                <td>Lampiran:</td>
                                <td><input type="text" name="lampiran" placeholder="Masukkan banyak lampiran"
                                        class="form-control"
                                        value="
                                    {{ $data['lampiran'] }}"></td>
                            </tr>
                            <tr>
                                <td>Perihal:</td>
                                <td>Penawaran Harga</td>
                            </tr>
                        </table>
                        <table style="float: right; width: 45%; text-align:left;">
                            <tr>
                                <td colspan="2">
                                    <div class="form-group">

                                        <div class="row">
                                            <div class="col-md-3">
                                                <input type="text" name="nama_kota" placeholder="Nama tempat"
                                                    class="form-control" value="{{ $data['nama_kota'] }}">
                                            </div>
                                            <div class="col-md-9">
                                                <input type="date" name="tanggal_pembuatan_surat"
                                                    placeholder="Tanggal Surat" class="form-control"
                                                    value="{{ $data['tanggal_pembuatan_surat'] }}">
                                            </div>
                                        </div>
                                    </div>




                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    Kepada:<br>
                                    PELAKSANA PENGADAAN BARANG/JASA<br>
                                    <p style="margin-bottom: -10px;">{{ $isi->namaPerusahaan }}</p><br>
                                    <p>{{ $isi->alamatPerusahaan }}</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="isi" style="margin-top: 5px; margin-left: 50px;">
                        <p>Yang bertanda tangan di bawah ini:</p>
                        <table style="width: 100%;">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><input type="text" name="nama_vendor" class="form-control"
                                        value="{{ $data['nama_vendor'] }}"></td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td>:</td>
                                <td><input type="text" name="jabatan" class="form-control"
                                        value="{{ $data['jabatan'] }}"></td>
                            </tr>
                            <tr>
                                <td>Bertindak untuk</td>
                                <td>:</td>
                                <td><input type="text" name="nama_perusahaan" placeholder="PT/CV/Firma................"
                                        class="form-control" value="{{ $data['nama_perusahaan'] }}"></td>
                            </tr>
                            <tr>
                                <td>dan atas nama</td>
                                <td>:</td>
                                <td><input type="text" name="atas_nama" class="form-control"
                                        placeholder="............................." value="{{ $data['atas_nama'] }}"></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td><input type="text" name="alamat_perusahaan" class="form-control"
                                        value="{{ $data['alamat_perusahaan'] }}"></td>
                            </tr>
                            <tr>
                                <td>No. Telepon/Fax</td>
                                <td>:</td>
                                <td><input type="text" name="telepon_fax" class="form-control"
                                        value="{{ $data['telepon_fax'] }}"></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td style="border-bottom: 2px solid black;"><input type="email" name="email_perusahaan"
                                        class="form-control" value="{{ $data['email_perusahaan'] }}"></td>
                            </tr>
                        </table>
                        <br>
                        <p>Dengan ini menyatakan:</p>
                        <ol>
                            <li>Tunduk pada ketentuan-ketentuan Pengadaan Barang/Jasa yang termuat dalam Peraturan Direksi
                                No. 0022.P/DIR/2020 tanggal 02 Maret 2020 dan perubahannya No. 0156.P/DIR/2021 Tanggal
                                2023-05-24 tentang Pedoman Pengadaan Barang/Jasa PT PLN (Persero).</li>
                            <li>Bersedia dan sanggup melaksanakan Pekerjaan:
                                <p class="blue-text">
                                    {{ $isi->kontrakkerja->nama_kontrak . 'PT. PLN (PERSERO) UNIT INDUK WILAYAH NTT UNIT PELAKSANA PEMBANGKITAN TIMOR' }}
                                </p>
                                <br>
                                <p>Sesuai dengan syarat-syarat yang tercantum dalam:</p>
                                <div>
                                    <div class="clearfix" style="">
                                        <div class="left" style="float:left;width:35%;">
                                            <p>- Rencana Kerja Dan Syarat-Syarat (RKS)</p>
                                        </div>
                                        <div class="right" style="float:right;width:65%;">
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td style="width: 15%">Dengan harga penawaran sebesar Rp. </td>
                                                    <td style="width: 5%;">:</td>
                                                    <td style="width: 70%;"><input type="text" name="harga_penawaran"
                                                            class="form-control number"
                                                            value="{{ $data['harga_penawaran'] }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Pajak Pertambahan Nilai (PPN) 11% (Rp.)</td>
                                                    <td>:</td>
                                                    <td><input type="text" name="ppn11" class="form-control number"
                                                            value="{{ $data['ppn11'] }}"></td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah Harga (Rp.)</td>
                                                    <td>:</td>
                                                    <td><input type="text" name="jumlah_harga"
                                                            class="form-control number"
                                                            value="{{ $data['jumlah_harga'] }}">
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <br>
                                    {{-- <p style="border-bottom: 1px dotted black; width:100%; text-align:justify;"
                                        class="terbilang"></p> --}}
                                    <div class="form-group">
                                        <label for="terbilang">Terbilang</label>
                                        <input type="text" name="terbilang" class="form-control"
                                            value="{{ $data['terbilang'] }}">
                                    </div>


                                    <p>Rincian penawaran harga tersebut di atas sudah termasuk PPN 11% seperti yang
                                        terlampir
                                        pada
                                        surat penawaran ini.</p>
                                </div>
                            </li>
                            <li>Penawaran tersebut mengikat dalam jangka waktu 30 (Tiga Puluh) hari terhitung sejak
                                diterimanya surat penawaran harga.</li>
                            <br>
                            <li>Waktu pelaksanaan pekerjaan: <br>
                                <p class="blue-text">{{ $isi->waktuPelaksanaan }}</p>
                            </li>
                            <br>
                            <li>Terlampir kami sampaikan data kelengkapan dokumen penawaran.</li>
                        </ol>
                    </div>
                    <p class="mt-6">Setelah menyimpan isi maka form penawaran akan disimpan dan di tampilkan ke pdf siap
                        untuk dilakukan print dan tanda tangan</p>
                    <div>
                        <a href="{{ route('vendor.kontrakkerja.detail', $formPenawaranHarga->id_kontrakkerja) }}"
                            class="btn btn-warning">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>

                    </div>


                </main>
            </div>
        </form>

    </div>

@endsection
