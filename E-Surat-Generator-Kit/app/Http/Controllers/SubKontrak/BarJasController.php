<?php

namespace App\Http\Controllers\SubKontrak;

use App\Http\Controllers\Controller;
use App\Models\SubKontrak\BarJas;
use App\Models\SubKontrak\SubBarjas;
use Illuminate\Http\Request;

class BarJasController extends Controller
{
    public function create($id_jenis_kontrak)
    {
        // Menampilkan form create
        return view('plnpengadaan.kontraktahap1.SubKontrak.BarJas.create', compact('id_jenis_kontrak'));
    }

    public function store(Request $request)
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
        return redirect()->route('subkontrak.show', ['id' => $barJas->id, 'id_jenis' => $barJas->id_jenis_kontrak])
            ->with('success', 'Data berhasil disimpan.');
    }


    public function edit($id)
    {
        // Mengambil data berdasarkan id
        $barjas = BarJas::find($id);

        // Tampilkan form edit
        return view('plnpengadaan.kontraktahap1.SubKontrak.BarJas.edit', compact('barjas'));
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
        $barJas = BarJas::find($id);
        return redirect()->route('subkontrak.show', ['id' => $barJas->id, 'id_jenis' => $barJas->id_jenis_kontrak])
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Hapus data dari database
        $barJas = BarJas::find($id);
        $barJas->subBarjas()->delete();
        $barJas->delete();

        // Redirect ke halaman subkontrak.show dengan parameter id dan id_jenis
        return redirect()->route('subkontrak.show', ['id' => $barJas->id, 'id_jenis' => $barJas->id_jenis_kontrak])
            ->with('success', 'Data berhasil dihapus.');
    }
}
