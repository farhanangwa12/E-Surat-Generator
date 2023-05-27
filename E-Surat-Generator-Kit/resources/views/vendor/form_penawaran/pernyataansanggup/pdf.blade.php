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

        /* Additional Styles for Laravel-DomPDF */
        @page {
            margin: 40px 40px;
            /* Adjust the margins as needed */
        }
    </style>
</head>

<body>
    <div class="header" style="background: grey;">
        {{-- <img src="{{ $kopsurat }}" alt="Kop Surat" style="object-fit: cover;" class="company-logo" width="200px"> --}}
        Kop Surat
    </div>
    <main>
        <h4 style="font-family: Arial; font-size: 16px; font-weight: bold; text-align:center;">SURAT PERNYATAAN</h4>
        <h5 style="font-family: Arial; font-size: 14px; font-weight: bold; text-align:center;">(KESANGGUPAN
            MELAKSANAKAN PEKERJAAN) </h5>
        <div class="isi" style="margin-top: 5px; margin-left: 50px;">

            <br>
            <p>Yang bertanda tangan dibawah ini:</p>
            <table style="width: 90%;">
                <tr>
                    <td style="width: 25%;">Nama</td>
                    <td style="width: 5%;">:</td>
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
                    <td>Alamat</td>
                    <td>:</td>
                    <td style="border-bottom: 2px dotted black;">{{ $alamat_perusahaan }}</td>
                </tr>
                <tr>
                    <td>No. Telepon/Fax</td>
                    <td>:</td>
                    <td style="border-bottom: 2px dotted black;">{{ $telepon_fax }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td style="border-bottom: 2px dotted black;">{{ $email_perusahaan }}</td>
                </tr>
            </table>

            <br>
            <p>Menyatakan dengan sebenarnya bahwa setelah mengetahui pengadaan yang akan dilaksanakan oleh PT PLN
                (Persero) UIW Nusa Tenggara Timur UPK Timor Tahun Anggaran 2022, maka dengan ini saya menyatakan bahwa
                Perusahaan kami berminat dan sanggup untuk melaksanakan pekerjaan : </p>

            <h5 style="font-family: Arial; font-size: 12px; font-weight: bold; text-align: center;">PEKERJAAN PENGADAAN
                {{ $nama_pekerjaan }}

            </h5>
            <div class="clearfix">
                <p style="float: left;">Sesuai RKS No.: <b>{{ $nomor_rks }}</b></p>

                <p style="float: right;">Tanggal: <b>{{ $tanggal_rks }}</b></p>
            </div>




            <p>Demikian Surat Pernyataan ini dibuat dengan sesungguhnya, untuk dapat dipergunakan sebagaimana
                semestinya.</p>
            <br>

            <br>
            <div style="float: right; text-align: right;">

            </div>
        </div>
        <div class="tandatangan" style="margin-top: 30px;">
            <p>{{ $kota_surat }}, {{ $tanggal_surat }} 2022</p>
            <p>PT./CV {{ $nama_perusahaan }}</p>
            <br>
            <p style="font-family: Arial;">Materai Rp. 10.000,-</p>
            <br>
            <p style="font-family: Arial;">Tanda Tangan</p>
            <p style="font-family: Arial;">Dan Cap Perusahaan</p>

            <p>({{ $nama }})</p>
            <p>{{ $jabatan }}</p>
        </div>

    </main>
</body>

</html>
