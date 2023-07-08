<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pernyataan Garansi</title>
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
    <div class="header">
        <img src="{{ $kopsurat }}" alt="Kop Surat" style="object-fit: cover;" class="company-logo" width="200px">

    </div>
    <main>
        <h4 style="font-family: Arial; font-size: 16px; font-weight: bold; text-align:center;">SURAT PERNYATAAN</h4>
        <h5 style="font-family: Arial; font-size: 14px; font-weight: bold; text-align:center;">(JAMINAN GARANSI)</h5>
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
                    <td style="width: 30%;">Bertindak untuk dan atas nama</td>
                    <td>:</td>
                    <td style="border-bottom: 2px dotted black;">{{ $nama_perusahaan }}</td>
                </tr>
                {{-- <tr>
                    <td></td>
                    <td>:</td>
                    <td style="border-bottom: 2px dotted black;">{{ $atas_nama }}</td>
                </tr> --}}
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
            <p>Menyatakan dengan sebenarnya bahwa setelah mengetahui pengadaan yang akan dilaksanakan oleh Tahun
                Anggaran 2022, maka dengan ini saya menyatakan bahwa Perusahaan kami berminat dan sanggup
                memberikan Jaminan Garansi Barang/Pekerjaan untuk pekerjaan:</p>

            <h5 style="font-family: Arial; font-size: 14px; font-weight: bold; text-align: center;">PEKERJAAN PENGADAAN
                {{ $nama_pekerjaan }}

            </h5>
            <div class="clearfix">
                <p style="float: left;">Sesuai RKS No.: <b>{{ $no_rks }}</b></p>
                <p style="float: right;">Tanggal: <b>{{ $tanggal_rks }}</b></p>
            </div>



            <p>Apabila dalam pelaksanaan pekerjaan kualitas dan hasil kinerja/performance tidak sesuai dengan
                yang dipersyaratkan, maka kami siap memperbaiki/meningkatkan performance tersebut.</p>
            <p>Segala biaya yang diperlukan untuk memperbaiki/meningkatkan performance tersebut adalah menjadi
                beban dan tanggung jawab kami.</p>
            <br>
            <p>Demikian Surat Pernyataan Jaminan Kualitas ini kami buat dengan penuh rasa tanggung jawab.</p>
            <br>

        </div>
        <div class="tandatangan" style="margin-top: 30px;height:20%;">
            <div style="float: right; text-align: center;">
                <p>{{ $kota_surat }}, {{ $tanggal_surat }}</p>
                <p> {{ $nama_perusahaan_terang }}</p>
                <p>{{ $jabatan }}</p>
                <br>
                <div class="" style="border: 1px solid black; height:110px;">
                    <p style="font-family: Arial;">Materai Rp. 10.000,-</p>
                    <p style="font-family: Arial;">Tanda Tangan</p>
                    <p style="font-family: Arial;">Dan Cap Perusahaan</p>
                </div>


                <p>(<b>{{ strtoupper($nama); }}</b>)</p>

            </div>
        </div>

    </main>
</body>

</html>
