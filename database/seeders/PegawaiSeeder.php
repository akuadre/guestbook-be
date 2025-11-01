<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Kepala Sekolah (1 orang)
            ['nip' => '1987001', 'nama_pegawai' => 'Drs. Suparman', 'jabatan_id' => 1, 'kontak' => '081234567890'],

            // Wakil Kepala Sekolah (4 orang)
            ['nip' => '1987002', 'nama_pegawai' => 'Siti Marlina', 'jabatan_id' => 2, 'kontak' => '081234567891'],
            ['nip' => '1987003', 'nama_pegawai' => 'Rudi Hartono', 'jabatan_id' => 2, 'kontak' => '081234567892'],
            ['nip' => '1987004', 'nama_pegawai' => 'Agus Setiawan', 'jabatan_id' => 2, 'kontak' => '081234567893'],
            ['nip' => '1987005', 'nama_pegawai' => 'Teguh Prasetyo', 'jabatan_id' => 2, 'kontak' => '081234567894'],

            // Guru (5 orang)
            ['nip' => '1987006', 'nama_pegawai' => 'Dewi Lestari', 'jabatan_id' => 3, 'kontak' => '081234567895'],
            ['nip' => '1987007', 'nama_pegawai' => 'Andi Kurniawan', 'jabatan_id' => 3, 'kontak' => '081234567896'],
            ['nip' => '1987008', 'nama_pegawai' => 'Rahmawati', 'jabatan_id' => 3, 'kontak' => '081234567897'],
            ['nip' => '1987009', 'nama_pegawai' => 'Rizal Maulana', 'jabatan_id' => 3, 'kontak' => '081234567898'],
            ['nip' => '1987010', 'nama_pegawai' => 'Budi Santoso', 'jabatan_id' => 3, 'kontak' => '081234567899'],

            // Tata Usaha (5 orang)
            ['nip' => '1987011', 'nama_pegawai' => 'Nur Hidayah', 'jabatan_id' => 4, 'kontak' => '081234567900'],
            ['nip' => '1987012', 'nama_pegawai' => 'Rina Amelia', 'jabatan_id' => 4, 'kontak' => '081234567901'],
            ['nip' => '1987013', 'nama_pegawai' => 'Dedi Supriadi', 'jabatan_id' => 4, 'kontak' => '081234567902'],
            ['nip' => '1987014', 'nama_pegawai' => 'Yusuf Maulana', 'jabatan_id' => 4, 'kontak' => '081234567903'],
            ['nip' => '1987015', 'nama_pegawai' => 'Melati Ayu', 'jabatan_id' => 4, 'kontak' => '081234567904'],

            // Keamanan (5 orang)
            ['nip' => '1987016', 'nama_pegawai' => 'Darto', 'jabatan_id' => 5, 'kontak' => '081234567905'],
            ['nip' => '1987017', 'nama_pegawai' => 'Wawan', 'jabatan_id' => 5, 'kontak' => '081234567906'],
            ['nip' => '1987018', 'nama_pegawai' => 'Ujang', 'jabatan_id' => 5, 'kontak' => '081234567907'],
            ['nip' => '1987019', 'nama_pegawai' => 'Tatang', 'jabatan_id' => 5, 'kontak' => '081234567908'],
            ['nip' => '1987020', 'nama_pegawai' => 'Samsul', 'jabatan_id' => 5, 'kontak' => '081234567909'],

            // Caraka (5 orang)
            ['nip' => '1987021', 'nama_pegawai' => 'Edi', 'jabatan_id' => 6, 'kontak' => '081234567910'],
            ['nip' => '1987022', 'nama_pegawai' => 'Yanto', 'jabatan_id' => 6, 'kontak' => '081234567911'],
            ['nip' => '1987023', 'nama_pegawai' => 'Bambang', 'jabatan_id' => 6, 'kontak' => '081234567912'],
            ['nip' => '1987024', 'nama_pegawai' => 'Ahmad', 'jabatan_id' => 6, 'kontak' => '081234567913'],
            ['nip' => '1987025', 'nama_pegawai' => 'Heri', 'jabatan_id' => 6, 'kontak' => '081234567914'],
        ];

        Pegawai::insert($data);
    }
}
