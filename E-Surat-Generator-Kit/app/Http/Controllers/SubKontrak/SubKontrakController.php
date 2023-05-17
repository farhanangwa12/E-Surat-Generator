<?php

namespace App\Http\Controllers\SubKontrak;

use App\Http\Controllers\Controller;
use App\Models\SubKontrak\BarJas;
use App\Models\SubKontrak\JenisKontrak;
use App\Models\SubKontrak\SubBarjas;
use Illuminate\Http\Request;

class SubKontrakController extends Controller
{
    public function show($id, $id_jenis){
        $barjas = BarJas::where('id_jenis_kontrak', $id_jenis)->get()->toArray();
        $data = [];
        foreach ($barjas as $databarjas){
            $subbarjas = SubBarjas::where('id_barjas', $databarjas['id'])->get()->toArray();
            $subdata = [];
            if (!empty($subbarjas)) {
                foreach ($subbarjas as $subbar) {
                    $subdata[] = [
                        'id_subbarjas' => $subbar['id'],
                        'id_barjas' => $subbar['id_barjas'],
                        'uraian' => $subbar['uraian'],
                        'volume' => $subbar['volume'],
                        'satuan' => $subbar['satuan'],
                        // 'harga_satuan' => $subbar['harga_satuan'],
                        // 'jumlah' => $subbar['jumlah']
                    ];
                }
            }
            $data[] = [
                'id_barjas' => $databarjas['id'],
                'id_jenis_kontrak' => $databarjas['id_jenis_kontrak'],
                'uraian' => $databarjas['uraian'],
                'volume' => $databarjas['volume'],
                'satuan' => $databarjas['satuan'],
                // 'harga_satuan' => $databarjas['harga_satuan'],
                // 'jumlah' => $databarjas['jumlah'],
                'sub_data' => $subdata,

            ];
        }
        $jenis = JenisKontrak::find($id_jenis);
        $id_jenis_kontrak = $id_jenis;

        return view('plnpengadaan.kontraktahap1.SubKontrak.index', compact('data', 'id_jenis_kontrak','jenis'));
    }


    
}
