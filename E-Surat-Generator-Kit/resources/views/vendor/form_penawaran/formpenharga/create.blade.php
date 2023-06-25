@extends('template.app')

@section('title', 'Ubah Form Penawaran Harga')

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
    <div class="card w-100">
        <div class="card-header">
            <h5 class="card-title">Form Penawaran Harga</h5>
        </div>


        <form action="{{ route('vendor.formpenawaranharga.store', $isi->kontrakkerja->id_kontrakkerja) }}" method="post"
            enctype="multipart/form-data">

            @csrf
            <div class="card-body">
                <div class="header mb-3">
                    <div class="form-group">
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
                                        <h1 class="modal-title fs-5">Crop Gambar</h1>
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





                    </div>



                </div>
                <main>
                    <div class="kop clearfix">
                        <div style="float: left; width: 45%;">
                            <div class="form-group mb-3">
                                <label for="nomor">Nomor:</label>
                                <input type="text" name="nomor" class="form-control" placeholder="Masukkan nomor surat"
                                    value="{{ $data['nomor'] }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="lampiran">Lampiran:</label>
                                <input type="text" name="lampiran" placeholder="Masukkan banyak lampiran" class="form-control"
                                    value="{{ $data['lampiran'] }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="perihal">Perihal:</label>
                                <input type="text" name="perihal" class="form-control" value="Penawaran Harga" disabled>
                            </div>
                        </div>
                        <div style="float: right; width: 45%; text-align: left;">
                            <div class="form-group mb-3">
                                <label for="nama_kota">Nama tempat Surat:</label>
                                <input type="text" name="nama_kota" placeholder="Cont : Surabaya" class="form-control"
                                    value="{{ $data['nama_kota'] }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="tanggal_pembuatan_surat">Tanggal Surat:</label>
                                <input type="date" name="tanggal_pembuatan_surat" class="form-control" placeholder="Tanggal surat surat"
                                    value="{{ $data['tanggal_pembuatan_surat'] }}">
                            </div>
                        </div>
                    </div>
                    
                  
                    <div>
                        <a href="{{ route('vendor.kontrakkerja.detail', $isi->kontrakkerja->id_kontrakkerja) }}"
                            class="btn btn-warning">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>

                    </div>


                </main>
            </div>
        </form>

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
        // Mengambil semua elemen dengan kelas 'number'
        const numberInputs = document.getElementsByClassName('number');

        // Iterasi melalui setiap elemen input dengan kelas 'number'
        for (let i = 0; i < numberInputs.length; i++) {
            const input = numberInputs[i];

            // Membatasi input hanya menerima angka
            input.addEventListener('input', function(event) {
                const inputValue = event.target.value;

                // Menghapus karakter selain angka
                const numericValue = inputValue.replace(/[^0-9]/g, '');

                // Mengubah angka menjadi format ribuan dengan titik setiap tiga digit
                const formattedValue = formatNumber(numericValue);

                // Mengupdate nilai input dengan format angka
                event.target.value = formattedValue;
            });
        }

        // Fungsi untuk memformat angka dengan titik setiap tiga digit
        function formatNumber(number) {
            return number.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>
@endsection
