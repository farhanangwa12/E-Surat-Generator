@extends('template.app')

@section('title', 'Tambah Sub Data')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Tambah Sub Data</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <form action="{{ route('subbarjas.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="id_barjas" value="{{ $id_barjas }}">

                            <div class="form-group mb-3">
                                <label for="uraian" class="form-label">Uraian</label>
                                <input type="text" class="form-control" id="uraian" name="uraian" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="volume" class="form-label">Volume</label>
                                <input type="number" class="form-control" id="volume" name="volume" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="satuan" class="form-label">Satuan</label>
                                <input type="text" class="form-control" id="satuan" name="satuan" required>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" required>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                            </div> --}}
                            <div class="form-group mb-3">
                                <a href="{{ route('subkontrak.show', ['id_kontrakkerja' => $id_kontrakkerja, 'id_jenis' => $id_jenis_kontrak]) }}"
                                    class="btn btn-primary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Create</button>

                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
