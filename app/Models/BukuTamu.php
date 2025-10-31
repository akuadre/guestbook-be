<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuTamu extends Model
{
    use HasFactory;

    protected $table = 'bukutamus';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama', 'role', 'instansi',
        'alamat', 'kontak',
        'siswa_id', 'jabatan_id', 'pegawai_id',
        'keperluan', 'foto_tamu',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
