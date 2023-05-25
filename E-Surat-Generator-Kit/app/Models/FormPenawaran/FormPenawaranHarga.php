<?php

namespace App\Models\FormPenawaran;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPenawaranHarga extends Model
{
    use HasFactory;
    protected $table = 'form_penawaran_harga'; // Ganti 'nama_tabel' dengan nama tabel yang digunakan


    protected $fillable = [
        'id_kontrakkerja',
        'id_vendor',
        'kopsurat',
        'file_path',
        'file_tandatangan',
        'no_unik_ttd',
        'tanggal_tandatangan'
        // Tambahkan atribut lainnya jika ada
    ];

    public function kontrakKerja()
    {
        return $this->belongsTo(KontrakKerja::class, 'id_kontrakkerja');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor');
    }
}
