<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisDokumenKelengkapan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_jenis';

    protected $fillable = ['nama_dokumen', 'no_dokumen', 'dokumen_sistem', 'keterangan'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->no_dokumen)) {
                $model->no_dokumen = $model->generateNoDokumen();
            }
        });

        static::updating(function ($model) {
            if (empty($model->no_dokumen)) {
                $model->no_dokumen = $model->generateNoDokumen();
            }
        });
        static::deleting(function ($model) {
            $model->no_dokumen = $model->generateNoDokumen();
        });
    }

    public function isSystemDocument()
    {
        // Daftar 4 data yang tidak dapat dihapus
        $systemDocuments = ['budi', 'domas', 'doksli', 'adi'];

        return in_array(strtolower($this->nama_dokumen), $systemDocuments);
    }
    protected function generateNoDokumen()
    {
        $nama_dokumen = strtolower(preg_replace('/\s+/', ' ', $this->nama_dokumen));
        $nama_dokumen = preg_replace('/[^a-z0-9]+/', '_', $nama_dokumen);
        $no_dokumen = $nama_dokumen;

        return $no_dokumen;
    }
    public function kelengkapanDokumenVendors()
    {
        return $this->hasMany(KelengkapanDokumenVendor::class, 'id_jenis_dokumen', 'id_jenis');
    }

    
}
