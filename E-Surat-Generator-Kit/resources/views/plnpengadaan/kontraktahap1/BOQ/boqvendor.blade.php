@extends('template.app')

@section('title', 'BOQ')

@section('content')

    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"></h1>

        <div class="row">
            <div class="col-12">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Detail Kontrak --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('pengajuankontrak.boq.update', $id) }}" id="myForm">
                            @method('PUT')
                            @csrf
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Uraian</th>
                                        <th>Volume</th>
                                        <th>Satuan</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        
                                        // function int_to_roman($num)
                                        // {
                                        //     // array untuk angka romawi
                                        //     $roman = [
                                        //         'M' => 1000,
                                        //         'CM' => 900,
                                        //         'D' => 500,
                                        //         'CD' => 400,
                                        //         'C' => 100,
                                        //         'XC' => 90,
                                        //         'L' => 50,
                                        //         'XL' => 40,
                                        //         'X' => 10,
                                        //         'IX' => 9,
                                        //         'V' => 5,
                                        //         'IV' => 4,
                                        //         'I' => 1,
                                        //     ];
                                        //     $result = '';
                                        //     // loop melalui array angka romawi
                                        //     foreach ($roman as $key => $value) {
                                        //         // dapatkan banyaknya simbol romawi yang dibutuhkan
                                        //         $numerals = intval($num / $value);
                                        //         // tambahkan simbol romawi ke string hasil
                                        //         $result .= str_repeat($key, $numerals);
                                        //         // kurangi angka asal dengan angka romawi yang telah dihasilkan
                                        //         $num = $num % $value;
                                        //     }
                                        //     return $result;
                                        // }
                                        $jenis = 1;
                                        $semua = 0;
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
                                                <td class="vol">{{ $data['vol'] }}</td>
                                                <td>{{ $data['sat'] }}</td>
                                                <td><input type="text" class="harga_satuan form-control" pattern="[0-9]*"
                                                        oninput="validateInput(this)"
                                                        name="boq[{{ $semua }}][harga_satuan]"
                                                        value="{{ $data['harga_satuan'] }}" />
                                                </td>
                                                <td><input type="text" name="boq[{{ $semua }}][jumlah]"
                                                        class="form-control jumlah" pattern="[0-9]*"
                                                        value="{{ $data['jumlah'] }}" readonly></td>
                                                {{-- <td>{{ $data['harga_satuan'] }}</td>
                                                <td>{{ $data['jumlah'] }}</td> --}}
                                            </tr>
                                            @php
                                                $no_subdata = 1;
                                                $semua++;
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
                                    <tr>
                                        <td colspan="5" style="text-align: right;"><strong>Total Jumlah:</strong>
                                        </td>
                                        <td><input type="text" class="form-control total_harga" name="total_jumlah"
                                                id="total_jumlah" readonly
                                                value="{{ $boq->total_jumlah == null ? 0 : $boq->total_jumlah }}"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align: right;"><strong>Dibulatkan </strong></td>
                                        <td><input type="text" class="form-control" id="pembulatan" name="dibulatkan"
                                                value="{{ $boq->dibulatkan == null ? 0 : $boq->dibulatkan }}" readonly>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="5" style="text-align: right;"><strong>PPN 11%</strong></td>
                                        <td><input type="text" class="form-control" id="ppn11" name="ppn11"
                                                readonly value="{{ $boq->ppn11 }}"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align: right;"><strong>Harga Total</strong></td>
                                        <td><input type="text" class="form-control" id="harga_total" name="harga_total"
                                                readonly value="{{ $boq->total_harga }}"></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="form-group">
                                <a href="{{ route('vendor.kontrakkerja.detail', $id) }}"
                                    class="btn btn-warning">Kembali</a>


                                <button type="button" id="submitBtn" onclick="submitForm()"
                                    class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>



            </div>

        </div>

    </div>
@endsection

@section('javascript')
    <script>
        function submitForm() {
            // Mendapatkan elemen formulir
            var form = document.getElementById("myForm");

            // Submit formulir
            form.submit();
        }
    </script>
    <script>
        // Check apakah input ada string
        function validateInput(input) {
            const value = input.value;
            // non digit
            const validValue = value.replace(/\D/g, ''); // Menghapus karakter non-digit

            if (value !== validValue) {
                input.value = validValue;
            }
            if (value.length > 1 && value[0] === '0') {
                input.value = value.slice(1);
            }
            if (validValue === '') {
                input.value = '0';
            }
        }

        const volume = document.querySelectorAll('.vol');
        const hargaSatuan = document.querySelectorAll('.harga_satuan');
        hargaSatuan.forEach((input) => {
            input.addEventListener('input', function() {

                const angka = parseFloat(input.value.replace(/\./g, '')); // Menghapus semua titik yang ada

                if (!isNaN(angka)) {
                    const formattedAngka = formatAngka(angka); // Memformat angka dengan menambahkan titik
                    input.value = formattedAngka;
                }
            });
        });

        const jumlahInputs = document.querySelectorAll('.jumlah');


        var totalJumlahInputs = document.querySelector('#total_jumlah');
        var dibulatkanInputs = document.querySelector('#pembulatan');
        var rok10Inputs = document.querySelector('#rok10');
        var ppn11Inputs = document.querySelector('#ppn11');
        var hargaTotal = document.querySelector('#harga_total')

        function perubahan() {
            let total_jumlah = 0;
            for (let i = 0; i < hargaSatuan.length; i++) {
                const nilaiVolume = parseFloat(volume[i].innerHTML);
                const nilaiHargaSatuan = parseFloat(hargaSatuan[i].value.replace(/\./g, ''));
                const nilaiJumlah = nilaiHargaSatuan * nilaiVolume;
                console.log("nilai Jumlah" + nilaiJumlah);
                jumlahInputs[i].value = nilaiJumlah.toFixed(0);
                total_jumlah += nilaiJumlah;



            }
            total_jumlah  = parseFloat(total_jumlah);
            dibulatkan = Math.round(total_jumlah);
            ppn11  = (parseFloat(dibulatkan) * 0.11).toFixed(0);
            harga_total  = (parseFloat(dibulatkan) + parseFloat(ppn11)).toFixed(0);

            totalJumlahInputs.value = formatAngka(total_jumlah);
            dibulatkanInputs.value = formatAngka(dibulatkan);
            ppn11Inputs.value = formatAngka(ppn11);
            hargaTotal.value = formatAngka(harga_total);


        }
        hargaSatuan.forEach(input => {

            input.addEventListener('input', perubahan);
        });




        function formatAngka(angka) {
            if (angka === '') {
                return '';
            }

            const numberString = angka.toString();
            const splitArray = numberString.split('');
            let formattedValue = '';

            for (let i = 0; i < splitArray.length; i++) {
                formattedValue += splitArray[i];
                if ((splitArray.length - 1 - i) % 3 === 0 && i !== splitArray.length - 1) {
                    formattedValue += '.';
                }
            }

            return formattedValue;
        }
    </script>


@endsection
