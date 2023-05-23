@extends('template.app')

@section('title', 'Ubah Form Penawaran Harga')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Halaman Tanda Tangan</div>

                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">Form Upload File Tanda Tangan</div>
                            <div class="card-body">
                                <form action="{{ route('vendor.formpenawaranharga.simpanttd') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="ttdFile">Upload File Tanda Tangan:</label>
                                        <input type="file" class="form-control-file" id="ttdFile" name="ttdFile">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
