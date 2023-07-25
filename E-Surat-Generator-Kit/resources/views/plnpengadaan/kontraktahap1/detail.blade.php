@extends('template.app')

@section('title', 'Detail Kontrak')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Detail Kontrak</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <div class="row">
            <div class="col-12">
                {{-- Informasi kontrak --}}
                <div class="card">
                    <div class="card-header">
                        Informasi Kontrak


                    </div>
                    <div class="card-body">


                        <style>
                            td,
                            th {

                                vertical-align: middle;
                            }
                        </style>
                        <table class="table table-stripped ">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama informasi</th>
                                    <th scope="col">Isi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                <tr>
                                    <th scope="col" style="width: 10%;">{{ $no++ }}</th>
                                    <td style="width: 45%;">Nama Kontrak</td>
                                    <td style="width: 45%;">{{ $kontrak->nama_kontrak }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>No Urut</td>
                                    <td>{{ $kontrak->no_urut }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Tahun</td>
                                    <td>{{ $kontrak->tahun }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Lama Pekerjaan</td>
                                    <td>{{ $kontrak->lama_pekerjaan }} Hari</td>
                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Kode Masalah</td>
                                    <td>{{ $kontrak->kode_masalah }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Lokasi Pekerjaan</td>
                                    <td>{{ $kontrak->lokasi_pekerjaan }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Tanggal SPMK</td>
                                    <td>{{ $kontrak->tanggal_spmk }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Nomor SPMK</td>
                                    <td>{{ $kontrak->nomor_spmk }}</td>
                                </tr>

                            </tbody>
                        </table>


                    </div>
                </div>
                {{-- Sumber Anggaran --}}
                <div class="card">
                    <div class="card-header">
                        Informasi Sumber Anggaran


                    </div>
                    <div class="card-body">
                        <style>
                            td,
                            th {

                                vertical-align: middle;
                            }
                        </style>
                        <table class="table table-stripped ">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%;">#</th>
                                    <th scope="col" style="width: 45%;">Nama informasi</th>
                                    <th scope="col" style="width: 45%;">Isi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>SKK-AO</td>
                                    <td>{{ $kontrak->skk_ao }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Tanggal Anggaran</td>
                                    <td>{{ $kontrak->tanggal_anggaran }}
                                    </td>
                                </tr>


                            </tbody>
                        </table>


                    </div>
                </div>

                {{-- Vendor --}}
                <div class="card">
                    <div class="card-header">
                        Informasi Vendor


                    </div>
                    <div class="card-body">
                        <style>
                            td,
                            th {

                                vertical-align: middle;
                            }
                        </style>
                        <table class="table table-stripped ">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%;">#</th>
                                    <th scope="col" style="width: 45%;">Nama informasi</th>
                                    <th scope="col" style="width: 45%;">Isi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Penyedia</td>
                                    <td>{{ $kontrak->penyedia }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Direktur</td>
                                    <td>{{ $kontrak->direktur }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Alamat</td>
                                    <td>{{ $kontrak->alamat_jalan . ' , ' . $kontrak->alamat_kota . ' , ' . $kontrak->alamat_provinsi }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Bank</td>
                                    <td>{{ $kontrak->nama_bank }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Nomor Rekening</td>
                                    <td>{{ $kontrak->nomor_rekening }}</td>
                                </tr>


                            </tbody>
                        </table>


                    </div>
                </div>

                {{-- Penyelenggara --}}
                <div class="card">
                    <div class="card-header">
                        Informasi Penyelenggara


                    </div>
                    <div class="card-body">
                        <style>
                            td,
                            th {

                                vertical-align: middle;
                            }
                        </style>
                        <table class="table table-stripped ">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%;">#</th>
                                    <th scope="col" style="width: 45%;">Nama informasi</th>
                                    <th scope="col" style="width: 45%;">Isi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Manager</td>
                                    <td>{{ $kontrak->manager }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Pengawas Lapangan</td>
                                    <td>{{ $kontrak->pengawas_lapangan }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Pejabat Pelaksana Pengadaan</td>
                                    <td>{{ $kontrak->pejabat_pelaksana_pengadaan }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Pengawas K3</td>
                                    <td>{{ $kontrak->pengawas_k3 }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Direksi</td>
                                    <td>{{ $kontrak->direksi }}</td>
                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Pengawas Pekerjaan</td>
                                    <td>{{ $kontrak->pengawas_pekerjaan }}</td>
                                </tr>

                            </tbody>
                        </table>


                    </div>
                </div>
                {{-- Tanggal Pengerjaan Surat Kontrak --}}
                <div class="card">
                    <div class="card-header">
                        Informasi Pengerjaan Surat Kontrak Pengadaan


                    </div>
                    <div class="card-body">
                        <style>
                            td,
                            th {

                                vertical-align: middle;
                            }
                        </style>
                        <table class="table table-stripped ">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%;">#</th>
                                    <th scope="col" style="width: 30%;">Nama informasi</th>
                                    <th scope="col" style="width: 30%;">Tanggal</th>
                                    <th scope="col" style="width: 30%;">Nomor Surat</th>


                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Tanggal RKS (Rencana Kerja Syarat)</td>
                                    <td>{{ $kontrak->tanggal_rks }}</td>
                                    <td>{{ $kontrak->nomor_rks }}</td>

                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Tanggal HPS (Harga Perkiraan Sendiri)</td>
                                    <td>{{ $kontrak->tanggal_hps }}</td>
                                    <td>{{ $kontrak->nomor_hps }}</td>

                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Tanggal Pakta Pejabat</td>
                                    <td>{{ $kontrak->tanggal_pakta_pejabat }}</td>
                                    <td>{{ $kontrak->nomor_pakta_pejabat }}</td>


                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Tanggal Pakta Pengguna</td>
                                    <td>{{ $kontrak->tanggal_pakta_pengguna }}</td>
                                    <td>{{ $kontrak->nomor_pakta_pengguna }}</td>

                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Tanggal Undangan</td>
                                    <td>{{ $kontrak->tanggal_undangan }}</td>
                                    <td>{{ $kontrak->nomor_undangan }}</td>

                                </tr>
                                <br>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Batas Akhir Penginputan Dokumen Penawaran</td>
                                    <td colspan="2">{{ $kontrak->tanggal_undangan }}</td>
                                    {{-- <td>{{ $kontrak->nomor_undangan }}</td> --}}

                                </tr>

                                <br>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Tanggal BA Buka</td>
                                    <td>{{ $kontrak->tanggal_ba_buka }}</td>
                                    <td>{{ $kontrak->nomor_ba_buka }}</td>

                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Tanggal BA Evaluasi</td>
                                    <td>{{ $kontrak->tanggal_ba_evaluasi }}</td>
                                    <td>{{ $kontrak->nomor_ba_evaluasi }}</td>

                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Tanggal BA Negosiasi</td>
                                    <td>{{ $kontrak->tanggal_ba_negosiasi }}</td>
                                    <td>{{ $kontrak->nomor_ba_negosiasi }}</td>

                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Tanggal BA Hasil PL</td>
                                    <td>{{ $kontrak->tanggal_ba_hasil_pl }}</td>
                                    <td>{{ $kontrak->nomor_ba_hasil_pl }}</td>

                                </tr>
                                <tr>
                                    <th scope="col">{{ $no++ }}</th>
                                    <td>Tanggal SPK</td>
                                    <td>{{ $kontrak->tanggal_spk }}</td>
                                    <td>{{ $kontrak->nomor_spk }}</td>

                                </tr>

                            </tbody>
                        </table>


                    </div>
                </div>


                {{-- Data Barang dan Jasa --}}
                <div class="card">
                    <div class="card-header">
                        Data Barang dan Jasa Pengadaan
                    </div>
                    <div class="card-body">
                        <style>
                            td,
                            th {

                                vertical-align: middle;
                            }
                        </style>
                        <table class="table table-stripped ">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%;">#</th>
                                    <th scope="col" style="width: 45%;">Barang dan Jasa</th>
                                    <th scope="col" style="width: 45%;">Aksi</th>

                                </tr>
                            </thead>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($jenis_kontrak as $j)
                                <tbody>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $j->nama_jenis }}</td>
                                        <td><a href="{{ route('subkontrak.show', ['id_kontrakkerja' => $id, 'id_jenis' => $j->id]) }}"
                                                class="btn btn-primary">Aksi</a></td>
                                    </tr>

                                </tbody>
                            @endforeach

                        </table>
                    </div>
                </div>
                @if ($kontrak->banyakbarangdanjasa > 0)
                    <div class="card">
                        <div class="card-header">
                            Dokumen Pengadaan
                           

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
                                            <th scope="col" style="width: 10%;">#</th>
                                            <th scope="col" style="width: 45%;">Nama Dokumen</th>
                                            <th scope="col" style="width: 45%;">Aksi</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="background: #743461;color: #ffffff;">
                                            <td colspan="3" style="text-align: center;">Pengadaan Tahap 1</td>
                                        </tr>
                                        @php
                                            $no = 1;
                                        @endphp
                                        <tr>
                                            <th scope="col">{{ $no++ }}</th>
                                            <td>HPS (Harga Perkiraan Sendiri)</td>
                                            <td>
                                                <a href="{{ route('pengajuankontrak.hps.isi', ['id' => $kontrakkerja->id_kontrakkerja]) }}"
                                                    class="btn btn-primary">Isi HPS</a>

                                                <a href="{{ route('pengajuankontrak.hps.detail', ['id' => $kontrakkerja->id_kontrakkerja, 'isDownload' => 1]) }}"
                                                    class="btn btn-primary">Detail</a>


                                                <a href="{{ route('pengajuankontrak.hps.detail', ['id' => $kontrakkerja->id_kontrakkerja, 'isDownload' => 2]) }}"
                                                    class="btn btn-primary">Download</a>
                                            </td>
                                        </tr>
                                        <tr style="background: #743461;color: #ffffff;">
                                            <td colspan="3" style="text-align: center;">Surat Vendor</td>
                                        </tr>
                                        <tr>
                                            <th scope="col">{{ $no++ }}</th>
                                            <td>Undangan</td>
                                            <td><a href="{{ route('pengajuankontrak.undangan', ['id' => $kontrakkerja->id_kontrakkerja, 'isDownload' => 1]) }}"
                                                    class="btn btn-primary">Preview</a>
                                                <a href="{{ route('pengajuankontrak.undangan', ['id' => $kontrakkerja->id_kontrakkerja, 'isDownload' => 2]) }}"
                                                    class="btn btn-primary">Download</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">{{ $no++ }}</th>
                                            <td>RKS (Rencana Kerja Syarat)</td>
                                            <td><a href="{{ route('pengajuankontrak.rks', ['id' => $kontrakkerja->id_kontrakkerja, 'isDownload' => 1]) }}"
                                                    class="btn btn-primary">Preview</a>
                                                <a href="{{ route('pengajuankontrak.rks', ['id' => $kontrakkerja->id_kontrakkerja, 'isDownload' => 2]) }}"
                                                    class="btn btn-primary">Download</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col">{{ $no++ }}</th>
                                            <td>BOQ</td>
                                            <td>
                                                <a href="{{ route('pengajuankontrak.boq.detail', ['id' => $kontrakkerja->id_kontrakkerja, 'isDownload' => 1]) }}"
                                                    class="btn btn-primary">Detail</a>


                                                <a href="{{ route('pengajuankontrak.boq.detail', ['id' => $kontrakkerja->id_kontrakkerja, 'isDownload' => 2]) }}"
                                                    class="btn btn-primary">Download</a>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>


                            </div>
                        </div>








                    </div>

                    <div class="card">
                        <div class="card-header">

                            Dengan mengklik tombol "Kirim", Anda akan menandatangani kontrak dan kontrak kerja akan dimulai.
                            Terima kasih atas perhatiannya.
                        </div>
                        <div class="card-body">
                            <div class="btn-group me-2" role="group" aria-label="Tombol gabungan">
                                <a href="{{ route('pengajuankontrak.index') }}" class="btn btn-info">Kembali</a>
                                <form
                                    action="{{ route('changestatus', ['id' => $kontrakkerja->id_kontrakkerja, 'status' => 'Validasi Dokumen Pengadaan Tahap 1', 'routeName' => 'pengajuankontrak.index']) }}"
                                    method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

        </div>
    @endsection
