@extends('template.app')

@section('title', 'Tanda Tangan')


@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Kontrak kerja</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header">
                    <h5 class="card-title mb-0">User Setting</h5>
                </div> --}}
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kontrak</th>
                                    <th>Vendor</th>
                                    <th>Tanggal Pekerjaan</th>
                                    <th>Status</th>
                                    <th>Pengisian Kontrak</th>
                                    {{-- <th>Aksi</th> --}}
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
                                        <td><a href="{{ route('tandatangan.manager.detail', ['id' => $item->id_kontrakkerja]) }}"
                                                class="btn btn-warning">Dokumen Lanjutan</a></td>
                                        {{-- <td> <a href="{{ route('pengajuankontrak.edit', ['id' => $item->id_kontrakkerja]) }}"
                                                class="btn btn-primary">Edit</a>
                                        </td> --}}
                                        {{-- <td>
                                        </td>  --}}
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
