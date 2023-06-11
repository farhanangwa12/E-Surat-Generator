<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumenKelengkapan;
use App\Models\KelengkapanDokumenVendor;

use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class VendorKelengkapanDokumenController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $vendor = Vendor::find($user->vendor_id);

        $id = $vendor->id_vendor;
        // print_r($vendor);
        // $namadokumen = KelengkapanDokumenVendor::rightJoin('jenis_dokumen_kelengkapans', 'kelengkapan_dokumen_vendors.id_jenis_dokumen', '=', 'jenis_dokumen_kelengkapans.id_jenis')->select('jenis_dokumen_kelengkapans.nama_dokumen', 'kelengkapan_dokumen_vendors.tanggal_upload')
        //     ->get();
        $namadokumen = JenisDokumenKelengkapan::all()->toArray();
        foreach ($namadokumen as $key) {
            $vendor = KelengkapanDokumenVendor::where('id_vendor', $id)->where('id_jenis_dokumen', $key['id_jenis'])->get();
            $newVendor = $vendor->toArray();
            $key['tanggal_upload'] =  empty($newVendor) ? 'Belum Upload' : $vendor[0]['tanggal_upload'];
            $key['sudahUpload'] =  empty($newVendor) ? false : true;
            $key['id_dokumen'] =  empty($newVendor) ? '' : $newVendor[0]['id_dokumen'];
            $key['file'] =  empty($newVendor) ? '' : $newVendor[0]['file'];



            $namadokumentoArr[] = $key;
        };

        $namadokumenCollect = collect($namadokumentoArr);
        return view('vendor.kelengkapandok', compact('namadokumenCollect'));
    }

    public function pdfviewer($name)
    {
        // Set the path to the PDF file
        $pdfFile = $name;



        // Get file path
        $file_path = storage_path('app/public/kelengkapandokumen/' . $pdfFile);

        // Check if file exists
        if (!File::exists($file_path)) {
            abort(404);
        }

        // Read file contents
        $file_content = File::get($file_path);

        // Set content type to PDF
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        // Return file response
        return response()->make($file_content, 200, $headers);
    }
    public function pdf($id, $jenis)
    {
        // Mendapatkan data KelengkapanDokumen berdasarkan $id
        $dokumen = KelengkapanDokumenVendor::find($id);

        if (!$dokumen) {
            abort(404); // Jika dokumen tidak ditemukan, berikan respons 404
        }

        // Mendapatkan path file dari folder public/storage/dokumenvendor
        $path = public_path('storage/dokumenvendor/' . $dokumen->file_upload);

        if (!file_exists($path)) {
            abort(404); // Jika file tidak ditemukan, berikan respons 404
        }

        // Membaca isi file PDF
        $file = file_get_contents($path);

        if ($jenis == 1) {
            // Jika jenis = 1, streaming PDF
            return response($file, 200)->header('Content-Type', 'application/pdf');
        } elseif ($jenis == 2) {
            // Jika jenis = 2, mengunduh PDF
            return response($file, 200)->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="' . $dokumen->file_upload . '"');
        } else {
            abort(400); // Jika jenis tidak valid, berikan respons 400
        }
    }

    public function kelengkapandokumeninternal($idvendor)
    {
        // $namadokumen = KelengkapanDokumenVendor::rightJoin('jenis_dokumen_kelengkapans', 'kelengkapan_dokumen_vendors.id_jenis_dokumen', '=', 'jenis_dokumen_kelengkapans.id_jenis')->select('jenis_dokumen_kelengkapans.nama_dokumen', 'kelengkapan_dokumen_vendors.tanggal_upload')
        //     ->get();
        $namadokumen = JenisDokumenKelengkapan::all()->toArray();
        foreach ($namadokumen as $key) {
            $vendor = KelengkapanDokumenVendor::where('id_vendor', $idvendor)->where('id_jenis_dokumen', $key['id_jenis'])->get();
            $newVendor = $vendor->toArray();
            $key['tanggal_upload'] =  empty($newVendor) ? 'Belum Upload' : $vendor[0]['tanggal_upload'];
            $key['sudahUpload'] =  empty($newVendor) ? false : true;
            $key['id_dokumen'] =  empty($newVendor) ? '' : $newVendor[0]['id_dokumen'];
            $key['file'] =  empty($newVendor) ? '' : $newVendor[0]['file'];



            $namadokumentoArr[] = $key;
        };

        $namadokumenCollect = collect($namadokumentoArr);
        return view('plninternal.Vendor.kelengkapandokumen', compact('namadokumenCollect'));
    }



    public function store($id, $id_kontrakkerja, Request $request)
    {
        // Step 1: Mencari JenisDokumenKelengkapan dengan relasi kelengkapanDokumenVendors
        $jenisDokumen = JenisDokumenKelengkapan::with('kelengkapanDokumenVendors')->find($id);

        if (!$jenisDokumen) {
            abort(404); // Jika jenis dokumen tidak ditemukan, berikan respons 404
        }

        // Step 2: Mencari kelengkapanDokumenVendor dengan id_kontrakkerja yang sesuai
        $kelengkapanDokumenVendor = $jenisDokumen->kelengkapanDokumenVendors
            ->where('id_kontrakkerja', $id_kontrakkerja)
            ->first();

        // Step 3: Menghandle operasi berdasarkan keberadaan kelengkapanDokumenVendor
        if (!$kelengkapanDokumenVendor) {
            // Jika kelengkapanDokumenVendor tidak ditemukan, generate data baru dan simpan file
            $file = $request->file('fileUpload');
            $filename = $this->generateFilename($file);

            // Simpan file ke storage app public dokumenvendor
            Storage::putFileAs('public/dokumenvendor', $file, $filename);

            // Buat data baru pada KelengkapanDokumenVendor
            $kelengkapanDokumenVendor = new KelengkapanDokumenVendor();
            $kelengkapanDokumenVendor->id_kontrakkerja = $id_kontrakkerja;
            $kelengkapanDokumenVendor->file_upload = $filename;
            $kelengkapanDokumenVendor->id_vendor = Auth::user()->vendor_id;
            $jenisDokumen->kelengkapanDokumenVendors()->save($kelengkapanDokumenVendor);
        } else {
            // Jika kelengkapanDokumenVendor sudah ada, simpan file dengan mengganti yang lama
            $file = $request->file('fileUpload');
            $filename = $this->generateFilename($file);

            // Simpan file ke storage app public dokumenvendor
            Storage::putFileAs('public/dokumenvendor', $file, $filename);

            // Update kolom file_upload pada KelengkapanDokumenVendor
            $kelengkapanDokumenVendor->file_upload = $filename;
            $kelengkapanDokumenVendor->save();
        }

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Dokumen berhasil diupload.');
    }

    // Helper function untuk mengenerate nama file baru
    private function generateFilename($file)
    {
        $tanggal = now()->format('Ymd');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename = $tanggal . '_DOK_' . $originalName . '.' . $extension;

        return $filename;
    }


    public function update(Request $request, $id, $id_kontrakkerja)
    {
        // Step 1: Mencari JenisDokumenKelengkapan dengan relasi kelengkapanDokumenVendors
        $jenisDokumen = JenisDokumenKelengkapan::with('kelengkapanDokumenVendors')->find($id);

        if (!$jenisDokumen) {
            abort(404); // Jika jenis dokumen tidak ditemukan, berikan respons 404
        }

        // Step 2: Mencari kelengkapanDokumenVendor dengan id_kontrakkerja yang sesuai
        $kelengkapanDokumenVendor = $jenisDokumen->kelengkapanDokumenVendors
            ->where('id_kontrakkerja', $id_kontrakkerja)
            ->first();

        // Step 3: Menghandle operasi berdasarkan keberadaan kelengkapanDokumenVendor
        if (!$kelengkapanDokumenVendor) {
            // Jika kelengkapanDokumenVendor tidak ditemukan, generate data baru dan simpan file
            $file = $request->file('fileUpload');
            $filename = $this->generateFilename($file);

            // Simpan file ke storage app public dokumenvendor
            Storage::putFileAs('public/dokumenvendor', $file, $filename);

            // Buat data baru pada KelengkapanDokumenVendor
            $kelengkapanDokumenVendor = new KelengkapanDokumenVendor();
            $kelengkapanDokumenVendor->id_kontrakkerja = $id_kontrakkerja;
            $kelengkapanDokumenVendor->file_upload = $filename;
            $kelengkapanDokumenVendor->id_vendor = Auth::user()->vendor_id;
            $jenisDokumen->kelengkapanDokumenVendors()->save($kelengkapanDokumenVendor);
        } else {
            // Jika kelengkapanDokumenVendor sudah ada, simpan file dengan mengganti yang lama
            $file = $request->file('fileUpload');
            $filename = $this->generateFilename($file);

            // Simpan file ke storage app public dokumenvendor
            Storage::putFileAs('public/dokumenvendor', $file, $filename);

            // Update kolom file_upload pada KelengkapanDokumenVendor
            $kelengkapanDokumenVendor->file_upload = $filename;
            $kelengkapanDokumenVendor->save();
        }

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Dokumen berhasil diupload.');
    }

    public function destroy($id)
    {
        $kelengkapanvendor = KelengkapanDokumenVendor::find($id);
        // Menghapus file yang lama (jika ada)

        $path = storage_path('app/public/kelengkapandokumen/' . $kelengkapanvendor->file);
        // Menghapus File jika berhasil redirect


        if (unlink($path)) {
            $kelengkapanvendor->delete();
            return redirect()->back()->with('success', 'Kelengkapan Dokumen deleted successfully');
        } else {
            echo "Gagal Menghapus file";
            return redirect()->back()->with('gagal', 'Error File tidak terhapus');
        }
    }
}
