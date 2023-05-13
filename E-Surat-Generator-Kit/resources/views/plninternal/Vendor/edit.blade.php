@extends('template.app')

@section('title', 'Edit User')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit User</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('vendor.update', $vendor->id_vendor) }}">
                            @csrf
                          

                            <div class="form-group mb-3">
                                <label for="penyedia" class="form-label">Penyedia</label>
                                <input type="text" class="form-control" id="penyedia"
                                    placeholder="Masukkan nama penyedia" name="penyedia" value="{{ $vendor->penyedia }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="direktur" class="form-label">Direktur</label>
                                <input type="text" class="form-control" id="direktur"
                                    placeholder="Masukkan nama direktur" name="direktur" value="{{ $vendor->direktur }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <div class="row align-start">
                                    <div class="col">
                                        <input type="text" class="form-control" id="alamat_jalan" name="alamat_jalan" placeholder="Contoh : Jalan Panglima" value="{{$vendor->alamat_jalan}}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="alamat_kota" name="alamat_kota" placeholder="Contoh : Madiun" value="{{$vendor->alamat_kota}}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="alamat_provinsi" name="alamat_provinsi" placeholder="Contoh : Jawa Timur" value="{{$vendor->alamat_provinsi}}">
                                    </div>
                                    
                                   
                                    


                                </div>
                    
                            </div>
                            <div class="form-group mb-3">
                                <label for="bank" class="form-label">Bank</label>
                                <input type="text" class="form-control" id="bank" placeholder="Contoh : BANK BNI" value="{{$vendor->bank}}"
                                    name="bank">


                            </div>
                            <div class="form-group mb-3">
                                <label for="nomor_rekening" class="form-label">Nomor Rekening</label>
                                <input type="text" class="form-control" id="nomor_rekening"
                                    placeholder="Contoh : 80090XXXXX " name="nomor_rek" value="{{$vendor->nomor_rek}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>



                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
