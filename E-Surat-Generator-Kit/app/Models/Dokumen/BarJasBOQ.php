<?php

namespace App\Models\Dokumen;

use App\Models\SubKontrak\BarJas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarJasBOQ extends Model
{
    use HasFactory;
    protected $table = 'bar_jas_b_o_q_s';
    protected $fillable = ['id_boq', 'id_barjas', 'harga_satuan', 'jumlah'];

    public function boq()
    {
        return $this->belongsTo(BOQ::class, 'id_boq');
    }

    public function barjas()
    {
        return $this->belongsTo(BarJas::class, 'id_barjas');
    }
}
