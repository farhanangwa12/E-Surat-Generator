<?php

namespace App\Http\Controllers\pengadaantahap2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

class LampNegoController extends Controller
{
     // Menampilkan semua data
     public function index()
     {
         
     }
 
     // Menampilkan form untuk membuat data baru
     public function create()
     {
         
     }
 
     // Menyimpan data baru ke dalam database
     public function store(Request $request)
     {
         
     }
 
     // Menampilkan detail data
     public function show($id, $isDownload)
     {
          $data = [
               'logokiri' => public_path('undangan/kiri.jpg'),
               'logo' => public_path('undangan/logo.png'), // path ke file header gambar
           
         
           ];

           $pdf = PDF::loadView('plnpengadaan.kontraktahap2.LampNego.lampnego', $data);
           $pdf->setOption(['isRemoteEnabled' => true]);
   
           $namefile = 'LampNego_' . time() . '.pdf';
 
           if ($isDownload == 1) {
               // Menampilkan output di browser
               return $pdf->stream($namefile);
           } else if ($isDownload == 2) {
               // Download file
               return $pdf->download($namefile);
           } else {
               return "Parameter tidak valid";
           }
     }
 
     // Menampilkan form untuk mengedit data
     public function edit($id)
     {
         
     }
 
     // Mengupdate data ke database
     public function update(Request $request, $id)
     {
         
     }
 
     // Menghapus data dari database
     public function destroy($id)
     {
         
     }
}
