@extends('template.app')

@section('title', 'Tambah Jenis Dokumen')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Tambah Jenis Dokumen</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">


                    <div class="card-body">


                        <form method="POST" action="{{ route('jenisdokumen.store') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
                                <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen"
                                    oninput="generateNoDokumen()" >
                                @error('nama_dokumen')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="no_dokumen">Nomor Dokumen</label>
                                <input type="text" class="form-control" id="no_dokumen" name="no_dokumen" 
                                    readonly>
                                @error('no_dokumen')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>




                            <div class="form-group mb-3">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
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

@section('javascript')
    <script>
        function generateNoDokumen() {
            var namaDokumen = document.getElementById('nama_dokumen').value;
            var noDokumen = namaDokumen.replace(/\s+/g, '_').toLowerCase();
            document.getElementById('no_dokumen').value = noDokumen;
        }
    </script>
@endsection
