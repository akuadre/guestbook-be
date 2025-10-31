<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = "siswas";
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_siswa',
        'nis',
        'kelas',
        'jenis_kelamin',
        'alamat',
        'kontak',
    ];

    public function bukutamu()
    {
        return $this->hasMany(BukuTamu::class, 'siswa_id');
    }
}
