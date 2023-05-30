@extends('template.app')

@section('title', 'Pengajuan Kontrak')


@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Pengajuan Kontrak</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <h5 class="card-title mb-0">Kontrak Kerja


                        </h5>


                    </div>
                    <div class="card-body">
                        <a href="{{ route('pengajuankontrak.create') }}" class="btn btn-primary mb-3">Tambah</a>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kontrak</th>
                                    <th>Vendor</th>
                                    <th>Tanggal Pekerjaan</th>
                                    <th>Status</th>
                                    <th>Pengisian Kontrak</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp

                                @foreach ($kontrak as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->nama_kontrak }}</td>
                                        <td>{{ $item->vendor->penyedia }}</td>

                                        <td>{{ date('d/m/Y', strtotime($item->tanggal_pekerjaan)) . ' - ' . date('d/m/Y', strtotime($item->tanggal_akhir_pekerjaan)) }}
                                        </td>
                                        <td>{{ $item->status }}</td>
                                        <td> <a href="{{ route('pengajuankontrak.detail', ['id' => $item->id_kontrakkerja]) }}"
                                                class="btn btn-warning">Dokumen Lanjutan</a></td>
                                        <td> <a href="{{ route('pengajuankontrak.edit', ['id' => $item->id_kontrakkerja]) }}"
                                                class="btn btn-primary">Edit</a>

                                            <form
                                                action="{{ route('pengajuankontrak.destroy', ['id' => $item->id_kontrakkerja]) }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </td>
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

@section('javascript')
