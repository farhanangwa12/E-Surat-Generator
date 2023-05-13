<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyelenggara extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_penyelenggara';
    protected $fillable = ['id_kontrakkerja','nama_jabatan','nama_pengguna'];
    public function kontrakkerja()
    {
        return $this->belongsTo(KontrakKerja::class, 'id_kontrakkerja', 'id_kontrakkerja');
    }
}
