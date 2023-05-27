<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
            height: 120px;
            margin-bottom: 10px;

        }


        /* Body */
        body {
            margin-top: 125px;
            /* Adjust this value based on header height */
        }

        /* Main */
        main {
            font-family: "Times New Roman", Times, serif;
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
</head>

<body>
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
            <p>Saya yang bertandatangan di bawah ini, dalam rangka proses mengikuti Pengadaan Barang/Jasa untuk:
            </p>
            <br>
            <br>
            <table style="width:90%; border: 1px solid pink;">
                <tr>
                    <td style="width: 25%;">Pekerjaan</td>
                    <td style="width: 5%;">:</td>
                    <td style="border-bottom: 2px dotted black;">{{ $nama_pekerjaan }}</td>
                </tr>
                <tr>
                    <td>Tahun Anggaran</td>
                    <td>:</td>
                    <td style="border-bottom: 2px dotted black;">{{ $tahun_anggaran }}</td>
                </tr>
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
                    <td>Bertindak untuk</td>
                    <td>:</td>
                    <td style="border-bottom: 2px dotted black;">{{ $nama_perusahaan }}</td>
                </tr>
                <tr>
                    <td>dan atas nama</td>
                    <td>:</td>
                    <td style="border-bottom: 2px dotted black;">{{ $atas_nama }}</td>
                </tr>
                <tr>
                    <td>Alamat:</td>
                    <td>:</td>
                    <td style="border-bottom: 2px dotted black;">{{ $alamat }}</td>
                </tr>
                <tr>
                    <td>No. Telepon/Fax:</td>
                    <td>:</td>
                    <td style="border-bottom: 2px dotted black;">{{ $telepon_fax }}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>:</td>
                    <td style="border-bottom: 2px dotted black;">{{ $email_perusahaan }}</td>
                </tr>
            </table>

            <br>

            <ol>
                <p>Menyatakan dengan sebenarnya bahwa:</p>
                <li>Akan menaati peraturan tentang Pedoman Pengadaan Barang/Jasa PT PLN (Persero) berdasarkan
                    Peraturan Direksi No. 0022.P/DIR/2020 tanggal 02 Maret 2020 dan perubahannya No. 0156.P/DIR/2021
                    tanggal 30 Agustus 2021 tentang Pedoman Pengadaan Barang/Jasa PT PLN (Persero).</li>

                <li>Dalam proses pengadaan ini berjanji akan melaksanakan secara bersih, transparan dan profesional
                    dalam arti tidak akan melakukan persekongkolan/pengaturan/kerjasama dengan pihak PT PLN
                    (Persero) UPK Timor yang dapat mengakibatkan terjadinya persaingan usaha tidak sehat. Dan
                    apabila ditunjuk sebagai pemenang akan mengerahkan segala kemampuan dan sumber daya secara
                    optimal untuk memberikan hasil kerja terbaik.</li>
                <br>
                <li>Apabila saya melanggar hal-hal yang telah saya nyatakan dalam PAKTA INTEGRITAS ini, saya
                    bersedia dikenakan sanksi sesuai dengan ketentuan peraturan perundang-undangan yang berlaku.
                </li>
            </ol>

            <p>Pernyataan ini saya sampaikan dengan sebenar-benarnya, tanpa menyembunyikan fakta dan hal material
                apapun, dan dengan demikian saya bertanggung jawab sepenuhnya atas kebenaran dari hal-hal yang saya
                nyatakan di sini, demikian pula akan bersedia bertanggung jawab baik secara perdata maupun pidana,
                apabila laporan dan pernyataan ini tidak sesuai dengan kenyataan sebenarnya.</p>
            <br>
            <p>Demikian pernyataan ini dibuat untuk dapat digunakan sebagimana mestinya.</p>
            <br>


            {{-- <div class="tandatangan" style="margin-top: 30px;">
            <p style="font-weight:bold;">{{ $atasNama }}</p>

            <div style="display: inline-block; border: 1px solid black; width:40%; margin: auto;">
                {!! $barcode !!}
            </div>

            <p style="font-weight:bold;"><u>{{ strtoupper($nama) }}</u></p>
            <p style="font-weight:bold;">{{ $jabatan }}</p>
        </div> --}}
            <div class="tandatangan">
                <p>{{ $kota }}, {{ $tanggal_surat }}</p>
                <p>Penyedia Barang dan Jasa,</p>
                <p>{{ $nama_perusahaan }}</p>
                <br>
                <p>Direktur</p>
                <div style="border: 1px solid black; padding: 5px; width: 100px; margin:auto; text-align: center;">
                    Material Rp
                    10.000</div>
                <p>({{ $namaterang }})</p>
                <br>
            </div>

    </main>
</body>

</html>
