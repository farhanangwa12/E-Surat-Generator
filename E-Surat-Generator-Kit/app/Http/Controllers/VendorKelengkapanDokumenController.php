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
        // // Read the contents of the PDF file
        // $pdfContent = file_get_contents($pdfFile);

        // // Create new mPDF object
        // $mpdf = new Mpdf();

        // // Set document information
        // $mpdf->SetTitle('Title of the PDF');
        // $mpdf->SetAuthor('Your Name');
        // $mpdf->SetSubject('Subject of the PDF');
        // $mpdf->SetKeywords('Keywords of the PDF');

        // // Write PDF content
        // $mpdf->WriteHTML($pdfContent);

        // // Output PDF to browser
        // $mpdf->Output();
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



    public function store(Request $request)
    {

        // $rules = [
        //     'file' => 'required|max:10000'
        // ];

        // // Melakukan validasi form upload dengan rule yang telah dibuat
        // $request->validate($rules);

        $file = $request->file('file');
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/kelengkapandokumen', $filename);

        $kelengkapanvendor = new KelengkapanDokumenVendor([
            'id_jenis_dokumen' => $request->get('jen'),
            'id_vendor' => $request->get('v'),
            'file' => $filename,
            'tanggal_upload' => Carbon::now()
        ]);
        $kelengkapanvendor->save();
        // Redirect ke halaman dashboard
        // return redirect('/user/show');
        return redirect()->back()->with('success', 'User created successfully');
    }



    public function update(Request $request, $id)
    {
        $kelengkapanvendor = KelengkapanDokumenVendor::find($id);



        // Menghapus file yang lama (jika ada)
        Storage::delete($kelengkapanvendor->file);
        // Mendapatkan instance file yang ter-upload
        $file = $request->file('file');
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/kelengkapandokumen', $filename);

        $kelengkapanvendor->file = $filename;
        $kelengkapanvendor->save();
        return redirect()->back()->with('success', 'Kelengkapan Dokumen updated successfully');
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
