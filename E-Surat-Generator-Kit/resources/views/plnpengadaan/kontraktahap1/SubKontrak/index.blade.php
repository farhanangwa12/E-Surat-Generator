@extends('template.app')

@section('title', 'Tampilan Barang dan Jasa')

@section('content')

    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">{{ $jenis->nama_jenis }}</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="text-right mb-3">
                            {{-- <a href="{{ route('jenis_kontrak.index', ['id' => $jenisKontrak->id_kontrak]) }}"
                                class="btn btn-primary">Kembali</a> --}}
                            <a href="{{ route('barjas.create', ['id_jenis_kontrak' => $id_jenis_kontrak]) }}"
                                class="btn btn-success">Tambah
                                BarJas</a>

                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Uraian</th>
                                    <th scope="col">Volume</th>
                                    <th scope="col">Satuan</th>
                                    {{-- <th scope="col">Harga Satuan</th>
                                    <th scope="col">Jumlah</th> --}}
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $barjas)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $barjas['uraian'] }}</td>
                                        <td>{{ $barjas['volume'] }}</td>
                                        <td>{{ $barjas['satuan'] }}</td>
                                        {{-- <td>{{ $barjas['harga_satuan'] }}</td>
                                        <td>{{ $barjas['jumlah'] }}</td> --}}
                                        <td>
                                            <a href="{{ route('subbarjas.create', ['id_barjas' => $barjas['id_barjas']]) }}"
                                                class="btn btn-success">Tambah Sub Data</a>
                                            <a href="{{ route('barjas.edit', ['id' => $barjas['id_barjas']]) }}"
                                                class="btn btn-warning">Edit</a>
                                            <form action="{{ route('barjas.destroy', ['id' => $barjas['id_barjas']]) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @foreach ($barjas['sub_data'] as $subbarjas)
                                        <tr>
                                            <th scope="row"></th>
                                            <td>{{ $subbarjas['uraian'] }}</td>
                                            <td>{{ $subbarjas['volume'] }}</td>
                                            <td>{{ $subbarjas['satuan'] }}</td>
                                            {{-- <td>{{ $subbarjas['harga_satuan'] }}</td>
                                            <td>{{ $subbarjas['jumlah'] }}</td> --}}
                                            <td>

                                                <a href="{{ route('subbarjas.edit', ['id' => $subbarjas['id_subbarjas']]) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <form
                                                    action="{{ route('subbarjas.destroy', ['id' => $subbarjas['id_subbarjas']]) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
