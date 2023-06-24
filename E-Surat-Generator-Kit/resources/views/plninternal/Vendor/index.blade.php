@extends('template.app')

@section('title', 'Management Vendor')
<style>
    th,td {
        vertical-align: middle;
        
    }
</style>
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Management Vendor</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"> <a href="{{ route('vendor.create') }}" class="btn btn-primary">Tambah</a>
                        </h5>


                    </div>
                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Penyedia</th>
                                    <th scope="col">Direktur</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Bank</th>
                                    <th scope="col">Nomor Rekening</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($vendor as $item)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $item->penyedia }}</td>
                                        <td>{{ $item->direktur }}</td>
                                        <td>{{ $item->alamat_jalan . ', ' . $item->alamat_kota . ', ' . $item->alamat_provinsi }}</td>
                                        <td>{{ $item->bank }}</td>
                                        <td>{{ $item->nomor_rek }}</td>
                                        <td> <a href="{{ route('vendor.edit', ['id' => $item->id_vendor]) }}"
                                                class="btn btn-primary">Edit</a>
                                            {{-- <a href="{{ route('vendor.kelengkapandokumen', ['idvendor'=> $item->id_vendor]) }}"
                                                class="btn btn-warning">Kelengkapan Dokumen</a> --}}
                                            <form action="{{ route('vendor.destroy', ['id' => $item->id_vendor]) }}"
                                                method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger">Hapus</button>
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
