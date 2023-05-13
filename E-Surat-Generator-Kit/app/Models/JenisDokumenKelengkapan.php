<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisDokumenKelengkapan extends Model
{
    protected $primaryKey = 'id_jenis';
    protected $fillable = [
        'nama_dokumen'

    ];
    public function kelengkapandokumenvendor(){
        $this->hasMany(KelengkapanDokumenVendor::class, 'id_jenis_dokumen', 'id_jenis');
    }
    use HasFactory;
}
