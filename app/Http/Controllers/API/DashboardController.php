<?php

namespace App\Http\Controllers\Api;

use App\Models\BukuTamu;
use App\Models\Siswa;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $totalSiswa = Siswa::count();
        $totalJabatan = Jabatan::count();
        $totalPegawai = Pegawai::count();
        $totalBukuTamu = BukuTamu::count();

        // Ambil 5 tamu terbaru
        $recentGuests = BukuTamu::select(
                'id',
                'nama',
                'keperluan',
                DB::raw('DATE_FORMAT(created_at, "%d %b %Y") as tanggal') // Format tanggal
            )
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'success' => true,
            'stats' => [
                'totalSiswa' => $totalSiswa,
                'totalJabatan' => $totalJabatan,
                'totalPegawai' => $totalPegawai,
                'totalBukuTamu' => $totalBukuTamu,
            ],
            'recentGuests' => $recentGuests,
        ]);
    }
}
