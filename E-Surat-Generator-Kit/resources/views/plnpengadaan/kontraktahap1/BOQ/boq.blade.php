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

@section('javascript')
    <script>
        function handleChange(input) {
            // mengambil nilai input
            var value = input.value;

            // menghapus semua karakter selain angka
            value = value.replace(/\D/g, '');

            // menambahkan titik setiap tiga digit dari belakang
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            // memperbarui nilai input
            input.value = value;
        }
        console.log();

        // Hapus Jenis Pekerjaan
        window.addEventListener("load", function() {
            var deleteButtons = document.querySelectorAll("#hapusjenis");

            deleteButtons.forEach(function(button) {
                button.addEventListener("click", function() {
                    var numberDelete = document.querySelectorAll("#hapusjenis").length;
                    var row = this.closest("tbody");
                    if (numberDelete > 1) {
                        row.parentNode.removeChild(row);
                        var tr = document.querySelector("#hapusjenis").closest('tr');
                        var tdHapusSearch = tr.querySelectorAll('td');
                            
                        var deleteButtonHidden = tdHapusSearch[tdHapusSearch.length - 1].querySelector('#hapusjenis').setAttribute("style", "display: none;");
                        console.log(deleteButtonHidden);
;          
                        var gantiNo = tr.querySelector('td:first-child').querySelector('input[name="no[]"]').value = 'I.';





                    }
                });
            });
        });
    </script>



    <script>
        var material = document.getElementById('MATERIAL');
        var jasa = document.getElementById('JASA');
        var materialbutton = material.querySelector('#material');
        var jasabutton = jasa.querySelector('#jasa');




        materialbutton.addEventListener("click", function() {



            // Memberikan nomor di no input
            // if (material.rows.length > 1) {

            //     var lastNoInput = material.rows[material.rows.length - 1].querySelector('input[name="no[]"]');

            //     var lastNoValue = parseInt(lastNoInput.value);
            //     if (!isNaN(lastNoValue)) {
            //         nomormaterial = lastNoValue + 1;
            //     }
            // }

            // if (isNaN(nomormaterial) || nomormaterial < 1) {
            //     nomormaterial = 1;
            // }

            var newRow = document.createElement("tr");

            var cellNomor = document.createElement('td');
            var nomorInput = document.createElement('input');
            nomorInput.type = "text";
            nomorInput.classList.add('form-control');
            nomorInput.setAttribute("name", "no[]");
            // nomorInput.setAttribute("readonly", "readonly");
            // Menyimpan nomor di no;
            // nomorInput.value = nomormaterial; 

            cellNomor.appendChild(nomorInput);





            var inputUraian = document.createElement('input');
            inputUraian.type = "text";
            inputUraian.classList.add('form-control');
            inputUraian.setAttribute("name", "uraian[]");
            var cellUraian = document.createElement('td');
            cellUraian.appendChild(inputUraian);

            var inputVol = document.createElement('input');
            inputVol.type = "number";
            inputVol.classList.add('form-control');
            inputVol.setAttribute("name", "vol[]");
            var cellVol = document.createElement('td');
            cellVol.appendChild(inputVol);

            var inputSat = document.createElement('input');
            inputSat.type = "text";
            inputSat.classList.add('form-control');
            inputSat.setAttribute("name", "sat[]");
            var cellSat = document.createElement('td');
            cellSat.appendChild(inputSat);

            var inputHargaSatuan = document.createElement('input');
            inputHargaSatuan.type = "text";
            inputHargaSatuan.classList.add('form-control');
            inputHargaSatuan.setAttribute("name", "harga_satuan[]");
            // menambahkan atribut onchange ke dalam element input
            inputHargaSatuan.setAttribute("onkeyup", "handleChange(this)");

            var cellHargaSatuan = document.createElement('td');
            cellHargaSatuan.appendChild(inputHargaSatuan);

            var inputJumlah = document.createElement('input');
            inputJumlah.type = "text";
            inputJumlah.classList.add('form-control');
            inputJumlah.setAttribute("name", "jumlah[]");
            inputJumlah.setAttribute("readonly", true);
            var cellJumlah = document.createElement('td');
            cellJumlah.appendChild(inputJumlah);

            var buttonHapus = document.createElement('button');
            buttonHapus.type = "button";
            buttonHapus.textContent = "Hapus";
            buttonHapus.classList.add('hapus-element', 'btn', 'btn-danger');
            buttonHapus.onclick = function() {
                hapusBarisMaterial(this);
            };
            var cellButtonHapus = document.createElement('td');
            cellButtonHapus.appendChild(buttonHapus);

            newRow.appendChild(cellNomor);
            newRow.appendChild(cellUraian);
            newRow.appendChild(cellVol);
            newRow.appendChild(cellSat);
            newRow.appendChild(cellHargaSatuan);
            newRow.appendChild(cellJumlah);
            newRow.appendChild(cellButtonHapus);

            // Menghapus delete lainnya
            var lastRow = material.rows[material.rows.length - 1];
            var cols = lastRow.getElementsByTagName('td');
            if (cols.length > 3) {
                var deleteButton = cols[6];
                while (deleteButton.hasChildNodes()) {
                    deleteButton.removeChild(deleteButton.lastChild);
                }

            }

            material.appendChild(newRow);


            // var hapusElementButtons = material.querySelectorAll(".hapus-element");
            // hapusElementButtons.forEach(function(button) {
            //     button.addEventListener("click", function() {
            //         var row = button.closest("tr");
            //         row.parentNode.removeChild(row);



            //     });
            // });



        });



        function hapusBarisMaterial(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);


            var lastRow = material.rows[material.rows.length - 1];
            var cols = lastRow.getElementsByTagName('td');
            if (cols.length > 3) {
                var deleteButton = cols[6];
                var buttonHapus = document.createElement('button');
                buttonHapus.type = "button";
                buttonHapus.textContent = "Hapus";
                buttonHapus.classList.add('hapus-element', 'btn', 'btn-danger');
                buttonHapus.onclick = function() {
                    hapusBarisMaterial(this);
                };
                var cellButtonHapus = document.createElement('td');
                deleteButton.appendChild(buttonHapus);

            }
        }





        // Jasa
        jasabutton.addEventListener("click", function() {



            // Memberikan nomor di no input
            // if (jasa.rows.length > 1) {

            //     var lastNoInput = jasa.rows[jasa.rows.length - 1].querySelector('input[name="no[]"]');

            //     var lastNoValue = parseInt(lastNoInput.value);
            //     if (!isNaN(lastNoValue)) {
            //         nomorjasa = lastNoValue + 1;
            //     }
            // }

            // if (isNaN(nomorjasa) || nomorjasa < 1) {
            //     nomorjasa = 1;
            // }

            var newRow = document.createElement("tr");

            var cellNomor = document.createElement('td');
            var nomorInput = document.createElement('input');
            nomorInput.type = "text";
            nomorInput.classList.add('form-control');
            nomorInput.setAttribute("name", "no[]");
            // nomorInput.setAttribute("readonly", "readonly");
            // Menyimpan nomor di no;
            // nomorInput.value = nomorjasa; 

            cellNomor.appendChild(nomorInput);





            var inputUraian = document.createElement('input');
            inputUraian.type = "text";
            inputUraian.classList.add('form-control');
            inputUraian.setAttribute("name", "uraian[]");
            var cellUraian = document.createElement('td');
            cellUraian.appendChild(inputUraian);

            var inputVol = document.createElement('input');
            inputVol.type = "number";
            inputVol.classList.add('form-control');
            inputVol.setAttribute("name", "vol[]");
            var cellVol = document.createElement('td');
            cellVol.appendChild(inputVol);

            var inputSat = document.createElement('input');
            inputSat.type = "text";
            inputSat.classList.add('form-control');
            inputSat.setAttribute("name", "sat[]");
            var cellSat = document.createElement('td');
            cellSat.appendChild(inputSat);

            var inputHargaSatuan = document.createElement('input');
            inputHargaSatuan.type = "text";
            inputHargaSatuan.classList.add('form-control');
            inputHargaSatuan.setAttribute("name", "harga_satuan[]");
            // menambahkan atribut onchange ke dalam element input
            inputHargaSatuan.setAttribute("onkeyup", "handleChange(this)");

            var cellHargaSatuan = document.createElement('td');
            cellHargaSatuan.appendChild(inputHargaSatuan);

            var inputJumlah = document.createElement('input');
            inputJumlah.type = "text";
            inputJumlah.classList.add('form-control');
            inputJumlah.setAttribute("name", "jumlah[]");
            inputJumlah.setAttribute("readonly", true);
            var cellJumlah = document.createElement('td');
            cellJumlah.appendChild(inputJumlah);

            var buttonHapus = document.createElement('button');
            buttonHapus.type = "button";
            buttonHapus.textContent = "Hapus";
            buttonHapus.classList.add('hapus-element', 'btn', 'btn-danger');
            buttonHapus.onclick = function() {
                hapusBarisjasa(this);
            };
            var cellButtonHapus = document.createElement('td');
            cellButtonHapus.appendChild(buttonHapus);

            newRow.appendChild(cellNomor);
            newRow.appendChild(cellUraian);
            newRow.appendChild(cellVol);
            newRow.appendChild(cellSat);
            newRow.appendChild(cellHargaSatuan);
            newRow.appendChild(cellJumlah);
            newRow.appendChild(cellButtonHapus);

            // Menghapus delete lainnya
            var lastRow = jasa.rows[jasa.rows.length - 1];
            var cols = lastRow.getElementsByTagName('td');
            if (cols.length > 3) {
                var deleteButton = cols[6];
                while (deleteButton.hasChildNodes()) {
                    deleteButton.removeChild(deleteButton.lastChild);
                }

            }

            jasa.appendChild(newRow);


            // var hapusElementButtons = jasa.querySelectorAll(".hapus-element");
            // hapusElementButtons.forEach(function(button) {
            //     button.addEventListener("click", function() {
            //         var row = button.closest("tr");
            //         row.parentNode.removeChild(row);



            //     });
            // });



        });



        function hapusBarisjasa(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);


            var lastRow = jasa.rows[jasa.rows.length - 1];
            var cols = lastRow.getElementsByTagName('td');
            if (cols.length > 3) {
                var deleteButton = cols[6];
                var buttonHapus = document.createElement('button');
                buttonHapus.type = "button";
                buttonHapus.textContent = "Hapus";
                buttonHapus.classList.add('hapus-element', 'btn', 'btn-danger');
                buttonHapus.onclick = function() {
                    hapusBarisjasa(this);
                };
                var cellButtonHapus = document.createElement('td');
                deleteButton.appendChild(buttonHapus);

            }
        }
    </script>

@endsection
