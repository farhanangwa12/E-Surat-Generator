@extends('template.app')

@section('title', 'Jenis Dokumen')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Jenis Dokumen</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <h5 class="card-title mb-0"> <a href="{{ route('jenisdokumen.create') }}"
                                class="btn btn-primary">Tambah</a>
                        </h5>


                    </div>
                    <div class="card-body">
                        <style>
                            td,
                            th {

                                vertical-align: middle;
                            }
                        </style>

                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Dokumen</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($jenisdok as $item)
                                    <tr>

                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $item->nama_dokumen }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>
                                            @if ($item->dokumen_sistem == 'tidak')
                                                <div class="btn-group">
                                                    <a href="{{ route('jenisdokumen.edit', ['id' => $item->id_jenis]) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                    <form
                                                        action="{{ route('jenisdokumen.destroy', ['id' => $item->id_jenis]) }}"
                                                        method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                                            class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </div>
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
@endsection
