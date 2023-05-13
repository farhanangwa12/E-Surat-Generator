@extends('template.app')

@section('title', 'Kelengkapan Dokumen')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Kelengkapan dokumen</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        <style>
                            th,
                            td {
                                vertical-align: middle;
                            }
                        </style>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Dokumen</th>
                                    <th scope="col">Tanggal Upload</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>




                                @php
                                    $i = 1;
                                @endphp

                                @foreach ($namadokumenCollect as $item)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $item['nama_dokumen'] }}</td>
                                        <td>{{ $item['tanggal_upload'] }}</td>
                                        <td>
                                            @if ($item['sudahUpload'])
                                                <div class="d-flex flex-row mb-3 align-items-center">
                                                    <form
                                                        action="{{ route('kelengkapandok.update', ['id' => $item['id_dokumen']]) }}"
                                                        method="POST" enctype="multipart/form-data" class="p-2">
                                                        @csrf
                                                        @method('PUT');

                                                        <input type="file" class="form-control" name="file"
                                                            id="file" accept="application/pdf">
                                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                                    </form>

                                                    <form class="p-2"
                                                        action="{{ route('kelengkapandok.destroy', ['id' => $item['id_dokumen']]) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary p-2"
                                                        data-bs-toggle="modal" data-bs-target="#infoModal"
                                                        onclick="changeSrc('{{ route('kelengkapandok.view', ['name' => $item['file']]) }}')">Info</button>





                                                </div>
                                            @else
                                                <form action="{{ route('kelengkapandok.store') }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf

                                                    <input type="hidden" name="v" value="1">
                                                    <input type="hidden" name="jen" value="{{ $item['id_jenis'] }}">
                                                    <input type="file" class="form-control" name="file" id="file"
                                                        accept="application/pdf">

                                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                                </form>
                                            @endif


                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>



                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Tampilan
                        Dokumen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex row">
                    {{-- <iframe
                 src="{{ route('kelengkapandok.view', ['name' => $item['file']]) }}"
                 style="min-width: 200px;max-width:800px; min-height:200px; max-height: 400px;"></iframe> --}}

                    <iframe src="www.google.com" id="myFrame" width="800px" height="400px"></iframe>
                    {{-- <iframe title="{{ $item['file'] }}" src="{{ route('kelengkapandok.view', ['name' => $item['file']]) }}"
                        width="800px" height="400px"></iframe> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

@endsection

<script>
    function changeSrc(url) {
        var iframe = document.getElementById("myFrame");
        iframe.src = url;
    }
</script>
