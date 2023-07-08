@extends('template.app')

@section('title', 'Ubah Form Penawaran Harga')

@section('content')
    <style>
        /* Header */





        body {
            font-family: Arial, sans-serif;
            font-size: 12px;

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
            <h3>DATA PENGALAMAN PERUSAHAAN</h3>
            <h4>SESUAI DENGAN BIDANG/SUB BIDANGNYA</h4>
        </div>



        <div class="card-body">
            <div class="header">

                <a href="{{ route('vendor.datapengalaman.create', ['id' => $id]) }}" class="btn btn-primary">Tambah</a>

            </div>

            <main>
                <div class="kop">

                </div>
                <table class="table">
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
                            <th>Kontrak</th>
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
                                <td>{{ $data['kontrak'] }}</td>
                                <td>{{ $data['ba_serah_terima'] }}</td>
                                <td>
                                    <a href="{{ route('vendor.datapengalaman.edit', ['id' => $id, 'id_data' => $data['id']]) }}"
                                        class="btn btn-primary">Edit</a>
                                    <form
                                        action="{{ route('vendor.datapengalaman.destroy', ['id' => $id, 'id_data' => $data['id']]) }}"
                                        method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <a href="{{ route('vendor.kontrakkerja.detail', ['id' => $id]) }}" class="btn btn-primary">Kembali</a>




            </main>

        </div>



    </div>
    {{-- <div class="card">
        <div class="card-header">
            Update Data Penawaran
        </div>
        <div class="card-body">

            <form
                action="{{ route('vendor.datapengalaman.updateDatapengalaman', ['id' => $id, 'id_data' => $kelengkapan->id]) }}"
                method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kota_surat" class="form-label">Kota Surat</label>
                                <input type="text" name="kota_surat" class="form-control" id="kota_surat"
                                    value="{{ $kelengkapan->kota_surat }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                                <input type="date" name="tanggal_surat" class="form-control" id="tanggal_surat"
                                    value="{{ $kelengkapan->tanggal_surat }}">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nama_perusahaan" class="form-label">Nama Perusahaan:</label>
                        <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan"
                            value="{{ $kelengkapan->nama_perusahaan }}">
                    </div>

                    <div class="mb-3">
                        <label for="nama_jelas" class="form-label">Nama Lengkap:</label>
                        <input type="text" class="form-control" id="nama_jelas" name="nama_jelas"
                            value="{{ $kelengkapan->nama_jelas }}">
                    </div>

                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan:</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan"
                            value="{{ $kelengkapan->jabatan }}">
                    </div>
                    <a href="{{ route('vendor.kontrakkerja.detail', ['id' => $id]) }}" class="btn btn-primary">Kembali</a>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>

        </div>
    </div> --}}

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
