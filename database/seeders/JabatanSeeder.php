<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jabatan;

class JabatanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama_jabatan' => 'Kepala Sekolah'],
            ['nama_jabatan' => 'Wakil Kepala Sekolah'],
            ['nama_jabatan' => 'Guru'],
            ['nama_jabatan' => 'Tata Usaha'],
            ['nama_jabatan' => 'Keamanan'],
            ['nama_jabatan' => 'Caraka'],
        ];

        Jabatan::insert($data);
    }
}
