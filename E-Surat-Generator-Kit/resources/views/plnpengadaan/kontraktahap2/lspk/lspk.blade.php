<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LSPK</title>
    <style>
        /* margin untuk konten utama */
        body {
            /* margin-top: 120px; */
            margin-bottom: 20px;
            font-family: "Times New Roman", sans-serif;

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
        main .pekerjaan h1 {
            text-align: center;
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

        .content h2 {
            margin-top: 30px;
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <main>
        <div class="judul">
            <h1>LAMPIRAN SURAT PERINTAH KERJA</h1>
            <p style="margin-right: 2px;">Nomor Pihak Pertama : {{ $nomor_pihak_pertama }} <br>
                Nomor Pihak Kedua : {{ $nomor_pihak_kedua }}<br>
                Tanggal : {{ $tanggal_spk }}
            </p>
            <div class="pekerjaan">
                <h1><b>{{$nama_pekerjaan}}</b></h1>

            </div>

        </div>

        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Uraian</th>
                        <th>Vol</th>
                        <th>Sat</th>
                        <th>Harga Satuan (Rp)</th>
                        <th>Jumlah (Rp)</th>
                    </tr>
                </thead>



                <tbody>
                    @php
                        
                        function int_to_roman($num)
                        {
                            // array untuk angka romawi
                            $roman = [
                                'M' => 1000,
                                'CM' => 900,
                                'D' => 500,
                                'CD' => 400,
                                'C' => 100,
                                'XC' => 90,
                                'L' => 50,
                                'XL' => 40,
                                'X' => 10,
                                'IX' => 9,
                                'V' => 5,
                                'IV' => 4,
                                'I' => 1,
                            ];
                            $result = '';
                            // loop melalui array angka romawi
                            foreach ($roman as $key => $value) {
                                // dapatkan banyaknya simbol romawi yang dibutuhkan
                                $numerals = intval($num / $value);
                                // tambahkan simbol romawi ke string hasil
                                $result .= str_repeat($key, $numerals);
                                // kurangi angka asal dengan angka romawi yang telah dihasilkan
                                $num = $num % $value;
                            }
                            return $result;
                        }
                        $jenis = 1;
                    @endphp

                    @foreach ($kontrakbaru as $jenis_kontrak)
                        <tr style="text-align:left;">
                            <td>{{ int_to_roman($jenis++) . '.' }}</td>
                            <td><b>{{ $jenis_kontrak['jenis_kontrak'] }}</b> </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @php
                            $no_data = 1;
                        @endphp
                        @foreach ($jenis_kontrak['data'] as $data)
                            <tr style="text-align:left;">
                                <td>{{ $no_data++ . '.' }}</td>
                                <td style="text-align: left">{{ $data['uraian'] }} </td>
                                <td>{{ $data['vol'] }}</td>
                                <td>{{ $data['sat'] }}</td>
                                <td>{{ $data['harga_satuan'] }} </td>
                                <td>{{ $data['jumlah'] }}</td>
                               
                            </tr>
                            @php
                                $no_subdata = 1;
                                
                            @endphp
                            @foreach ($data['sub_data'] as $subdata)
                                <tr>
                                    <td></td>
                                    <td style="text-align:left;">{{ $subdata['uraian'] }} </td>
                                    <td>{{ $subdata['volume'] }}</td>
                                    <td>{{ $subdata['satuan'] }}</td>
                                    <td></td>
                                    <td></td>
                                   
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach

                </tbody>

                <tfoot>
                    <tr style="font-weight: bold;">
                        <td colspan="5" style="text-align: right;">JUMLAH HARGA</td>

                        <td>{{ $jumlah_harga }}</td>

                    </tr>
                    <tr style="font-weight: bold;">
                        <td colspan="5" style="text-align: right;">Pembulatan</td>

                        <td>{{ $pembulatan }}</td>

                    </tr>
                    <tr style="font-weight: bold;">
                        <td colspan="5" style="text-align: right;">PPN 11%</td>

                        <td>{{ $ppn11 }}</td>


                    </tr>
                    <tr style="font-weight: bold;">
                        <td colspan="5"style="text-align: right;">Harga Total</td>

                        <td>{{ $total_harga }}</td>

                    </tr>
                </tfoot>

            </table>

            <h2><i>Terbilang : Duaratus Enampuluh Dua Juta Seratus Limapuluh Sembilan Ribu Enamratus Delapanpuluh
                    Sembilan
                    Rupiah</i></h2>


        </div>

        <table style="width: 100%; text-align:center;">
            <tr>
                <td style="width:50%;">PIHAK KEDUA <br>
                    PT. MULTI INAR BANGUNAN <br>
                    DIREKTUR</td>
                <td style="width: 50%;">PIHAK PERTAMA <br>
                    PT. PLN (PERSERO) UIW NUSA TENGGARA TIMUR <br>
                    UNIT PELAKSANA PEMBANGKITAN TIMOR <br>
                    MANAGER
                </td>
            </tr>
            <tr style="height: 80px;">
                <td>Tanda Tangan Direktur</td>
                <td>Tanda Tangan Manager
                </td>
            </tr>
            <tr>
                <td><b>BUDI SUSANTI</b></td>
                <td><b>SELAMET DUNIA AKHIRAT</b>
                </td>
            </tr>
        </table>

    </main>
</body>

</html>
