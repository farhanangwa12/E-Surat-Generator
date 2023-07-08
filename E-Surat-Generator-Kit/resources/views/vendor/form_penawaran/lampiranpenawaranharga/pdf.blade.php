<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lampiran Penawaran harga</title>
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
            height: 200px;
            margin-bottom: 10px;

        }


        body {
            margin-top: 210px;
            font-family: Times New Roman;
            font-size: 12px;
       
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
    <div class="header">
        {{-- <img src="{{ $data2['kopsurat'] }}" alt="Kop Surat" class="company-logo" height="500px"> --}}
        <img src="{{ $data2['kopsurat'] }}" alt="Kop Surat" class="company-logo" height="500px">

    </div>
    <main>
        <header>
            <h1><u><b>LAMPIRAN RINCIAN HARGA PENAWARAN</b>
                </u>
            </h1>
            <p><b>{{ $data2['nama_pekerjaan'] }} PT PLN (PERSERO) UNIT INDUK
                WILAYAH NTT UNIT PELAKSANA PEMBANGKITAN TIMOR</b> </p>

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
                <tr>
                    <th>Harga Satuan (Rp.)</th>
                    <th>Jumlah (Rp.)</th>
                </tr>
                <tr>
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
                    <td colspan="5" class="footer">Dibulatkan:</td>
                    <td>{{ $data2['dibulatkan'] }}</td>
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


        <p>Terbilang: <i>{{ $data2['terbilang'] }}</i></p>
    </main>
    <style>
        .signature-box {
            margin: auto auto;
            width: 70%;


            border: 1px solid #000;

            text-align: center;
            padding: 5px;
        }

        .signature {
            font-size: 12px;
            margin-bottom: 10px;
        }

        .stamp {
            font-size: 12px;

        }
    </style>
    <table class="tandatangan" style="width: 100%;">
        <tr>
            <td style="width:70%;"></td>
            <td style="text-align: center;">
                <p>{{ $data2['kota_surat'] . ' , ' . $data2['tanggal_surat'] }}</p>
                <p>{{ $data2['penyedia'] }}</p>
            </td>
        </tr>
        <tr>
            <td></td>

            <td style="text-align: center;">
                <div></div>
                <div class="signature-box">
                    <div class="signature">Tanda Tangan</div>
                    <div class="stamp">Cap Perusahaan</div>
                </div>

                <p class="bold">{{ $data2['nama_direktur'] }}</p>
            </td>
        </tr>
    </table>
</body>

</html>
