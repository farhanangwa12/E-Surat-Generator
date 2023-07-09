<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Penawaran</title>
    <style>
        /* Header */
        .header {
            position: fixed;
            top: -10px;
            left: 0;
            width: 100%;
            text-align: center;
     
            padding: 10px 0;
        }

       
        .company-logo {
            width: 100%;
            height: 200px;
            margin-bottom: 10px;
          
        }


        /* Body */
        body {
            margin-top: 210px;
            /* Adjust this value based on header height */
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

        .blue-text {
            color: #003366;
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

        /* Additional Styles for Laravel-DomPDF */
        @page {
            margin: 40px 40px;
            /* Adjust the margins as needed */
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ $kopsurat }}" alt="Kop Surat"  class="company-logo" height="500px">
    
    </div>
    <main>
        <div class="kop clearfix">
            <table style="float: left; width: 45%;">
                <tr>
                    <td>Nomor:</td>
                    <td> {{ $nomor }}</td>
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
        </div>
        <div class="isi" style="margin-top: 5px; margin-left: 50px;">
            <p>Yang bertanda tangan di bawah ini:</p>
            <table style="width: 100%;">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td style="border-bottom: 2px dotted black;">{{ $nama }}</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td style="border-bottom: 2px dotted black;">{{ $jabatan }}</td>
                </tr>
                <tr>
                    <td>Bertindak untuk
                        dan atas nama
                    </td>
                    <td>:</td>
                    <td style="border-bottom: 2px dotted black;">{{ $vendorperusahaan }}</td>
                </tr>
               
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td style="border-bottom: 2px dotted black;">{{ $alamat }}</td>
                </tr>
                <tr>
                    <td>No. Telepon/Fax</td>
                    <td>:</td>
                    <td style="border-bottom: 2px dotted black;">{{ $telepon }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td style="border-bottom: 2px solid black;">{{ $email }}</td>
                </tr>
            </table>
            <br>
            <p>Dengan ini menyatakan:</p>
            <ol>
                <li>Tunduk pada ketentuan-ketentuan Pengadaan Barang/Jasa yang termuat dalam Peraturan
                    Direksi
                    No. 0022.P/DIR/2020 tanggal 02 Maret 2020 dan perubahannya No. 0156.P/DIR/2021
                    Tanggal {{ $tanggalPengadaan }}
                    tentang Pedoman Pengadaan Barang/Jasa PT PLN (Persero).</li>
                <li>Bersedia dan sanggup melaksanakan Pekerjaan:
                    <p class="blue-text">{{ $pekerjaan }}</p>
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
                                        <td style="width: 15%">Dengan harga penawaran sebesar Rp.</td>
                                        <td style="width: 5%;">:</td>
                                        <td style="width: 70%;border-bottom: ">Rp. {{ $hargaPenawaran }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pajak Pertambahan Nilai (PPN) 11%</td>
                                        <td>:</td>
                                        <td>Rp. {{ $ppn }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Harga</td>
                                        <td>:</td>
                                        <td>Rp. {{ $jumlahHarga }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <br>
                        <p style="border-bottom: 1px dotted black; width:100%; text-align:justify;" class="terbilang">
                            {{ $terbilang }} </p>

                        <p>Rincian penawaran harga tersebut di atas sudah termasuk PPN 11% seperti yang terlampir
                            pada
                            surat penawaran ini.</p>
                    </div>
                </li>
                <li>Penawaran tersebut mengikat dalam jangka waktu 30 (Tiga Puluh) hari terhitung sejak
                    diterimanya surat penawaran harga.</li>
                <br>
                <li>Waktu pelaksanaan pekerjaan: <br>
                    <p class="blue-text">{{ $waktuPelaksanaan }}</p>
                </li>
                <br>
                <li>Terlampir kami sampaikan data kelengkapan dokumen penawaran.</li>
            </ol>
        </div>
        <div class="tandatangan" style="margin-top: 30px;">
            <p style="font-weight:bold;">{{ $atasNama }}</p>

            <div style="display: inline-block; border: 1px solid black; width:80%; margin: auto;">
                {{-- {!! $barcode !!} --}}
                Materai Rp. 10.000,- <br>
                Tanda Tangan <br>
                Dan Cap Perusahaan
            </div>

            <p style="font-weight:bold;"><u>{{ strtoupper($nama) }}</u></p>
            <p style="font-weight:bold;">{{ $jabatan }}</p>
        </div>

    </main>
</body>

</html>
