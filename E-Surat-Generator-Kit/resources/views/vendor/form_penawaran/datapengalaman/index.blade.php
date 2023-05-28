@extends('template.app')

@section('title', 'Ubah Form Penawaran Harga')

@section('content')
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
    <div class="card w-100">
        <div class="card-header">
            <h5 class="card-title">Create Form Penawaran Harga</h5>
        </div>



        <div class="card-body">
            <div class="header">
                {{-- <img src="{{ $kopsurat }}" alt="Kop Surat" style="object-fit: cover;" class="company-logo" width="200px"> --}}
                Header
            </div>

            <main>
                <div class="kop">
                    <h1>DATA PENGALAMAN PERUSAHAAN</h1>
                    <h2>SESUAI DENGAN BIDANG/SUB BIDANGNYA</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th rowspan="2">No</th>
                            <th rowspan="2">Bidang Pekerjaan</th>
                            <th rowspan="2">Sub Bidang Pekerjaan</th>
                            <th rowspan="2">Lokasi</th>
                            <th colspan="2">Pemberi Tugas/Penanggung Jawab</th>
                            <th colspan="1">Kontrak</th>
                            <th colspan="3">Tanggal Selesai Menurut</th>
                            <th rowspan="2">Aksi</th>
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
                        @foreach ($datapengalaman as $data)
                            <tr>
                                <td>{{ $data['id'] }}</td>
                                <td>{{ $data['bidang_pekerjaan'] }}</td>
                                <td>{{ $data['sub_bidang_pekerjaan'] }}</td>
                                <td>{{ $data['lokasi'] }}</td>
                                <td>{{ $data['nama_pemberi_tugas'] }}</td>
                                <td>{{ $data['alamat_pemberi_tugas'] }}</td>
                                <td>{{ $data['no_tanggal_kontrak'] }}</td>
                                <td>{{ $data['nilai'] }}</td>
                                <td>{{ $data['nilai_kontrak'] }}</td>
                                <td>{{ $data['ba_serah_terima'] }}</td>
                                <td>
                                    <a href="{{ route('vendor.datapengalaman.edit', $data['id']) }}"
                                        class="btn btn-primary">Edit</a>
                                    <form action="{{ route('vendor.datapengalaman.destroy', $data['id']) }}" method="POST"
                                        style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="tandatangan">
                    <div>............... (Tanggal), .................. 2022</div>
                    <div>PT/CV/Firma ..............................</div>
                    <div class="kotak" style="height: 50px; margin: 10px 0;border: 1px solid black;"></div>
                    <div class="nama-jabatan">Nama Jelas</div>
                    <div class="nama-jabatan">Jabatan</div>
                </div>
            </main>
        </div>



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
