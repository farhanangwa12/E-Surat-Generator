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
        $barjas = BarJas::where('id', $id_barjas)->with('Jeniskontrak')->first();
        // dd($barjas);
        $id_kontrakkerja = $barjas->Jeniskontrak->id_kontrak;
        $id_jenis_kontrak = $barjas->Jeniskontrak->id;
        return view('plnpengadaan.kontraktahap1.SubKontrak.SubBarJas.create', compact('id_barjas', 'id_kontrakkerja', 'id_jenis_kontrak'));
    }

    public function edit($id)
    {
        $subbarjas = SubBarJas::findOrFail($id);

        // Tampilkan halaman tambah data
        $barjas = SubBarjas::where('id', $id)->with('BarJas.Jeniskontrak')->first();
        // dd($barjas);
        $id_kontrakkerja = $barjas->BarJas->Jeniskontrak->id_kontrak;
        $id_jenis_kontrak = $barjas->BarJas->Jeniskontrak->id;
        // Tampilkan halaman edit data
        return view('plnpengadaan.kontraktahap1.SubKontrak.SubBarJas.edit', compact('subbarjas', 'id_kontrakkerja', 'id_jenis_kontrak'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_barjas' => 'required',
            'uraian' => 'required',
            'volume' => 'required|numeric',
            'satuan' => 'required',
            // 'harga_satuan' => 'required|numeric',
        ]);
        if (!preg_match('/^-\s+/', $validatedData['uraian'])) {
            $validatedData['uraian'] = '- ' . $validatedData['uraian'];
        }
        // $validatedData['jumlah'] = $validatedData['volume'] * $validatedData['harga_satuan'];

        $subbarjas1 = SubBarJas::create($validatedData);


        $subbarjas2 = SubBarjas::where('id', $subbarjas1->id)->with('Barjas.jenisKontrak')->first();

        // $barjas = BarJas::find($validatedData['id_barjas']);
        // $jenis_kontrak = JenisKontrak::find($barjas->id_jenis_kontrak);
        // $kontrak = KontrakKerja::find($jenis_kontrak->id_kontrak);
        // Redirect atau response sesuai kebutuhan
        return redirect()->route('subkontrak.show', ['id_kontrakkerja' => $subbarjas2->Barjas->jenisKontrak->id_kontrak, 'id_jenis' => $subbarjas2->Barjas->jenisKontrak->id])
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_barjas' => 'required',
            'uraian' => 'required',
            'volume' => 'required|numeric',
            'satuan' => 'required',
            // 'harga_satuan' => 'required|numeric',
        ]);
        if (!preg_match('/^-\s+/', $validatedData['uraian'])) {
            $validatedData['uraian'] = '- ' . $validatedData['uraian'];
        }

        $subbarjas1 = SubBarJas::findOrFail($id);
        $subbarjas1->update($validatedData);



        $subbarjas2 = SubBarjas::where('id', $subbarjas1->id)->with('Barjas.jenisKontrak')->first();


        // $barjas = BarJas::find($validatedData['id_barjas']);
        // $jenis_kontrak = JenisKontrak::find($barjas->id_jenis_kontrak);
        // $kontrak = KontrakKerja::find($jenis_kontrak->id_kontrak);
        // Redirect atau response sesuai kebutuhan
        return redirect()->route('subkontrak.show', ['id_kontrakkerja' => $subbarjas2->Barjas->jenisKontrak->id_kontrak, 'id_jenis' => $subbarjas2->Barjas->jenisKontrak->id])
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {


        // Redirect atau response sesuai kebutuhan

        $subbarjas1 = SubBarjas::where('id', $id)->with('Barjas.jenisKontrak')->first();

        // Hapus
        $subbarjas2 = SubBarjas::findOrFail($id);
        $subbarjas1->delete();



        // $barjas = BarJas::find($subBarJas->id_barjas);
        // $jenis_kontrak = JenisKontrak::find($barjas->id_jenis_kontrak);
        // $kontrak = KontrakKerja::find($jenis_kontrak->id_kontrak);
        // Redirect atau response sesuai kebutuhan
        return redirect()->route('subkontrak.show', ['id_kontrakkerja' => $subbarjas2->Barjas->jenisKontrak->id_kontrak, 'id_jenis' => $subbarjas2->Barjas->jenisKontrak->id])
            ->with('success', 'Data berhasil dihapus.');
    }
}
