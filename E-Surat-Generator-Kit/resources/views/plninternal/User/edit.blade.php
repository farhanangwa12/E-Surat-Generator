@extends('template.app')

@section('title', 'Edit User')

@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit User</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <form method="post" action="{{ route('users.update', ["id" => $user->id]) }}">
                            @csrf
                            <div class="form- mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Enter your name" value="{{ $user->name }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email address</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter email" value="{{ $user->email }}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="role">Role</label>
                                <select class="form-select" name="role">

                                    <option selected="" disabled>== Pilih Jenis Akun ==</option>
                                    <option @php echo $user->role == "pengadaan" ? 'selected' : '' @endphp
                                        value="pengadaan">Pengadaan</option>
                                    <option @php echo $user->role == "manager" ? 'selected' : '' @endphp value="manager">Manager</option>
                                    <option @php echo $user->role == "vendor" ? 'selected' : '' @endphp value="vendor">Vendor</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for=""></label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>



                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
