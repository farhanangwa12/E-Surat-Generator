<!DOCTYPE html>
<html>

<head>
    <title>BOQ</title>
    <style>
        body {
            font-family: Times New Roman;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
        }

        h1 {
            font-size: 16px;
            font-weight: bold;
            text-decoration: underline;
        }

        table {
            border-collapse: collapse;
            margin: 20px auto;
            width: 100%;
        }

        table tr.blue {
            background-color: #bdffff;
        }

        table tr.orange {
            background-color: #ffffcc;
        }

        table tr.abuabu {
            background-color: #cccccc;
        }

        th,
        td {
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
    <main>
        <header>
            <h1>BILL OF QUANTITY (BOQ)
            </h1>
            <p>{{$data2['nomor']}}
            </p>
            <p>Tanggal : {{$data2['tanggal_pekerjaan']}}
            </p>
            <p>{{ $data2['nama_pekerjaan']}} </p>
        </header>
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
                        <td>{{ @Terbilang::roman($jenis++) . '.' }}</td>
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
     

        <p>Terbilang:  <i>{{ ucwords(@Terbilang::make($data2['harga_total'])) }}</i></p>
    </main>
    <table class="tandatangan" style="width: 100%;">
        <tr>
            <td style="width:80%;"></td>
            <td style="text-align: center;">
                <p>?? {{$data2['tanggal_pekerjaan']}}</p>
                <p>{{$data2['penyedia']}}</p>
            </td>
        </tr>
        <tr>
            <td></td>
         
            <td style="text-align: center;">
                <div></div>
                {{-- <div class="square"></div> --}}
                <p class="bold">{{ $data2['nama_direktur'] }}</p>
            </td>
        </tr>
    </table>

</body>

</html>
