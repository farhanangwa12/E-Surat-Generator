@extends('template.app')

@section('title', 'Detail Kontrak')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Detail Kontrak</h1>

        <div class="row">
            <div class="col-12">


                {{-- Surat Undangan --}}
                <div class="card">
                    <div class="card-header">
                        Undangan
                    </div>
                    <div class="card-body  d-flex justify-content-center align-items-center">
                        <iframe src="{{ route('pengajuankontrak.undangan', ['id' => $id, 'isDownload' => 'I']) }}" width="80%" height="500px"
                            frameborder="0"></iframe>

                    </div>
                </div>
                {{-- Surat BOQ --}}
                <div class="card">
                    <div class="card-header">
                        BOQ
                    </div>
                    <div class="card-body  d-flex justify-content-center align-items-center">
                        <iframe src="{{ route('pengajuankontrak.boq.detail', ['id' => $id, 'isDownload' => 1]) }}" width="80%" height="500px"
                            frameborder="0"></iframe>

                    </div>
                </div>
                {{-- Surat RKS --}}
                <div class="card">
                    
                    <div class="card-header">
                        RKS
                       
                    </div>
                    <div class="card-body  d-flex justify-content-center align-items-center">
                        <iframe src="{{ route('pengajuankontrak.rks', ['id' => $id, 'isDownload' => 1]) }}" width="80%" height="500px"
                            frameborder="0"></iframe>

                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <h1>Dokumen Kontrak</h1>
                        <p>Silahkan isi dokumen di bawah ini.</p>


                    </div>
                    <div class="card-body">
                        <style>
                            td,
                            th {

                                vertical-align: middle;
                            }
                        </style>
                        <div class="row justify-content-end">

                     
                        <table class="table table-stripped ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Dokumen</th>
                                    <th scope="col">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no=1
                                @endphp
                               
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>RKS</td>
                                    <td><a class="btn btn-primary" href="{{route('rks.isi', ['id'=> $kontrakkerja->id_kontrakkerja])}}">Isi RKS</a></td>
                                </tr>
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>BOQ</td>
                                    <td><a class="btn btn-primary" href="{{route('pengajuankontrak.boq.isi', ['id'=> $kontrakkerja->id_kontrakkerja])}}">Isi BOQ</a></td>
                                </tr>
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>Form Penawaran</td>
                                    <td><a class="btn btn-primary" href="#">Isi Form Penawaran</a></td>

                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>
           





            </div>
        </div>

    </div>
@endsection
