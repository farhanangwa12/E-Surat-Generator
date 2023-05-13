@extends('template.app')

@section('title', 'Tambah User')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Tambah Pegawai</h1>

        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('pegawai.store') }}" class="myForm">
                    <div class="card">
                        <div class="card-header">
                            Data User
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('users.store') }}">
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

                                <div class="form-group mb-3">
                                    <label for="role">Role</label>
                                    <select class="form-select" name="role">

                                        <option selected="" disabled>== Pilih Jenis Akun ==</option>
                                        <option value="pengadaan">Pengadaan</option>
                                        <option value="manager">Manager</option>
                                        <option value="vendor">Vendor</option>
                                    </select>
                                </div>



                            </form>



                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Data Pegawai
                        </div>

                        <div class="card-body">



                            <div class="form-group mb-3">
                                <label for="nama_pegawai">Nama Pegawai</label>
                                <input type="text" name="nama_pegawai" class="form-control" id="nama_pegawai"
                                    placeholder="Masukkan nama pegawai">
                            </div>
                            <div class="form-group mb-3">
                                <label for="jabatan">Jabatan</label>
                                <input type="Jabatan" name="jabatan" class="form-control" id="jabatan"
                                    placeholder="Masukkan Jabatan">
                            </div>
                            <div class="form-group mb-3">
                                <label for="nomor_jabatan">Nomor Jabatan</label>
                                <input type="text" name="nomor_jabatan" class="form-control" id="nomor_jabatan"
                                    placeholder="Masukkan Nomor Jabatan">
                            </div>
                            {{-- <input type="submit" class="btn btn-primary" value="Submit"> --}}
                            <button type="button" onclick="submitForm()" class="btn btn-primary">Submit</button>





                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

<script>
    function submitForm() {
        document.getElementById("myForm").submit();
        console.log("test");
    }
</script>
