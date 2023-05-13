@extends('template.app')

@section('title', 'Tanda Tangan')


@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Pengajuan Kontrak</h1>

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
                                <th>No</th>
                                <th>Nama Kontrak</th>
                                <th>Tanggal Pekerjaan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Kontrak A</td>
                                <td>01/01/2023</td>
                                <td>Selesai</td>
                                <td><a href="#">Edit</a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Kontrak B</td>
                                <td>02/01/2023</td>
                                <td>Belum Selesai</td>
                                <td><a href="#">Edit</a></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Kontrak C</td>
                                <td>03/01/2023</td>
                                <td>Selesai</td>
                                <td><a href="#">Edit</a></td>
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
