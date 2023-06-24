@extends('template.app')

@section('title', 'Lamp Nego')

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
                        <form method="POST" action="{{ route('lampnego.update', ['id' => $id]) }}" id="myForm">
                            @method('PUT')
                            @csrf
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Uraian</th>
                                        <th rowspan="2">Volume</th>
                                        <th rowspan="2">Satuan</th>
                                        <th colspan="2">PENAWARAN (Rp.)</th>
                                        <th colspan="2">NEGOSIASI (Rp.)</th>
                                    </tr>
                                    <tr>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah</th>
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
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @php
                                            $no_barjas = 0;
                                            $no_data = 0;
                                        @endphp
                                        @foreach ($jenis_kontrak['data'] as $data)
                                            <tr style="text-align:left;">
                                                <td>{{ $no_barjas }}</td>
                                                <td style="text-align: left">{{ $data['uraian'] }} </td>
                                                <td class="vol">{{ $data['vol'] }}</td>
                                                <td>{{ $data['sat'] }}</td>
                                                <td>{{ $data['harga_satuan_penawaran'] }}
                                                </td>
                                                <td>{{ $data['jumlah_penawaran'] }}</td>

                                                <td><input type="text" class="harga_satuan form-control" pattern="[0-9]*"
                                                        oninput="validateInput(this)"
                                                        name="negosiasi[{{ $no_barjas }}][harga_satuan]"
                                                        value="{{ $data['harga_satuan_negosiasi'] }}" />
                                                </td>
                                                <td><input type="text" name="negosiasi[{{ $no_barjas }}][jumlah]"
                                                        class="form-control jumlah" pattern="[0-9]*" value="{{ $data['harga_satuan_negosiasi'] }}"
                                                        readonly></td>
                                                {{-- <td>{{ $data['harga_satuan'] }}</td>
                                                <td>{{ $data['jumlah'] }}</td> --}}
                                            </tr>
                                            

                                            @foreach ($data['sub_data'] as $subdata)
                                                <tr>
                                                    <td></td>
                                                    <td style="text-align:left;">{{ $subdata['uraian'] }} </td>
                                                    <td>{{ $subdata['volume'] }}</td>
                                                    <td>{{ $subdata['satuan'] }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    {{-- <td>{{ $subdata['harga_satuan'] }}</td>
                                                    <td>{{ $subdata['jumlah'] }}</td> --}}
                                                </tr>
                                            @endforeach
                                            @php
                                                $no_barjas++;
                                                
                                            @endphp
                                        @endforeach
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" style="text-align: right;"><strong>Total Jumlah:</strong>
                                        </td>
                                        <td>{{ $boq->total_jumlah == null ? 0 : $boq->total_jumlah }}</td>
                                        <td style="text-align: right;"><strong>Total Jumlah:</strong>
                                        </td>
                                        <td><input type="text" class="form-control total_harga"
                                                name="total_jumlah_negosiasi" id="total_jumlah" readonly
                                                value="{{ $lampnego->total_jumlah == null ? 0 : $lampnego->total_jumlah }}"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align: right;"><strong>Dibulatkan </strong></td>
                                        <td>{{ $boq->dibulatkan == null ? 0 : $boq->dibulatkan }}
                                        </td>
                                        <td style="text-align: right;"><strong>Dibulatkan </strong></td>
                                        <td><input type="text" class="form-control" id="pembulatan"
                                                name="dibulatkan_negosiasi"
                                                value="{{ $lampnego->dibulatkan == null ? 0 : $lampnego->dibulatkan }}" readonly>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="5" style="text-align: right;"><strong>PPN 11%</strong></td>
                                        <td>{{ $boq->ppn11 }}</td>
                                        <td style="text-align: right;"><strong>PPN 11%</strong></td>
                                        <td><input type="text" class="form-control" id="ppn11" name="ppn11_negosiasi"
                                                readonly value="{{ $lampnego->ppn11 }}"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align: right;"><strong>Harga Total</strong></td>
                                        <td>{{ $boq->total_harga }}</td>
                                        <td style="text-align: right;"><strong>Harga Total</strong></td>
                                        <td><input type="text" class="form-control" id="harga_total"
                                                name="harga_total_negosiasi" readonly value="{{ $lampnego->total_harga }}"></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="form-group">
                                <a href="{{ route('negoharga.detail', ['id' => $id]) }}"
                                    class="btn btn-primary">Kembali</a>


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

        var ppn11Inputs = document.querySelector('#ppn11');
        var hargaTotal = document.querySelector('#harga_total')

        function perubahan() {
            let total_jumlah = 0;
            for (let i = 0; i < hargaSatuan.length; i++) {
                const nilaiVolume = parseFloat(volume[i].innerHTML);
                const nilaiHargaSatuan = parseFloat(hargaSatuan[i].value.replace(/\./g, ''));
                const nilaiJumlah = nilaiHargaSatuan * nilaiVolume;
                jumlahInputs[i].value = formatAngka(nilaiJumlah.toFixed(0));
                total_jumlah += nilaiJumlah;



            }
            // totalJumlahInputs.value = parseFloat(total_jumlah);
            // dibulatkanInputs.value = Math.round(totalJumlahInputs.value);
     
            // ppn11Inputs.value = (parseFloat(dibulatkanInputs.value)  * 0.11).toFixed(2);
            // hargaTotal.value = (parseFloat(dibulatkanInputs.value)  + parseFloat(ppn11Inputs
            //     .value)).toFixed(2);

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
