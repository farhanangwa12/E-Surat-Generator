<?php

namespace App\Http\Controllers\SubKontrak;

use App\Http\Controllers\Controller;
use App\Models\KontrakKerja;
use App\Models\SubKontrak\BarJas;
use App\Models\SubKontrak\JenisKontrak;
use App\Models\SubKontrak\SubBarjas;
use Illuminate\Http\Request;

class SubBarJasController extends Controller
{
    public function create($id_barjas)
    {
        // Tampilkan halaman tambah data

        return view('plnpengadaan.kontraktahap1.SubKontrak.SubBarJas.create', compact('id_barjas'));
    }

    public function edit($id)
    {
        $subbarjas = SubBarJas::findOrFail($id);

        // Tampilkan halaman edit data
        return view('plnpengadaan.kontraktahap1.SubKontrak.SubBarJas.edit', compact('subbarjas'));

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_barjas' => 'required',
            'uraian' => 'required',
            'volume' => 'required|numeric',
            'satuan' => 'required',
            'harga_satuan' => 'required|numeric',
        ]);
        if (!preg_match('/^-\s+/', $validatedData['uraian'])) {
           $validatedData['uraian'] = '- ' . $validatedData['uraian'];
        }
        $validatedData['jumlah'] = $validatedData['volume'] * $validatedData['harga_satuan'];

        SubBarJas::create($validatedData);


        $barjas = BarJas::find($validatedData['id_barjas']);
        $jenis_kontrak = JenisKontrak::find($barjas->id_jenis_kontrak);
        $kontrak = KontrakKerja::find($jenis_kontrak->id_kontrak);
        // Redirect atau response sesuai kebutuhan
        return redirect()->route('subkontrak.show', ['id' => $kontrak['id_kontrakkerja'], 'id_jenis' => $jenis_kontrak->id])
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_barjas' => 'required',
            'uraian' => 'required',
            'volume' => 'required|numeric',
            'satuan' => 'required',
            'harga_satuan' => 'required|numeric',
        ]);

        $subBarJas = SubBarJas::findOrFail($id);
        $subBarJas->update($validatedData);

     
        $barjas = BarJas::find($validatedData['id_barjas']);
        $jenis_kontrak = JenisKontrak::find($barjas->id_jenis_kontrak);
        $kontrak = KontrakKerja::find($jenis_kontrak->id_kontrak);
        // Redirect atau response sesuai kebutuhan
        return redirect()->route('subkontrak.show', ['id' => $kontrak->id_kontrakkerja, 'id_jenis' => $jenis_kontrak->id])
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $subBarJas = SubBarjas::findOrFail($id);
        $subBarJas->delete();

        // Redirect atau response sesuai kebutuhan
    
        $barjas = BarJas::find($subBarJas->id_barjas);
        $jenis_kontrak = JenisKontrak::find($barjas->id_jenis_kontrak);
        $kontrak = KontrakKerja::find($jenis_kontrak->id_kontrak);
        // Redirect atau response sesuai kebutuhan
        return redirect()->route('subkontrak.show', ['id' => $kontrak->id_kontrakkerja, 'id_jenis' => $jenis_kontrak->id])
            ->with('success', 'Data berhasil dihapus.');
    }
}
