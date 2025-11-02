<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama_siswa' => 'Adi Nugraha', 'nis' => '1001', 'kelas' => 'XI MEKA B', 'jenis_kelamin' => 'L', 'alamat' => 'Jl. Merdeka No. 1', 'kontak' => '0811111111'],
            ['nama_siswa' => 'Siti Rahma', 'nis' => '1002', 'kelas' => 'X TEK A', 'jenis_kelamin' => 'P', 'alamat' => 'Jl. Melati No. 2', 'kontak' => '0811111112'],
            ['nama_siswa' => 'Dimas Pratama', 'nis' => '1003', 'kelas' => 'XI RPL A', 'jenis_kelamin' => 'L', 'alamat' => 'Jl. Kenanga No. 3', 'kontak' => '0811111113'],
            ['nama_siswa' => 'Ayu Lestari', 'nis' => '1004', 'kelas' => 'XI TEK B', 'jenis_kelamin' => 'P', 'alamat' => 'Jl. Mawar No. 4', 'kontak' => '0811111114'],
            ['nama_siswa' => 'Rian Saputra', 'nis' => '1005', 'kelas' => 'XI TOI A', 'jenis_kelamin' => 'L', 'alamat' => 'Jl. Anggrek No. 5', 'kontak' => '0811111115'],
            ['nama_siswa' => 'Intan Wulandari', 'nis' => '1006', 'kelas' => 'XII PSPT A', 'jenis_kelamin' => 'P', 'alamat' => 'Jl. Sakura No. 6', 'kontak' => '0811111116'],
            ['nama_siswa' => 'Doni Firmansyah', 'nis' => '1007', 'kelas' => 'XI SIJA A', 'jenis_kelamin' => 'L', 'alamat' => 'Jl. Flamboyan No. 7', 'kontak' => '0811111117'],
            ['nama_siswa' => 'Nina Kartika', 'nis' => '1008', 'kelas' => 'XI RPL C', 'jenis_kelamin' => 'P', 'alamat' => 'Jl. Dahlia No. 8', 'kontak' => '0811111118'],
            ['nama_siswa' => 'Bima Aditya', 'nis' => '1009', 'kelas' => 'XII TPTU B', 'jenis_kelamin' => 'L', 'alamat' => 'Jl. Kamboja No. 9', 'kontak' => '0811111119'],
            ['nama_siswa' => 'Lia Putri', 'nis' => '1010', 'kelas' => 'XII RPL B', 'jenis_kelamin' => 'P', 'alamat' => 'Jl. Cempaka No. 10', 'kontak' => '0811111120'],
        ];

        Siswa::insert($data);
    }
}
