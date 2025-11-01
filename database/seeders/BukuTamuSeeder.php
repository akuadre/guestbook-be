<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BukuTamu;

class BukuTamuSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Ahmad Yani',
                'role' => 'Tamu Umum',
                'instansi' => 'Dinas Pendidikan',
                'alamat' => 'Jl. Kebon Jeruk No. 5',
                'kontak' => '081222333444',
                'siswa_id' => null,
                'jabatan_id' => 1,
                'pegawai_id' => 1,
                'keperluan' => 'Audiensi dengan Kepala Sekolah',
                'foto_tamu' => 'foto1.jpg',
            ],
            [
                'nama' => 'Siti Aminah',
                'role' => 'Orang Tua',
                'instansi' => null,
                'alamat' => 'Jl. Mawar No. 6',
                'kontak' => '081333444555',
                'siswa_id' => 2,
                'jabatan_id' => 3,
                'pegawai_id' => 6,
                'keperluan' => 'Menemui wali kelas anaknya',
                'foto_tamu' => 'foto2.jpg',
            ],
            [
                'nama' => 'Bambang Setiawan',
                'role' => 'Tamu Umum',
                'instansi' => 'PT Telkom',
                'alamat' => 'Jl. Gatot Subroto No. 7',
                'kontak' => '081444555666',
                'siswa_id' => null,
                'jabatan_id' => 4,
                'pegawai_id' => 11,
                'keperluan' => 'Kunjungan administrasi',
                'foto_tamu' => 'foto3.jpg',
            ],
            [
                'nama' => 'Rahmat Hidayat',
                'role' => 'Orang Tua',
                'instansi' => null,
                'alamat' => 'Jl. Melati No. 10',
                'kontak' => '081555666777',
                'siswa_id' => 5,
                'jabatan_id' => 3,
                'pegawai_id' => 8,
                'keperluan' => 'Mengambil rapor',
                'foto_tamu' => 'foto4.jpg',
            ],
            [
                'nama' => 'Lina Marlina',
                'role' => 'Tamu Umum',
                'instansi' => 'Koperasi Sekolah',
                'alamat' => 'Jl. Teratai No. 9',
                'kontak' => '081666777888',
                'siswa_id' => null,
                'jabatan_id' => 6,
                'pegawai_id' => 26,
                'keperluan' => 'Menemui Caraka untuk pengantaran barang',
                'foto_tamu' => 'foto5.jpg',
            ],
        ];

        BukuTamu::insert($data);
    }
}
