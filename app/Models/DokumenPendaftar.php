<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPendaftar extends Model
{
    use HasFactory;

    protected $table = 'dokumen_pendaftar';

    protected $fillable = [
        'pendaftar_id',
        'jenis_dokumen',
        'file_path',
        'original_name',
        'status',
        'catatan',
    ];

    public function pendaftar()
    {
        return $this->belongsTo(Pendaftar::class);
    }
}
