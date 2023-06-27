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
     
    ];

    public function Barjas()
    {
        return $this->belongsTo(BarJas::class,'id_barjas');
    }
}
