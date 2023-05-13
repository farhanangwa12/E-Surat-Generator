<?php

namespace App\Models\SubKontrak;

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
}
