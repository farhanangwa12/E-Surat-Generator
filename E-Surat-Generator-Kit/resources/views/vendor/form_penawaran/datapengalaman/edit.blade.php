@extends('template.app')

@section('title', 'Ubah Data Pengalaman')

@section('content')
    <style>
        .alert {
            padding: 10px;
            border-radius: 4px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .fade-out {
            animation: fadeOut 5s ease-in-out forwards;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
                display: none;
            }
        }
    </style>
    <div class="card w-100">
        <div class="card-header">
            <h5 class="card-title">Ubah Data Pengalaman</h5>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('vendor.datapengalaman.update', ['id' => $id, 'id_data' => $datapengalaman->id]) }}"
                method="POST">
                @method('PUT')
                @csrf

                <div class="mb-3">
                    <label for="bidang_pekerjaan" class="form-label">Bidang Pekerjaan:</label>
                    <input type="text" class="form-control" id="bidang_pekerjaan" name="bidang_pekerjaan"
                        value="{{ $datapengalaman->bidang_pekerjaan }}">
                </div>

                <div class="mb-3">
                    <label for="sub_bidang_pekerjaan" class="form-label">Sub Bidang Pekerjaan:</label>
                    <input type="text" class="form-control" id="sub_bidang_pekerjaan" name="sub_bidang_pekerjaan"
                        value="{{ $datapengalaman->sub_bidang_pekerjaan }}">
                </div>

                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi:</label>
                    <input type="text" class="form-control" id="lokasi" name="lokasi"
                        value="{{ $datapengalaman->lokasi }}">
                </div>

                <div class="mb-3">
                    <label for="nama_pemberi_tugas" class="form-label">Nama Pemberi Tugas:</label>
                    <input type="text" class="form-control" id="nama_pemberi_tugas" name="nama_pemberi_tugas"
                        value="{{ $datapengalaman->nama_pemberi_tugas }}">
                </div>

                <div class="mb-3">
                    <label for="alamat_pemberi_tugas" class="form-label">Alamat Pemberi Tugas:</label>
                    <input type="text" class="form-control" id="alamat_pemberi_tugas" name="alamat_pemberi_tugas"
                        value="{{ $datapengalaman->alamat_pemberi_tugas }}">
                </div>

                <div class="mb-3">
                    <label for="no_tanggal_kontrak" class="form-label">No Tanggal Kontrak:</label>
                    <input type="text" class="form-control" id="no_tanggal_kontrak" name="no_tanggal_kontrak"
                        value="{{ $datapengalaman->no_tanggal_kontrak }}">
                </div>

                <div class="mb-3">
                    <label for="nilai" class="form-label">Nilai:</label>
                    <input type="text" class="form-control" id="nilai" name="nilai"
                        value="{{ $datapengalaman->nilai }}">
                </div>

                <div class="mb-3">
                    <label for="kontrak" class="form-label">Kontrak:</label>
                    <input type="text" class="form-control" id="kontrak" name="kontrak"
                        value="{{ $datapengalaman->kontrak }}">
                </div>

                <div class="mb-3">
                    <label for="ba_serah_terima" class="form-label">BA Serah Terima:</label>
                    <input type="text" class="form-control" id="ba_serah_terima" name="ba_serah_terima"
                        value="{{ $datapengalaman->ba_serah_terima }}">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>




    </div>


@endsection
