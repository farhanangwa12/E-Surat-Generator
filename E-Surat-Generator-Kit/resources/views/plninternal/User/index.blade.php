@extends('template.app')

@section('title', 'Management User')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Management User</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"> <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah</a>
                        </h5>


                    </div>
                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Jenis Akun</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($users as $item)
                                  
                                    <tr>
                                        <td scope="row">{{ $no++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>

                                        @if ($item->vendor !== null)
                                            <td>
                                                <button class="btn btn-success">Vendor</button>

                                            </td>
                                        @elseif($item->pegawai !== null)
                                            <td>
                                                <button class="btn btn-success">Pegawai</button>

                                            </td>
                                        @else
                                            <td>
                                                <button class="btn btn-danger">Tidak Terhubung</button>

                                            </td>
                                        @endif

                                        <td> <a href="{{ route('users.edit', ['id' => $item->id]) }}"
                                                class="btn btn-primary">Edit</a>
                                            <form action="{{ route('users.destroy', ['id' => $item->id]) }}" method="POST"
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
