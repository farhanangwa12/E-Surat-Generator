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
                            </div>

                            <div class="mb-3">
                                <label for="dokumen_penting" class="form-label">Dokumen Penting</label>
                                <select class="form-select" id="dokumen_penting" name="dokumen_penting" required>
                                    <option value="ya" {{ $jenisdokumen->dokumen_penting === 'ya' ? 'selected' : '' }}>
                                        Ya</option>
                                    <option value="tidak"
                                        {{ $jenisdokumen->dokumen_penting === 'tidak' ? 'selected' : '' }}>Tidak</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $jenisdokumen->deskripsi }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>



                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
