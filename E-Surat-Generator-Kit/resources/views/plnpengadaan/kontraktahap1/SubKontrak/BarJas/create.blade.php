@extends('template.app')

@section('title', 'Tambah Data')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Tambah Data</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h1>Tambah Data</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('barjas.store',$id_kontrakkerja) }}" method="post">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <input type="hidden" name="id_jenis_kontrak" value="{{ $id_jenis_kontrak }}">
                            <div class="form-group mb-3">
                                <label for="uraian">Uraian</label>
                                <input type="text" class="form-control @error('uraian') is-invalid @enderror"
                                    name="uraian" value="{{ old('uraian') }}">
                                @error('uraian')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="volume">Volume</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('volume') is-invalid @enderror" name="volume"
                                    value="{{ old('volume') }}">
                                @error('volume')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="satuan">Satuan</label>
                                <input type="text" class="form-control @error('satuan') is-invalid @enderror"
                                    name="satuan" value="{{ old('satuan') }}">
                                @error('satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label for="harga_satuan">Harga Satuan</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('harga_satuan') is-invalid @enderror" name="harga_satuan"
                                    value="{{ old('harga_satuan') }}">
                                @error('harga_satuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}
                            <div class="form-group">
                                <a href="{{ route('subkontrak.show', ['id_kontrakkerja' => $id_kontrakkerja, 'id_jenis' => $id_jenis_kontrak]) }}"
                                    class="btn btn-primary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>



                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
