<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BukuTamu;
use Carbon\Carbon;

class BukuTamuSeeder extends Seeder
{
    public function run()
    {
        $today = Carbon::now()->toDateString();

        $data = [
            [
                'nama' => 'Ahmad Yani',
                'role' => 'umum',
                'instansi' => 'Dinas Pendidikan',
                'alamat' => 'Jl. Kebon Jeruk No. 5',
                'kontak' => '081222333444',
                'siswa_id' => null,
                'jabatan_id' => 1,
                'pegawai_id' => 1,
                'keperluan' => 'Audiensi dengan Kepala Sekolah',
                'foto_tamu' => 'foto1.jpg',
                'created_at' => Carbon::parse($today . ' 08:51:02'),
            ],
            [
                'nama' => 'Siti Aminah',
                'role' => 'ortu',
                'instansi' => null,
                'alamat' => 'Jl. Mawar No. 6',
                'kontak' => '081333444555',
                'siswa_id' => 2,
                'jabatan_id' => 3,
                'pegawai_id' => 6,
                'keperluan' => 'Menemui wali kelas anaknya',
                'foto_tamu' => 'foto2.jpg',
                'created_at' => Carbon::parse($today . ' 09:21:04'),
            ],
            [
                'nama' => 'Bambang Setiawan',
                'role' => 'umum',
                'instansi' => 'PT Telkom',
                'alamat' => 'Jl. Gatot Subroto No. 7',
                'kontak' => '081444555666',
                'siswa_id' => null,
                'jabatan_id' => 4,
                'pegawai_id' => 11,
                'keperluan' => 'Kunjungan administrasi',
                'foto_tamu' => 'foto3.jpg',
                'created_at' => Carbon::parse($today . ' 12:51:42'),
            ],
            [
                'nama' => 'Rahmat Hidayat',
                'role' => 'ortu',
                'instansi' => null,
                'alamat' => 'Jl. Melati No. 10',
                'kontak' => '081555666777',
                'siswa_id' => 5,
                'jabatan_id' => 3,
                'pegawai_id' => 8,
                'keperluan' => 'Mengambil rapor',
                'foto_tamu' => 'foto4.jpg',
                'created_at' => Carbon::parse($today . ' 14:20:11'),
            ],
            [
                'nama' => 'Lina Marlina',
                'role' => 'umum',
                'instansi' => 'Koperasi Sekolah',
                'alamat' => 'Jl. Teratai No. 9',
                'kontak' => '081666777888',
                'siswa_id' => null,
                'jabatan_id' => 6,
                'pegawai_id' => 25,
                'keperluan' => 'Menemui Caraka untuk pengantaran barang',
                'foto_tamu' => 'foto5.jpg',
                'created_at' => Carbon::parse($today . ' 14:40:21'),
            ],
        ];

        BukuTamu::insert($data);
    }
}
