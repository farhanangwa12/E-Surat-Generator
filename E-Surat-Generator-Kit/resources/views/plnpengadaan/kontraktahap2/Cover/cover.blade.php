<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cover</title>
    <style>
        /* CSS untuk tag <body> */
        body {
            text-align: center;

        }

        /* CSS untuk tag <main> */
        main {
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        /* CSS untuk judul */
        h1 {
            font-size: 24px;
            font-weight: bold;
            text-decoration: underline;
            font-family: Arial;
        }

        h2 {
            font-size: 20px;
            font-weight: bold;
            font-family: Arial;
        }

        table {
            width: 100%;
            margin-top: 5%;
            margin-bottom: 5%;
            
        }
        td {
            height: 30px;
        }

        /* CSS untuk teks di bawah judul */
        p {
            font-size: 16px;
            font-weight: bold;
            font-family: Arial;
            margin-top: 10%;
        }
    </style>
</head>

<body>

    <main>


        <!-- HTML -->
        <h1>SURAT PERINTAH KERJA</h1>
        <p>ANTARA</p>
        <p>PT PLN (PERSERO) <br>
            UNIT INDUK WILAYAH NUSA TENGGARA TIMUR <br>
            UNIT PELAKSANA PEMBANGKITAN TIMOR <br>
        </p>
        <p>DENGAN</p>
        <p>{{$surat->nama_perusahaan}} </p>

        <table>
            <tr>
                <td>Nomor Pihak Pertama</td>
                <td>:</td>
                <td>{{$surat->nomor_pihak_pertama}} </td>

            </tr>
            <tr>
                <td>Nomor Pihak Kedua</td>
                <td>:</td>
                <td>{{$surat->nomor_pihak_kedua}}</td>

            </tr>
            <tr>
                <td>Tanggal Awal Kontrak</td>
                <td>:</td>
                <td>{{$surat->tanggal_awal_kontrak}} </td>

            </tr>
          
            <tr>
                <td>Tanggal Akhir Kontrak</td>
                <td>:</td>
                <td>{{$surat->tanggal_akhir_kontrak}} </td>

            </tr>
            <tr>
                <td>Jangka Waktu</td>
                <td>:</td>
                <td>{{$surat->jangka_waktu}}</td>

            </tr>
            <tr>
                <td>Nilai Pekerjaan</td>
                <td>:</td>
                <td>{{$surat->nilai_pekerjaan}}</td>

            </tr>
           
        </table>
        <p>TENTANG</p>
        <h2 style="margin-left:80px; margin-right:80px;">PEKERJAAN PENGADAAN DAN JASA INSTALASI KWH METER ENGINE PLTU JEMBER PT PLN (PERSERO) UNIT INDUK WILAYAH NTT
            UNIT PELAKSANA PEMBANGKITAN TIMOR</h2>

        <p>{{$surat->tahun}}</p>


    </main>

</body>

</html>
