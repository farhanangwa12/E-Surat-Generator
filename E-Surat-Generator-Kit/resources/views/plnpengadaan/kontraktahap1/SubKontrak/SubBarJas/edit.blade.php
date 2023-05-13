@extends('template.app')

@section('title', 'Edit Sub Data')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit Sub Data</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h1>Edit Sub Data</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('subbarjas.update', $subbarjas->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                        
                            <input type="hidden" name="id_barjas" value="{{  $subbarjas->id_barjas }}">
                        
                            <div class="mb-3">
                              <label for="uraian" class="form-label">Uraian</label>
                              <input type="text" class="form-control" id="uraian" name="uraian" value="{{ $subbarjas->uraian }}" required>
                            </div>
                            <div class="mb-3">
                              <label for="volume" class="form-label">Volume</label>
                              <input type="number" class="form-control" id="volume" name="volume" value="{{ $subbarjas->volume }}" required>
                            </div>
                            <div class="mb-3">
                              <label for="satuan" class="form-label">Satuan</label>
                              <input type="text" class="form-control" id="satuan" name="satuan" value="{{ $subbarjas->satuan }}" required>
                            </div>
                            <div class="mb-3">
                              <label for="harga_satuan" class="form-label">Harga Satuan</label>
                              <input type="number" class="form-control" id="harga_satuan" name="harga_satuan" value="{{ $subbarjas->harga_satuan }}" required>
                            </div>
                            <div class="mb-3">
                              <label for="jumlah" class="form-label">Jumlah</label>
                              <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ $subbarjas->jumlah }}" required>
                            </div>
                        
                            <button type="submit" class="btn btn-primary">Update</button>
                          </form>



                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
