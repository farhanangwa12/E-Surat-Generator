<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();
 
        return view('plninternal.Pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('plninternal.Pegawai.create');
    }

    public function store(Request $request)
    {
        $akun = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',

        ]);
        $akun = new User($akun);
        $akun->password = bcrypt($request->get('password'));

        $akun->save();

    
        $id = $akun->id;
       

        $pegawai = $request->validate([
            'nama_pegawai' => 'required',
            'jabatan' => 'required',
            'nomor_jabatan' => 'required'
        ]);

        $pegawai = new Pegawai($pegawai);
        $pegawai->id_akun = $id;
        $pegawai->save();


        

      
    
        return redirect()->route('pegawai')->with('success', 'Pegawai berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('plninternal.Pegawai.show', compact('pegawai'));
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('plninternal.Pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_pegawai' => 'required',
    
            'jabatan' => 'required',
            'nomor_jabatan' => 'required'
        ]);


        $pegawai = Pegawai::find($id);
        $pegawai->nama_pegawai = $validatedData['nama_pegawai'];
      
        // $pegawai->password = bcrypt($request->get('password'));
        $pegawai->jabatan = $validatedData['jabatan'];
        $pegawai->nomor_jabatan = $validatedData['nomor_jabatan'];

        $pegawai->save();
        return redirect()->route('pegawai')->with('success', 'Pegawai berhasil diupdate!');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai')->with('success', 'Pegawai berhasil dihapus!');
    }
}
