<?php

namespace App\Http\Controllers\pengadaantahap1;

use App\Http\Controllers\Controller;
use App\Models\KontrakKerja;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\NamedRange;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use TCPDF;
use PDF;

class BOQController extends Controller
{
    public function index($id)
    {
        return view('plnpengadaan.kontraktahap1.BOQ.boq', compact('id'));
    }
    public function store(Request $request, $id)
    {


        $boq = KontrakKerja::find($id);
        $spreadsheet = IOFactory::load(storage_path('app/public/dokumenpenawaran/' . $boq->filemaster));
        $worksheet = $spreadsheet->setActiveSheetIndexByName('BOQ');

        // Mencari Endline Baris
        $endLineCoordinat = '';
        // Loop Worksheet 
        foreach ($worksheet->getRowIterator() as $row) {
            foreach ($row->getCellIterator() as $cell) {
                // cek nilai jika memenuhi "JUMLAH HARGA"
                if ($cell->getValue() == "JUMLAH HARGA") {
                    // Mengambil koordinat
                    $endLineCoordinat = $cell->getCoordinate();

                    // Exit
                    break 2;
                }
            }
        }


        // // Menghapus Baris mengidentifikasi
        // $coordinateObject = Coordinate::coordinateFromString($endLineCoordinat);
        // // Get the column and row index of the starting coordinate
        // $row = 19 - $coordinateObject[1]-1;
        // $worksheet->removeRow(19, $row);

        // Hitung jumlah request yang masuk dikurangi token
        $total = count($request->all()) - 1;
        $worksheet->insertNewRowBefore(19, ($total - 2));


        // translasi Array dari request ke variabel data
        $data = [];
        foreach ($request->input('no') as $key => $value) {
            $data[] = [$value, $request->input('uraian')[$key], null, null, null, null, $request->input('vol')[$key], $request->input('sat')[$key], $request->input('harga_satuan')[$key], $request->input('jumlah')[$key]];
        }
        $startCol = 2;
        $startRow = 18;



        // Merge Cell pada Uraian
        for ($i = 0; $i < count($data); $i++) {
            // menentukan string referensi sel untuk sel pada kolom C-F dan baris 19-24
            $startCell = 'C' . $startRow;
            $endCell = 'F' . $startRow;

            // menggabungkan sel pada kolom C-F dan baris 19-24 dengan menggunakan string referensi sel
            $worksheet->mergeCells($startCell . ':' . $endCell);
        }

        // Mengisi data ke File
        foreach ($data as $row => $rowData) {

            foreach ($rowData as $col => $value) {

                $cell = $worksheet->getCell([$startCol + $col, $startRow + $row]);
                $cell->setValue($value);
            }
        }










        $writter = IOFactory::createWriter($spreadsheet, 'Xlsx');
        // $writter->save(storage_path('app/public/dokumenpenawaran/' . $boq->filemaster));
        $writter->save(storage_path('app/public/dokumenpenawaran/bug5.xlsx'));
        return redirect()->route('pengajuankontrak.detail', ['id' => $id]);
    }
    public function detail($id, $isDownloaded)
    {
        $data = [
            'test' => 'test'

        ];
        $pdf = PDF::loadView('plnpengadaan.kontraktahap1.BOQ.boqisi', $data);
        $pdf->setOption(['isRemoteEnabled' => true]);

        $namefile = 'BOQ_' . time() . '.pdf';
        if ($isDownloaded == 1) {
            // Menampilkan output di browser
            return $pdf->stream($namefile);
        } else if ($isDownloaded == 2) {
            // Download file
            return $pdf->download($namefile);
        } else {
            return "Parameter tidak valid";
        }
     
    }

    public function isi($id)
    {


        return view('plnpengadaan.kontraktahap1.BOQ.boqvendor', compact('id'));
    }
    public function update(Request $request, $id)
    {
        return view('plnpengadaan.kontraktahap1.BOQ.boq', compact('id'));
    }
}
