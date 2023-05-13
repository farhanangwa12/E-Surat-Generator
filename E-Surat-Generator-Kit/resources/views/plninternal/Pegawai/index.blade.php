@extends('template.app')

@section('title', 'Management User')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Management Pegawai</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"> <a href="{{ route('pegawai.create') }}" class="btn btn-primary">Tambah</a>
                        </h5>


                    </div>
                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Pegawai</th>
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">Nomor Jabatan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($pegawai as $item)
                                    <tr>
                                        <td scope="row">{{ $no++ }}</td>
                                        <td>{{ $item->nama_pegawai }}</td>
                                        <td>{{ $item->jabatan }}</td>
                                        <td>{{ $item->nomor_jabatan }}</td>

                                        <td> <a href="{{ route('pegawai.edit', ['id' => $item->id_pegawai]) }}"
                                                class="btn btn-primary">Edit</a>
                                            <form action="{{ route('pegawai.destroy', ['id' => $item->id_pegawai]) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
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
