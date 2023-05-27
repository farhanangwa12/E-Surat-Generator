<!DOCTYPE html>
<html>

<head>
    <title>Halaman Tampilan View</title>
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


        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        main .kop {
            text-align: center;
            margin-bottom: 20px;
        }

        main .kop h1 {
            font-size: 12px;
            font-weight: bold;
            margin: 0;
        }

        main .kop h2 {
            font-size: 10px;
            font-weight: bold;
            margin: 0;
        }
        main table {
            width: 100%;
            border: 1px solid black; 
            
            /* Mengatur batas (border) hitam pada tabel */
            border-collapse: collapse;
        }

        main th {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        main td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }
        main .tandatangan {
            float: right;
            text-align: center;
            margin-top: 20px;
        }

        main .tandatangan div {
            margin-bottom: 10px;
        }

        main .nama-jabatan {
            font-size: 10px;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="header">
        {{-- <img src="{{ $kopsurat }}" alt="Kop Surat" style="object-fit: cover;" class="company-logo" width="200px"> --}}
        Header
    </div>

    <main>
        <div class="kop">
            <h1>DATA PENGALAMAN PERUSAHAAN </h1>
            <h2>SESUAI DENGAN BIDANG/SUB BIDANGNYA</h2>
        </div>
        <table>
            <thead>

                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Bidang Pekerjaan</th>
                    <th rowspan="2">Sub Bidang Pekerjaan</th>
                    <th rowspan="2">Lokasi</th>
                    <th colspan="2">Pemberi Tugas/Penanggung Jawab
                    </th>
                    <th colspan="1">Kontrak
                    </th>

                    <th colspan="3">Tanggal Selesai Menurut
                    </th>

                </tr>
                <tr>

                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Tanggal</th>
                    <th>Nilai</th>
                    <th>Nilai Kontrak</th>
                    <th>BA Serah Terima</th>
                </tr>


            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td>
                    <td>7</td>
                    <td>8</td>
                    <td>9</td>
                    <td>10</td>

                </tr>
                <tr>
                    <td>1</td>
                    <td>Bidang 1</td>
                    <td>Sub Bidang 1</td>
                    <td>Lokasi 1</td>
                    <td>Nama Pemberi Tugas 1</td>
                    <td>Alamat Pemberi Tugas 1</td>
                    <td>No Tanggal Kontrak 1</td>
                    <td>Nilai 1</td>
                    <td>Nilai Kontrak 1</td>
                    <td>BA Serah Terima 1</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Bidang 2</td>
                    <td>Sub Bidang 2</td>
                    <td>Lokasi 2</td>
                    <td>Nama Pemberi Tugas 2</td>
                    <td>Alamat Pemberi Tugas 2</td>
                    <td>No Tanggal Kontrak 2</td>
                    <td>Nilai 2</td>
                    <td>Nilai Kontrak 2</td>
                    <td>BA Serah Terima 2</td>
                </tr>
            </tbody>
        </table>

        <div class="tandatangan">
            <div>............... (Tanggal), .................. 2022</div>
            <div>PT/CV/Firma ..............................</div>
            <div class="kotak" style="height: 50px; margin: 10px 0;border: 1px solid black;">
                
            </div>
            <div 
            class="nama-jabatan">Nama Jelas</div>
            <div class="nama-jabatan">Jabatan</div>
        </div>
    </main>

</body>

</html>
