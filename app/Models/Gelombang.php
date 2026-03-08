<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gelombang extends Model
{
    public function pendaftar()
    {
        return $this->hasMany(Pendaftar::class, 'gelombang', 'nama');
    }
}
