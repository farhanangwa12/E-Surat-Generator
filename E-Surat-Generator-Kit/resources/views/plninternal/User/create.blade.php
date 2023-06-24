@extends('template.app')

@section('title', 'Tambah User')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Tambah User</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Enter your name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email address</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="Password" required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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


                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>



                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var roleSelect = document.getElementById('role');
            var testInput = document.getElementById('test');

            roleSelect.addEventListener('change', function() {
                if (roleSelect.value === '') {
                    testInput.disabled = true;
                } else {
                    testInput.disabled = false;
                }
            });
        });
    </script>
@endsection
