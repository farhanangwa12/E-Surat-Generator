<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisDokumenKelengkapan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_jenis';
    protected $fillable = [
        'nama_dokumen',
        'no_dokumen',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->no_dokumen = $model->generateNoDokumen();
        });

        static::updating(function ($model) {
            $model->no_dokumen = $model->generateNoDokumen();
        });
    }

    protected function generateNoDokumen()
    {
        $nama_dokumen = strtolower(preg_replace('/\s+/', ' ', $this->nama_dokumen));
        $nama_dokumen = preg_replace('/[^a-z0-9]+/', '_', $nama_dokumen);
        $no_dokumen = $nama_dokumen . '_' . date('YmdHis');
        
        return $no_dokumen;
    }
    

    public function kelengkapandokumenvendor()
    {
        $this->hasMany(KelengkapanDokumenVendor::class, 'id_jenis_dokumen', 'id_jenis');
    }
}
