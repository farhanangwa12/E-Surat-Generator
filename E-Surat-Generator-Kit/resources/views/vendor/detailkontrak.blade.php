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
                        <iframe src="{{ route('pengajuankontrak.undangan', ['id' => $id, 'isDownload' => '1']) }}"
                            width="80%" height="500px" frameborder="0"></iframe>

                    </div>
                </div>
                {{-- Surat BOQ --}}
                <div class="card">
                    <div class="card-header">
                        BOQ
                    </div>
                    <div class="card-body  d-flex justify-content-center align-items-center">
                        <iframe src="{{ route('pengajuankontrak.boq.detail', ['id' => $id, 'isDownload' => 1]) }}"
                            width="80%" height="500px" frameborder="0"></iframe>

                    </div>
                </div>
                {{-- Surat RKS --}}
                <div class="card">

                    <div class="card-header">
                        RKS

                    </div>
                    <div class="card-body  d-flex justify-content-center align-items-center">
                        <iframe src="{{ route('pengajuankontrak.rks', ['id' => $id, 'isDownload' => 1]) }}" width="80%"
                            height="500px" frameborder="0"></iframe>

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
                            <table class="table table-stripped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Dokumen</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>RKS</td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('rks.isi', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Isi
                                                RKS</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>BOQ</td>
                                        <td>
                                            <a href="{{ route('boqtandatanganvendor', ['id' => $kontrakkerja->id_kontrakkerja]) }}"
                                                class="btn btn-primary">Tanda Tangan BOQ</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('pengajuankontrak.boq.isi', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Isi
                                                BOQ</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>Form Penawaran</td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.formpenawaranharga.create', $kontrakkerja->id_kontrakkerja) }}">Isi
                                                Form Penawaran</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.formpenawaranharga.halamanttd',['id' =>  $kontrakkerja->id_kontrakkerja]) }}">Halamanttd</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.formpenawaranharga.pdf', $kontrakkerja->id_kontrakkerja) }}">Tampilan PDF</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>Pernyataan Garansi</td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.pernyataan.garansi.index') }}">Isi Pernyataan
                                                Garansi</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.pernyataan.garansi.halamanttd') }}">Halamanttd</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>Pernyataan Sanggup</td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.pernyataan.sangup.index') }}">Isi Pernyataan
                                                Sanggup</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.pernyataan.sangup.halamanttd') }}">Halamanttd</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>




                    @if ($kontrakkerja->status == 'Dokumen Input Vendor')
                        <div class="card">
                            <div class="card-header">
                                Setelah tombol kirim ditekan, informasi akan langsung dikirimkan ke pihak PLN untuk proses
                                penawaran harga. Proses ini tidak dapat dibatalkan. Mohon konfirmasi apakah vendor yakin
                                akan melanjutkan.

                            </div>
                            <div class="card-body">

                                <div class="btn-group me-2" role="group" aria-label="Tombol gabungan">
                                    <a href="{{ route('pengajuankontrak.index') }}" class="btn btn-info">Kembali</a>
                                    <form
                                        action="{{ route('changestatus', ['id' => $kontrakkerja->id_kontrakkerja, 'status' => 'Dokumen Input Pengadaan Tahap 2', 'routeName' => 'isikontrak']) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($kontrakkerja->status == 'Tanda Tangan Vendor')
                        <div class="card">
                            <div class="card-header">
                                Mohon konfirmasi apakah vendor setuju dengan persyaratan penawaran yang telah disampaikan.
                                Jika tidak setuju, silakan klik tombol "Tidak Setuju". Jika setuju, silakan tanda tangan
                                sebagai tanda persetujuan. Terima kasih atas perhatiannya.
                            </div>
                            <div class="card-body">

                                <div class="btn-group me-2" role="group" aria-label="Tombol gabungan">
                                    <a href="{{ route('pengajuankontrak.index') }}" class="btn btn-info">Kembali</a>
                                    <form
                                        action="{{ route('changestatus', ['id' => $kontrakkerja->id_kontrakkerja, 'status' => 'Kontrak Dibatalkan', 'routeName' => 'vendor.kontrakkerja']) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Tidak Setuju</button>
                                    </form>
                                    <form
                                        action="{{ route('changestatus', ['id' => $kontrakkerja->id_kontrakkerja, 'status' => 'Kontrak Disetujui', 'routeName' => 'vendor.kontrakkerja']) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Setuju</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endif







                </div>
            </div>

        </div>
    @endsection
