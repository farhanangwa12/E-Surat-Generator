<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>RKS</title>
<style>
    /* CSS untuk header */
    header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 110px;

    }

    /* Tampilan Header */
    .header-table {
        width: 100%;
        max-width: 100%;
        table-layout: auto;
        border-collapse: collapse;
    }


    .header-table td:first-child {
        width: 70%;
        /* border: 1px solid black; */
    }

    .header-table td:last-child {
        width: 30%;
        /* border: 1px solid black; */
    }




    /* margin untuk konten utama */
    body {
        margin-top: 120px;
        margin-bottom: 20px;
    }




    /* Styling informasi surat */
    .rks-wrapper {
        text-align: center;
        margin: 0 auto;
    }

    .rks-title {
        font-size: 20px;
        font-weight: bold;
        font-family: "Times New Roman", Times, serif;
        text-decoration: underline;
    }

    .rks-content {
        font-size: 12px;
        font-family: "Times New Roman", Times, serif;
        margin: 0 80px;
        background-color: red;
    }

    /* Styling bawah judul rks */
    table.rkscontent-table {

        width: 100%;
        margin-bottom: 1em;
        background: #fff;
        color: #333;
        border-collapse: collapse;
        text-align: left;
    }

    table.rkscontent-table th,
    table.rkscontent-table td {
        padding: 0.5em;
        vertical-align: top;

    }

    table.rkscontent-table th {
        background: #f2f2f2;
        font-weight: bold;

    }

    /* Styling tabel di dalam main */
    table.main-table {
        width: 100%;
        margin-bottom: 1em;
        background: #fff;
        color: #333;
        border-collapse: collapse;

    }

    table.main-table th,
    table.main-table td {
        text-align: left;
        padding: 0.5em;
        vertical-align: top;
    }



    /* simbol segitiga */
    ul.simbolsegitiga li {
        list-style: none;
    }

    ul.simbolsegitiga li:before {
        content: "\2206";
        /* kode Unicode simbol segitiga */
        padding-right: 0.5em;
    }
</style>

</head>

<body>






    <header>
        <table class="header-table" style="width:100%; max-width:100%; table-layout:auto;">
            <tr>

                <td><img src="{{ $logokiri }}" style="vertical-align: top;" alt="Logo Kiri" width="480px"></td>
                <td><img src="{{ $logo }}" style="margin-left:20%;" alt="Logo PLN" height="40px"></td>

            </tr>
            <tr>

                <td></td>
                <td style="text-align: center; font-size: 12px;"><b> UIW NUSA TENGGARA TIMUR<br>
                        UNIT PELAKSANA PEMBANGKITAN TIMOR</b>
                </td>
            </tr>
        </table>
    </header>

    



    <main>
        <div class="rks-wrapper">
            <h2 class="rks-title">RENCANA KERJA SYARAT-SYARAT (RKS)</h2>
            <div class="rks-content">
                <table class="rkscontent-table">
                    <tr>
                        <td style="width: 20%;"><b>Nomor</b></td>
                        <td style="width: 10%;"><b>:</b></td>
                        <td style="width: 70%;"><b>{{ $surat->nomor }}</b></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;"><b>Tanggal</b></td>
                        <td style="width: 10%;"><b>:</b></td>
                        <td style="width: 70%;"><b>{{ $surat->tanggal }}</b></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;"><b>Pekerjaan</b></td>
                        <td style="width: 10%;"><b>:</b></td>
                        <td style="width: 70%; text-align:justify;"><b>{{ $surat->pekerjaan }}</b></td>
                    </tr>

                </table>



            </div>

        </div>
        <div class="table-wrapper">
            <table class="main-table">

                <tr>
                    <td style="width: 10%">I.</td>
                    <td style="width: 90%; text-decoration:underline;"><b><u>INSTRUKSI KEPADA PENYEDIA
                                BARANG/JASA</u></b></td>

                </tr>
                <tr>
                    <td style="width: 10%">1.1.</td>
                    <td style="width: 90%; text-align:justify;">Proses Pengadaan Barang/Jasa ini disusun berdasarkan
                        Peraturan Direksi
                        No. 0022.P/DIR/2020 tanggal 02 Maret 2020 dan perubahannya No. 0156.P/DIR/2021 tanggal 30
                        Agustus 2021 tentang Pedoman Pengadaan Barang/Jasa PT PLN (Persero).</td>

                </tr>
                <tr>
                    <td style="width: 10%">1.2.</td>
                    <td style="width: 90%; text-align:justify;">{{ $surat->bab_1_2 }}</td>

                </tr>
                <tr>
                    <td style="width: 10%">1.3.</td>
                    <td style="width: 90%; text-align:justify;">Adapun penawaran harga telah kami terima
                        selambat-lambatnya pada :<br>

                        <table style="width: 100%;padding:0 40px;" id="table_tanggal">
                            <tr>
                                <td style="width: 30%; text-align:left;">Hari/Tanggal</td>
                                <td style="width: 10%;">:</td>
                                <td style="width: 60%"><b>{{ $surat->bab_1_3_tanggal }}</b></td>
                            </tr>
                            <tr>
                                <td style="width: 30%; text-align:left;">Pukul</td>
                                <td style="width: 10%;">:</td>
                                <td style="width: 60%"><b>{{ $surat->bab_1_3_pukul }}</b></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="width: 10%">1.4.</td>
                    <td style="width: 90%; text-align:justify;">Harga dalam surat penawaran berlaku untuk jangka
                        waktu sekurang-kurangnya 1 (satu) bulan atau 30 hari kalender terhitung sejak tanggal surat
                        penawaran harga.</td>

                </tr>
                <tr>
                    <td style="width: 10%">1.5.</td>
                    <td style="width: 90%; text-align:justify;">{{ $surat->bab_1_5 }}</td>

                </tr>
                <tr>
                    <td style="width: 10%">1.6.</td>
                    <td style="width: 90%; text-align:justify;">{{ $surat->bab_1_6 }}</td>

                </tr>
                <tr>
                    <td style="width: 10%">1.7.</td>
                    <td style="width: 90%; text-align:justify;">Tempat penyerahan pekerjaan : <br>
                        <b><i>{{ $surat->bab_1_7 }}</i></b>

                    </td>

                </tr>
                <tr>
                    <td style="width: 10%">1.8.</td>
                    <td style="width: 90%; text-align:justify;">Dalam mengajukan penawaran harga agar melampirkan
                        Surat-surat yang masih berlaku, yaitu :
                        <table style="width: 100%;">
                            <tr>
                                <td>-</td>
                                <td>SIUP/SIUJK/SIUJPTL dengan kegiatan usaha yang sesuai untuk pengadaan ini dan
                                    masih berlaku;</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>Akte Pendirian Perusahaan beserta perubahan terakhir;</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>Keputusan MENKUMHAM (jika ada);</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>Nomor Pokok Wajib Pajak (NPWP) Perusahaan;</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>Ijin Gangguan/SITU/Surat Domisili/Izin Lokasi;</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>Surat Tanda Daftar Perusahaan (TDP) atau Nomor Induk Berusaha (NIB);</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>Pakta Integritas;</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>Surat Pernyataan Sanggup Menyelesaikan Pekerjaan Dengan Baik;</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>Surat Pernyataan Garansi Pekerjaan;</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>Memiliki Pengalaman Pengadaan sejenis dibuktikan dengan <b> Salinan
                                        Kontrak/SPK;</b></td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>Memiliki kemampuan menyediakan fasilitas berupa peralatan yang diperlukan untuk
                                    pelaksanaan pekerjaan;</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>Dokumen HIRARC (Hazard Identification Risk Assessment And Risk Control) Dan JSA
                                    (Job Safety Analysist);</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>Surat Pernyataan Penerapan K3L;</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>Neraca/Laporan keuangan Perusahaan terakhir yang memuat laporan laba rugi;</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>Tanda Terima penyampaian Surat Pajak Tahunan (SPT) Pajak Penghasilan (PPh) tahun
                                    terkahir, dan Surat Setoran Pajak (SSP) PPh, Pasal 21 atau Pajak Pertambahan
                                    Nilai (PPN) sekurang-kurangnya 3 (tiga) bulan terakhir;</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td><i>Dokumen penunjang lainnya (apabila ada);</i></td>
                            </tr>
                        </table>
                    </td>

                </tr>
                <tr>
                    <td style="width: 10%">1.9.</td>
                    <td style="width: 90%; text-align:justify;">Cara penilaian penawaran. <br>
                        <table style="width: 100%;">
                            <tr>
                                <td>-</td>
                                <td>Akan dilakukan penilaian administrasi dan teknis sesuai Persyaratan (RKS) yang
                                    ditetapkan.</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>Penilaian penawaran harga akan dilakukan berdasarkan harga yang wajar.</td>
                            </tr>
                            <tr>
                                <td>-</td>
                                <td>Apabila harga penawaran dianggap wajar maka dibuat Berita Acara Evaluasi
                                    ditandatangani oleh Pejabat Pelaksana Pengadaan Barang/Jasa, dilanjutkan dengan
                                    Negosiasi untuk selanjutnya dibuatkan Surat Perintah Kerja (SPK).</td>
                            </tr>


                        </table>
                    </td>

                </tr>
            </table>
            <table class="main-table">

                <tr>
                    <td style="width: 10%">II.</td>
                    <td style="width: 90%; text-decoration:underline;"><b><u>U M U M</u></b></td>

                </tr>
                <tr>
                    <td style="width: 10%">2.1.</td>
                    <td style="width: 90%; text-align:justify;">{{ $surat->bab_2_2 }}</td>

                </tr>
                <tr>
                    <td style="width: 10%">2.2.</td>
                    <td style="width: 90%; text-align:justify;">{{ $surat->bab_2_2 }}
                    </td>

                </tr>
                <tr>
                    <td style="width: 10%">2.3.</td>
                    <td style="width: 90%; text-align:justify;">Penyedia Barang/Jasa dalam hal ini adalah Pelaksana
                        Pekerjaan yang di tunjuk oleh PT PLN (Persero) Unit Induk Wilayah NTT Unit Pelaksana
                        Pembangkitan Timor berdasarkan hasil proses pengadaan langsung untuk melaksanakan pekerjaan
                        tersebut yang bertindak sebagai PIHAK KEDUA di dalam Kontrak/SPK.</td>

                </tr>
                <tr>
                    <td style="width: 10%">2.4.</td>
                    <td style="width: 90%; text-align:justify;">
                        Korespondensi <br>
                        Alamat para pihak sebagai berikut : <br>
                        <ol>
                            <li>Pengguna Barang / Jasa <br>
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width: 20%;">Nama</td>
                                        <td style="width: 10%;">:</td>
                                        <td style="width: 70%;">{{ $surat->bab_2_4_nama }} </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%;">Alamat</td>
                                        <td style="width: 10%;">:</td>
                                        <td style="width: 70%;">{{ $surat->bab_2_4_alamat }} </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%;">Telepon</td>
                                        <td style="width: 10%;">:</td>
                                        <td style="width: 70%;">0380-826198</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%;">Website</td>
                                        <td style="width: 10%;">:</td>
                                        <td style="width: 70%;">https://www.pln.co.id/</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%;">Faksimili</td>
                                        <td style="width: 10%;">:</td>
                                        <td style="width: 70%;">0380-826101</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%;">e-mail</td>
                                        <td style="width: 10%;">:</td>
                                        <td style="width: 70%;">lakdan.upktimor@gmail.com</td>
                                    </tr>
                                </table>


                            </li>
                            <li>Penyedia Barang/Jasa<br>
                                <table style="width: 100%;">
                                    <tr>
                                        <td style="width: 20%;">Nama</td>
                                        <td style="width: 10%;">:</td>
                                        <td style="width: 70%;">{{$surat->nama}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%;">Alamat</td>
                                        <td style="width: 10%;">:</td>
                                        <td style="width: 70%;">{{$surat->alamat}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%;">Telepon</td>
                                        <td style="width: 10%;">:</td>
                                        <td style="width: 70%;">{{$surat->telepon}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%;">Website</td>
                                        <td style="width: 10%;">:</td>
                                        <td style="width: 70%;">{{$surat->website}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%;">Faksimili</td>
                                        <td style="width: 10%;">:</td>
                                        <td style="width: 70%;">{{$surat->faksimili}}></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 20%;">e-mail</td>
                                        <td style="width: 10%;">:</td>
                                        <td style="width: 70%;">{{$surat->email}}></td>
                                    </tr>
                                </table>
                            </li>
                        </ol>


                    </td>

                </tr>
                <tr>
                    <td style="width: 10%">2.5.</td>
                    <td style="width: 90%; text-align:justify;">Wakil Sah Para Pihak sebagai
                        berikut : <br>
                        Untuk Pengguna Barang/Jasa <br>

                         <table style="width: 100%;">
                            <tr>
                                <td style="width: 20%;">1. Direksi Pekerjaan</td>
                                <td style="width: 10%;">:</td>
                                <td style="width: 70%;">{{ $surat->bab_2_5_direksipekerjaan }}</td>
                            </tr>
                            <tr>
                                <td style="width: 20%;">2. Pengawas Pekerjaan</td>
                                <td style="width: 10%;">:</td>
                                <td style="width: 70%;">{{ $surat->bab_2_5_pengawaspekerjaan }}</td>
                            </tr> 
                            <tr>
                                <td style="width: 20%;">3. Pengawas K3</td>
                                <td style="width: 10%;">:</td>
                                <td style="width: 70%;">{{ $surat->bab_2_5_pengawask3 }}</td>
                            </tr>
                          
                        </table>
                        Untuk Penyedia Barang/Jasa <br>
                        <table style="width: 100%;">
                          
                            <tr>
                                <td style="width: 20%;">1. Pengawas Pekerjaan</td>
                                <td style="width: 10%;">:</td>
                                <td style="width: 70%;">{{$surat->pengawasPekerjaan}}</td>
                            </tr> 
                            <tr>
                                <td style="width: 20%;">2. Pengawas K3</td>
                                <td style="width: 10%;">:</td>
                                <td style="width: 70%;">{{$surat->pengawasPekerjaan}}</td>
                            </tr>
                          
                        </table>
                       
                    </td>

                </tr>
                <tr>
                    <td style="width: 10%">2.6.</td>
                    <td style="width: 90%; text-align:justify;">
                        Tanggal Berlaku Kontrak <br>
                        Kontrak mulai berlaku efektif terhitung sejak ditandatangani Surat Perintah Kerja (SPK).</td>

                </tr>
                <tr>
                    <td style="width: 10%">2.7.</td>
                    <td style="width: 90%; text-align:justify;">
                        Jadwal Pelaksanaan Pekerjaan<br>
                        Penyedia Barang/Jasa harus menyelesaikan pekerjaan selama : <br>
                        <b>{{ $surat->bab_2_7 }} </b>

                    </td>

                </tr>
                <tr>
                    <td style="width: 10%">2.8.</td>
                    <td style="width: 90%; text-align:justify;">
                        Sumber Pembiayaan <br>
                        {{ $surat->bab_2_8_kontrak }} <br>
                        {{ $surat->bab_2_8_nomor }} <br>
                        {{ $surat->tanggal }}

                    </td>

                </tr>
                <tr>
                    <td style="width: 10%">2.9.</td>
                    <td style="width: 90%; text-align:justify;">
                        Pembayaran Pekerjaan <br>
                        <ol>
                            <li>Pembayaran pekerjaan dilakukan setelah Penyedia Barang/Jasa mengajukan Surat Permohonan
                                Pembayaran yang ditujukan ke PT PLN (Persero) Unit Induk Wilayah Nusa Tenggara Timur
                                dengan cara mentransfer ke rekening bank Penyedia Barang/Jasa. Pembayaran pekerjaan
                                dilakukan setelah Penyedia Barang/Jasa mengajukan Surat Permohonan Pembayaran yang
                                ditujukan ke PT PLN (Persero) Unit Induk Wilayah Nusa Tenggara Timur dengan cara 1
                                (satu) tahap yaitu ketika pekerjaan telah selesai 100% (seratus persen) akan dibayarkan
                                100% (seratus persen). Syarat pembayaran adalah sebagai berikut : <br>
                                <i>1.1. Pembayaran 100 % akan dilakukan dengan mengajukan berkas pembayaran sebagai
                                    berikut :</i>
                                <ol type="a">
                                    <li>Surat Permohonan Pembayaran;</li>
                                    <li>Kwitansi rangkap 4 (empat), asli bermaterai pada rangkap I dan rangkap II;</li>
                                    <li>Berita Acara Pembayaran Bermaterai;</li>
                                    <li>Berita Acara Pemeriksaan Pekerjaan (BAPP);</li>
                                    <li>Berita Acara Serah Terima Pekerjaan (BASTP) bermaterai;</li>
                                    <li>E-Faktur Pajak;</li>
                                    <li>Fotocopy NPWP;</li>
                                    <li>Fotocopy PKP;</li>
                                    <li>Surat Pernyataan Garansi Pekerjaan;</li>
                                    <li>Fotocopy Surat Perintah Kerja;</li>
                                    <li>Foto Dokumentasi pekerjaan yang menggambarkan fisik selesai 100%;</li>
                                    <li>SIUJK dan SBUJK</li>
                                    <li>Dokumen penunjang lainnya (apabila ada).</li>

                                </ol>


                            </li>
                            <li> PT PLN (Persero) tidak memberikan uang muka atas pekerjaan ini.</li>
                            <li>Apabila Penyedia Barang/Jasa terlambat menyelesaikan pekerjaan dari jadwal yang telah
                                ditetapkan dalam Surat Perjanjian Kerja, kepada Penyedia Barang/Jasa yang bersangkutan
                                harus dikenakan denda atau ganti rugi 1‰ (satu perseribu) dari Nilai Surat Perintah
                                Kerja untuk setiap hari keterlambatan dengan denda maksimum 5% (lima perseratus) dari
                                Nilai Surat Perintah Kerja.</li>
                            <li>Dalam hal ini terjadi pembatalan Surat Perintah Kerja secara sepihak, kedua belah pihak
                                sepakat untuk memberitahukan minimal 15 hari sebelum pembatalan.</li>

                        </ol>
                    </td>

                </tr>
                <tr>
                    <td style="width: 10%">2.10.</td>
                    <td style="width: 90%; text-align:justify;">Garansi<br>
                        <ol>
                            <li>{{ $surat->bab_2_10_1 }}</li>
                            <li>Masa Garansi minimal selama 6 (enam) bulan terhitung sejak tanggal Berita Acara Serah
                                Terima Pekerjaan oleh Penyedia Barang/Jasa kepada Pengguna Barang/Jasa;</li>
                            <li>Bilamana hasil PEKERJAAN PENGADAAN DAN JASA INSTALASI KWH METER ENGINE PLTU JEMBER PT
                                PLN (PERSERO) UNIT INDUK WILAYAH NTT UNIT PELAKSANA PEMBANGKITAN TIMOR yang diserahkan
                                oleh Penyedia Barang/Jasa kepada Pengguna Barang/Jasa ternyata tidak sesuai dengan
                                ketentuan, maka Pengguna Barang/Jasa berhak untuk menolak sebagian atau keseluruhan dari
                                pekerjaan yang dimaksud;</li>
                            <li>{{ $surat->bab_2_10_4 }}</li>
                            <li>Penyedia Barang/Jasa wajib melindungi Pengguna Barang/Jasa dari segala tuntutan atau
                                klaim dari pihak ketiga yang disebabkan atas pelanggaran atau Hak Atas Kekayaan
                                Intelektual/ HAKI (Hak Paten, Hak Cipta, dan Merek) oleh Penyedia Barang/Jasa;</li>
                            <li>Penyedia Barang/Jasa tetap bertanggung jawab selama masa Garansi apabila terjadi
                                kesalahan (error) atau tidak berfungsinya hasil pekerjaan, sejak diserahterimakan sampai
                                dengan masa Garansi berakhir.</li>
                        </ol>
                    </td>

                </tr>
                <tr>
                    <td style="width: 10%">2.11.</td>
                    <td style="width: 90%; text-align:justify;">Kerahasiaan Informasi <br>Dalam pelaksanaan kerjasama
                        tersebut, kedua belah pihak sepakat bahwa seluruh informasi baik mengenai hasil-hasil yang
                        dicapai maupun segala sesuatu yang diketahui atau dipertukarkan oleh kedua belah pihak baik pada
                        saat sebelum, selama maupun sesudah proses pelaksanaan kerjasama ini, wajib diperlakukan sebagai
                        rahasia selama 3 (tiga) tahun terhitung sejak tanggal berakhirnya Kontrak/Surat Perintah Kerja
                        karena sebab apapun, kecuali ditentukan lain secara tertulis oleh pihak yang memberi informasi.
                    </td>

                </tr>
                <tr>
                    <td style="width: 10%">2.12.</td>
                    <td style="width: 90%; text-align:justify;">Pembatalan Surat Perintah Kerja <br>Dalam hal ini
                        terjadi pembatalan Surat Perintah Kerja, kedua belah pihak sepakat untuk memberitahukan minimal
                        15 hari sebelum pembatalan.



                    </td>

                </tr>
                <tr>
                    <td style="width: 10%">2.13.</td>
                    <td style="width: 90%; text-align:justify;">
                        Penyelesaian Perselisihan <br> Apabila terjadi perselisihan mengenai pelaksanaan Kontrak/SPK
                        ini, maka kedua belah pihak sepakat untuk menyelesaikannya dengan cara musyawarah, dan bila
                        tidak tercapai maka penyelesaian perselisihan tersebut akan diselesaikan di Kantor BANI
                        Perwakilan Surabaya.




                    </td>

                </tr>


            </table>

            {{-- Syarat syarat teknik --}}
            <table class="main-table">

                <tr>
                    <td style="width: 10%">III.</td>
                    <td style="width: 90%; text-decoration:underline;"><b><u>SYARAT-SYARAT TEKNIK :</u></b></td>

                </tr>
                <tr>
                    <td style="width: 10%">3.1.</td>
                    <td style="width: 90%; text-align:justify;">Kualitas Pekerjaan : <br>
                        1. Dalam pelaksanaan pekarjaan Penyedia Barang/Jasa wajib menjaga kualitas dan hasil
                        kinerja/performance, apabila tidak sesuai dengan yang dipersyaratkan, maka Penyedia Barang/Jasa
                        siap memperbaiki/meningkatkan performance tersebut. <br>2. Segala biaya yang diperlukan untuk
                        memperbaiki/meningkatkan performance tersebut adalah menjadi beban dan tangung jawab Penyedia
                        Barang/Jasa.</td>

                </tr>
                <tr>
                    <td style="width: 10%">3.2.</td>
                    <td style="width: 90%; text-align:justify;">Sesuai dengan Persyaratan/Speck Teknik/KAK terlampir.

                    </td>

                </tr>



            </table>

            {{-- Daftar Kuantitas dan harga  --}}
            <table class="main-table">

                <tr>
                    <td style="width: 10%">IV.</td>
                    <td style="width: 90%; text-decoration:underline;"><b><u>DAFTAR KUANTITAS DAN HARGA (BILL OF
                                QUANTITY/ BoQ)</u></b></td>

                </tr>
                <tr>
                    <td style="width: 10%">4.1.</td>
                    <td style="width: 90%; text-align:justify;">Harga sudah termasuk : harga dasar, pengiriman,
                        pemasangan, ROK, dan Perpajakan.</td>

                </tr>
                <tr>
                    <td style="width: 10%">4.2.</td>
                    <td style="width: 90%; text-align:justify;">Daftar Kuantitas dan Harga (Bill of quantity (BoQ))
                        sebagaimana terlampir.</td>

                </tr>



            </table>
            {{-- Keselematan dan kesehatan kerja  --}}
            <table class="main-table">

                <tr>
                    <td style="width: 10%">V.</td>
                    <td style="width: 90%; text-decoration:underline;"><b><u>KESELAMATAN DAN KESEHATAN KERJA :</u></b>
                    </td>

                </tr>
                <tr>
                    <td style="width: 10%">5.1.</td>
                    <td style="width: 90%; text-align:justify;">Penyedia Barang/Jasa wajib mematuhi peraturan
                        keselamatan dan kesehatan kerja di lingkungan PT. PLN (Persero).</td>

                </tr>
                <tr>
                    <td style="width: 10%">5.2.</td>
                    <td style="width: 90%; text-align:justify;">Penyedia Barang/Jasa wajib bertanggung jawab menjaga
                        keselamatan pekerjanya dan menjaga keamanan, mematuhi tata tertib, juga menjaga kebersihan
                        tempat kerja dan lingkungan sekitarnya.

                    </td>

                </tr>
                <tr>
                    <td style="width: 10%">5.3.</td>
                    <td style="width: 90%; text-align:justify;">Tata cara pengaturan keselamatan dan kesehatan kerja
                        dilakukan sesuai ketentuan dalam surat dari EVP Health, Safety, Security, And Environment Nomor
                        : 0170/KLH.00.01/DIVHSSE/2019 tanggal 06 Mei 2019 tentang Penerapan Klausul Keselamatan dan
                        Kesehatan Kerja (K3) dan Sanksi K3 pada Perjanjian Pengadaan Barang dan Jasa, maka seluruh pihak
                        yang terkait wajib mematuhi peraturan tersebut.</td>

                </tr>
                <tr>
                    <td style="width: 10%">5.4.</td>
                    <td style="width: 90%; text-align:justify;">Kegiatan Pencegahan Terjadinya Kecelakaan Kerja <br>
                        <ol type="a">
                            <li>Pencegahan Kondisi Berbahaya (Unsafe Condition) <br>
                                Penyedia Barang/Jasa wajib melakukan pengendalian teknis terhadap adanya kondisi
                                berbahaya (unsafe condition) pada tempat-tempat kerja antara lain: <br>

                                <ul class="simbolsegitiga">
                                    <li>Penyedia Barang/Jasa wajib mematuhi peraturan Keselamatan dan Kesehatan Kerja
                                        (K3) yang berlaku di lingkungaan PT. PLN (Persero);</li>
                                    <li>Penyedia Barang/Jasa wajib memiliki dan menerapkan Standing Operation Prosedure
                                        (SOP) untuk setiap pekerjaan;</li>
                                    <li>Penyedia Barang/Jasa wajib menyediakan peralatan kerja dan APD sesuai standart
                                        bagi tenaga kerjanya pada pelaksanaan pekerjaan yang berpotensi bahaya;</li>
                                    <li>Penyedia Barang/Jasa wajib melakukan Identifikasi Bahaya, Penilaian Risiko dan
                                        Pengendalian Risiko (IBPPR) / HIRARC pada tempat kerja yang berpotensi bahaya;
                                    </li>
                                    <li>Penyedia Barang/Jasa wajib membuat Job Safety Analysis (JSA) dan Ijin Kerja
                                        (working permit) pada setiap melaksanakan pekerjaan yang berpotensi bahaya;</li>
                                    <li>Penyedia Barang/Jasa wajib melakukan pemeriksaan kesehatan kerja bagi tenaga
                                        kerjanya yang bekerja pada pekerjaan yang berpotensi bahaya serta
                                        meng-asuransikannya.</li>
                                </ul>

                            </li>
                            <li>Pencegahan Tindakan Berbahaya (Unsafe Action)<br>
                                Penyedia Barang/Jasa wajib melakukan pengendalian personel terhadap perilaku berbahaya
                                (Unsafe Action) dari Pelaksana dan Pengawas pekerjaan, antara lain:<br>

                                <ul class="simbolsegitiga">
                                    <li>Penyedia Barang/Jasa wajib menunjuk dan menetapkan Pengawas Pekerjaan / Pengawas
                                        K3 yang memiliki kompetensi di bidang pekerjaannya;</li>
                                    <li>Penyedia Barang/Jasa wajib memasang LOTO (Lock Out Tag Out) pada saat
                                        pelaksanaan pekerjaan yang berpotensi bahaya;</li>
                                    <li>Pelaksana Pekerjaan dari Penyedia Barang/Jasa wajib menggunakan peralatan kerja
                                        dan APD sesuai standart pada pelaksanaan pekerjaan yang berpotensi bahaya;</li>
                                    <li>Penyedia Barang/Jasa wajib melakukan pengawasan terhadap perilaku tenaga
                                        kerjanya yang membahayakan bagi diri sendiri maupun orang lain, yang dapat
                                        menyebabkan terjadinya kecelakaan kerja;</li>
                                    <li>Penyedia Barang/Jasa wajib memberikan petunjuk dan arahan keselamatan (Safety
                                        Briefing) kepada Pelaksana Pekerjaan dan Pengawas Pekerjaan sebelum melaksanakan
                                        pekerjaan yang berpotensi bahaya;</li>
                                </ul>

                            </li>
                        </ol>
                    </td>

                </tr>
                <tr>
                    <td style="width: 10%">5.5.</td>
                    <td style="width: 90%; text-align:justify;">Sertifikasi/Pendidikan dan Pelatihan <br>
                        Apabila terjadi kecelakaan kerja akibat kelalaian Penyedia Barang/Jasa dalam penerapan Sistem
                        Manajemen Keselamatan dan Kesehatan Kerja (SMK3), maka PIHAK PERTAMA berhak mengevaluasi,
                        memutus Surat Perjanjian yang sedang berlangsung secara sepihak serta memasukkan Penyedia
                        Barang/Jasa pada Daftar Hitam (Black List) perusahaan.</td>

                </tr>
                <tr>
                    <td style="width: 10%">5.7.</td>
                    <td style="width: 90%; text-align:justify;">Penyedia Barang/Jasa wajib menyampaikan laporan
                        tertulis kepada PIHAK PERTAMA mengenai setiap kejadian kecelakaan kerja yang timbul sehubungan
                        dengan pelaksanaan Surat Perjanjian ini dalam waktu maksimal 24 (dua puluh empat) jam setelah
                        kejadian.</td>

                </tr>
                <tr>
                    <td style="width: 10%">5.8.</td>
                    <td style="width: 90%; text-align:justify;">Dalam mencapai Zerro Accident (nihil kecelakaan kerja),
                        maka Penyedia Barang/Jasa wajib mengimplementasikan Tujuh Komitmen Keselamatan Kerja (TUMIT
                        KEKE) yang mana setiap melaksanakan pekerjaan untuk senantiasa memastikan : <br>
                        <ol type="1">
                            <li>Siap SDM (Sumber Daya Manusia) yang kompeten;</li>
                            <li>Siap SOP (Standard Operation Procedure);</li>

                            <li>Siap APD (Alat Pelindung Diri);</li>
                            <li>Siap Tool (peralatan kerja yang memenuhi standar keselamatan kerja);</li>
                            <li>Siap JSA (Job Safety Analysis);</li>
                            <li>Siap Rambu-Rambu keselamatan kerja;</li>
                            <li>Mesin/Instalasi Aman;</li>


                        </ol>
                    </td>

                </tr>





            </table>

            {{-- KETENTUAN LAINNYA.  --}}
            <table class="main-table">

                <tr>
                    <td style="width: 10%">VI.</td>
                    <td style="width: 90%; text-decoration:underline;"><b><u>KETENTUAN LAINNYA.</u></b></td>

                </tr>
                <tr>
                    <td style="width: 10%">6.1.</td>
                    <td style="width: 90%; text-align:justify;">Penyedia Barang/Jasa hendaknya selalu berpedoman pada
                        ketentuan-ketentuan teknis/data yang ada dalam Speck teknik / KAK / Persyaratan (RKS) serta
                        (Bill of quantity (BoQ).</td>

                </tr>
                <tr>
                    <td style="width: 10%">6.2.</td>
                    <td style="width: 90%; text-align:justify;">{{ $surat->bab_6_2 }}</td>


                </tr>
                <tr>
                    <td style="width: 10%">6.3.</td>
                    <td style="width: 90%; text-align:justify;">{{ $surat->bab_6_3 }}</td>


                </tr>



            </table>


            <table style="width: 100%;">
                <tr>
                    <td style="width:50%; text-align:center;">DISAHKAN OLEH,<br>PENGGUNA BARANG/JASA <br>PT PLN
                        (PERSERO) UPK TIMOR <br>MANAGER
                    </td>
                    <td style="width:50%; text-align:center;">DISUSUN OLEH, <br>
                        PELAKSANA PENGADAAN BARANG/JASA <br>PT PLN (PERSERO) UPK TIMOR <br>PEJABAT PELAKSANA PENGADAAN
                    </td>
                </tr>

                <tr>
                    <td style="width:50%; text-align:center; height: 80px;"> Tanda Tangan Manager
                        {{-- <img src="data:image/png;base64,{{$tandatangan}}" alt="barcode" width="100px" height="100px"  />  --}}
                    </td>
                    <td style="width:50%; text-align:center;  height: 80px;">Tanda Tangan Pengadaan
                    </td>

                </tr>
                <tr>
                    <td style="width:50%; text-align:center;"> <b>{{ $surat->namaterang_manager }}</b>
                    </td>
                    <td style="width:50%; text-align:center;"> <b>{{ $surat->namaterang_pengadaan }}</b>
                    </td>
                </tr>

            </table>
        </div>
    </main>

    <script type="text/php">
        if ( isset($pdf) ) { 
            $pdf->page_script('
                if ($PAGE_COUNT > 1) {
                    $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                    $size = 12;
                    $pageText = "Hal. " . $PAGE_NUM . " dari " . $PAGE_COUNT;
                    $y = 810;
                    $x = 450;
                    $pdf->text($x, $y, $pageText, $font, $size);
                } 
            ');
        }
    </script>
</body>

</html>
