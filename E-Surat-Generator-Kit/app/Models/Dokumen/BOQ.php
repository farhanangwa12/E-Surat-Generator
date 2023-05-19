<?php

namespace App\Models\Dokumen;

use App\Models\KontrakKerja;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BOQ extends Model
{
    use HasFactory;
    protected $table = 'b_o_q_s';
    protected $fillable = ['id_kontrakkerja', 'total_jumlah', 'dibulatkan', 'rok10', 'ppn11', 'total_harga', 'tandatangan_direktur'];

    public function kontrakKerjas()
    {
        return $this->belongsTo(KontrakKerja::class, 'id_kontrakkerja');
    }

    public function barJasBOQs()
    {
        return $this->hasMany(BarJasBOQ::class, 'id_boq');
    }
   
}
