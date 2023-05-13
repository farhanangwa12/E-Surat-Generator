@extends('template.app')

@section('title', 'Tambah Kontrak')

@section('content')
    <div class="container-fluid p-0">
      
        <h1 class="h3 mb-3">Tambah Kontrak</h1>

        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('pengajuankontrak.store') }}">
                    @csrf
                    {{-- Detail Kontrak --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            Detail Kontrak
                        </div>


                        <div class="card-body">
                            <div class="row align-item-start mb-3">

                                <div class="form-group col">
                                    <label for="nama_kontrak">Nama Kontrak</label>
                                    <textarea cols="15" rows="10" name="nama_kontrak" class="form-control" id="nama_kontrak"
                                        placeholder="Masukkan nama kontrak"></textarea>

                                </div>


                            </div>
                            <div class="row align-item-start mb-3">
                                <div class="form-group col">
                                    <label for="no_urut">No Urut</label>
                                    <input type="number" name="no_urut" class="form-control" id="no_urut"
                                        placeholder="Masukkan no urut">
                                </div>
                                <div class="form-group col">
                                    <label for="tahun">Tahun</label>
                                    <input type="number" name="tahun" class="form-control" id="tahun"
                                        value="{{ date('Y') }}" placeholder="Masukkan nama tahun">
                                </div>

                            </div>


                            <div class="row align-item-start justify-content-end mb-3">
                                <div class="form-group col">
                                    <label for="lama_pekerjaan">Lama Pekerjaan</label>
                                    <input type="number" name="lama_pekerjaan" class="form-control" id="lama_pekerjaan"
                                        placeholder="Masukkan berapa hari pekerjaan">
                                </div>
                                <div class="form-group col">
                                    <label for="kode_masalah">Kode Masalah</label>

                                    <select class="form-select" aria-label="Kode Masalah " name="kode_masalah" id="kode_masalah">
                                        <option selected>=== PILIH SALAH SATU ==</option>
                                        <option value="DAN.01.01">Pengadaan Barang</option>
                                        <option value="DAN.01.02">Pengadaan Jasa</option>
                                        <option value="DAN.01.03">Pengadaan Barang & Jasa</option>
                                    </select>

                                </div>

                            </div>
                            <div class="row align-item-start justify-content-end mb-3">
                                <div class="form-group col">
                                    <label for="lokasi_pekerjaan">Lokasi Pekerjaan</label>
                                    <input type="text" name="lokasi_pekerjaan" class="form-control" id="lokasi_pekerjaan"
                                        placeholder="Masukkan nama lokasi">
                                </div>


                            </div>

                            {{-- <div class="row align-item-start mb-3">
                                <div class="form-group col">
                                    <label for="tanggal_pekerjaan">Tanggal Awal</label>
                                    <input type="date" name="tanggal_pekerjaan" class="form-control"
                                        id="tanggal_pekerjaan" placeholder="Masukkan tanggal awal">
                                </div>

                                <div class="form-group col">
                                    <label for="tanggal_akhir_pekerjaan">Tanggal Akhir</label>
                                    <input type="date" name="tanggal_akhir_pekerjaan" class="form-control"
                                        id="tanggal_akhir_pekerjaan" placeholder="Masukkan tanggal akhir">
                                </div>



                            </div> --}}

                            <div class="row align-item-start mb-3">
                                <div class="form-group col">
                                    <label for="tanggal_spmk">Tanggal SPMK</label>
                                    <input type="date" name="tanggal_spmk" class="form-control" id="tanggal_spmk"
                                        placeholder="Masukkan tanggal awal">
                                </div>
                                <div class="form-group col">
                                    <label for="nomor_spmk">No SPMK</label>
                                    <input type="text" name="nomor_spmk" class="form-control" id="nomor_spmk"
                                        placeholder="Masukkan nomor kontrak">
                                </div>

                            </div>


                        </div>
                    </div>

                    {{-- Sumber Anggaran --}}
                    <div class="card">
                        <div class="card-header">
                            Sumber Anggaran
                        </div>


                        <div class="card-body">
                            <div class="row align-item-start mb-3">

                                <div class="form-group col">
                                    <label for="skk-ao">SKK-AO</label>
                                    <input type="text" name="skk-ao" class="form-control" id="skk-ao"
                                        placeholder="Masukkan SKK-AO">
                                </div>

                            </div>
                            <div class="row align-item-start mb-3">

                                <div class="form-group col">
                                    <label for="tanggal_anggaran">Tanggal Anggaran</label>
                                    <input type="date" name="tanggal_anggaran" class="form-control" id="tanggal_anggaran"
                                        placeholder="Masukkan Tanggal Anggaran">
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- Vendor --}}
                    <div class="card">
                        <div class="card-header">
                            Detail Vendor
                        </div>


                        <div class="card-body">
                            <div class="row align-item-start mb-3">
                                <div class="form-group col">
                                    <label for="ven">Vendor</label>

                                    <select class="form-select" aria-label="ven" name="ven" id="ven">
                                        <option value="" selected>=== PILIH SALAH SATU ==</option>
                                        @foreach ($vendor as $item)
                                            <option value="{{ $item->id_vendor }}">{{ $item->penyedia }}</option>
                                        @endforeach
                                    </select>




                                </div>

                                <div class="form-group col">
                                    <label for="penyedia">Penyedia Barang / Jasa</label>
                                    <input type="text" name="penyedia" class="form-control" id="penyedia"
                                        placeholder="Masukkan data vendor" readonly>
                                </div>


                            </div>
                            <div class="row align-item-start mb-3">
                                {{-- <span class="col"></span> --}}
                                <div class="form-group col">
                                    <label for="direktur">Direktur</label>
                                    <input type="text" name="direktur" class="form-control" id="direktur"
                                        placeholder="Masukkan Nama Direktur" readonly>
                                </div>
                                <div class="form-group col">
                                    <label for="alamat">Alamat </label>
                                    <div class="row align-start">
                                        <div class="col">
                                            <input type="text" class="form-control" id="alamat_jalan"
                                                name="alamat_jalan" placeholder="Contoh : Jalan Panglima" readonly>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" id="alamat_kota"
                                                name="alamat_kota" placeholder="Contoh : Madiun" readonly>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" id="alamat_provinsi"
                                                name="alamat_provinsi" placeholder="Contoh : Jawa Timur" readonly>
                                        </div>





                                    </div>
                                </div>



                            </div>
                            <div class="row align-item-start mb-3">
                                <div class="form-group col">
                                    <label for="nama_bank">BANK</label>
                                    <input type="text" name="nama_bank" class="form-control" id="nama_bank"
                                        placeholder="Masukkan Nama Bank" readonly>
                                </div>

                                <div class="form-group col">
                                    <label for="nomor_rekening">Nomor Rekening</label>
                                    <input type="nomor" name="nomor_rekening" class="form-control" id="nomor_rekening"
                                        placeholder="Masukkan Nomor Rekening" readonly>
                                </div>




                            </div>
                        </div>
                    </div>


                    {{-- Detail Penyelenggaran --}}
                    <div class="card">
                        <div class="card-header">
                            Detail Penyelenggara
                        </div>


                        <div class="card-body">
                            <div class="row align-item-start mb-3">
                                <div class="form-group col">
                                    <label for="manager">Manager</label>
                                    <input type="text" name="manager" class="form-control" id="manager"
                                        placeholder="Masukkan nama manager">
                                </div>
                                <div class="form-group col">
                                    <label for="pengawas_lapangan">Pengawas Lapangan</label>
                                    <input type="text" name="pengawas_lapangan" class="form-control"
                                        id="pengawas_lapangan" placeholder="Masukkan nama pengawas lapangan">
                                </div>

                            </div>
                            <div class="row align-item-start mb-3">
                                <div class="form-group col">
                                    <label for="pejabat_pelaksana_pengadaan">Pejabat Pelaksana Pengadaan</label>
                                    <input type="text" name="pejabat_pelaksana_pengadaan" class="form-control"
                                        id="pejabat_pelaksana_pengadaan"
                                        placeholder="Masukkan Pejabat Pelaksana Pengadaan">
                                </div>
                                <div class="form-group col">
                                    <label for="pengawas_k3">Pengawas K3</label>
                                    <input type="text" name="pengawas_k3" class="form-control" id="pengawas_k3"
                                        placeholder="Masukkan pengawas k3">
                                </div>

                            </div>
                            <div class="row align-item-start mb-3">
                                <div class="form-group col">
                                    <label for="direksi">Direksi</label>
                                    <input type="text" name="direksi" class="form-control" id="direksi"
                                        placeholder="Masukkan nama direksi">
                                </div>
                                <div class="form-group col">
                                    <label for="pengawas_pekerjaan">Pengawas Pekerjaan</label>
                                    <input type="text" name="pengawas_pekerjaan" class="form-control"
                                        id="pengawas_pekerjaan" placeholder="Masukkan nomor kontrak">
                                </div>

                            </div>







                        </div>
                    </div>



                    {{-- Detail Surat Pendukung --}}
                    <div class="card">
                        <div class="card-header">
                            Tanggal Pengurusan Dokumen Pengadaan
                        </div>


                        {{-- <div class="card-body">





                            <div class="row align-item-start mb-3">
                                <div class="form-group">
                                    <label for="rks">Tanggal Speck/RKS</label>
                                    <input type="date" name="rks" class="form-control" id="rks"
                                        placeholder="Masukkan nama direksi">
                                </div>
                                <div class="form-group col">
                                    <label for="hps">Tanggal HPS</label>
                                    <input type="date" name="hps" class="form-control" id="hps"
                                        placeholder="Masukkan hps">
                                </div>

                            </div>

                            <div class="row align-item-start mb-3">
                                <div class="form-group col">
                                    <label for="pakta_pejabat">Tanggal PAKTA PEJABAT</label>
                                    <input type="date" name="pakta_pejabat" class="form-control" id="pakta_pejabat"
                                        placeholder="Masukkan pakta pejabat">
                                </div>
                                <div class="form-group col">
                                    <label for="undangan">Tanggal Undangan</label>
                                    <input type="date" name="undangan" class="form-control" id="undangan"
                                        placeholder="Masukkan undangan">
                                </div>

                            </div>

                            <div class="row align-item-start mb-3">
                                <div class="form-group col">
                                    <label for="pakta_pejabat">Tanggal PAKTA PENGGUNA</label>
                                    <input type="date" name="pakta_pejabat" class="form-control" id="pakta_pejabat"
                                        placeholder="Masukkan pakta pejabat">
                                </div>
                                <div class="form-group col">
                                    <label for="ba_buka">tanggal BA Buka</label>
                                    <input type="date" name="ba_buka" class="form-control" id="ba_buka"
                                        placeholder="Masukkan ba buka">
                                </div>

                            </div>

                            <div class="row align-item-start mb-3">
                                <div class="form-group col">
                                    <label for="ba_negosiasi">Tanggal BA Negosiasi</label>
                                    <input type="date" name="ba_negosiasi" class="form-control" id="ba_negosiasi"
                                        placeholder="Masukkan ba negosiasi">
                                </div>
                                <div class="form-group col">
                                    <label for="ba_evaluasi">Tanggal BA Evaluasi</label>
                                    <input type="date" name="ba_evaluasi" class="form-control" id="ba_evaluasi"
                                        placeholder="Masukkan BA Evaluasi">
                                </div>

                            </div>
                            <div class="row align-item-start mb-3">
                                <div class="form-group col">
                                    <label for="spl">Tanggal SPL</label>
                                    <input type="text" name="spl" class="form-control" id="spl"
                                        placeholder="Masukkan SPL">
                                </div>
                                <div class="form-group col">
                                    <label for="ba_hasil_pl">Tanggal BA Hasil PL</label>
                                    <input type="text" name="ba_hasil_pl" class="form-control" id="ba_hasil_pl"
                                        placeholder="Masukkan BA hasil pl">
                                </div>

                            </div>
                            <div class="row align-item-start mb-3">
                                <div class="form-group col">
                                    <label for="spk">SPK
                                    </label>
                                    <input type="date" name="spk" class="form-control" id="spk"
                                        placeholder="Masukkan tanggal SPK">
                                </div>
                                <span class="col"></span>

                            </div>

                            <button type="submit" class="btn btn-primary col">Submit</button>



                        </div> --}}
                        <div class="card-body">

                            <div class="form-group mb-3">
                                <label for="rks">Speck/RKS</label>
                                <div class="row">
                                    <div class="col"><input type="text" name="nomor_rks" class="form-control"
                                            id="nomor_rks" placeholder="Nomor RKS" readonly></div>
                                    <div class="col"> <input type="date" name="tanggal_rks" class="form-control"
                                            id="tanggal_rks" placeholder="Masukkan nama rks"></div>

                                </div>

                            </div>
                            <div class="form-group mb-3">
                                <label for="hps">HPS</label>
                                <div class="row">
                                    <div class="col"><input type="text" name="nomor_hps" class="form-control"
                                            id="nomor_hps" placeholder="Nomor HPS" readonly></div>
                                    <div class="col"> <input type="date" name="tanggal_hps" class="form-control"
                                            id="tanggal_hps"></div>
                                </div>


                            </div>
                            <div class="form-group mb-3">
                                <label for="pakta_pejabat">PAKTA PEJABAT</label>

                                <div class="row">
                                    <div class="col"><input type="text" name="nomor_pakta_pejabat"
                                            class="form-control" id="nomor_pakta_pejabat" placeholder="Nomor HPS"
                                            readonly>
                                    </div>
                                    <div class="col"> <input type="date" name="tanggal_pakta_pejabat"
                                            class="form-control" id="tanggal_pakta_pejabat"></div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="undangan">Undangan</label>
                                <div class="row">
                                    <div class="col"><input type="text" name="nomor_undangan" class="form-control"
                                            id="nomor_undangan" placeholder="Nomor HPS" readonly>
                                    </div>
                                    <div class="col"> <input type="date" name="tanggal_undangan"
                                            class="form-control" id="tanggal_undangan"></div>
                                </div>


                            </div>
                            <div class="form-group mb-3">
                                <label for="pakta_pengguna">PAKTA PENGGUNA</label>
                                <div class="row">
                                    <div class="col"><input type="text" name="nomor_pakta_pengguna"
                                            class="form-control" id="nomor_pakta_pengguna" placeholder="Nomor HPS"
                                            readonly>
                                    </div>
                                    <div class="col"> <input type="date" name="tanggal_pakta_pengguna"
                                            class="form-control" id="tanggal_pakta_pengguna"></div>

                                </div>
                            </div>


                            <br>
                            <div class="form-group mb-3">
                                <label for="ba_buka">BA Buka</label>
                                <div class="row">
                                    <div class="col"><input type="text" name="nomor_ba_buka" class="form-control"
                                            id="nomor_ba_buka" placeholder="Nomor HPS" readonly>
                                    </div>
                                    <div class="col"> <input type="date" name="tanggal_ba_buka"
                                            class="form-control" id="tanggal_ba_buka"></div>

                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="ba_evaluasi">BA Evaluasi</label>
                                <div class="row">
                                    <div class="col"><input type="text" name="nomor_ba_evaluasi"
                                            class="form-control" id="nomor_ba_evaluasi" placeholder="Nomor HPS" readonly>
                                    </div>
                                    <div class="col"> <input type="date" name="tanggal_ba_evaluasi"
                                            class="form-control" id="tanggal_ba_evaluasi"></div>


                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="ba_negosiasi">BA Negosiasi</label>


                                <div class="row">
                                    <div class="col"><input type="text" name="nomor_ba_negosiasi"
                                            class="form-control" id="nomor_ba_negosiasi" placeholder="Nomor HPS"
                                            readonly>
                                    </div>
                                    <div class="col"> <input type="date" name="tanggal_ba_negosiasi"
                                            class="form-control" id="tanggal_ba_negosiasi"></div>
                                </div>
                            </div>


                            <div class="form-group mb-3">
                                <label for="ba_hasil_pl">BA Hasil PL</label>
                                <div class="row">

                                    <div class="col"><input type="text" name="nomor_ba_hasil_pl"
                                            class="form-control" id="nomor_ba_hasil_pl" placeholder="Nomor HPS" readonly>
                                    </div>
                                    <div class="col"> <input type="date" name="tanggal_ba_hasil_pl"
                                            class="form-control" id="tanggal_ba_hasil_pl"></div>

                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="spk">SPK
                                </label>

                                <div class="row">
                                    <div class="col"><input type="text" name="nomor_spk" class="form-control"
                                            id="nomor_spk" placeholder="Nomor HPS" readonly>
                                    </div>
                                    <div class="col"> <input type="date" name="tanggal_spk" class="form-control"
                                            id="tanggal_spk"></div>

                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary mb-3">Submit</button>



                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>

@endsection
@section('javascript')
    <script>
        // Ambil elemen input dengan id "penyedia" dan "direktur"
        const venSelect = document.getElementById("ven");



        // Tambahkan event listener untuk input dengan id "penyedia"
        venSelect.addEventListener("change", function() {
            // Saat pengguna selesai mengisi input dengan id "penyedia",
            // set nilai input dengan id "direktur" menjadi nilai dari input dengan id "penyedia"
            console.log(venSelect.value);
            if (venSelect.value === "") {
                document.getElementById('penyedia').value = "";
                document.getElementById('direktur').value = "";
                document.getElementById('alamat_jalan').value = "";
                document.getElementById('alamat_kota').value = "";
                document.getElementById('alamat_provinsi').value = "";
                document.getElementById('nama_bank').value = "";
                document.getElementById('nomor_rekening').value = "";


            } else {
                fetch("http://127.0.0.1:8000/api/vendor/" + venSelect.value)
                    .then(response => response.json())
                    .then(data => {

                        // data yang diambil dari API tersedia di sini

                        document.getElementById('penyedia').value = data.penyedia;
                        document.getElementById('direktur').value = data.direktur;
                        document.getElementById('alamat_jalan').value = data.alamat_jalan;
                        document.getElementById('alamat_kota').value = data.alamat_kota;
                        document.getElementById('alamat_provinsi').value = data.alamat_provinsi;
                        document.getElementById('nama_bank').value = data.bank;
                        document.getElementById('nomor_rekening').value = data.nomor_rek;




                    })
                    .catch(error => {
                        // error handling
                        console.error(error);
                    });
            }


        });
    </script>
    <script>
        const kodeMasalah = document.getElementById('kode_masalah');
        console.log('kodemasalah:',kodeMasalah);
        const NoUrut = document.getElementById('no_urut');
        console.log(NoUrut);

        const tahun = document.getElementById('tahun');
        console.log(tahun);


        kodeMasalah.addEventListener("change", function() {

            document.getElementById('nomor_rks').value = NoUrut.value + ".RKS/" + kodeMasalah.value + "/200900/" + tahun.value;
            document.getElementById('nomor_hps').value = NoUrut.value + ".HPS/" + kodeMasalah.value + "/UPKTIMOR/" + tahun.value;
            document.getElementById('nomor_pakta_pejabat').value = NoUrut.value + ".PI//" + kodeMasalah.value + "/UPKTIMOR/" + tahun.value;
            document.getElementById('nomor_undangan').value = NoUrut.value + ".UND/" + kodeMasalah.value + "/200900/" + tahun.value;
            document.getElementById('nomor_pakta_pengguna').value = NoUrut.value + ".PI/" + kodeMasalah.value + "/M-UPKTIMOR/" + tahun.value;
            document.getElementById('nomor_ba_buka').value = NoUrut.value + ".BA_PEMB/" + kodeMasalah.value + "/200900/" + tahun.value;
            document.getElementById('nomor_ba_evaluasi').value = NoUrut.value + ".BA-EVA/" + kodeMasalah.value + "/200900/" + tahun.value;
            document.getElementById('nomor_ba_negosiasi').value = NoUrut.value + ".BA-NEG/" + kodeMasalah.value + "/200900/" + tahun.value;
            document.getElementById('nomor_ba_hasil_pl').value = NoUrut.value + ".BA-HPL/" + kodeMasalah.value + "/200900/" + tahun.value;
            document.getElementById('nomor_spk').value = NoUrut.value + ".SPK/" + kodeMasalah.value + "/200900/" + tahun.value;
            
       
        });

        NoUrut.addEventListener("blur", function() {
          
            document.getElementById('nomor_rks').value = NoUrut.value + ".RKS/" + kodeMasalah.value + "/200900/" + tahun.value;
            document.getElementById('nomor_hps').value = NoUrut.value + ".HPS/" + kodeMasalah.value + "/UPKTIMOR/" + tahun.value;
            document.getElementById('nomor_pakta_pejabat').value = NoUrut.value + ".PI//" + kodeMasalah.value + "/UPKTIMOR/" + tahun.value;
            document.getElementById('nomor_undangan').value = NoUrut.value + ".UND/" + kodeMasalah.value + "/200900/" + tahun.value;
            document.getElementById('nomor_pakta_pengguna').value = NoUrut.value + ".PI/" + kodeMasalah.value + "/M-UPKTIMOR/" + tahun.value;
            document.getElementById('nomor_ba_buka').value = NoUrut.value + ".BA_PEMB/" + kodeMasalah.value + "/200900/" + tahun.value;
            document.getElementById('nomor_ba_evaluasi').value = NoUrut.value + ".BA-EVA/" + kodeMasalah.value + "/200900/" + tahun.value;
            document.getElementById('nomor_ba_negosiasi').value = NoUrut.value + ".BA-NEG/" + kodeMasalah.value + "/200900/" + tahun.value;
            document.getElementById('nomor_ba_hasil_pl').value = NoUrut.value + ".BA-HPL/" + kodeMasalah.value + "/200900/" + tahun.value;
            document.getElementById('nomor_spk').value = NoUrut.value + ".SPK/" + kodeMasalah.value + "/200900/" + tahun.value;
            
       
        });

        tahun.addEventListener("blur", function(event) {
           
            document.getElementById('nomor_rks').value = NoUrut.value + ".RKS/" + kodeMasalah.value + "/200900/" + tahun.value;
            document.getElementById('nomor_hps').value = NoUrut.value + ".HPS/" + kodeMasalah.value + "/UPKTIMOR/" + tahun.value;
            document.getElementById('nomor_pakta_pejabat').value = NoUrut.value + ".PI//" + kodeMasalah.value + "/UPKTIMOR/" + tahun.value;
            document.getElementById('nomor_undangan').value = NoUrut.value + ".UND/" + kodeMasalah.value + "/200900/" + tahun.value;
            document.getElementById('nomor_pakta_pengguna').value = NoUrut.value + ".PI/" + kodeMasalah.value + "/M-UPKTIMOR/" + tahun.value;
            document.getElementById('nomor_ba_buka').value = NoUrut.value + ".BA_PEMB/" + kodeMasalah.value + "/200900/" + tahun.value;
            document.getElementById('nomor_ba_evaluasi').value = NoUrut.value + ".BA-EVA/" + kodeMasalah.value + "/200900/" + tahun.value;
            document.getElementById('nomor_ba_negosiasi').value = NoUrut.value + ".BA-NEG/" + kodeMasalah.value + "/200900/" + tahun.value;
            document.getElementById('nomor_ba_hasil_pl').value = NoUrut.value + ".BA-HPL/" + kodeMasalah.value + "/200900/" + tahun.value;
            document.getElementById('nomor_spk').value = NoUrut.value + ".SPK/" + kodeMasalah.value + "/200900/" + tahun.value;
            
       
        });
    </script>
@endsection
