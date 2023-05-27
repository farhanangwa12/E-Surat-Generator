@extends('template.app')

@section('title', 'Ubah Form Penawaran Harga')

@section('content')
    <style>
        /* CSS styling here */
    </style>
    <div class="card w-100">
        <div class="card-header">
            <h5 class="card-title">Create Form Penawaran Harga</h5>
        </div>
        <form action="{{ route('vendor.formpenawaranharga.store', $formPenawaranHarga->id_kontrakkerja) }}" method="post"
            enctype="multipart/form-data">

            @csrf
            <div class="card-body">
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
                        <div class="nama-jabatan">Nama Jelas</div>
                        <div class="nama-jabatan">Jabatan</div>
                    </div>
                </main>
            </div>
        </form>

    </div>

@endsection

@section('javascript')
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
