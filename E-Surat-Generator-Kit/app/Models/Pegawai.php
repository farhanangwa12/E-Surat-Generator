<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pegawai';
    protected $fillable = [
        'nama_pegawai', 'id_akun', 'jabatan', 'nomor_jabatan'

    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
