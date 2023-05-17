<?php

namespace App\Http\Controllers;

use App\Models\KontrakKerja;
use Illuminate\Http\Request;

class VendorTandaTangan extends Controller
{
    public function index()
    {
        $status = [
            'Tanda Tangan Vendor',
        ];
        $kontrak = KontrakKerja::whereIn('status', $status)->get();

        return view('vendor.tandatangan', compact('kontrak'));
    }
}
