<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lamp Nego</title>
    <style>
        /* CSS untuk header */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 110px;

        }

        /* Tampilan Header */
        .header-table {
            width: 100%;
            max-width: 100%;
            table-layout: auto;
            border-collapse: collapse;
        }


        .header-table td:first-child {
            width: 70%;
            /* border: 1px solid black; */
        }

        .header-table td:last-child {
            width: 30%;
            /* border: 1px solid black; */
        }




        /* margin untuk konten utama */
        body {
            margin-top: 120px;
            margin-bottom: 20px;
        }

        .judul {
            font-family: "Times New Roman", sans-serif;

            text-align: center;
            padding: 10px;

        }

        .judul h1 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: -10px;
        }

        .judul p {
            font-size: 12px;
            margin-bottom: -10px;
        }

        /* Main */
        main .pekerjaan {
            margin-top: 40px;
            margin-left: 30px;
            margin-right: 30px;
        }

        .content {
            margin-top: 20px;
        }

        .content p {
            text-align: justify;
            line-height: 1.5;
        }

        .content {
            width: 80%;
            margin: 20px auto;
        }

        .content table {
            border-collapse: collapse;
            width: 100%;
        }

        .content th,
        .content td {
            border: 1px solid #000000;
            text-align: left;
            padding: 8px 12px;
        }

        .content th {
            background-color: #ccffff;
            color: black;
        }

        .content .oranye th {
            background-color: #ffffcc;
            color: black;
        }
    </style>
</head>

<body>
    <header>
        <table class="header-table" style="width:100%; max-width:100%; table-layout:auto;">
            <tr>

                <td><img src="{{ $logokiri }}" style="vertical-align: top;" alt="Logo Kiri" width="480px"></td>
                <td><img src="{{ $logo }}" style="margin-left:20%;" alt="Logo PLN" height="40px"></td>

            </tr>
            <tr>

                <td></td>
                <td style="text-align: center; font-size: 12px;"><b> UIW NUSA TENGGARA TIMUR<br>
                        UNIT PELAKSANA PEMBANGKITAN TIMOR</b>
                </td>
            </tr>
        </table>
    </header>
    <main>
        <div class="judul">
            <h1><b>LAMPIRAN BERITA ACARA HASIL PELAKSANAAN NEGOSIASI</b></h1>
            <p style="margin-right: 2px;">Nomor : 111.BA-NEG/DAN.01.03/200900/2022</p>
            <p style="margin-right: 2px;">Tanggal : 30 Desember 2022</p>
            <div class="pekerjaan">
                <h1><b>PEKERJAAN PENGADAAN DAN JASA INSTALASI KWH METER ENGINE PLTU JEMBER PT PLN (PERSERO) UNIT INDUK
                        WILAYAH NTT UNIT PELAKSANA PEMBANGKITAN TIMOR</b></h1>

            </div>

        </div>

        <div class="content">
            <table>

                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Uraian</th>
                    <th rowspan="2">Vol</th>
                    <th rowspan="2">Sat</th>
                    <th colspan="2">Penawaran</th>
                    <th colspan="2">Negosiasi</th>
                </tr>
                <tr class="oranye">
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Total</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Barang A</td>
                    <td>100</td>
                    <td>pcs</td>
                    <td>Rp. 5.000</td>
                    <td>Rp. 4.500</td>
                    <td>Rp. 5.000</td>
                    <td>Rp. 4.500</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Barang B</td>
                    <td>50</td>
                    <td>kg</td>
                    <td>Rp. 10.000</td>
                    <td>Rp. 9.000</td>
                    <td>Rp. 5.000</td>
                    <td>Rp. 4.500</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Barang C</td>
                    <td>2</td>
                    <td>m</td>
                    <td>Rp. 20.000</td>
                    <td>Rp. 18.000</td>
                    <td>Rp. 5.000</td>
                    <td>Rp. 4.500</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Barang D</td>
                    <td>10</td>
                    <td>l</td>
                    <td>Rp. 15.000</td>
                    <td>Rp. 13.500</td>
                    <td>Rp. 5.000</td>
                    <td>Rp. 4.500</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Barang E</td>
                    <td>5</td>
                    <td>pcs</td>
                    <td>Rp. 25.000</td>
                    <td>Rp. 22.500</td>
                    <td>Rp. 5.000</td>
                    <td>Rp. 4.500</td>
                </tr>

                <tr>
                    <td colspan="8" style="border-bottom: 5px solid black;"></td>
                </tr>
                <tr>
                    <td colspan="4">JUMLAH HARGA</td>
                    <td></td>
                    <td>203.900.000</td>
                    <td></td>
                    <td>203.900.000</td>
                </tr>
                <tr>
                    <td colspan="4">Pembulatan</td>
                    <td></td>
                    <td>203.900.000</td>
                    <td></td>
                    <td>203.900.000</td>
                </tr>
                <tr>
                    <td colspan="4">PPN 11%</td>
                    <td></td>
                    <td>203.900.000</td>
                    <td></td>
                    <td>203.900.000</td>
                </tr>
                <tr>
                    <td colspan="4">Harga Total</td>
                    <td></td>
                    <td>203.900.000</td>
                    <td></td>
                    <td>203.900.000</td>
                </tr>
            </table>


        </div>
        <table style="width: 80%; margin: 0 auto;">
            <tr>
                <td style="text-align: right;">Harga Di sepakati</td>
                <td>=</td>
                <td style="text-align: left;">Rp262.159.689</td>
            </tr>
            <tr>
                <td style="text-align: right;">Terbilang</td>
                <td>:</td>
                <td style="text-align:left;">Duaratus Enampuluh Dua Juta Seratus Limapuluh Sembilan Ribu Enamratus
                    Delapanpuluh Sembilan Rupiah</td>
            </tr>
        </table>

        <table style="margin-top: 40px;">
            <tr style="text-align: center;">
                <td style="width: 50%;">SETUJU DAN SEPAKAT,<br>
                    PENYEDIA BARANG/JASA <br>
                    PT. MULTI INAR BANGUNAN <br>
                    DIREKTUR
                </td>

                <td style="width: 50%;"> DINEGOSIASI OLEH,
                    PELAKSANA PENGADAAN BARANG/JASA
                    PT PLN (PERSERO) UPK TIMOR
                    PEJABAT PELAKSANA PENGADAAN
                </td>
            </tr>
            <tr style="text-align: center;">
                <td>Tanda tangan Direktur
                </td>

                <td> Tanda tangan Pengadaan
                </td>
            </tr>
            <tr style="text-align: center;">
                <td><b>BUDI SUSANTI</b>
                </td>

                <td><b> UNTUNG DAN BERKAH</b>
                </td>
            </tr>
            <tr style="text-align: center;">
                <td colspan="2">DISAHKAN OLEH,<br>
                    PENGGUNA BARANG/JASA <br>
                    PT PLN (PERSERO) UPK TIMOR <br>
                    MANAGER
                </td>

            </tr>
            <tr style="text-align: center;">
                <td colspan="2">Tanda tangan Direktur
                </td>


            </tr>
            <tr style="text-align: center;">
                <td colspan="2">
                    <b>SELAMET DUNIA AKHIRAT</b>

                </td>

            </tr>
        </table>


    </main>
</body>

</html>
