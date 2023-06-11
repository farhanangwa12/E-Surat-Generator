@extends('template.app')

@section('title', 'User Setting')


@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">User Setting</h1>
        @if (session('success'))
           
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
           
        @endif




        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h1 class="card-title mb-0">Ubah data</h1>

                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('ubahuser') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="inputName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="inputName" name="name"
                                    placeholder="Enter your name" value="{{ $data->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="inputEmail" name="email"
                                    value="{{ $data->email }}" placeholder="Enter your email address">
                            </div>


                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <img id="preview-image" src="{{ asset('photoprofile/' . $data->picture_profile) }}"
                                        alt="Photoprofile" style="max-width: 400px; max-height: 400px; object-fit: cover;">
                                </div>
                                <div class="col-md-8 d-flex justify-content-center align-items-center">
                                    <div>
                                        <label class="custom-file-label" for="picture_profile">Choose file</label>
                                        <input type="file" class="form-control custom-file-input" id="picture_profile"
                                            name="picture_profile" onchange="previewImage(event)">
                                    </div>
                                </div>
                            </div>






                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>


                </div>


            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Ubah Tanda Tangan</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('ubahtandatangan') }}" method="post" class="ubahuser">
                            @csrf
                            <div class="mb-3">
                                <label for="signature">Signature:</label><br>
                                <div style="display: flex; flex-direction: column; align-items: center;">
                                    <canvas id="signature-pad" height="200" width="600"
                                        style="border: 1px solid black; margin-left: auto; margin-right: auto;"></canvas><br><br>
                                    <input type="hidden" id="signature" name="signature">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Ganti Password</h1>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ route('gantipass') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="password_lama" class="form-label">Password Lama</label>
                                <input type="password" class="form-control" id="password_lama" name="password_lama"
                                    placeholder="Masukkan Password Lama">
                                @error('password_lama')
                                    <div class="mb-3">
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_baru" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="password_baru" name="password_baru"
                                    placeholder="Masukkan Password baru">
                            </div>
                            <div class="mb-3">
                                <label for="password_baru_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="password_baru_confirmation"
                                    name="password_baru_confirmation" placeholder="Masukkan Password baru">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
    <script>
        var canvas = document.getElementById('signature-pad');
        var signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgba(0, 0, 0, 0)', // Atur latar belakang menjadi transparan
        });

        var form = document.querySelector('.ubahuser');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            var signature = signaturePad.toDataURL();
            document.getElementById('signature').value = signature;
            form.submit();
        });
    </script>
    <script>
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function() {
                var imgElement = document.getElementById("preview-image");
                imgElement.src = reader.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
