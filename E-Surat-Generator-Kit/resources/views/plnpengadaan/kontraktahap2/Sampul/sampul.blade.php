<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sampul</title>
    <style>
        header {
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          margin-left: -30px;
          margin-top: -30px;


          border: 32px solid #604a7b;
          width: 100%;
          height: 100%;

        }
        
        main {
            /* Mengatur lebar elemen main menjadi 100% */
            width: 100%;
         

            
        }

        table {
            /* Mengatur lebar tabel menjadi 100% dari lebar elemen main */
            width: 90%;

            border-collapse: collapse;
            /* Menggabungkan border cell yang berdekatan */

            /* Isian properti CSS lainnya untuk membuat tabel */

            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
            margin-bottom: 20px;

            color: #333;
        }

        th,
        td {
            /* Mengatur padding dan border sel pada tabel */
            text-align: center;
            vertical-align: middle;

        }


        /* table  */
        table h2 {
            font-size: 20px;
            font-family: Arial;
            font-weight: bold;
        }

        table h3 {
            font-size: 16px;
            font-family: Arial;
            font-weight: bold;
        }

        table h4 {
            font-size: 14px;
            font-family: Arial;
            font-weight: bold;
        }

        .logopln {
            margin-left: 40px;
        }
    </style>
</head>

<body>
    <header>
      
    </header>

    <main>
        <table>
            <tr>
                <td style="height: 18px;"><img class="logopln" src="{{ $logopln }}" alt="logopln" width="100px"></td>
                <td style="width: 90%;"><b>
                        <h2>PT. PLN (PERSERO) UIW NTT</h2> <br>
                        <h3>UNIT PELAKSANA PEMBANGKITAN TIMOR</h3> <br>
                        <h4>Jl. Diponegoro Kuanino – Kupang 85119</h4>
                    </b></td>
            </tr>

            <tr>

                <td colspan="2"><img src="{{ $baris_bawah }}" alt="baris bawah" width="100%"></td>
            </tr>
        </table>








        <div class="pembukaan_surat" style="margin-top: 40px; margin-bottom: 40px; text-align:center;">
            <h1 style="font-size: 24px; font-family: Arial; font-weight: bold; text-decoration: underline;">
                SURAT PERINTAH KERJA
            </h1>
            <p style="font-size: 20px; font-family: Arial; font-weight: bold; text-align: center;">
                {{$surat->nomor}}
            </p>
            <p style="font-size: 20px; font-family: Arial; font-weight: bold; text-align: center;">
                {{$surat->tanggal}}
            </p>
        </div>

        <div class="isi_surat"
            style="font-size: 20px; font-family: Arial; font-weight: bold; margin: 40px 80px; text-align:center;">
            <p>{{$surat->pekerjaan}}</p>
        </div>


        <div style="text-align: center; margin-top: 40px; margin-bottom: 40px;">
            <p style="font-size: 20px; font-family: Arial; font-weight: bold;">Antara</p>
            <p style="font-size: 20px; font-family: Arial; margin-top: 40px; margin-bottom: 40px;"><b>PT. PLN (PERSERO) UNIT INDUK WILAYAH NTT <br>
               UNIT PELAKSANA PEMBANGKITAN TIMOR</b></p>
            <p style="font-size: 20px; font-family: Arial; font-weight: bold;">Dengan</p>
            <p style="font-size: 20px; font-family: Arial; margin-top: 40px; margin-bottom: 40px;"><b>{{$surat->nama_perusahaan}} </b></p>
            <p style="font-size: 20px; font-family: Arial; margin-top: 40px; margin-bottom: 40px;"> <b>{{$surat->nilai_pekerjaan}}</b>
            </p>
        </div>




    </main>
</body>

</html>
