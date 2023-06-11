<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumenKelengkapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisDokumenController extends Controller
{
    public function index()
    {
        $jenisdok = JenisDokumenKelengkapan::all();
        // return view('plninternal.User.index', compact('users'));
        return view('plninternal.NamaDokumenCRUD.index', compact('jenisdok'));
    }

    public function create()
    {

        return view('plninternal.NamaDokumenCRUD.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_dokumen' => 'required',
            'no_dokumen' => 'required',
            'keterangan' => 'nullable',
        ]);
      

        $jenisDokumen = new JenisDokumenKelengkapan();
        $jenisDokumen->nama_dokumen = $request->nama_dokumen;
        $jenisDokumen->no_dokumen = $request->no_dokumen;
        $jenisDokumen->keterangan = $request->keterangan;
        $jenisDokumen->save();

        // Redirect ke halaman dashboard
        // return redirect('/user/show');
        return redirect()->route('jenisdokumen')->with('success', 'Jenis dokumen created successfully');
    }

    public function edit($id)
    {
        $jenisdokumen = JenisDokumenKelengkapan::find($id);

        return view('plninternal.NamaDokumenCRUD.edit', compact('jenisdokumen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_dokumen' => 'required',
            'no_dokumen' => 'required',
            'keterangan' => 'nullable',
        ]);

        $jenisdokumen = JenisDokumenKelengkapan::find($id);
        $jenisdokumen->nama_dokumen = $request->nama_dokumen;
        $jenisdokumen->no_dokumen = $request->no_dokumen;
        $jenisdokumen->keterangan = $request->keterangan;
        $jenisdokumen->save();
        return redirect()->route('jenisdokumen')->with('success', 'Jenis Dokumen updated successfully');
    }

    public function destroy($id)
    {
        $jenisdokumen = JenisDokumenKelengkapan::find($id);
        $jenisdokumen->delete();
        return redirect()->route('jenisdokumen')->with('success', 'Jenis Dokumen deleted successfully');
    }
}
