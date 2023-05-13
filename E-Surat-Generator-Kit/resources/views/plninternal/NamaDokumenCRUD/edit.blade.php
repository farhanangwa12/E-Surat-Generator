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
                                    placeholder="Masukkan nama dokumen" value="{{$jenisdokumen->nama_dokumen}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>



                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
