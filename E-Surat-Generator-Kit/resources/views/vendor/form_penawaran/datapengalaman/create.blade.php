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

        <div class="card-body">
            <form action="{{ route('vendor.datapengalaman.store') }}" method="POST">
                @csrf

                <label for="bidang_pekerjaan">Bidang Pekerjaan:</label>
                <input type="text" name="bidang_pekerjaan">

                <label for="sub_bidang_pekerjaan">Sub Bidang Pekerjaan:</label>
                <input type="text" name="sub_bidang_pekerjaan">

                <label for="lokasi">Lokasi:</label>
                <input type="text" name="lokasi">

                <label for="nama_pemberi_tugas">Nama Pemberi Tugas:</label>
                <input type="text" name="nama_pemberi_tugas">

                <label for="alamat_pemberi_tugas">Alamat Pemberi Tugas:</label>
                <input type="text" name="alamat_pemberi_tugas">

                <label for="no_tanggal_kontrak">No Tanggal Kontrak:</label>
                <input type="text" name="no_tanggal_kontrak">

                <label for="nilai">Nilai:</label>
                <input type="text" name="nilai">

                <label for="nilai_kontrak">Nilai Kontrak:</label>
                <input type="text" name="nilai_kontrak">

                <label for="ba_serah_terima">BA Serah Terima:</label>
                <input type="text" name="ba_serah_terima">

                <button type="submit">Simpan</button>
            </form>

        </div>


    </div>

@endsection
