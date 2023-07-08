<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ba Nego</title>
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
            margin-bottom: 2px;
        }

        /* Main */
        main .pekerjaan table {
            margin-top: 40px;
            border-collapse: collapse;
            width: 100%;
        }

        main .pekerjaan table td {

            padding: 10px;
            text-align: center;
            vertical-align: text-top;
        }

        /* Bagian konten */

        .content {
            margin-top: 20px;
        }

        .content p {
            text-align: justify;
            line-height: 1.5;
        }

        .content table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        .content td {
            padding: 10px;
            text-align: center;
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
            <h1>BERITA ACARA HASIL PELAKSANAAN NEGOSIASI</h1>
            <p style="margin-right: 2px;"><b>{{ $surat->nomor }}</b></p>
            <div class="pekerjaan">
                <table>
                    <tr>
                        <td>Pekerjaan:</td>
                        <td style="text-align: justify;"><i><b>{{ $surat->pekerjaan }}</b></i></td>
                    </tr>
                </table>

            </div>

        </div>

        <div class="content">
            <p>{{ $surat->paragraf_1 }} </p>

            <table>
                <tr>
                    <td style="text-align: left;">- Penawaran semula sebesar</td>
                    <td>:</td>
                    <td style="text-align: left;"><b>{{ $surat->penawaran_semula }}</b> </td>
                    <td>(Termasuk PPN 11%)</td>
                </tr>
                <tr>
                    <td style="text-align: left;">- Penawaran setelah negosiasi</td>
                    <td>:</td>
                    <td style="text-align: left;"><b>{{ $surat->penawaran_negosiasi }}</b></td>
                    <td>(Termasuk PPN 11%)</td>
                </tr>
            </table>

            <p>Demikian Berita Acara Negosiasi ini dibuat untuk dipergunakan seperlunya.</p>
            <table>
                <tr>
                    <td style="width: 50%;">SETUJU DAN SEPAKAT, <br>
                        PENYEDIA BARANG/JASA <br>
                        {{ $surat->namaperusahaan }} <br>
                        DIREKTUR
                    </td>
                    <td style="width: 50%;">DINEGOSIASI OLEH, <br>
                        PELAKSANA PENGADAAN BARANG/JASA <br>
                        PT PLN (PERSERO) UPK TIMOR <br>
                        PEJABAT PELAKSANA PENGADAAN <br>
                    </td>

                </tr>
                <tr>
                    <td style="height: 5%;">
                        {{-- @if ($surat->tandatangan_vendor != 0)
                            <img src="data:image/png;base64,{{ @DNS2D::getBarcodePNG($surat->tandatangan_vendor, 'QRCODE') }}"
                                alt="Barcode">
                        @endif --}}
                    </td>
                    <td>
                        {{-- @if ($surat->tandatangan_vendor != 0)
                            <img src="data:image/png;base64,{{ @DNS2D::getBarcodePNG($surat->tandatangan_pengadaan, 'QRCODE') }}"
                                alt="Barcode">
                        @endif --}}
                    </td>

                </tr>
                <tr>
                    <td><b>{{ $surat->vendor }} </b></td>
                    <td><b>{{ $surat->pengadaan }} </b> </td>

                </tr>
                <tr>
                    <td colspan="2">DISAHKAN OLEH, <br>
                        PENGGUNA BARANG/JASA <br>
                        PT PLN (PERSERO) UPK TIMOR <br>
                        MANAGER <br>
                    </td>


                </tr>
                <tr>
                    <td colspan="2" style="height: 5%;">
                        {{-- @if ($surat->tandatangan_vendor != 0)
                            <img src="data:image/png;base64,{{ @DNS2D::getBarcodePNG($surat->tandatangan_manager, 'QRCODE') }}"
                                alt="Barcode">
                        @endif --}}
                    </td>

                </tr>
                <tr>
                    <td colspan="2"><b>{{ $surat->manager }}
                        </b></td>


                </tr>
            </table>
        </div>

    </main>
</body>

</html>
