<?php

namespace App\Http\Controllers;

use App\Models\DokumenVendor\Formpenawaranharga;
use App\Models\JenisDokumenKelengkapan;
use App\Models\KontrakKerja;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class VendorKontrakKerjaController extends Controller
{
    public function index()
    {
        $status = [


            // 'Kontrak dibatalkan',
            'Kontrak disetujui',
            // 'Tanda Tangan Vendor',
            // 'Kontrak Kerja Berjalan'
        ];
        $auth = Auth()->user();

        $kontrak = KontrakKerja::whereIn('status', $status)->where('id_vendor', $auth->vendor_id)->get();

        return view('vendor.kontrakkerja', compact('kontrak'));
    }
    public function detail($id)
    {

        $kontrakkerja = KontrakKerja::find($id);

        // // Path File
        // $path = storage_path('app/public/dokumenpenawaran/' . $kontrakkerja->filemaster);

        // $spreadsheet = IOFactory::load($path);
        // $worksheet = $spreadsheet->getActiveSheet();

        $jenisDokumenKelengkapans =   JenisDokumenKelengkapan::with(['kelengkapanDokumenVendors' => function ($query) use ($id) {
            $query->where('id_kontrakkerja', $id);
        }])->get()->toArray();

        // dd($jenisDokumenKelengkapans[0]['kelengkapan_dokumen_vendors'][0]['id_dokumen']);
        $formpenawaran = Formpenawaranharga::with(['dokumen' => function ($query) use ($id) {
            $query->where('id_kontrakkerja', $id);
        }])->first();

        $statusformpenawaran = false;
        if (isset($formpenawaran) && $formpenawaran->kopsurat) {
            $statusformpenawaran = true;
        }


        return view('vendor.detailkontrak', compact('kontrakkerja', 'id', 'jenisDokumenKelengkapans', 'statusformpenawaran'));
    }



    public function detailttd($id)
    {
        $kontrakkerja = KontrakKerja::find($id);

        // // Path File
        // $path = storage_path('app/public/dokumenpenawaran/' . $kontrakkerja->filemaster);

        // $spreadsheet = IOFactory::load($path);
        // $worksheet = $spreadsheet->getActiveSheet();
        $jenisDokumenKelengkapans =  JenisDokumenKelengkapan::with(['kelengkapanDokumenVendors' => function ($query) use ($id) {
            $query->where('id_kontrakkerja', $id);
        }])->get()->toArray();

        // dd($jenisDokumenKelengkapans[0]['kelengkapan_dokumen_vendors'][0]['id_dokumen']);
        return view('vendor.detailttd', compact('kontrakkerja', 'id', 'jenisDokumenKelengkapans'));
    }



    public function pengisiankontrakkerja()
    {

        $status = [
            'Dokumen Input Vendor',
        ];
        $kontrak = KontrakKerja::whereIn('status', $status)->get();

        return view('vendor.pengisiankontrakkerja', compact('kontrak'));
    }
}
