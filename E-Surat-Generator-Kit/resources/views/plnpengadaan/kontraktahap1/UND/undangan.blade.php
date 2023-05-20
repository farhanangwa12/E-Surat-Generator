<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Undangan</title>
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


    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }

    main .isi p {
        text-align: justify;
    }

    .footer {
        position: fixed;
        left: 0;
        bottom: 0;

        width: 100%;
    }
</style>

</head>

<body>






    <header>
        <table class="header-table" style="width:100%; max-width:100%; table-layout:auto;">
            <tr>

                <td><img src="{{ $data['logokiri'] }}" style="vertical-align: top;" alt="Logo Kiri" width="480px"></td>
                <td><img src="{{ $data['logo'] }}" style="margin-left:20%;" alt="Logo PLN" height="40px"></td>

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
        <div class="informasisurat clearfix" style="position: relative; width:100%; height:">
            <div style="text-align: left; width:50%; float: left;">
                <table>
                    <tr>
                        <td style="width: 30%;">Nomor</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 65%;">{{ $data['nomor']; }}</td>
                    </tr>
                    <tr>
                        <td>Lampiran</td>
                        <td>:</td>
                        <td>1 (satu) set</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>:</td>
                        <td>Undangan Penawaran Harga</td>
                    </tr>
                </table>
            </div>
            <div style="text-align: left;width: 45%; float: right;">
                <table>
                    <tr>
                        <td>{{ $data['tanggal_und']; }}</td>
                    </tr>
                    <tr>
                        <td style="height: 20px;"></td>
                    </tr>
                    <tr>
                        <td>Kepada Yth.</td>
                    </tr>
                    <tr>
                        <td><strong>{{ $data['nama_vendor']; }}</strong></td>
                    </tr>
                    <tr>
                        <td>{{ $data['alamat_jalan']; }}</td>
                    </tr>
                    <tr>
                        <td>{{ $data['alamat_kotaprovinsi']; }}</td>
                    </tr>
                </table>
            </div>


        </div>
        <div class="isi" style="margin-left: 30px; margin-top:10px; margin-bottom: 10px;">
            <p>{{ $data['paragraf1']; }} </p>
            <p>{{ $data['paragraf2']; }}</p>
            <p>Apabila berminat kami harapkan penyampaian penawaran telah kami terima selambat-lambatnya pada;
            </p>
            <p>Hari / Tanggal : <b>{{ $data['hari_tanggal']; }}</b>
            </p>
            <p>Apabila lulus evaluasi penawaran akan dilanjutkan dengan negosiasi.
            </p>

            <p>Apabila ada hal-hal yang belum jelas dapat di tanyakan ke Pejabat Pelaksana Pengadaan PT PLN (Persero)
                Unit Induk Wilayah Nusa Tenggara Timur Unit Pelaksana Pembangkitan Timor.

            </p>
            <p>Demikian atas perhatian Saudara kami ucapkan terima kasih.
            </p>
        </div>
        <div class="tandatangan" style="float: right;">
            <table style="width: 100%; text-align:center;">
                <tr style="text-align: center;">
                    <td>PEJABAT PELAKSANA PENGADAAN <br>
                        PT PLN (PERSERO) UNIT INDUK WILAYAH NTT <br>
                        UNIT PELAKSANA PEMBANGKITAN TIMOR <br>
                    </td>
                </tr>
                <tr>
                    <td style="height:5em;">@if ($data['tandatangan_pengadaan'] != 0)
                        <img src="data:image/png;base64,{{ @DNS2D::getBarcodePNG( $data['tandatangan_pengadaan'], 'QRCODE')}}" alt="Barcode">
                    @endif</td>
                </tr>
                <tr>
                    <td><b>{{ $data['nama_pengadaan']; }}</b></td>
                </tr>
            </table>
        </div>

    </main>

    <div class="footer">
        <img src="{{ $data['footer']; }}" style="vertical-align: top;" alt="Logo Kiri" width="100%">
    </div>


</body>

</html>
