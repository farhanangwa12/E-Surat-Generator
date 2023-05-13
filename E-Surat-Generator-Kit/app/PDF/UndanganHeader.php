<?php

namespace App\PDF;

use TCPDF;
require_once base_path('vendor/tcpdf/tcpdf.php');
class UndanganHeader extends TCPDF
{
    public function Header()
    {
        // Hapus garis header default
        $this->SetDrawColor(255, 255, 255);
        $this->Line(0, $this->GetY(), $this->getPageWidth(), $this->GetY());

        
        $file1 = public_path('undangan/kiri.jpg');
        $file2 = public_path('undangan/logo.png');
        $file3 = public_path('undangan/Picture3.png');



        // Menambahkan gambar pertama
        $this->Image($file1, 15, 10, 135, 15, '', '', '', false, 300, '', false, false, 0, false, false, false);

        // Menambahkan gambar kedua
        $this->Image($file2, 150, 10, 45, 20, '', '', '', false, 300, '', false, false, 0, false, false, false);

        // Menambahkan gambar ketiga
        $this->Image($file3, 150, 30, 45, 10, '', '', '', false, 300, '', false, false, 0, false, false, false);

    }
    public function Footer()
    {
        $this->SetFooterMargin(20); // mengatur margin footer sebesar 10 mm
        // Code untuk custom footer
        $this->SetY(-15);
        $this->SetFont('helvetica', '', 8);
        
        $this->Image(public_path('undangan/footer.png'),15, null,0,20);
    }
}
