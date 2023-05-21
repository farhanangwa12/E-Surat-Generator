<?php

namespace App\Models;

use App\Models\Dokumen\BOQ;
use App\Models\Dokumen\UND;
use App\Models\SubKontrak\JenisKontrak;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrakKerja extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kontrakkerja';
    protected $fillable = [
        'id_kontrakkerja',
        'nama_kontrak',
        'id_vendor',
        'tanggal_spmk',
        'no_spmk',
        'tanggal_kontrak',
        'tanggal_pekerjaan',
        'tanggal_akhir_pekerjaan',
        'lokasi_pekerjaan',
        'no_urut',
        'tahun',
        'kode_masalah',
        'status',
        'filemaster'
    ];
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id_vendor', 'id_vendor');
    }
    public function pembuatansuratkontrak()
    {
        return $this->hasOne(PembuatanSuratKontrak::class, 'id_kontrakkerja', 'id_kontrakkerja');
    }
    public function penyelenggara()
    {
        return $this->hasOne(Penyelenggara::class, 'id_kontrakkerja', 'id_kontrakkerja');
    }
    public function sumberanggaran()
    {
        return $this->hasOne(SumberAnggaran::class, 'id_kontrakkerja', 'id_kontrakkerja');
    }

    public function tandatangan()
    {
        return $this->hasOne(TandaTangan::class, 'id_kontrakkerja', 'id_kontrakkerja');
    }


    // Relasi dengan jenis_kontrak
    public function jenis_kontrak()
    {
        return $this->hasMany(JenisKontrak::class, 'id_kontrak');
    }


    // Dokumen
    public function hps()
    {
        return $this->hasMany(HPS::class, 'id_kontrakkerja', 'id_kontrakkerja');
    }
    public function und()
    {
        return $this->hasMany(UND::class, 'id_kontrakkerja');
    }
    public function boqs()
    {
        return $this->hasMany(BOQ::class, 'id_kontrakkerja');
    }
}
