@extends('template.app')

@section('title', 'Tambah Vendor')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Tambah Vendor</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('vendor.store') }}">
                    <div class="card">
                        <div class="card-header">
                            Data User
                        </div>

                        <div class="card-body">

                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Enter your name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email address</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter email">
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Password">
                            </div>


                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Data Vendor
                        </div>

                        <div class="card-body">


                            @csrf



                            <div class="form-group mb-3">
                                <label for="penyedia" class="form-label">Penyedia</label>
                                <input type="text" class="form-control" id="penyedia"
                                    placeholder="Masukkan nama penyedia" name="penyedia">
                            </div>
                            <div class="form-group mb-3">
                                <label for="direktur" class="form-label">Direktur</label>
                                <input type="text" class="form-control" id="direktur"
                                    placeholder="Masukkan nama direktur" name="direktur">
                            </div>
                            <div class="form-group mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <div class="row align-start">
                                    <div class="col">
                                        <input type="text" class="form-control" id="alamat_jalan" name="alamat_jalan" placeholder="Contoh : Jalan Panglima">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="alamat_kota" name="alamat_kota" placeholder="Contoh : Madiun">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="alamat_provinsi" name="alamat_provinsi" placeholder="Contoh : Jawa Timur">
                                    </div>
                                    
                                   
                                    


                                </div>
                    
                            </div>
                            <div class="form-group mb-3">
                                <label for="bank" class="form-label">Bank</label>
                                <input type="text" class="form-control" id="bank" placeholder="Contoh : BANK BNI"
                                    name="bank">


                            </div>
                            <div class="form-group mb-3">
                                <label for="nomor_rekening" class="form-label">Nomor Rekening</label>
                                <input type="text" class="form-control" id="nomor_rekening"
                                    placeholder="Contoh : 80090XXXXX " name="nomor_rek">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>




                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
