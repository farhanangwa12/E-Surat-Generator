<!DOCTYPE html>
<html>

<head>
    <title>Halaman Tampilan View</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 12px;
            font-weight: bold;
            margin: 0;
        }

        .header h2 {
            font-size: 10px;
            font-weight: bold;
            margin: 0;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .tabel-kiri h3,
        .tabel-kanan h3 {
            font-weight: normal;
        }

        .tabel-kiri {
            border-right: none;
        }

        .tabel-kanan {
            border-left: none;
        }

        .tabel-kiri tr td:nth-child(5) {
            border-right: none;
        }

        .tandatangan {
            float: right;
            text-align: center;
        }

        /* tabel setelah  */
        .piutang td,
        .piutang tr {
            border: none;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Kop Surat</h1>
        <h2>Sub Title</h2>
    </div>
    <main>
        <div class="tabel clearfix" style="border: 1px solid red; width: 100%;">
            <h3><b>Neraca Perusahaan Terakhir Per Tanggal ........ Bulan ................................ Tahun ..............									
            </b></h3>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th colspan="5">
                            <h3>AKTIVA</h3>
                        </th>
                        <th colspan="5">
                            <h3>PASIVA</h3>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>I</td>
                        <td>Aktiva Lancar</td>
                        <td>:</td>
                        <td>Rp...........</td>
                        <td></td>
                        <td>IV</td>
                        <td>Utang jangka pendek</td>
                        <td>:</td>
                        <td>Rp...........</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Kas</td>
                        <td>:</td>
                        <td>Rp...........</td>
                        <td></td>
                        <td></td>
                        <td>Utang dagang</td>
                        <td>:</td>
                        <td>Rp...........</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Bank</td>
                        <td>:</td>
                        <td>Rp...........</td>
                        <td></td>
                        <td></td>
                        <td>Utang pajak</td>
                        <td>:</td>
                        <td>Rp...........</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Piutang *)

                        </td>
                        <td>:</td>
                        <td>Rp...........</td>
                        <td></td>
                        <td></td>
                        <td>Utang lainnya</td>
                        <td>:</td>
                        <td>Rp...........</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Persediaan Barang
                        </td>
                        <td>:</td>
                        <td>Rp...........</td>
                        <td></td>

                        <td></td>
                        <td>Jumlah (d)</td>
                        <td></td>
                        <td></td>
                        <td>Rp...........</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Pekerjaan dalam Proses
                        </td>
                        <td>:</td>
                        <td>Rp...........</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Jumlah (a)

                        </td>
                        <td></td>
                        <td></td>
                        <td>Rp…….
                        </td>
                        <td>V</td>
                        <td>Utang jangka panjang (e)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>

                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>II</td>
                        <td>Aktiva tetap
                        </td>
                        <td>:</td>
                        <td>Rp...........</td>
                        <td></td>
                        <td>VI</td>
                        <td>Kekayaan bersih (a+b+c) – (d+e)</td>
                        <td>:</td>
                        <td>Rp...........</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Peralatan dan Mesin</td>
                        <td>:</td>
                        <td>Rp...........</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>Peralatan dan Mesin</td>
                        <td>:</td>
                        <td>Rp...........</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Inventaris</td>
                        <td>:</td>
                        <td>Rp...........</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Gedung-gedung</td>
                        <td>:</td>
                        <td>Rp...........</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Jumlah (b)</td>
                        <td></td>
                        <td></td>
                        <td>Rp…….
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>III</td>
                        <td>Aktiva Lainnya (c)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                </tbody>
                <tfoot>
                    <tr>
                        <td></td>

                        <td colspan="3">Jumlah
                        </td>
                        <td>Rp…….</td>
                        <td></td>

                        <td colspan="3">Jumlah
                        </td>
                        <td>Rp…….</td>
                    </tr>
                </tfoot>
            </table>
            <table style="width: 40%;" class="piutang">
                <tr>
                    <td> *)</td>
                    <td>Piutang jangka pendek (sampai dengan enam bulan )</td>
                    <td>:</td>
                    <td>Rp...........</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Piutang jangka pendek (lebih dari enam bulan)</td>
                    <td>:</td>
                    <td>Rp...........</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Jumlah </td>
                    <td>:</td>
                    <td>Rp...........</td>
                </tr>




            </table>

        </div>
    </main>


    <div class="tandatangan">
        <div>............... (Tanggal), .................. 2022</div>
        <div>PT/CV/Firma ..............................</div>
        <div class="nama-jabatan">Nama Jelas</div>
        <div class="nama-jabatan">Jabatan</div>
    </div>
</body>

</html>
