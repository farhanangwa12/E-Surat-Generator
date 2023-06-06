@extends('template.app')

@section('title', 'Ubah Form Penawaran Harga')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 12px;
            font-weight: bold;
            margin: 0;
        }

        .header h2 {
            font-size: 10px;
            font-weight: bold;
            margin: 0;
        }


        .tabel table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .tabel th,
        .tabel td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }

        .tabel-kiri h3,
        .tabel-kanan h3 {
            font-weight: normal;
        }

        .tabel-kiri {
            border-right: none;
        }

        .tabel-kanan {
            border-left: none;
        }

        .tabel-kiri tr td:nth-child(5) {
            border-right: none;
        }

        .tandatangan {
            float: right;
            text-align: center;
        }

        /* tabel setelah  */
        .piutang td,
        .piutang tr {
            border: none;
        }
    </style>
    <div class="card w-100">
        <div class="card-header">
            <h5 class="card-title">Create Form Penawaran Harga</h5>
        </div>
        <form action="{{ route('vendor.neraca.update', $id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="header">
                    <h1>Kop Surat</h1>
                    <h2>Sub Title</h2>
                </div>
                <main>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="tabel clearfix" style="width: 100%;">
                        <h3 class="mb-4 mt-4" style="font-size: 11px;"><b>Neraca Perusahaan Terakhir Per Tanggal <input
                                    type="date" class="form-control" name="tanggal_neraca"
                                    placeholder="Masukkan Tanggal Neraca"></b>
                        </h3>
                        <table style="width: 100%;">
                            <thead>
                                <tr>
                                    <th colspan="5">
                                        <h3>AKTIVA</h3>
                                    </th>
                                    <th colspan="5">
                                        <h3>PASIVA</h3>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>I</td>
                                    <td>Aktiva Lancar</td>
                                    <td>:</td>
                                    <td>Rp<input type="text" name="aktiva_lancar" class="form-control number"
                                            placeholder="Nominal Aktiva Lancar" value="{{ $aktiva_lancar }}"></td>
                                    <td></td>
                                    <td>IV</td>
                                    <td>Utang jangka pendek</td>
                                    <td>:</td>
                                    <td>Rp<input type="text" name="utang_jangka_pendek" class="form-control number"
                                            placeholder="Nominal Utang Jangka Pendek" value="{{ $utang_jangka_pendek }}"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Kas</td>
                                    <td>:</td>
                                    <td>Rp<input type="text" name="kas" class="form-control number"
                                            placeholder="Nominal Kas" value="{{ $kas }}"></td>
                                    <td></td>
                                    <td></td>
                                    <td>Utang dagang</td>
                                    <td>:</td>
                                    <td>Rp<input type="text" name="utang_dagang" class="form-control number"
                                            placeholder="Nominal Utang Dagang" value="{{ $utang_dagang }}"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Bank</td>
                                    <td>:</td>
                                    <td>Rp<input type="text" name="bank" class="form-control number"
                                            placeholder="Nominal Bank" value="{{ $bank }}"></td>
                                    <td></td>
                                    <td></td>
                                    <td>Utang pajak</td>
                                    <td>:</td>
                                    <td>Rp<input type="text" name="utang_pajak" class="form-control number"
                                            placeholder="Nominal Utang Pajak" value="{{ $utang_pajak }}"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Piutang *)</td>
                                    <td>:</td>
                                    <td>Rp<input type="text" name="piutang" class="form-control number"
                                            placeholder="Nominal Piutang"></td>
                                    <td></td>
                                    <td></td>
                                    <td>Utang lainnya</td>
                                    <td>:</td>
                                    <td>Rp<input type="text" name="utang_lainnya" class="form-control number"
                                            placeholder="Nominal Utang Lainnya"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Persediaan Barang</td>
                                    <td>:</td>
                                    <td>Rp<input type="text" name="persediaan_barang" class="form-control number"
                                            placeholder="Nominal Persediaan Barang"></td>
                                    <td></td>
                                    <td></td>
                                    <td>Jumlah (d)</td>
                                    <td></td>
                                    <td></td>
                                    <td>Rp<input type="text" name="jumlah_d" class="form-control number"
                                            placeholder="Nominal Jumlah (d)"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Pekerjaan dalam Proses</td>
                                    <td>:</td>
                                    <td>Rp<input type="text" name="pekerjaan_dalam_proses" class="form-control number"
                                            placeholder="Nominal Pekerjaan dalam Proses"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Jumlah (a)</td>
                                    <td></td>
                                    <td></td>
                                    <td>Rp<input type="text" name="jumlah_a" class="form-control number"
                                            placeholder="Nominal Jumlah (a)"></td>
                                    <td>V</td>
                                    <td>Utang jangka panjang (e)</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>II</td>
                                    <td>Aktiva tetap</td>
                                    <td>:</td>
                                    <td>Rp<input type="text" name="aktiva_tetap" class="form-control number"
                                            placeholder="Nominal Aktiva Tetap"></td>
                                    <td></td>
                                    <td>VI</td>
                                    <td>Kekayaan bersih (a+b+c) – (d+e)</td>
                                    <td>:</td>
                                    <td>Rp<input type="text" name="kekayaan_bersih" class="form-control number"
                                            placeholder="Nominal Kekayaan Bersih"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Peralatan dan Mesin</td>
                                    <td>:</td>
                                    <td>Rp<input type="text" name="peralatan_dan_mesin_1" class="form-control number"
                                            placeholder="Nominal Peralatan dan Mesin"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Peralatan dan Mesin</td>
                                    <td>:</td>
                                    <td>Rp<input type="text" name="peralatan_dan_mesin_2" class="form-control number"
                                            placeholder="Nominal Peralatan dan Mesin"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Inventaris</td>
                                    <td>:</td>
                                    <td>Rp<input type="text" name="inventaris" class="form-control number"
                                            placeholder="Nominal Inventaris"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Gedung-gedung</td>
                                    <td>:</td>
                                    <td>Rp<input type="text" name="gedung_gedung" class="form-control number"
                                            placeholder="Nominal Gedung-gedung"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Jumlah (b)</td>
                                    <td></td>
                                    <td></td>
                                    <td>Rp<input type="text" name="jumlah_b" class="form-control number"
                                            placeholder="Nominal Jumlah (b)"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>III</td>
                                    <td>Aktiva Lainnya (c)</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td colspan="3">Jumlah</td>
                                    <td>Rp<input type="text" name="jumlah_a_b" class="form-control number"
                                            placeholder="Nominal Jumlah (b)"></td>
                                    <td></td>
                                    <td colspan="3">Jumlah</td>
                                    <td>Rp<input type="text" name="jumlah_d" class="form-control number"
                                            placeholder="Nominal Jumlah (b)"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <table style="width: 40%;" class="piutang">
                            <tr>
                                <td> *)</td>
                                <td>Piutang jangka pendek (sampai dengan enam bulan )</td>
                                <td>:</td>
                                <td>Rp <input type="text" name="piutang_jangka_pendek_sampai_6_bulan"
                                        class="form-control number"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Piutang jangka pendek (lebih dari enam bulan)</td>
                                <td>:</td>
                                <td>Rp <input type="text" name="piutang_jangka_pendek_lebih_dari_6_bulan"
                                        class="form-control number"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Jumlah </td>
                                <td>:</td>
                                <td>Rp <input type="text" name="jumlah" class="form-control number"></td>
                            </tr>
                        </table>
                    </div>
                   
                </main>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

@endsection

@section('javascript')
    <script>
        // Mengambil semua elemen dengan kelas 'number'
        const numberInputs = document.getElementsByClassName('number');

        // Iterasi melalui setiap elemen input dengan kelas 'number'
        for (let i = 0; i < numberInputs.length; i++) {
            const input = numberInputs[i];

            // Membatasi input hanya menerima angka
            input.addEventListener('input', function(event) {
                const inputValue = event.target.value;

                // Menghapus karakter selain angka
                const numericValue = inputValue.replace(/[^0-9]/g, '');

                // Mengubah angka menjadi format ribuan dengan titik setiap tiga digit
                const formattedValue = formatNumber(numericValue);

                // Mengupdate nilai input dengan format angka
                event.target.value = formattedValue;
            });
        }

        // Fungsi untuk memformat angka dengan titik setiap tiga digit
        function formatNumber(number) {
            return number.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>
@endsection
