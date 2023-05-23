<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        /* Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            text-align: center;
            background-color: #f1f1f1;
            padding: 10px 0;
        }

        .company-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .company-address {
            font-size: 14px;
        }

        .company-logo {
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }


        /* Body */
        body {
            margin-top: 120px;
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
            /* font-size: 10px;
            font-family: Arial, Helvetica, sans-serif; */
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
</head>

<body>
    <div class="header">
        <img src="path/to/company-logo.png" alt="Company Logo" class="company-logo">
        <div class="company-name">Nama Perusahaan</div>
        <div class="company-address">Alamat Perusahaan, Kota</div>
    </div>
    <main>
        <div class="kop clearfix">
            <table style="float: left; width: 45%;">
                <tr>
                    <td>Nomor:</td>
                    <td>...../........./....../........</td>
                </tr>
                <tr>
                    <td>Lampiran:</td>
                    <td>..................................</td>
                </tr>
                <tr>
                    <td>Perihal:</td>
                    <td>Penawaran Harga</td>
                </tr>
            </table>
            <table style="float: right; width: 45%; text-align:left;">
                <tr>

                    <td colspan="2">
                        ..…......................….,.................... 2022
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        Kepada:<br>
                        PELAKSANA PENGADAAN BARANG/JASA<br>
                        PT Indah Permata Saru<br>
                        JL. Makan Nasi
                    </td>
                </tr>
            </table>
        </div>
        <div class="isi" style="margin-left: 60px;">
            <br>
            <p>Yang bertanda tangan di bawah ini:</p>
            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>................................................................................................................
                    </td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>................................................................................................................
                    </td>
                </tr>
                <tr>
                    <td>Bertindak untuk</td>
                    <td>:</td>
                    <td>PT/CV/Firma........................................................................................
                    </td>
                </tr>
                <tr>
                    <td>dan atas nama</td>
                    <td>:</td>
                    <td>................................................................................................................
                    </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>................................................................................................................
                    </td>
                </tr>
                <tr>
                    <td>No. Telepon/Fax</td>
                    <td>:</td>
                    <td>........................../....................................................................................
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td style="border-bottom: 2px solid black;">
                        ................................................................................................................
                    </td>
                </tr>
            </table>
            <br>
            <p>Dengan ini menyatakan:</p>
            <ol>
                <li>Tunduk pada ketentuan-ketentuan Pengadaan Barang/Jasa yang termuat dalam Peraturan
                    Direksi
                    No. 0022.P/DIR/2020 tanggal 02 Maret 2020 dan perubahannya No. 0156.P/DIR/2021 tanggal
                    30
                    Agustus 2021 tentang Pedoman Pengadaan Barang/Jasa PT PLN (Persero).</li>

                <li >Bersedia dan sanggup melaksanakan Pekerjaan:
                    <p class="blue-text">PEKERJAAN PENGdadadada</p> <br>
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
                                        <td style="width: 70%;border-bottom: ">...........................................................</td>
                                    </tr>
                                    <tr>
                                        <td>Pajak Pertambahan Nilai (PPN) 11%</td>
                                        <td>:</td>
                                        <td>...........................................................</td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Harga</td>
                                        <td>:</td>
                                        <td>...........................................................</td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                        <br>
                        <p style="border-bottom: 1px dotted black; width:100%;" class="terbilang">*Terbilang*</p>
                        <p>Rincian penawaran harga tersebut di atas sudah termasuk PPN 11% seperti yang terlampir
                            pada
                            surat penawaran ini.</p>
                    </div>

                </li>
                <li>Penawaran tersebut mengikat dalam jangka waktu 30 (Tiga Puluh) hari terhitung sejak
                    diterimanya surat penawaran harga.</li>
                <br>
                <li>Waktu pelaksanaan pekerjaan: <br>
                    <p class="blue-text">dadadadadada</p>
                </li>
                <br>
                <li>Terlampir kami sampaikan data kelengkapan dokumen penawaran.</li>
            </ol>


        </div>
        <div class="tandatangan" style="border: 1px solid pink;">
            <p style="font-weight:bold;">Nama PT/CV ….......................</p>

            <p style="width: 50%; border: 1px solid black; margin: auto;"> Materai Rp. 10.000,- <br> Tanda Tangan Dan
                Cap Perusahaan</p>
            <p style="font-weight:bold;"><u>Nama Jelas</u>

            </p>
            <p style="font-weight:bold;">
                Jabatan
            </p>
        </div>
    </main>

</body>

</html>
