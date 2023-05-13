@extends('template.app')

@section('title', 'Tambah Kontrak')

@section('content')


    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Detail Kontrak</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        BOQ
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="{{ route('pengajuankontrak.boq.create', ['id' => $id]) }}" method="post">
                            @csrf
                            <table id="input-table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Uraian</th>
                                        <th>Vol</th>
                                        <th>Sat</th>
                                        <th>Harga Satuan (Rp)</th>
                                        <th>Jumlah (Rp.)</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="MATERIAL">
                                    <tr>
                                        <td><input type="text" name="no[]" class="form-control" value="I."
                                                readonly></td>
                                        <td colspan="5"><input type="text" name="uraian[]" class="form-control"
                                                value="PENGADAAN MATERIAL"></td>
                                        <td><button type="button" id="material" class="btn btn-primary">
                                                Tambah Baris</button>

                                            <button id="hapusjenis" class="btn btn-danger">Delete</button>
                                        </td>
                                        <input type="hidden" name="vol[]">
                                        <input type="hidden" name="sat[]">
                                        <input type="hidden" name="harga_satuan[]">
                                        <input type="hidden" name="jumlah[]">

                                    </tr>

                                </tbody>

                                <tbody id="JASA">
                                    <tr>
                                        <td><input type="text" name="no[]" class="form-control" value="II."
                                                readonly></td>
                                        <td colspan="5"><input type="text" name="uraian[]" class="form-control"
                                                value="PENGADAAN JASA"></td>
                                        <td><button type="button" id="jasa" class="btn btn-primary">

                                                Tambah Baris</button>
                                            <button id="hapusjenis" class="btn btn-danger">Delete</button>
                                        </td>
                                        <input type="hidden" name="vol[]">
                                        <input type="hidden" name="sat[]">
                                        <input type="hidden" name="harga_satuan[]">
                                        <input type="hidden" name="jumlah[]">
                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">



                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            <button type="submit" class="btn btn-primary">Kirim</button>
                            </form>
                        </div>





                    </div>
                </div>
                <a href="" class="btn btn-primary">Kembali</a>
                <a href="" class="btn btn-info">Kirim</a>






            </div>
        </div>

    </div>
@endsection

