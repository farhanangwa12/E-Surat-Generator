@extends('template.app')

@section('title', 'Tanda Tangan Pengadaan')

@section('content')

    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"></h1>

        <div class="row">
            <div class="col-12">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Detail Kontrak --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        Dengan menandatangani tanda tangan yang disediakan dan memberikan aksi pada tombol kirim, Anda
                        mengkonfirmasi bahwa dokumen tersebut telah diverifikasi dan siap untuk dikirim ke vendor, sehingga
                        proses pengadaan dapat dilanjutkan.
                        <style>
                            #signature-canvas {
                                border: 1px solid black;
                            }
                        </style>
                        <div class="d-flex justify-content-center">
                            <canvas id="signature-canvas" width="500" height="200"></canvas>
                        </div>


                    </div>
                    <div class="card-body">

                        <div class="btn-group me-2" role="group" aria-label="Tombol gabungan">
                            <a href="{{ route('tandatangan.detail', ['id'=>$id]) }}" class="btn btn-info">Kembali</a>
                            <button type="submit" class="btn btn-primary" id="save-signature-btn">Kirim</button>
                        </div>
                    </div>
                </div>



            </div>

        </div>

    </div>
@endsection

@section('javascript')

    <script>
        // ambil elemen canvas dan tombol untuk menyimpan tanda tangan
        var canvas = document.getElementById("signature-canvas");
        var saveBtn = document.getElementById("save-signature-btn");
        var context = canvas.getContext("2d");

        // inisialisasi variabel untuk menampung titik awal dan status tanda tangan
        var isDrawing = false;
        var lastX = 0;
        var lastY = 0;

        // fungsi untuk memulai tanda tangan
        function startDrawing(e) {
            isDrawing = true;
            [lastX, lastY] = [e.offsetX, e.offsetY];
        }

        // fungsi untuk menggambar tanda tangan
        function draw(e) {
            console.log(e.offsetX);
            if (!isDrawing) return;
            context.beginPath();
            context.moveTo(lastX, lastY);
            context.lineTo(e.offsetX, e.offsetY);
            context.stroke();
            [lastX, lastY] = [e.offsetX, e.offsetY];
        }

        // fungsi untuk mengakhiri tanda tangan
        function endDrawing() {
            isDrawing = false;
        }

        // fungsi untuk mengonversi gambar tanda tangan ke base64-encoded string
        function convertToBase64() {
            var signatureData = canvas.toDataURL("image/png");

            // mengonversi base64 menjadi binary
            const base64Image = signatureData.split(';base64,').pop();
            const byteArray = atob(base64Image);
            const byteArrayLength = byteArray.length;
            const uint8Array = new Uint8Array(byteArrayLength);
            for (let i = 0; i < byteArrayLength; i++) {
                uint8Array[i] = byteArray.charCodeAt(i);
            }

            // membuat file dari binary
            const file = new File([uint8Array], "gambar.png", {
                type: "image/png"
            });

            // membuat form data untuk mengirim file dan token CSRF
            const formData = new FormData();
            formData.append("pengadaan", file);
            formData.append("id", "{{ $id }}");
            // formData.append("status", "")
            formData.append("_token", "{{ csrf_token() }}");

            // membuat AJAX request
            const xhr = new XMLHttpRequest();
            xhr.open('POST', "{{ route('undangan.simpantandatangan') }}");
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    window.location.href = "{{ route('tandatangan.detail', ['id'=>$id]) }}";
                    console.log('Tanda Tangan berhasil diupload');
                } else {
                    var response = JSON.parse(xhr.responseText);
                    var errorMessage = response
                    .error_message; // Ubah "error_message" sesuai dengan properti yang sesuai dalam respons JSON
                    console.log('Gagal Melakukan Tanda tangan:', errorMessage);
                }
            };
            xhr.send(formData);
            return signatureData;
        }

        // fungsi untuk mengonversi base64-encoded string ke gambar tanda tangan
        function convertToImage(signatureData) {
            var signatureImage = new Image();
            signatureImage.src = signatureData;
            signatureImage.onload = function() {
                context.drawImage(signatureImage, 0, 0);
            };
        }

        // tambahkan event listener ke elemen canvas
        canvas.addEventListener("mousedown", startDrawing);
        canvas.addEventListener("mousemove", draw);
        canvas.addEventListener("mouseup", endDrawing);

        // tambahkan event listener ke tombol untuk menyimpan tanda tangan
        saveBtn.addEventListener("click", function() {
            // konversi gambar tanda tangan ke base64-encoded string
            // var signatureData = convertToBase64();
            convertToBase64();



            // // konversi base64-encoded string ke gambar tanda tangan
            // convertToImage(signatureData);
        });
    </script>
@endsection
