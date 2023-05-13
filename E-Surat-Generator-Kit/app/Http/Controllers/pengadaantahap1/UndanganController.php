<?php

namespace App\Http\Controllers\pengadaantahap1;

use App\Http\Controllers\Controller;
use App\Models\KontrakKerja;
use App\PDF\UndanganHeader;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use TCPDF;

require_once base_path('vendor/tcpdf/tcpdf.php');


class UndanganController extends Controller
{
       // Undangan Ada backup
       // Undangan
       public function Undangan($id, $isDownload)
       {
              // Meload Data berdasarkan ID
              $kontrakkerja = KontrakKerja::find($id);

              $file_path = storage_path('app/public/dokumenpenawaran/' . $kontrakkerja->filemaster);
              // Meload data file master yang disimpan di database
              $spreadsheet = IOFactory::load($file_path);
              $worksheet = $spreadsheet->setActiveSheetIndexByName('UND');






              // Mengatur ukuran halaman
              $pdf = new UndanganHeader();

              // Mengatur font default
              $pdf->SetFont('times', '', 12);

              // set auto page break
              $pdf->SetAutoPageBreak(true, 0);

              // Menambahkan halaman
              $pdf->AddPage();

              // Mengatur margin
              $pdf->SetMargins(15, 40, 15);

              //  // remove default header/footer
              //  $pdf->setPrintHeader(false);

              // Membuat footer 




              // Set cursor position
              $pdf->SetY(40);

              // Set width and height of the multicell
              $cell_width = ($pdf->getPageWidth() - $pdf->getMargins()['left'] - $pdf->getMargins()['right']) / 2;
              $cell_height = 10;
              // Ambil data dari excel 
              $nomor_surat = $worksheet->getCell('D10')->getCalculatedValue();
              $tanggal_surat = $worksheet->getCell('I10')->getCalculatedValue();
              $nama_pt = $worksheet->getCell('I13')->getCalculatedValue();
              $alamatjalan = $worksheet->getCell('I14')->getCalculatedValue();
              $alamatprov = $worksheet->getCell('I16')->getCalculatedValue();


              // Atur Text    
              $bagian_kiri = '
Nomor	       :	' . $nomor_surat . '
Lampiran      :	1 (satu) set
Perihal       :	Undangan Penawaran Harga
         ';
              $bagian_kanan1 = "\n" . $tanggal_surat . "			
       
Kepada Yth.";

              $namapt =  $nama_pt;
              $bagian_kanan2 = $alamatjalan . ' ' . $alamatprov;


              // Bagian Kiri Surat
              $pdf->MultiCell($cell_width, $cell_height, $bagian_kiri, 0, 'L', 0, 0, '', '', true);

              //  
              // Bagian Kanan Surat berisi Alamat dan Vendor
              $x_kanansurat = $pdf->GetX() + 30;
              $y_kanansurat = $pdf->GetY();
              $width_kanansurat = $pdf->getPageWidth() - $x_kanansurat - 15;
              $height_kanansurat = $cell_height;

              //  $pdf->MultiCell($cell_width, $cell_height, $bagian_kanan, 1, 'R', 0, 1, $pdf->getPageWidth() / 2, '', true);
              $pdf->MultiCell($width_kanansurat, $height_kanansurat, $bagian_kanan1, 1, 'L', false, 1, $x_kanansurat, $y_kanansurat);


              $pdf->setX($x_kanansurat);
              $pdf->SetFont('times', 'B', 12);
              $pdf->MultiCell($width_kanansurat, $height_kanansurat, $namapt, 1, 'L', false, 1, null, null);
              $pdf->setX($x_kanansurat);
              $pdf->SetFont('times', '', 12);
              $pdf->MultiCell($width_kanansurat, $height_kanansurat, $bagian_kanan2, 1, 'L', false, 1, null, null);





              // Beri Jarak setelah membuat cell
              $pdf->Ln(10);

              // Bagian Konten

              // Meload data per paragraf dari excel
              $paragraf1 = $worksheet->getCell('D21')->getCalculatedValue();
              $paragraf2 = $worksheet->getCell('D27')->getCalculatedValue();
              $worksheet->setCellValue('P44',  '=F35');
              $tanggal =  $worksheet->getCell('P44')->getCalculatedValue();
              $test = $worksheet->setCellValue('Z20','=MASTER!L16');
    
     
              


              // Mencari lebar kotak untuk konten
              $pageWidth = $pdf->GetPageWidth() - $pdf->GetX() - 30;
              $pdf->setXY(30, $pdf->GetY());
              // create multicell with full width
              $paragraf1 = $paragraf1;
              $paragraf2 = $paragraf2;
              $tanggalinfo1 = "Apabila berminat kami harapkan penyampaian penawaran telah kami terima selambat-lambatnya pada";
              $tanggalinfo2 = "Hari / Tanggal	:";
              $tanggal = $tanggal;
              $kesimpulan = "
Apabila lulus evaluasi penawaran akan dilanjutkan dengan negosiasi.						
Apabila ada hal-hal yang belum jelas dapat di tanyakan ke Pejabat Pelaksana Pengadaan PT PLN (Persero) Unit Induk Wilayah Nusa Tenggara Timur Unit Pelaksana Pembangkitan Timor.                                         
Demikian atas perhatian Saudara kami ucapkan terima kasih.";


              $tanda_tangan = "
         ";
              // Paragraf 1 content
              $pdf->MultiCell($pageWidth, 10, $paragraf1, 0, 'J', false, 1);
              $pdf->Ln(2);
              // Paragraf 2 content
              $pdf->setX(30);
              $pdf->MultiCell($pageWidth, 10, $paragraf2, 0, 'J', false, 1);
              $pdf->Ln(2);
              // Bagiantanggalinfo1
              $pdf->setX(30);
              $pdf->MultiCell($pageWidth, 10, $tanggalinfo1, 0, 'L', false, 1);
              $pdf->Ln(2);

              // Bagian Tanggal
              $pdf->setX(30);
              $pdf->MultiCell(30, 5, $tanggalinfo2, 0, 'L', false, 0);

              $pdf->SetFont('times', 'B', 12);
              $pdf->MultiCell(50, 5, $tanggal, 0, 'L', false, 1);
              $pdf->SetFont('times', '', 12);

              // Bagian Kesimpulan
              $pdf->setX(30);
              $pdf->MultiCell($pageWidth, 10, $kesimpulan, 0, 'L', 0, 1);
              $pdf->Ln(2);



              // Bagian Tanda Tangan
              $x_ttd = 100;
              $y_ttd = $pdf->GetY();
              $width_ttd = $pdf->getPageWidth() - $x_ttd - 15;
              $height_ttd = 10;
              $nama_jabatan = "
 PEJABAT PELAKSANA PENGADAAN				
 PT PLN (PERSERO) UNIT INDUK WILAYAH NTT				
 UNIT PELAKSANA PEMBANGKITAN TIMOR				
         ";
              $pdf->setX($x_ttd);
              $pdf->MultiCell($width_ttd, $height_ttd, $nama_jabatan, 0, 'C');
              $pdf->Ln(2);

              // Set position for tanda tangan
              $pdf->setX($x_ttd);
              $pdf->Cell($width_ttd,$height_ttd + 20, '',0, 1, 'C');
              // $pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,H', null, null, $width_ttd, $height_ttd + 20, array(), 'N');
              $pdf->Ln(2);
              // Set position for barcode
              $pdf->setX($x_ttd);
              // Menampilkan tulisan
              $nama_pejabat_pengadaan = $worksheet->getCell('H55')->getCalculatedValue();

              $pdf->Cell($width_ttd, $height_ttd, $nama_pejabat_pengadaan, 0, 0, 'C');
              $pdf->Ln(2);






              // output the PDF
              $pdf->Output('example.pdf', $isDownload);
       }



       //     // Undangan
       //     public function Undangan($id)
       //     {
       //         // Mengatur ukuran halaman
       //         $pdf = new UndanganHeader();

       //         // Mengatur font default
       //         $pdf->SetFont('helvetica', '', 10);

       //         // set auto page break
       //         $pdf->SetAutoPageBreak(true, 0);

       //         // Menambahkan halaman
       //         $pdf->AddPage();

       //         // Mengatur margin
       //         $pdf->SetMargins(15, 15, 15);

       //         // remove default header/footer
       //         $pdf->setPrintHeader(false);

       //         // Membuat footer 


       //         $file1 = public_path('undangan/kiri.jpg');
       //         $file2 = public_path('undangan/logo.png');
       //         $file3 = public_path('undangan/Picture3.png');



       //         // Menambahkan gambar pertama
       //         $pdf->Image($file1, 15, 10, 135, 15, '', '', '', false, 300, '', false, false, 0, false, false, false);

       //         // Menambahkan gambar kedua
       //         $pdf->Image($file2, 150, 10, 45, 20, '', '', '', false, 300, '', false, false, 0, false, false, false);

       //         // Menambahkan gambar ketiga
       //         $pdf->Image($file3, 150, 30, 45, 10, '', '', '', false, 300, '', false, false, 0, false, false, false);



       //         // Set cursor position
       //         $pdf->SetY(50);

       //         // Set width and height of the multicell
       //         $cell_width = ($pdf->getPageWidth() - $pdf->getMargins()['left'] - $pdf->getMargins()['right']) / 2;
       //         $cell_height = 20;

       //         // Atur Text    
       //         $bagian_kiri = '
       // Nomor	    :	111.UND/DAN.01.03/200900/2022
       // Lampiran	:	1 (satu) set
       // Perihal	    :	Undangan Penawaran Harga
       //         ';
       //         $test = "26 Desember 2022";
       //         $bagian_kanan = "
       // Kupang, " . $test . "			

       // Kepada Yth.			
       // PT. MULTI INAR BANGUNAN
       // Jalan Simpang kepuh No 199			
       // Surabaya, Jawa Timur			
       //         ";


       //         // Create the first multicell
       //         $pdf->MultiCell($cell_width, $cell_height, $bagian_kiri, 1, 'L', 0, 0, '', '', true);

       //         // Create the second multicell


       //         $pdf->MultiCell($cell_width, $cell_height, $bagian_kanan, 1, 'L', 0, 1, $pdf->getPageWidth() / 2, '', true);
       //         // Beri Jarak setelah membuat cell
       //         $pdf->Ln(10);

       //         // Bagian Konten

       //         // Mencari lebar kotak untuk konten
       //         $pageWidth = $pdf->GetPageWidth() - $pdf->GetX() - 30;
       //         $pdf->setXY(30, $pdf->GetY());
       //         // create multicell with full width
       //         $paragraf1 = "Sehubungan dengan rencana PEKERJAAN PENGADAAN DAN JASA INSTALASI KWH METER ENGINE PLTU JEMBER PT PLN (PERSERO) UNIT INDUK WILAYAH NTT UNIT PELAKSANA PEMBANGKITAN TIMOR, maka dengan ini kami mengundang perusahaan saudara untuk  mengikuti proses Pengadaan Barang/Jasa di lingkungan PT PLN (Persero) Unit Induk Wilayah Nusa Tenggara Timur Unit Pelaksana Pembangkitan Timor melalui metode pengadaan langsung.";
       //         $paragraf2 = "Terlampir kami sampaikan Rencana Kerja dan Syarat-Syarat (RKS) PEKERJAAN PENGADAAN DAN JASA INSTALASI KWH METER ENGINE PLTU JEMBER PT PLN (PERSERO) UNIT INDUK WILAYAH NTT UNIT PELAKSANA PEMBANGKITAN TIMOR Pengadaan Barang/Jasa yang dimaksud.";
       //         $tanggalinfo1 = "Apabila berminat kami harapkan penyampaian penawaran telah kami terima selambat-lambatnya pada";
       //         $tanggalinfo2 = "Hari / Tanggal	:";
       //         $tanggal = "Rabu / 28 Desember 2022";
       //         $kesimpulan = "
       // Apabila lulus evaluasi penawaran akan dilanjutkan dengan negosiasi.								

       // Apabila ada hal-hal yang belum jelas dapat di tanyakan ke Pejabat Pelaksana Pengadaan PT PLN (Persero) Unit Induk Wilayah Nusa Tenggara Timur Unit Pelaksana Pembangkitan Timor.								


       // Demikian atas perhatian Saudara kami ucapkan terima kasih.";


       //         $tanda_tangan = "
       //         ";
       //         // Paragraf 1 content
       //         $pdf->MultiCell($pageWidth, 10, $paragraf1, 1, 'L',false, 1);
       //         $pdf->Ln(5);
       //         // Paragraf 2 content
       //         $pdf->setX(30);
       //         $pdf->MultiCell($pageWidth, 10, $paragraf2, 1, 'L',false, 1);
       //         $pdf->Ln(5);
       //         // Bagiantanggalinfo1
       //         $pdf->setX(30);
       //         $pdf->MultiCell($pageWidth, 10, $tanggalinfo1, 1, 'L', 0, 0);
       //         $pdf->Ln(10);

       //         // Bagian Tanggal
       //         $pdf->setX(30);
       //         $pdf->Cell(30, 10, $tanggalinfo2, 1, 0);

       //         $pdf->Cell(50, 10, $tanggal, 1, 1);
       //         $pdf->Ln(5);
       //         // Bagian Kesimpulan
       //         $pdf->setX(30);
       //         $pdf->MultiCell($pageWidth, 10, $kesimpulan, 1, 'L', 0,1);
       //         $pdf->Ln(5);



       //         // Bagian Tanda Tangan
       //         $x_ttd = 100;
       //         $y_ttd = $pdf->GetY();
       //         $width_ttd = $pdf->getPageWidth()-$x_ttd-15;
       //         $height_ttd = 10;
       //         $nama_jabatan = "
       // PEJABAT PELAKSANA PENGADAAN				
       // PT PLN (PERSERO) UNIT INDUK WILAYAH NTT				
       // UNIT PELAKSANA PEMBANGKITAN TIMOR				
       //         ";
       //         $pdf->setX($x_ttd);
       //         $pdf->MultiCell($width_ttd,$height_ttd, $nama_jabatan,1,'C');
       //         $pdf->Ln(2);

       //         // Set position for tanda tangan
       //         $pdf->setX($x_ttd);
       //         // $pdf->Cell($width_ttd,$height_ttd, 'Tanda Tangan',1, 1, 'C');
       //         $pdf->write2DBarcode('www.tcpdf.org', 'QRCODE,H',null, null, $width_ttd, $height_ttd+20,array(), 'N');
       //         $pdf->Ln(2);
       //         // Set position for barcode
       //         $pdf->setX($x_ttd);
       //         $pdf->Cell($width_ttd,$height_ttd, 'UNTUNG DAN BERKAH', 1, 0, 'C');
       //         $pdf->Ln(2);






       //         // output the PDF
       //         $pdf->Output('example.pdf', 'I');
       //     }
}
