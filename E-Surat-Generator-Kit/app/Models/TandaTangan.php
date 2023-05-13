<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TandaTangan extends Model
{
    use HasFactory;
    
    protected $guarded = [
        'id', 'created_at', 'updated_at'

    ];
    public function tandatangan()
    {
        return $this->belongsTo(KontrakKerja::class, 'id_kontrakkerja', 'id_kontrakkerja');

    }

   
}
