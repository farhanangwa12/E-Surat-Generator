@extends('template.app')

@section('title', 'Pernyataan Sanggup')

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


        /* Body */
        body {

            /* Adjust this value based on header height */
            font-family: Arial, sans-serif;
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

        <h1 class="h3 mb-3">Pernyataan Sanggup</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Kop Perusahaan
                      

                    </div>
                    <div class="card-body">
                      @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                        <main>
                            <h4 style="font-family: Arial; font-size: 16px; font-weight: bold; text-align:center;">SURAT
                                PERNYATAAN</h4>
                            <h5 style="font-family: Arial; font-size: 14px; font-weight: bold; text-align:center;">
                                (KESANGGUPAN MELAKSANAKAN PEKERJAAN)</h5>
                            <div class="isi" style="margin-top: 5px; margin-left: 50px;">
                                <br>
                                <form method="POST" action="{{ route('vendor.pernyataan.sangup.update', $id) }}">
                                    @csrf
                                    <table style="width: 90%;">
                                        <tr>
                                            <td style="width: 25%;">Nama</td>
                                            <td style="width: 5%;">:</td>
                                            <td style="border-bottom: 2px dotted black;">
                                                <input type="text" name="nama" class="form-control"
                                                    placeholder="Masukkan nama" value="{{ $nama }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Jabatan</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;">
                                                <input type="text" name="jabatan" class="form-control"
                                                    placeholder="Masukkan jabatan" value="{{ $jabatan }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Bertindak untuk</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;">
                                                <input type="text" name="bertindak_untuk" class="form-control"
                                                    placeholder="Masukkan pihak yang diwakili" value="{{ $nama_perusahaan }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>dan atas nama</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;">
                                                <input type="text" name="atas_nama" class="form-control"
                                                    placeholder="Masukkan nama pihak yang diwakili" value="{{ $atas_nama }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;">
                                                <input type="text" name="alamat" class="form-control"
                                                    placeholder="Masukkan alamat" value="{{ $alamat_perusahaan }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>No. Telepon/Fax</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;">
                                                <input type="text" name="telepon_fax" class="form-control"
                                                    placeholder="Masukkan nomor telepon/fax" value="{{ $telepon_fax }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td style="border-bottom: 2px dotted black;">
                                                <input type="text" name="email" class="form-control"
                                                    placeholder="Masukkan email" value="{{ $email_perusahaan }}">
                                            </td>
                                        </tr>
                                        <!-- Tambahkan input lainnya dengan format yang sama -->

                                    </table>

                                    <br>
                                    <p>Menyatakan dengan sebenarnya bahwa setelah mengetahui pengadaan yang akan
                                        dilaksanakan oleh PT PLN (Persero) UIW Nusa Tenggara Timur UPK Timor Tahun Anggaran
                                        2022, maka dengan ini saya menyatakan bahwa Perusahaan kami berminat dan sanggup
                                        untuk melaksanakan pekerjaan:</p>

                                    <h5 style="font-family: Arial; font-size: 12px; font-weight: bold; text-align: center;">
                                        PEKERJAAN PENGADAAN
                                        {{ $nama_pekerjaan }}
                                    </h5>
                                    <div class="clearfix">
                                        <p style="float: left;">Sesuai RKS No.: <b>{{ $nomor_rks }}</b></p>
                                        <p style="float: right;">Tanggal: <b>{{ $tanggal_rks }}</b></p>
                                    </div>

                                    <p>Demikian Surat Pernyataan ini dibuat dengan sesungguhnya, untuk dapat dipergunakan
                                        sebagaimana semestinya.</p>
                                    <br>
                                    <br>
                                    <div style="float: right; text-align: right;">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </main>
                    </div>

                </div>
            </div>


        </div>

    </div>
@endsection
