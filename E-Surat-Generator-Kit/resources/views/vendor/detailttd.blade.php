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
                                                href="{{ route('vendor.formpenawaranharga.halamanttd', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Halamanttd</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.formpenawaranharga.pdf', $kontrakkerja->id_kontrakkerja) }}">Tampilan
                                                PDF</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>Lampiran Penawaran Harga</td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.lampiranpenawaranharga.create', $kontrakkerja->id_kontrakkerja) }}">Isi
                                                Lampiran Penawaran Harga</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.lampiranpenawaranharga.halamanttd', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Halamanttd</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.lampiranpenawaranharga.pdf', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Tampilan
                                                PDF</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>Paktavendor</td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.paktavendor.create', $kontrakkerja->id_kontrakkerja) }}">Isi
                                                Paktavendor</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.paktavendor.halamanttd', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Halamanttd</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.paktavendor.pdf', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Tampilan
                                                PDF</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>Pernyataan Garansi</td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.pernyataan.garansi.create', $kontrakkerja->id_kontrakkerja) }}">Isi
                                                Pernyataan Garansi</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.pernyataan.garansi.halamanttd', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Halamanttd</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.pernyataan.garansi.pdf', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Tampilan
                                                PDF</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>Pernyataan Sanggup</td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.pernyataan.sangup.create', $kontrakkerja->id_kontrakkerja) }}">Isi
                                                Pernyataan Sanggup</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.pernyataan.sangup.halamanttd', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Halamanttd</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.pernyataan.sangup.pdf', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Tampilan
                                                PDF</a>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>Data Pengalaman</td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.datapengalaman.index', $kontrakkerja->id_kontrakkerja) }}">Isi
                                                Data Pengalaman</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.datapengalaman.halamanttd', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Halamanttd</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.datapengalaman.pdf', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Tampilan
                                                PDF</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>Neraca</td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.neraca.create', $kontrakkerja->id_kontrakkerja) }}">Isi
                                                Neraca</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.neraca.halamanttd', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Halamanttd</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.neraca.pdf', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Tampilan
                                                PDF</a>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>











                </div>


                <div class="card">
                    <div class="card-header">
                        Dokumen Kelengkapan
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Dokumen</th>
                                    <th>keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jenisDokumenKelengkapans as $jenisDokumenKelengkapan)
                                    <tr>
                                        <td>{{ $jenisDokumenKelengkapan['id_jenis'] }}</td>
                                        <td>{{ $jenisDokumenKelengkapan['nama_dokumen'] }}</td>
                                        <td>{{ $jenisDokumenKelengkapan['keterangan'] }}</td>

                                        @if ($jenisDokumenKelengkapan['dokumen_sistem'] == 'ya')
                                            @if (count($jenisDokumenKelengkapan['kelengkapan_dokumen_vendors']) > 0)
                                                @if (isset($jenisDokumenKelengkapan['kelengkapan_dokumen_vendors'][0]['file_upload']))
                                                    <td>
                                                        <div class="row">
                                                            <div class="col">

                                                                <a href="{{ route('vendor.kelengkapan-dokumen.pdf', ['id' => $jenisDokumenKelengkapan['kelengkapan_dokumen_vendors'][0]['id_dokumen'], 'jenis' => 1]) }}"
                                                                    class="btn btn-primary">Detail</a>
                                                            </div>
                                                            <div class="col">
                                                                <a href="{{ route('vendor.kelengkapan-dokumen.pdf', ['id' => $jenisDokumenKelengkapan['kelengkapan_dokumen_vendors'][0]['id_dokumen'], 'jenis' => 2]) }}"
                                                                    class="btn btn-primary">Download</a>
                                                            </div>
                                                        </div>

                                                    </td>
                                                @else
                                                    <td>
                                                        Dokumen belum di tandatangani
                                                    </td>
                                                @endif
                                            @else
                                                <td>

                                                    Isian Dokumen Belum diisi
                                                </td>
                                            @endif
                                        @else
                                            @if (count($jenisDokumenKelengkapan['kelengkapan_dokumen_vendors']) > 0)
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <form method="POST"
                                                                action="{{ route('vendor.kelengkapandok.update', ['id' => $jenisDokumenKelengkapan['id_jenis'], 'id_kontrakkerja' => $id]) }}"
                                                                enctype="multipart/form-data" id="uploadForm">
                                                                @method('PUT')
                                                                @csrf
                                                                <div class="mb-3">
                                                                    <label for="fileUpload"
                                                                        class="btn btn-primary">Update</label>
                                                                    <input type="file" class="form-control"
                                                                        id="fileUpload" name="fileUpload" accept=".pdf"
                                                                        style="display: none;">


                                                                </div>






                                                            </form>
                                                        </div>
                                                        <div class="col">

                                                            <a href="{{ route('vendor.kelengkapan-dokumen.pdf', ['id' => $jenisDokumenKelengkapan['kelengkapan_dokumen_vendors'][0]['id_dokumen'], 'jenis' => 1]) }}"
                                                                class="btn btn-primary">Detail</a>
                                                        </div>
                                                        <div class="col">
                                                            <a href="{{ route('vendor.kelengkapan-dokumen.pdf', ['id' => $jenisDokumenKelengkapan['kelengkapan_dokumen_vendors'][0]['id_dokumen'], 'jenis' => 2]) }}"
                                                                class="btn btn-primary">Download</a>
                                                        </div>
                                                    </div>

                                                </td>
                                            @else
                                                <td>
                                                    <form method="POST"
                                                        action="{{ route('vendor.kelengkapandok.store', ['id' => $jenisDokumenKelengkapan['id_jenis'], 'id_kontrakkerja' => $id]) }}"
                                                        enctype="multipart/form-data" id="uploadForm">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label for="fileUpload" class="btn btn-primary">Upload File
                                                                PDF</label>
                                                            <input type="file" class="form-control" id="fileUpload"
                                                                name="fileUpload" accept=".pdf" style="display: none;">


                                                        </div>


                                                    </form>
                                                </td>
                                            @endif
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        Mohon konfirmasi apakah vendor setuju dengan persyaratan penawaran yang telah
                        disampaikan.
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
            </div>

        </div>

    @endsection
    @section('javascript')

        <script>
            var fileUploadList = document.querySelectorAll('#fileUpload');

            var uploadForm = document.querySelectorAll('#uploadForm');
            fileUploadList.forEach((fileUpload, index) => {
                fileUpload.addEventListener('change', function(event) {
                    var confirmation = confirm('Apakah Anda yakin ingin mengupload dokumen?');
                    console.log(index);
                    if (confirmation) {
                        uploadForm[index].submit();

                    }

                });
            });
        </script>

    @endsection
