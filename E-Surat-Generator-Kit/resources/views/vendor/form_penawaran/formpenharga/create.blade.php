@extends('template.app')

@section('title', 'Ubah Form Penawaran Harga')


@section('content')
    <style>
        /* Header */
        .header {

            width: 100%;
            text-align: center;
            background-color: #f1f1f1;
            padding: 10px 0;
        }

        .company-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .company-address {
            font-size: 14px;
        }

        .company-logo {
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }


        /* Body */
        body {
            margin-top: 120px;
            /* Adjust this value based on header height */
        }

        .kop {
            width: 100%;
        }

        .kop table {
            width: 100%;
        }

        .kop th,
        .kop td {
            text-align: left;
            padding: 8px;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .blue-text {
            color: #003366;
        }

        .tandatangan {
            float: right;
            text-align: center;
        }

        .terbilang::before {
            content: "(";
        }

        .terbilang::after {
            content: ")";
        }
    </style>
    <div class="card w-100">
        <div class="card-header">
            <h5 class="card-title">Create Form Penawaran Harga</h5>
        </div>
        <div class="card-body">
            <main class="container mt-5">
                <form action="{{ route('vendor.formpenawaranharga.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="bertindak_untuk" class="form-label">Bertindak untuk</label>
                        <input type="text" class="form-control" id="bertindak_untuk" name="bertindak_untuk"
                            placeholder="Bertindak untuk" required>
                    </div>
                    <div class="mb-3">
                        <label for="atas_nama" class="form-label">dan atas nama</label>
                        <input type="text" class="form-control" id="atas_nama" name="atas_nama" placeholder="Atas Nama"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="telepon_fax" class="form-label">No. Telepon/Fax</label>
                        <input type="text" class="form-control" id="telepon_fax" name="telepon_fax"
                            placeholder="No. Telepon/Fax" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            required>
                    </div>
                    <p>Dengan ini menyatakan:</p>
                    <ol>
                        <li>Tunduk pada ketentuan-ketentuan Pengadaan Barang/Jasa yang termuat dalam Peraturan Direksi
                            No. 0022.P/DIR/2020 tanggal 02 Maret 2020 dan perubahannya No. 0156.P/DIR/2021 tanggal 30
                            Agustus 2021 tentang Pedoman Pengadaan Barang/Jasa PT PLN (Persero).</li>
                        <li>Bersedia dan sanggup melaksanakan Pekerjaan:
                            <p class="blue-text">PEKERJAAN PENGdadadada</p>
                            <br>
                            <p>Sesuai dengan syarat-syarat yang tercantum dalam:</p>
                            <ol type="a">
                                <li>Rencana Kerja dan Syarat (RKS).</li>
                                <li>Klarifikasi dan Evaluasi Penawaran (KEP).</li>
                                <li>Surat Penawaran Harga ini.</li>
                            </ol>
                        </li>
                        <li>Menyatakan harga yang kami tawarkan adalah harga yang netto, belum termasuk PPN (Pajak
                            Pertambahan
                            Nilai).</li>
                    </ol>
                    <div class="mb-3">
                        <label for="total_harga" class="form-label">Total Harga Penawaran</label>
                        <input type="text" class="form-control" id="total_harga" name="total_harga"
                            placeholder="Total Harga Penawaran" required>
                    </div>
                    <p>Pengerjaan pekerjaan dimulai sejak tanggal:</p>
                    <div class="mb-3">
                        <label for="tanggal_mulai" class="form-label">Pengadaan Barang/Jasa (tanggal surat persetujuan
                            dan/atau berita acara penyerahan) *</label>
                        <input type="text" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                            placeholder="Tanggal Mulai" required>
                    </div>
                    <p>Dengan ketentuan-ketentuan lainnya sebagaimana diuraikan dalam RKS dan syarat-syarat lain yang telah
                        disampaikan serta telah kami pelajari dengan seksama.</p>
                    <p>Demikian Surat Penawaran Harga ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan
                        terima kasih.</p>
                    <div class="tandatangan">
                        <p>
                            <input type="text" class="form-control" id="nama_ttd" name="nama_ttd" placeholder="Nama TTD"
                                required>
                            <br>
                            <span style="font-size: 12px;">
                                <input type="text" class="form-control" id="jabatan_ttd" name="jabatan_ttd"
                                    placeholder="Jabatan TTD" required>
                            </span>
                        </p>
                    </div>
                    <br>
                    <br>
                    <div class="terbilang" style="text-align:center;">
                        <span>Terbilang: <input type="text" class="form-control" id="terbilang" name="terbilang"
                                placeholder="Terbilang" required></span>
                    </div>
                    <br>
                    <br>
                    <p class="terbilang" style="margin-left: 20px;">* Yang Dapat Diukur (Lanjutkan Garis Bawah)</p>
                    <br>
                    <br>
                    <div style="text-align:center;">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </main>
        </div>
    </div>

@endsection
