@extends('template.app')

@section('title', 'Edit Pegawai')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit Pegawai</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="{{ route('pegawai.update', $pegawai->id_pegawai) }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="nama_pegawai">Nama Pegawai</label>
                                <input type="text" name="nama_pegawai" class="form-control" id="nama_pegawai"
                                    placeholder="Masukkan nama pegawai" value="{{ $pegawai->nama_pegawai }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="id_akun">ID Akun</label>
                                <input type="text" name="id_akun" class="form-control" id="id_akun"
                                    placeholder="Masukkan ID Akun" value="{{$pegawai->id_akun}}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="jabatan">Jabatan</label>
                                <input type="text" name="jabatan" class="form-control" id="jabatan"
                                    placeholder="Masukkan Jabatan" value="{{ $pegawai->jabatan }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="nomor_jabatan">Nomor Jabatan</label>
                                <input type="text" name="nomor_jabatan" class="form-control" id="nomor_jabatan"
                                    placeholder="nomor_jabatan" value="{{ $pegawai->nomor_jabatan }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>



                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
