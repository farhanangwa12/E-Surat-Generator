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
                {{-- Surat BOQ (Bill Of Quantity) --}}
                <div class="card">
                    <div class="card-header">
                        BOQ (Bill Of Quantity)
                    </div>
                    <div class="card-body  d-flex justify-content-center align-items-center">
                        <iframe src="{{ route('pengajuankontrak.boq.detail', ['id' => $id, 'isDownload' => 1]) }}"
                            width="80%" height="500px" frameborder="0"></iframe>

                    </div>
                </div>
                {{-- Surat RKS (Rencana Kerja Syarat) --}}
                <div class="card">

                    <div class="card-header">
                        RKS (Rencana Kerja Syarat)

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
                                    {{-- <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>RKS</td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('rks.isi', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Isi
                                                RKS</a>
                                        </td>
                                    </tr> --}}
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>BOQ (Bill Of Quantity)</td>
                                        <td>
                                            {{-- <a href="{{ route('boqtandatanganvendor', ['id' => $kontrakkerja->id_kontrakkerja]) }}"
                                                class="btn btn-primary">Tanda Tangan BOQ (Bill Of Quantity)</a> --}}
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
                                                href="{{ route('vendor.formpenawaranharga.create', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Isi
                                                Form Penawaran</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.formpenawaranharga.halamanttd', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Halamanttd</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('vendor.formpenawaranharga.pdf',  ['id' => $kontrakkerja->id_kontrakkerja, 'jenis' => 1]) }}">Tampilan
                                                PDF</a>
                                        </td>
                                    </tr>

                                    @if ($statusformpenawaran)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>Lampiran Penawaran Harga</td>
                                            <td>
                                                {{-- <a class="btn btn-primary"
                                                href="{{ route('vendor.lampiranpenawaranharga.create', $kontrakkerja->id_kontrakkerja) }}">Isi
                                                Lampiran Penawaran Harga</a> --}}
                                                <a class="btn btn-primary"
                                                    href="{{ route('vendor.lampiranpenawaranharga.halamanttd', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Halamanttd</a>
                                                <a class="btn btn-primary"
                                                    href="{{ route('vendor.lampiranpenawaranharga.pdf', ['id' => $kontrakkerja->id_kontrakkerja, 'jenis' => 1]) }}">Tampilan
                                                    PDF</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>Paktavendor</td>
                                            <td>
                                                {{-- <a class="btn btn-primary"
                                                    href="{{ route('vendor.paktavendor.create', $kontrakkerja->id_kontrakkerja) }}">Isi
                                                    Paktavendor</a> --}}
                                                <a class="btn btn-primary"
                                                    href="{{ route('vendor.paktavendor.halamanttd', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Halamanttd</a>
                                                <a class="btn btn-primary"
                                                    href="{{ route('vendor.paktavendor.pdf',  ['id' => $kontrakkerja->id_kontrakkerja, 'jenis' => 1]) }}">Tampilan
                                                    PDF</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>Pernyataan Garansi</td>
                                            <td>
                                                {{-- <a class="btn btn-primary"
                                                    href="{{ route('vendor.pernyataan.garansi.create', $kontrakkerja->id_kontrakkerja) }}">Isi
                                                    Pernyataan Garansi</a> --}}
                                                <a class="btn btn-primary"
                                                    href="{{ route('vendor.pernyataan.garansi.halamanttd', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Halamanttd</a>
                                                <a class="btn btn-primary"
                                                    href="{{ route('vendor.pernyataan.garansi.pdf',  ['id' => $kontrakkerja->id_kontrakkerja, 'jenis' => 1]) }}">Tampilan
                                                    PDF</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>Pernyataan Sanggup</td>
                                            <td>
                                                {{-- <a class="btn btn-primary"
                                                    href="{{ route('vendor.pernyataan.sangup.create', $kontrakkerja->id_kontrakkerja) }}">Isi
                                                    Pernyataan Sanggup</a> --}}
                                                <a class="btn btn-primary"
                                                    href="{{ route('vendor.pernyataan.sangup.halamanttd', ['id' => $kontrakkerja->id_kontrakkerja]) }}">Halamanttd</a>
                                                <a class="btn btn-primary"
                                                    href="{{ route('vendor.pernyataan.sangup.pdf',  ['id' => $kontrakkerja->id_kontrakkerja, 'jenis' => 1]) }}">Tampilan
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
                                                    href="{{ route('vendor.datapengalaman.pdf',  ['id' => $kontrakkerja->id_kontrakkerja, 'jenis' => 1]) }}">Tampilan
                                                    PDF</a>
                                            </td>
                                        </tr>
                                    @endif
                                    {{-- <tr>
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

                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>











                </div>

                @if ($statusformpenawaran)
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
                                                                    enctype="multipart/form-data"
                                                                    id="uploadForm{{ 'Update' . $jenisDokumenKelengkapan['id_jenis'] }}"
                                                                    class="formuntukUpload">
                                                                    @method('PUT')
                                                                    @csrf
                                                                    <div class="mb-3">
                                                                        <label
                                                                            for="fileUpload{{ 'Update' . $jenisDokumenKelengkapan['id_jenis'] }}"
                                                                            onclick="uploadFile('Update{{ $jenisDokumenKelengkapan['id_jenis'] }}')"
                                                                            class="btn btn-primary">Update</label>
                                                                        <input type="file" class="form-control"
                                                                            id="fileUpload{{ 'Update' . $jenisDokumenKelengkapan['id_jenis'] }}"
                                                                            name="fileUpload" accept=".pdf"
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
                                                            <div class="col">
                                                                <form
                                                                    action="{{ route('vendor.kelengkapandok.destroy', ['id' => $jenisDokumenKelengkapan['kelengkapan_dokumen_vendors'][0]['id_dokumen'], 'id_kontrakkerja' => $id]) }}"
                                                                    method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button class="btn btn-danger"
                                                                        onclick="confirmation('Apakah anda yakin ingin menghapus ?')">Hapus</button>

                                                                </form>

                                                            </div>
                                                        </div>

                                                    </td>
                                                @else
                                                    <td>
                                                        <form method="POST"
                                                            action="{{ route('vendor.kelengkapandok.store', ['id' => $jenisDokumenKelengkapan['id_jenis'], 'id_kontrakkerja' => $id]) }}"
                                                            enctype="multipart/form-data"
                                                            id="uploadForm{{ 'Store' . $jenisDokumenKelengkapan['id_jenis'] }}"
                                                            class="formuntukUpload">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label
                                                                    for="fileUpload{{ 'Store' . $jenisDokumenKelengkapan['id_jenis'] }}"
                                                                    onclick="uploadFile('Store{{ $jenisDokumenKelengkapan['id_jenis'] }}')"
                                                                    class="btn btn-primary">Upload
                                                                    File
                                                                    PDF</label>
                                                                <input type="file" class="form-control"
                                                                    id="fileUpload{{ 'Store' . $jenisDokumenKelengkapan['id_jenis'] }}"
                                                                    name="fileUpload" accept=".pdf"
                                                                    style="display: none;">


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
                @endif


                <div class="card">
                    <div class="card-header">
                        Setelah tombol kirim ditekan, informasi akan langsung dikirimkan ke
                        pihak PLN untuk proses
                        penawaran harga. Proses ini tidak dapat dibatalkan. Mohon konfirmasi
                        apakah vendor yakin
                        akan melanjutkan.

                    </div>
                    <div class="card-body">

                        <div class="btn-group me-2" role="group" aria-label="Tombol gabungan">
                            <a href="{{ route('isikontrak') }}" class="btn btn-info">Kembali</a>
                            @if ($statusformpenawaran)
                                <form
                                    action="{{ route('changestatus', ['id' => $kontrakkerja->id_kontrakkerja, 'status' => 'Dokumen Input Pengadaan Tahap 2', 'routeName' => 'isikontrak']) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>


            </div>

        </div>

    @endsection
    @section('javascript')
        <script>
            function uploadFile(formId) {
                var form = document.getElementById("uploadForm" + formId);
                var fileInput = document.querySelector("#fileUpload" + formId);


                fileInput.addEventListener('change', function(event) {

                    var file = fileInput.files[0];

                    if (file) {
                        var confirmation = confirm('Apakah Anda yakin ingin mengupload dokumen baru?');

                        if (confirmation) {
                            form.submit();
                        } else {
                            // Menghapus file yang dipilih jika tidak dikonfirmasi
                            fileInput.value = "";
                        }
                    }
                });
            }
        </script>


        {{-- <script>
            var fileUploadListStore = document.getElementById('fileUploadStore');
            var fileUploadListUpdate = document.querySelectorAll('#fileUploadUpdate');


            var formUploadListUpdate = document.querySelectorAll('#uploadFormUpdate');
            var formUploadListStore = document.querySelectorAll('#uploadFormStore');

            // var formUploadList = document.querySelectorAll('.formuntukUpload');

            console.log('test :', fileUploadListStore[0]);
            fileUploadListStore.forEach((fileUpload, index) => {
                fileUpload.addEventListener('change', function(event) {
                    var confirmation = confirm('Apakah Anda yakin ingin mengupload dokumen baru?');
                    console.log(index);
                    if (confirmation) {
                        console.log(formUploadListStore[index]);
                        formUploadListStore[index].submit();

                    }

                });
            });


            fileUploadListUpdate.forEach((fileUpload, index) => {
                fileUpload.addEventListener('change', function(event) {
                    var confirmation = confirm('Apakah Anda yakin ingin memperbarui dokumen?');
                    console.log(index);
                    if (confirmation) {
                        console.log(formUploadListUpdate[index]);
                        formUploadListUpdate[index].submit();

                    }

                });
            });
        </script> --}}

    @endsection
