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


        // $id = $akun->id;
        $validator = Validator::make($request->all(), [
            'penyedia' => 'required',
            'direktur' => 'required',
            'alamat_jalan' => 'required',
            'alamat_kota' => 'required',
            'alamat_provinsi' => 'required',
            'bank' => 'required',
            'nomor_rek' => 'required',
            'telepon' => 'nullable',
            'website' => 'nullable',
            'faksimili' => 'nullable',
            'email_perusahaan' => 'nullable|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Jika validasi berhasil, simpan ke model Vendor
        $vendor = new Vendor;
        $vendor->penyedia = $request->input('penyedia');
        $vendor->direktur = $request->input('direktur');
        $vendor->alamat_jalan = $request->input('alamat_jalan');
        $vendor->alamat_kota = $request->input('alamat_kota');
        $vendor->alamat_provinsi = $request->input('alamat_provinsi');
        $vendor->bank = $request->input('bank');
        $vendor->nomor_rek = $request->input('nomor_rek');
        $vendor->telepon = $request->input('telepon');
        $vendor->website = $request->input('website');
        $vendor->faksimili = $request->input('faksimili');
        $vendor->email_perusahaan = $request->input('email_perusahaan');
        $vendor->save();




        $akun = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',


        ]);
        $akun = new User($akun);
        $akun->password = bcrypt($request->get('password'));
        $akun->role = 'vendor';
        $akun->vendor_id = $vendor->id_vendor;
        $akun->save();

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


        // $id = $akun->id;
        $validator = Validator::make($request->all(), [
            'penyedia' => 'required',
            'direktur' => 'required',
            'alamat_jalan' => 'required',
            'alamat_kota' => 'required',
            'alamat_provinsi' => 'required',
            'bank' => 'required',
            'nomor_rek' => 'required',
            'telepon' => 'nullable',
            'website' => 'nullable',
            'faksimili' => 'nullable',
            'email_perusahaan' => 'nullable|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $vendor = Vendor::find($id);

        // Jika validasi berhasil, simpan ke model Vendor
        $vendor = new Vendor;
        $vendor->penyedia = $request->input('penyedia');
        $vendor->direktur = $request->input('direktur');
        $vendor->alamat_jalan = $request->input('alamat_jalan');
        $vendor->alamat_kota = $request->input('alamat_kota');
        $vendor->alamat_provinsi = $request->input('alamat_provinsi');
        $vendor->bank = $request->input('bank');
        $vendor->nomor_rek = $request->input('nomor_rek');
        $vendor->telepon = $request->input('telepon');
        $vendor->website = $request->input('website');
        $vendor->faksimili = $request->input('faksimili');
        $vendor->email_perusahaan = $request->input('email_perusahaan');
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
