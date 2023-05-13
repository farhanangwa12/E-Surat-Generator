<?php

namespace App\Http\Controllers;

use App\Models\KontrakKerja;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class VendorKontrakKerjaController extends Controller
{
    public function index()
    {
        $kontrak = KontrakKerja::where('status','Input Kontrak Vendor')->get();

        return view('vendor.kontrakkerja', compact('kontrak'));
    }
    public function detail($id)
    {
        $kontrakkerja = KontrakKerja::find($id);

        // Path File
        $path = storage_path('app/public/dokumenpenawaran/' . $kontrakkerja->filemaster);

        $spreadsheet = IOFactory::load($path);
        $worksheet = $spreadsheet->getActiveSheet();

        return view('vendor.detailkontrak', compact('kontrakkerja', 'id'));
    }


    public function pengisiankontrakkerja()
    {
        return view('vendor.pengisiankontrakkerja');
    }
}
