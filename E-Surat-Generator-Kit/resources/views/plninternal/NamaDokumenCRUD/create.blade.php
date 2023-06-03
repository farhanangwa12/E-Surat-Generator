@extends('template.app')

@section('title', 'Tambah User')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Tambah Jenis Dokumen</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">


                    <div class="card-body">
                        <form method="POST" action="{{ route('jenisdokumen.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="nama_dokumen" class="form-label">Nama Dokumen</label>
                                <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" required>
                            </div>

                            <div class="mb-3">
                                <label for="dokumen_penting" class="form-label">Dokumen Penting</label>
                                <select class="form-select" id="dokumen_penting" name="dokumen_penting" required>
                                    <option value="ya">Ya</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                            </div>

           
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>



                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
