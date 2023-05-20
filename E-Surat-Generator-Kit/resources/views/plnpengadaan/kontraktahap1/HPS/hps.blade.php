<!DOCTYPE html>
<html>

<head>
    <title>HPS</title>
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


        body {
            font-family: Times New Roman;
            font-size: 12px;
            margin: 0;
            padding: 0;
            text-align: center;
            margin-top: 135px;
        }


        h1 {
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
        }

        main table {
            border-collapse: collapse;
            margin: 20px auto;
            width: 100%;
        }

        main table tr.blue {
            background-color: #bdffff;
        }

        main table tr.orange {
            background-color: #ffffcc;
        }

        main table tr.abuabu {
            background-color: #cccccc;
        }

        main th,
        main td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
        }

        .square {
            width: 40px;
            height: 40px;
            background-color: black;
            margin-left: auto;
            margin-right: auto;
        }

        .bold {
            font-weight: bold;
        }

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }

        table.tandatangan {
            border-collapse: collapse;

        }

        table.tandatangan td,
        table.tandatangan th {
            border: none;
        }
    </style>
</head>

<body>

    <header>
        <table class="header-table" style="width:100%; max-width:100%; table-layout:auto;">
            <tr>

                <td><img src="{{ $data2['logokiri'] }}" style="vertical-align: top;" alt="Logo Kiri" width="480px"></td>
                <td><img src="{{ $data2['logo'] }}" style="margin-left:20%;" alt="Logo PLN" height="40px"></td>

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
        <h1>LAMPIRAN REKAP HARGA PERKIRAAN SENDIRI (HPS)
        </h1>
        <p>{{ $data2['nomor'] }}
        </p>
       
        <p>{{ $data2['tanggal_pekerjaan'] }}

        </p>
        <p><b>{{ $data2['nama_pekerjaan'] }} </b></p>
        <table>
            <thead>
                <tr class="blue">
                    <th rowspan="2">No</th>
                    <th rowspan="2">Uraian</th>
                    <th rowspan="2">Vol</th>
                    <th rowspan="2">Sat</th>
                    <th colspan="2">HPS (Rp.)</th>

                </tr>
                <tr class="orange">
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                </tr>
                <tr class="abuabu">
                    <th>1</th>
                    <th>2</th>
                    <th>3.00</th>
                    <th>4</th>
                    <th>5</th>

                    <th>6</th>
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
                            {{-- <td>{{ $data['harga_satuan'] }}</td>
                            <td>{{ $data['jumlah'] }}</td> --}}
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
                                {{-- <td>{{ $subdata['harga_satuan'] }}</td>
                                <td>{{ $subdata['jumlah'] }}</td> --}}
                            </tr>
                        @endforeach
                    @endforeach
                @endforeach

            </tbody>
            <tfoot>
                <tr style="border-top: 4px solid black;">
                    <td colspan="5" class="footer">Jumlah Harga:</td>
                    <td>{{ $data2['jumlah_harga'] }}</td>

                    {{-- Buggg --}}
                </tr>
                <tr>
                    <td colspan="5" class="footer">DIBULATKAN</td>
                    <td>{{ $data2['dibulatkan'] }}</td>
                </tr>
                <tr>
                    <td colspan="5" class="footer">ROK 10%:</td>
                    <td>{{ $data2['rok_10'] }}</td>
                </tr>
                <tr>
                    <td colspan="5" class="footer">PPN 11%:</td>
                    <td>{{ $data2['ppn_11'] }}</td>
                </tr>
                <tr>
                    <td colspan="5" class="footer">Total Harga:</td>
                    <td>{{ $data2['harga_total'] }}</td>
                </tr>
            </tfoot>
        </table>
         {{-- <p style="text-align: left;margin-top:20px; margin-bottom:20px;">Terbilang:
            <i>{{$data2['harga_total']}}</i></p> --}}
         
        <p style="text-align: left;margin-top:20px; margin-bottom:20px;">Terbilang:
            <i>{{ ucwords(@Terbilang::make($data2['harga_total'])) }}</i></p>
    </main>
    <table style="width: 100%; text-align:center;">
        <tr>
            <td>DISAHKAN OLEH, <br>
                PENGGUNA BARANG/JASA <br>
                PT PLN (PERSERO) UPK TIMOR <br>
                MANAGER <br>






            </td>
            <td>
                DISUSUN OLEH, <br>
                PELAKSANA PENGADAAN BARANG/JASA <br>
                PT PLN (PERSERO) UPK TIMOR <br>
                PEJABAT PELAKSANA PENGADAAN
            </td>
        </tr>
        <tr>
            <td style="height:40px;">@if ($data2['tandatangan_pengadaan'] != 0)
                <img src="data:image/png;base64,{{ @DNS2D::getBarcodePNG( $data2['tandatangan_pengadaan'], 'QRCODE')}}" alt="Barcode">
            @endif
            </td>
            <td style="height:40px;">
           
                @if ($data2['tandatangan_manager'] != 0)
                <img src="data:image/png;base64,{{ @DNS2D::getBarcodePNG( $data2['tandatangan_manager'], 'QRCODE')}}" alt="Barcode">
            @endif</td>
        </tr>
        <tr>
            <td style="width: 50%;"><b> {{ $data2['nama_manager'] }} </b></td>
            <td style="width: 50%;"><b>{{ $data2['pengadaan'] }}</b></td>
        </tr>
    </table>

</body>

</html>
