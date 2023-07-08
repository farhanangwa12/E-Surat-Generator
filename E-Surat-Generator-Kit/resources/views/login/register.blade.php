<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('adminkit/img/icons/icon-48x48.png') }}" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

    <title>Register Vendor </title>

    <link href="{{ asset('adminkit/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3>Registrasi Vendor</h3>
            </div>
            <div class="card-body">
                @if ($errors->has('penyedia'))
                    <span class="text-danger">
                        @foreach ($errors->get('penyedia') as $error)
                            {{ $error }}<br>
                        @endforeach
                    </span>
                @endif
                <ul class="nav nav-tabs" id="registrationTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1"
                            type="button" role="tab" aria-controls="tab1" aria-selected="true">Data Identitas
                            Vendor</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link disabled" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2"
                            type="button" role="tab" aria-controls="tab2" aria-selected="false">Data Akun</button>
                    </li>
                </ul>
                <form action="{{ route('simpan.vendor') }}" method="POST">
                    @csrf
                    <div class="tab-content mt-3">


                        <div class="tab-pane fade show active" id="tab1" role="tabpanel"
                            aria-labelledby="tab1-tab">
                            <div class="mb-3">
                                <label for="penyedia" class="form-label">Penyedia</label>
                                <input type="text" class="form-control @error('penyedia') is-invalid @enderror"
                                    id="penyedia" name="penyedia" placeholder="Penyedia" required>
                                @error('penyedia')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="direktur" class="form-label">Direktur</label>
                                <input type="text" class="form-control @error('direktur') is-invalid @enderror"
                                    id="direktur" name="direktur" placeholder="Direktur" required>
                                @error('direktur')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamatJalan" class="form-label">Alamat Jalan</label>
                                <input type="text" class="form-control @error('alamat_jalan') is-invalid @enderror"
                                    id="alamatJalan" name="alamat_jalan" placeholder="Alamat Jalan" required>
                                @error('alamat_jalan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamatKota" class="form-label">Alamat Kota</label>
                                <input type="text" class="form-control @error('alamat_kota') is-invalid @enderror"
                                    id="alamatKota" name="alamat_kota" placeholder="Alamat Kota" required>
                                @error('alamat_kota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamatProvinsi" class="form-label">Alamat Provinsi</label>
                                <input type="text"
                                    class="form-control @error('alamat_provinsi') is-invalid @enderror"
                                    id="alamatProvinsi" name="alamat_provinsi" placeholder="Alamat Provinsi" required>
                                @error('alamat_provinsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="bank" class="form-label">Bank</label>
                                <input type="text" class="form-control @error('bank') is-invalid @enderror"
                                    id="bank" name="bank" placeholder="Bank" required>
                                @error('bank')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nomorRek" class="form-label">Nomor Rekening</label>
                                <input type="text" class="form-control @error('nomor_rek') is-invalid @enderror"
                                    id="nomorRek" name="nomor_rek" placeholder="Nomor Rekening" required>
                                @error('nomor_rek')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="telepon" class="form-label">Telepon:</label>
                                <input type="text" class="form-control" name="telepon" id="telepon"
                                    placeholder="Contoh : 08XXXXXXX">
                                @error('telepon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="website" class="form-label">Website:</label>
                                <input type="text" class="form-control" name="website" id="website"
                                    placeholder="Contoh : www.mywebsite.com">
                                @error('website')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="faksimili" class="form-label">Faksimili:</label>
                                <input type="text" class="form-control" name="faksimili" id="faksimili"
                                    placeholder="Contoh : (031)21123231">
                                @error('faksimili')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email_perusahaan" class="form-label">Email Perusahaan:</label>
                                <input type="email" class="form-control" name="email_perusahaan"
                                    id="email_perusahaan" placeholder="Contoh : perusahaan@example.com">
                                @error('email_perusahaan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="pengawas_pekerjaan">Pengawas Pekerjaan:</label>
                                <input type="text" class="form-control" name="pengawas_pekerjaan"
                                    id="pengawas_pekerjaan" placeholder="Masukkan nama pengawas pekerjaan">
                                @error('pengawas_pekerjaan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="pengawas_k3">Pengawas K3:</label>
                                <input type="text" class="form-control" name="pengawas_k3" id="pengawas_k3"
                                    placeholder="Masukkan nama pengawas K3">
                                @error('pengawas_k3')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <button type="button" class="btn btn-primary" onclick="goToTab(2)">Selanjutnya</button>

                        </div>
                        <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Password Confirmation</label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            {{-- <div class="mb-3">
                                <label for="picture_profile" class="form-label">Picture Profile</label>
                                <input type="file"
                                    class="form-control @error('picture_profile') is-invalid @enderror"
                                    name="picture_profile" accept=".png, .jpg, .jpeg">
                                @error('picture_profile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            <button type="button" class="btn btn-primary" onclick="goToTab(1)">Kembali</button>
                            <button class="btn btn-primary">Submit</button>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <script src="{{ asset('tampilan/dist/js/bootstrap.bundle.min.js') }}"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script> --}}
    <script src="{{ asset('adminkit/js/app.js') }}"></script>
    <script>
        const registrationTabs = new bootstrap.Tab(document.getElementById('registrationTabs'));
        const tab1Button = document.getElementById('tab1-tab');
        const tab2Button = document.getElementById('tab2-tab');

        function goToTab(tabNumber) {
            if (tabNumber === 2) {
                tab2Button.classList.remove('disabled');
                tab2Button.click();
                tab1Button.classList.add('disabled');
            }
            if (tabNumber === 1) {
                tab1Button.classList.remove('disabled');
                tab1Button.click();
                tab2Button.classList.add('disabled');
            }
        }
    </script>

</body>

</html>
