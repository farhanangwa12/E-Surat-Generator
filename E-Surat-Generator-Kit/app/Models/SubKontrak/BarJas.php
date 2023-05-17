<?php

namespace App\Models\SubKontrak;

use App\Models\BarJasHPS;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarJas extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_jenis_kontrak',
        'uraian',
        'volume',
        'satuan',
   
    ];


    public function jenisKontrak()
    {
        return $this->belongsTo(JenisKontrak::class, 'id_jenis_kontrak');
    }
    public function subBarjas()
    {
        return $this->hasMany(SubBarjas::class, 'id_barjas');
    }


    public function barjasHPS()
    {
        return $this->hasMany(BarJasHPS::class, 'id_barjas', 'id');
    }
}
