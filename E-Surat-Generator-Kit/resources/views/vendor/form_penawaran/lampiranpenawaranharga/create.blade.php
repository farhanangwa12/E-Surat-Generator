@extends('template.app')

@section('title', 'ISI RKS')

@section('content')


    <link href="{{ asset('library/cropper/cropper.min.css') }}" rel="stylesheet">
    <script src="{{ asset('library/cropper/cropper.min.js') }}"></script>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            outline: 0;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-dialog {
            position: relative;
            margin: auto;
            top: 10%;
            width: 50%;
            max-width: 700px;
            /* Atur ukuran maksimum jika diperlukan */
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 0.3rem;
            outline: 0;
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            border-bottom: 1px solid #dee2e6;
            border-top-left-radius: 0.3rem;
            border-top-right-radius: 0.3rem;
        }

        .modal-title {
            margin-bottom: 0;
            line-height: 1.5;
            font-size: 1.25rem;
            font-weight: 500;
        }

        .modal-body {
            position: relative;
            padding: 1rem;
        }

        .modal-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 1rem;
            border-top: 1px solid #dee2e6;
            border-bottom-right-radius: 0.3rem;
            border-bottom-left-radius: 0.3rem;
        }

        .btn {
            margin-right: 0.5rem;
        }
    </style>
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
                        <form id="myForm" action="{{ route('vendor.lampiranpenawaranharga.update', ['id' => $id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <label for="kopsurat">Masukkan gambar kopsurat
                                dengan ketentuan panjang 120px
                            </label>
                            <input type="file" name="kopsurat" class="form-control" placeholder="Kopsurat"
                                accept=".jpg, .jpeg, .png">
                            <input type="hidden" name="hasilkopsurat" class="hasilcrop">





                            <div class="modal" id="exampleModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Modal title</h1>
                                            <button type="button" id="modalClose" class="btn-close"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="img-container">
                                                <img class="previewImages" alt="Mantap" style="max-height: 500px;">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" id="modalCancel"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary" id="cropButton">Crop</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                        $semua = 1;
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
                                                <td class="vol">{{ $data['vol'] }}</td>
                                                <td>{{ $data['sat'] }}</td>
                                                <td><input type="text" class="harga_satuan form-control" pattern="[0-9]*"
                                                        oninput="validateInput(this)"
                                                        name="lampiran[{{ $semua }}][harga_satuan]"
                                                        value="{{ $data['harga_satuan'] }}" />
                                                </td>
                                                <td><input type="text" name="lampiran[{{ $semua }}][jumlah]"
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
                                        <td><input type="number" class="form-control total_harga" name="total_jumlah"
                                                id="total_jumlah" readonly
                                                value="{{ $lampiranPenawaran->total_jumlah == null ? 0 : $lampiranPenawaran->total_jumlah }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align: right;"><strong>Dibulatkan </strong></td>
                                        <td><input type="number" class="form-control" id="pembulatan" name="dibulatkan"
                                                value="{{ $lampiranPenawaran->dibulatkan == null ? 0 : $lampiranPenawaran->dibulatkan }}"
                                                readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align: right;"><strong>PPN 11%</strong></td>
                                        <td><input type="number" class="form-control" id="ppn11" name="ppn11"
                                                readonly value="{{ $lampiranPenawaran->ppn11 }}"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align: right;"><strong>Harga Total</strong></td>
                                        <td><input type="number" class="form-control" id="harga_total" name="harga_total"
                                                readonly value="{{ $lampiranPenawaran->total_harga }}"></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="kota_surat" class="form-label">Kota Surat</label>
                                        <input type="text" name="kota_surat" class="form-control" id="kota_surat" value="{{ $lampiranPenawaran->kota_surat }}" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_surat" class="form-label">Tanggal Surat</label>

                                        <input type="date"  name="tanggal_surat" class="form-control" id="tanggal_surat" value="{{ $lampiranPenawaran->tanggal_surat}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="{{ route('pengajuankontrak.detail', ['id' => $id]) }}"
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
        const inputFile = document.querySelector('input[name="kopsurat"]');
        const hiddenInput = document.querySelector('.hasilcrop');
        const previewImage = document.querySelector('.previewImages');
        const modal = document.getElementById('exampleModal');

        const closeModalButton = document.getElementById('modalClose');
        const cropButton = document.querySelector('#cropButton');

        var cropper;

        // Event listener untuk input file
        inputFile.addEventListener('change', function(event) {
            const file = event.target.files[0];

            // Membaca file menggunakan FileReader
            const reader = new FileReader();
            reader.onload = function(e) {
                // Menampilkan gambar pada preview
                previewImage.src = e.target.result;

                // Menampilkan modal
                modal.style.display = 'block';


                // Menginisialisasi Cropper pada gambar
                cropper = new Cropper(previewImage, {
                    autoCropArea: 1,
                    aspectRatio: 3 / 1,


                    viewMode: 3,

                });

            };
            reader.readAsDataURL(file);

        });

        closeModalButton.addEventListener('click', function() {
            modal.style.display = 'none';
            modalOverlay.style.display = 'none';
            // Mengosongkan input file dan preview gambar
            inputFile.value = '';
            previewImage.src = '';
            // Mereset Cropper
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        });

        // Event listener untuk tombol Crop pada modal
        cropButton.addEventListener('click', function() {

            // Mendapatkan gambar crop dalam bentuk data URL
            const croppedCanvas = cropper.getCroppedCanvas();
            const croppedDataURL = croppedCanvas.toDataURL();

            // Menyimpan data URL ke input hidden
            hiddenInput.value = croppedDataURL;

            // Menutup modal
            modal.style.display = 'none';
        });
    </script>
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
                jumlahInputs[i].value = nilaiJumlah.toFixed(0);
                total_jumlah += nilaiJumlah;



            }
            totalJumlahInputs.value = parseFloat(total_jumlah);
            dibulatkanInputs.value = Math.round(totalJumlahInputs.value);

            ppn11Inputs.value = ((parseFloat(dibulatkanInputs.value)) * 0.11).toFixed(2);
            hargaTotal.value = (parseFloat(dibulatkanInputs.value) + parseFloat(ppn11Inputs
                .value)).toFixed(2);


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
