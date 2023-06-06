<?php

namespace App\Models\DokumenVendor;

use App\Models\KelengkapanDokumenVendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Neraca extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_dokumen',
        'tanggal_neraca',
        'aktiva_lancar',
        'utang_jangka_pendek',
        'kas',
        'utang_dagang',
        'utang_pajak',
        'piutang',
        'persediaan_barang',
        'pekerjaan_dalam_proses',
        'aktiva_tetap',
        'kekayaan_bersih',
        'peralatan_dan_mesin_1',
        'peralatan_dan_mesin_2',
        'inventaris',
        'gedung_gedung',
        'jumlah_a_b',
        'jumlah_d',
        'piutang_jangka_pendek_sampai_6_bulan',
        'piutang_jangka_pendek_lebih_dari_6_bulan',
        'jumlah',
    ];

    public function kelengkapanDokumenVendor()
    {
        return $this->belongsTo(KelengkapanDokumenVendor::class, 'id_dokumen', 'id_dokumen');
    }
}
