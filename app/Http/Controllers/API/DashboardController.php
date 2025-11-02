<?php

namespace App\Http\Controllers\Api;

use App\Models\BukuTamu;
use App\Models\Siswa;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    /**
     * Get dashboard statistics
     */
    public function index()
    {
        try {
            $stats = [
                'totalSiswa' => Siswa::count(),
                'totalJabatan' => Jabatan::count(),
                'totalPegawai' => Pegawai::count(),
                'totalBukuTamu' => BukuTamu::count(),
            ];

            // Recent guests (last 5)
            $recentGuests = BukuTamu::with(['siswa', 'pegawai.jabatan'])
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get()
                ->map(function ($guest) {
                    return [
                        'id' => $guest->id,
                        'nama' => $guest->nama,
                        'keperluan' => $guest->keperluan,
                        'tanggal' => Carbon::parse($guest->created_at)->format('d/m/Y'),
                        'role' => $guest->role,
                        'instansi' => $guest->instansi,
                    ];
                });

            return response()->json([
                'success' => true,
                'stats' => $stats,
                'recentGuests' => $recentGuests
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data dashboard: ' . $e->getMessage()
            ], 500);
        }
    }
}
