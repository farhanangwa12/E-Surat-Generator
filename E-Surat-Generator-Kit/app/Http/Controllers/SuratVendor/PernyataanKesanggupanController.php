<?php

namespace App\Http\Controllers\SuratVendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PernyataanKesanggupanController extends Controller
{
    public function index()
    {
        return view('vendor.form_penawaran.pernyataan_sanggup');
    }

    public function create()
    {
        return view('vendor.form_penawaran.create');
    }

    public function update(Request $request)
    {
        // Logika update data

        return redirect()->route('pernyataan.sanggup.index');
    }

    public function halamanttd()
    {
        return view('vendor.form_penawaran.halamanttd');
    }

    public function simpanttd(Request $request)
    {
        // Logika menyimpan tanda tangan

        return redirect()->route('pernyataan.sanggup.index');
    }
}
