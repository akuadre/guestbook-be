<?php

namespace App\Http\Controllers\API;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PegawaiController extends Controller
{
    /**
     * Endpoint untuk React: Mengambil daftar pegawai untuk tabel utama.
     */
    public function index(Request $request)
    {
        $query = Pegawai::with('jabatan'); // Eager load jabatan saja

        // Logika pencarian server-side
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_pegawai', 'like', "%{$searchTerm}%")
                  ->orWhere('nip', 'like', "%{$searchTerm}%");
            });
        }

        $perPage = $request->get('rows_per_page', 10);
        $pegawai = $query->orderBy('nama_pegawai', 'asc')->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $pegawai->items(),
            'current_page' => $pegawai->currentPage(),
            'last_page' => $pegawai->lastPage(),
            'total' => $pegawai->total(),
            'from' => $pegawai->firstItem(),
            'to' => $pegawai->lastItem(),
        ]);
    }

    /**
     * Endpoint untuk React: Mengambil detail pegawai.
     */
    public function show($id)
    {
        // Hanya load relasi jabatan yang ada di model
        $pegawai = Pegawai::with('jabatan')->find($id);

        if (!$pegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Data pegawai tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pegawai
        ]);
    }
}
