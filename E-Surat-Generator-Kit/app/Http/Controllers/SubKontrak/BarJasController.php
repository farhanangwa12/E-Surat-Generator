<?php

namespace App\Http\Controllers\SubKontrak;

use App\Http\Controllers\Controller;
use App\Models\SubKontrak\BarJas;
use App\Models\SubKontrak\SubBarjas;
use Illuminate\Http\Request;

class BarJasController extends Controller
{
    public function create($id_kontrakkerja,$id_jenis_kontrak)
    {
        // Menampilkan form create
        return view('plnpengadaan.kontraktahap1.SubKontrak.BarJas.create', compact('id_jenis_kontrak', 'id_kontrakkerja'));
    }

    public function store(Request $request, $id_kontrakkerja)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'id_jenis_kontrak' => 'required',
            'uraian' => 'required',
            'volume' => 'required|numeric',
            'satuan' => 'required',
            // 'harga_satuan' => 'required|numeric',

        ]);
        // $validatedData['jumlah'] = $validatedData['volume'] * $validatedData['harga_satuan'];

        // Simpan data ke database
        $barJas = BarJas::create($validatedData);

        // Redirect ke halaman subkontrak.show dengan parameter id dan id_jenis
        return redirect()->route('subkontrak.show', ['id_kontrakkerja' => $id_kontrakkerja, 'id_jenis' => $barJas->id_jenis_kontrak])
            ->with('success', 'Data berhasil disimpan.');
    }


    public function edit($id)
    {
        // Mengambil data berdasarkan id
        $barjas = BarJas::find($id);
        $barJas1 = BarJas::where('id',$id)->with('jenisKontrak')->first();

        $id_jenis_kontrak = $barJas1->jenisKontrak->id;
        $id_kontrakkerja = $barJas1->jenisKontrak->id_kontrak;
        
   
        // Tampilkan form edit
        return view('plnpengadaan.kontraktahap1.SubKontrak.BarJas.edit', compact('barjas', 'id_jenis_kontrak', 'id_kontrakkerja'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $validatedData = $request->validate([
            'id_jenis_kontrak' => 'required',
            'uraian' => 'required',
            'volume' => 'required|numeric',
            'satuan' => 'required',
            // 'harga_satuan' => 'required|numeric',

        ]);
        // $validatedData['jumlah'] = $validatedData['volume'] * $validatedData['harga_satuan'];
        // Update data ke database
        BarJas::where('id', $id)->update($validatedData);

        // Redirect ke halaman subkontrak.show dengan parameter id dan id_jenis
        $barJas = BarJas::where('id',$id)->with('jenisKontrak')->first();
        // dd($barJas);
        return redirect()->route('subkontrak.show', ['id_kontrakkerja' => $barJas->jenisKontrak->id_kontrak, 'id_jenis' => $barJas->id_jenis_kontrak])
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Mencari data dan mengambil id kontrakkerja
        $barJas1 = BarJas::where('id',$id)->with('jenisKontrak')->first();


        // Hapus data dari database
        $barJas2 = BarJas::find($id);
        $barJas2->subBarjas()->delete();
        $barJas2->delete();

        
        // Redirect ke halaman subkontrak.show dengan parameter id dan id_jenis
        return redirect()->route('subkontrak.show', ['id_kontrakkerja' => $barJas1->jenisKontrak->id_kontrak, 'id_jenis' => $barJas2->id_jenis_kontrak])
            ->with('success', 'Data berhasil dihapus.');
    }
}
