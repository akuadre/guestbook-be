<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatans';
    protected $primaryKey = 'id';

    protected $fillable =
    [
        'nama_jabatan'
    ];

    public function bukutamu()
    {
        return $this->hasMany(BukuTamu::class, 'jabatan_id');
    }

    public function pegawai()
    {
        return $this->hasMany(Pegawai::class, 'jabatan_id');
    }
}
