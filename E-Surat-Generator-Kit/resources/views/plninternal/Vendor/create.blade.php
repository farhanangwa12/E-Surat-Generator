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
                            Data User <br>
                            {{-- <button type="button" id="toggleButton" class="btn btn-primary" onclick="toggleAccount()">Tambah Akun</button> --}}
                        </div>


                        {{-- <div class="card-body" id="akun" style="display: none;"> --}}
                        <div class="card-body" id="akun" style="">



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


                        <script>
                            function toggleAccount() {
                                var akunDiv = document.getElementById('akun');
                                var toggleButton = document.getElementById('toggleButton');

                                if (akunDiv.style.display === 'none') {
                                    akunDiv.style.display = 'block';
                                    toggleButton.textContent = 'Batal';

                                } else {
                                    akunDiv.style.display = 'none';
                                    toggleButton.textContent = 'Tambah Akun';

                                }
                            }
                        </script>
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
                                        <input type="text" class="form-control" id="alamat_jalan" name="alamat_jalan"
                                            placeholder="Contoh : Jalan Panglima">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="alamat_kota" name="alamat_kota"
                                            placeholder="Contoh : Madiun">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="alamat_provinsi"
                                            name="alamat_provinsi" placeholder="Contoh : Jawa Timur">
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

                            <div class="mb-3">
                                <label for="telepon" class="form-label">Telepon</label>
                                <input type="text" class="form-control" placeholder="Contoh : 08XXXXXXX"id="telepon"
                                    name="telepon">
                            </div>
                            <div class="mb-3">
                                <label for="website" class="form-label">Website</label>
                                <input type="text" class="form-control" placeholder="Contoh : www.mywebsite.com"
                                    id="website" name="website">
                            </div>
                            <div class="mb-3">
                                <label for="faksimili" class="form-label">Faksimili</label>
                                <input type="text" class="form-control" placeholder="Contoh : (031)21123231"
                                    id="faksimili" name="faksimili">
                            </div>
                            <div class="mb-3">
                                <label for="email_perusahaan" class="form-label">Email Perusahaan</label>
                                <input type="email" class="form-control" placeholder="Contoh : perusahaanku@email.com"
                                    id="email_perusahaan" name="email_perusahaan">
                            </div>

                            <div class="form-group mb-3">
                                <label for="pengawas_pekerjaan">Pengawas Pekerjaan:</label>
                                <input type="text" class="form-control" name="pengawas_pekerjaan"
                                    id="pengawas_pekerjaan">
                            </div>
                            <div class="form-group mb-3">
                                <label for="pengawas_k3">Pengawas K3:</label>
                                <input type="text" class="form-control" name="pengawas_k3" id="pengawas_k3">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>




                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
