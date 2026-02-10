<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalSeleksi extends Model
{
    protected $fillable = ['nama', 'tanggal', 'waktu', 'lokasi'];
}
