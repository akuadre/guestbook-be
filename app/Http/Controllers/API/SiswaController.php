<?php

namespace App\Http\Controllers\API;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SiswaController extends Controller
{
    /**
     * Endpoint untuk React: Mengambil daftar siswa untuk tabel utama.
     * Mendukung paginasi dan pencarian (server-side).
     */
    public function index(Request $request)
    {
        $query = Siswa::query();

        // Logika pencarian server-side
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('namasiswa', 'like', "%{$searchTerm}%")
                  ->orWhere('nis', 'like', "%{$searchTerm}%");
            });
        }

        // Ambil rows_per_page dari request, default 10
        $perPage = $request->get('rows_per_page', 10);
        $siswa = $query->orderBy('nama_siswa', 'asc')->paginate($perPage);

        return response()->json($siswa);
    }

    /**
     * Endpoint untuk React: Mengambil detail LENGKAP satu siswa untuk modal popup.
     */
    public function show($idsiswa)
    {
        $siswa = Siswa::find($idsiswa);

        if (!$siswa) {
            return response()->json(['success' => false, 'message' => 'Data siswa tidak ditemukan'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $siswa
        ]);
    }
}

