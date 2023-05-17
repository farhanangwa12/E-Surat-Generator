<?php

namespace App\Models;

use App\Models\SubKontrak\BarJas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarJasHPS extends Model
{
    use HasFactory;
    protected $table = 'bar_jas_h_p_s';

    protected $fillable = [
        'id_hps',
        'id_barjas',
        'harga_satuan',
        'jumlah',
    ];

    public function hps()
    {
        return $this->belongsTo(HPS::class, 'id_hps', 'id');
    }

    public function barjas()
    {
        return $this->belongsTo(BarJas::class, 'id_barjas', 'id');
    }
}
