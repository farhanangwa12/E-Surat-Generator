@extends('template.app')

@section('title', 'Edit Jenis Dokumen')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit Jenis Dokumen </h1>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="{{ route('jenisdokumen.update', $jenisdokumen->id_jenis) }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="nama_dokumen">Nama Dokumen</label>
                                <input type="text" name="nama_dokumen" class="form-control" id="nama_dokumen"
                                    placeholder="Masukkan nama dokumen" value="{{ $jenisdokumen->nama_dokumen }}"  oninput="generateNoDokumen()">
                                @error('nama_dokumen')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="no_dokumen">Nomor Dokumen</label>
                                <input type="text" class="form-control" id="no_dokumen" name="no_dokumen"
                                    value="{{ $jenisdokumen->no_dokumen }}" readonly>
                                @error('no_dokumen')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
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
    <script>
        function generateNoDokumen() {
            var namaDokumen = document.getElementById('nama_dokumen').value;
            var noDokumen = namaDokumen.replace(/\s+/g, '_').toLowerCase();
            document.getElementById('no_dokumen').value = noDokumen;
        }
    </script>
@endsection
