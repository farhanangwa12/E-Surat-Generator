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

        $validatedData = $request->validate([
            'nama_dokumen' => 'required',
        ]);

        $jenisdokumen = new JenisDokumenKelengkapan($validatedData);
        $jenisdokumen->save();
        // Redirect ke halaman dashboard
        // return redirect('/user/show');
        return redirect()->route('jenisdokumen')->with('success', 'Jenis dokumen created successfully');
    }

    public function edit($id)
    {
        $jenisdokumen = JenisDokumenKelengkapan::find($id);
        
        return view('plninternal.NamaDokumenCRUD.edit',compact('jenisdokumen'));
    }

    public function update(Request $request, $id)
    {
      
        $jenisdokumen = JenisDokumenKelengkapan::find($id);
        $jenisdokumen->nama_dokumen = $request->get('nama_dokumen');
    
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
