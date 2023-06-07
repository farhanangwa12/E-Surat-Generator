@extends('template.app')

@section('title', 'Ubah Form Penawaran Harga')

@section('content')
    <style>
        /* Header */
        .header {
            position: fixed;
            top: -10px;
            left: 0;
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Halaman Tanda Tangan</div>

                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">Form Upload File Tanda Tangan</div>
                            <div class="card-body">
                                <form action="{{ route('vendor.pernyataan.sangup.simpanttd', $id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <div class="form-group m-4">
                                        <ol>
                                            <li>Download PDF Form Penawaran dari halaman utama</li>
                                            <li>Print PDF lalu tanda tangan dengan materai</li>
                                            <li>Scan pdf lalu upload ke halaman ini</li>
                                        </ol>

                                        <label for="file_tandatangan">Upload File Tanda Tangan:</label>
                                        <input type="file" class="form-control" name="file_tandatangan" accept=".pdf">

                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
