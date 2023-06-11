@extends('template.app')

@section('title', 'Edit User')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit Pegawai</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="{{ route('jenisdokumen.store') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="nama_dokumen">Nama Dokumen</label>
                                <input type="text" name="nama_dokumen" class="form-control" id="nama_dokumen"
                                    placeholder="Masukkan nama dokumen" value="{{ $jenisdokumen->nama_dokumen }}">
                                @error('nama_dokumen')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="no_dokumen">Nomor Dokumen</label>
                                <input type="text" class="form-control" id="no_dokumen" name="no_dokumen"
                                    value="{{ $jenisdokumen->no_dokumen }}">
                                @error('no_dokumen')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ $jenisdokumen->keterangan }}</textarea>
                                @error('keterangan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>



                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
