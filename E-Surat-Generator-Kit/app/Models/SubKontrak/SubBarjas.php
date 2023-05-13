<?php

namespace App\Models\SubKontrak;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBarjas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_barjas',
        'uraian',
        'volume',
        'satuan',
        'harga_satuan',
        'jumlah'
    ];

    public function Barjas()
    {
        return $this->belongsTo(Barjas::class);
    }
}
