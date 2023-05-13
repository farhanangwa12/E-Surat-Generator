@extends('template.app')

@section('title', 'User Setting')


@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Nama Dokumen Vendor</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <h5 class="card-title mb-0">User Setting</h5>
                    </div> --}}
                    <div class="card-body">
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
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Surat Izin Kerja</td>
                                    <td>2022-01-01</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Laporan Keuangan</td>
                                    <td>2022-02-01</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Surat Permohonan Pinjaman</td>
                                    <td>2022-03-01</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Kartu Keluarga</td>
                                    <td>2022-04-01</td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>Surat Keterangan Domisili</td>
                                    <td>2022-05-01</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('javascript')
