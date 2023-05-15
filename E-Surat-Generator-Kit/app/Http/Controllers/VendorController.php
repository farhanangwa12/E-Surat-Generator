<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function showbyid($id)
    {
        $vendor = Vendor::find($id);

        if (!$vendor) {
            return response()->json(['error' => 'Vendor not found'], 404);
        }

        return response()->json($vendor);
    }
    public function show()
    {
        $vendor = Vendor::all();
        return view('plninternal.Vendor.index', compact('vendor'));
    }

    public function create()
    {
        return view('plninternal.Vendor.create');
    }

    public function store(Request $request)
    {
        $akun = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',


        ]);
        $akun = new User($akun);
        $akun->password = bcrypt($request->get('password'));
        $akun->role = 'vendor';
        $akun->save();


        $id = $akun->id;
        $validatedData = $request->validate([
            'penyedia' => 'required|max:255',
            'direktur' => 'required|max:255',
            'alamat_jalan' => 'required|max:255',
            'alamat_kota' => 'required|max:255',
            'alamat_provinsi' => 'required|max:255',
            'bank' => 'required|max:255',
            'nomor_rek' => 'required|max:255',
        ]);

        $vendor = new Vendor($validatedData);
        $vendor->id_akun = $id;

        $vendor->save();
        // Redirect ke halaman dashboard
        return redirect()->route('vendor')->with('success', 'Vendor created successfully');
    }

    public function edit($id)
    {
        $vendor = Vendor::find($id);
        return view('plninternal.Vendor.edit', compact('vendor'));
    }

    public function update(Request $request, $id)
    {



        $validatedData = $request->validate([

            'penyedia' => 'required|max:255',
            'direktur' => 'required|max:255',
            'alamat' => 'required|max:255',
            'bank' => 'required|max:255',
            'nomor_rek' => 'required|max:255',
        ]);



        $vendor = Vendor::find($id);

        $vendor->penyedia = $validatedData['penyedia'];
        $vendor->direktur = $validatedData['direktur'];
        $vendor->alamat = $validatedData['alamat'];
        $vendor->bank = $validatedData['bank'];
        $vendor->nomor_rek = $validatedData['nomor_rek'];

        $vendor->save();
        return redirect()->route('vendor')->with('success', 'vendor updated successfully');
    }

    public function destroy($id)
    {
        $vendor = Vendor::find($id);
        $vendor->delete();
        return redirect()->route('vendor')->with('success', 'vendor deleted successfully');
    }
}
