<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    public function mencariTotalHarga($spreadsheet, $worksheetname)
    {
        $worksheet = $spreadsheet->getSheetByName($worksheetname);
        $cellValue = $worksheet->getCell('C14')->getCalculatedValue();
        // Get highest column and row
        $highestColumn = $worksheet->getHighestColumn();
        $highestRow = $worksheet->getHighestDataRow();
        $barisTerakhir = '';
        // Loop through each row
        for ($row = 1; $row <= $highestRow; $row++) {
            // Loop through each column
            for ($col = 'A'; $col <= $highestColumn; $col++) {
                // Get cell coordinate
                $cellCoordinate = $col . $row;

                // Get cell value
                $cellValue = $worksheet->getCell($cellCoordinate)->getValue();

                // Check if cell value is "JUMLAH HARGA"
                if ($cellValue == "JUMLAH HARGA") {

                    $barisTerakhir = preg_replace("/[^0-9]/", "", $cellCoordinate) - 1;

                    break 2;
                }
            }
        }
        return $barisTerakhir;
    }


    public function mencariKoordinatCell($spreadsheet, $worksheetname, $text)
    {
        $worksheet = $spreadsheet->getSheetByName($worksheetname);
        // $cellValue = $worksheet->getCell('C14')->getCalculatedValue();
        // Get highest column and row
        $highestColumn = $worksheet->getHighestColumn();
        $highestRow = $worksheet->getHighestDataRow();
        $barisTerakhir = '';
        // Loop through each row
        for ($row = 1; $row <= $highestRow; $row++) {
            // Loop through each column
            for ($col = 'A'; $col <= $highestColumn; $col++) {
                // Get cell coordinate
                $cellCoordinate = $col . $row;

                // Get cell value
                $cellValue = $worksheet->getCell($cellCoordinate)->getValue();

                // Check if cell value is "JUMLAH HARGA"
                if ($cellValue == $text) {

                    // $barisTerakhir = preg_replace("/[^0-9]/", "", $cellCoordinate) - 1;

                    break 2;
                }
            }
        }
        return $cellCoordinate;
    }
}
