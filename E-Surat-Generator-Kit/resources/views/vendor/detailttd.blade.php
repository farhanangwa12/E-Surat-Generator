@extends('template.app')

@section('title', 'Detail Kontrak')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Detail Kontrak</h1>

        {{-- Surat Undangan --}}
        <div class="card">
            <div class="card-header">
                Undangan
            </div>
            <div class="card-body  d-flex justify-content-center align-items-center">
                <iframe src="{{ route('pengajuankontrak.undangan', ['id' => $id, 'isDownload' => '1']) }}" width="80%"
                    height="500px" frameborder="0"></iframe>

            </div>
        </div>
        {{-- Surat BOQ --}}
        <div class="card">
            <div class="card-header">
                BOQ
            </div>
            <div class="card-body  d-flex justify-content-center align-items-center">
                <iframe src="{{ route('pengajuankontrak.boq.detail', ['id' => $id, 'isDownload' => 1]) }}" width="80%"
                    height="500px" frameborder="0"></iframe>

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

        {{-- Surat BANego --}}
        <div class="card">

            <div class="card-header">
                BANego

            </div>
            <div class="card-body  d-flex justify-content-center align-items-center">
                <iframe src="{{ route('banego.show', ['id' => $kontrakkerja->id_kontrakkerja, 'isDownload' => 1]) }}"
                    width="80%" height="500px" frameborder="0"></iframe>

            </div>
        </div>
        {{-- Surat RKS --}}
        <div class="card">

            <div class="card-header">
                Lamp Nego

            </div>
            <div class="card-body  d-flex justify-content-center align-items-center">
                <iframe src="{{ route('lampnego.show', ['id' => $kontrakkerja->id_kontrakkerja, 'isDownload' => 1]) }}"
                    width="80%" height="500px" frameborder="0"></iframe>

            </div>
        </div>
        {{-- Surat Cover --}}
        <div class="card">

            <div class="card-header">
                Cover

            </div>
            <div class="card-body  d-flex justify-content-center align-items-center">
                <iframe src="{{ route('cover.show', ['id' => $kontrakkerja->id_kontrakkerja, 'isDownload' => 1]) }}"
                    width="80%" height="500px" frameborder="0"></iframe>

            </div>
        </div>

        {{-- Surat Sampul --}}
        <div class="card">

            <div class="card-header">
                Sampul

            </div>
            <div class="card-body  d-flex justify-content-center align-items-center">
                <iframe src="{{ route('sampul.show', ['id' => $kontrakkerja->id_kontrakkerja, 'isDownload' => 1]) }}"
                    width="80%" height="500px" frameborder="0"></iframe>

            </div>
        </div>
         {{-- Surat SPKBJ --}}
         <div class="card">

            <div class="card-header">
                SPKBJ

            </div>
            <div class="card-body  d-flex justify-content-center align-items-center">
                <iframe src="{{ route('spkbj.show', ['id' => $kontrakkerja->id_kontrakkerja, 'isDownload' => 1]) }}"
                    width="80%" height="500px" frameborder="0"></iframe>

            </div>
        </div>

        {{-- Surat L-SPK --}}
        <div class="card">

            <div class="card-header">
                L-SPK

            </div>
            <div class="card-body  d-flex justify-content-center align-items-center">
                <iframe src="{{ route('lspk.show', ['id' => $kontrakkerja->id_kontrakkerja, 'isDownload' => 1]) }}"
                    width="80%" height="500px" frameborder="0"></iframe>

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
                                            Belum di Upload
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
            <div class="card-body">

                <a href="{{ route('vendor.kontrakkerja') }}" class="btn btn-primary">Kembali</a>
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
