<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = "pegawais";
    protected $primaryKey = 'id';

    protected $fillable = [
        'nip',
        'nama_pegawai',
        'jabatan_id',
        'kontak',
    ];

    public function jabatan () {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function bukutamu()
    {
        return $this->hasMany(BukuTamu::class, 'pegawai_id');
    }
}
