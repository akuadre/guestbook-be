<?php

namespace App\Http\Controllers\API;

use App\Models\Pegawai;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    /**
     * Endpoint untuk React: Mengambil daftar pegawai untuk tabel utama.
     */
    public function index(Request $request)
    {
        $query = Pegawai::with('jabatan');

        // Logika pencarian server-side
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_pegawai', 'like', "%{$searchTerm}%")
                  ->orWhere('nip', 'like', "%{$searchTerm}%");
            });
        }

        // Filter berdasarkan jabatan
        if ($request->has('jabatan') && $request->jabatan != '') {
            $query->whereHas('jabatan', function($q) use ($request) {
                $q->where('nama_jabatan', 'like', "%{$request->jabatan}%");
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

    /**
     * Endpoint untuk React: Menyimpan data pegawai baru.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|max:20|unique:pegawais,nip',
            'nama_pegawai' => 'required|string|max:255',
            'jabatan_id' => 'required|exists:jabatans,id',
            'kontak' => 'nullable|string|max:20',
        ], [
            'nip.unique' => 'NIP sudah terdaftar',
            'jabatan_id.required' => 'Jabatan harus dipilih',
            'jabatan_id.exists' => 'Jabatan tidak valid',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $pegawai = Pegawai::create($request->all());

            // Load relasi jabatan untuk response
            $pegawai->load('jabatan');

            return response()->json([
                'success' => true,
                'message' => 'Data pegawai berhasil ditambahkan',
                'data' => $pegawai
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambah data pegawai: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Endpoint untuk React: Mengupdate data pegawai.
     */
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Data pegawai tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|max:20|unique:pegawais,nip,' . $id,
            'nama_pegawai' => 'required|string|max:255',
            'jabatan_id' => 'required|exists:jabatans,id',
            'kontak' => 'nullable|string|max:20',
        ], [
            'nip.unique' => 'NIP sudah terdaftar',
            'jabatan_id.required' => 'Jabatan harus dipilih',
            'jabatan_id.exists' => 'Jabatan tidak valid',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $pegawai->update($request->all());

            // Load relasi jabatan untuk response
            $pegawai->load('jabatan');

            return response()->json([
                'success' => true,
                'message' => 'Data pegawai berhasil diupdate',
                'data' => $pegawai
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data pegawai: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Endpoint untuk React: Menghapus data pegawai.
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);

        if (!$pegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Data pegawai tidak ditemukan'
            ], 404);
        }

        try {
            $pegawai->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data pegawai berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data pegawai: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Endpoint untuk React: Mengambil daftar jabatan untuk dropdown.
     */
    public function getJabatans()
    {
        try {
            $jabatans = Jabatan::orderBy('id', 'asc')->get();

            return response()->json([
                'success' => true,
                'data' => $jabatans
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data jabatan'
            ], 500);
        }
    }
}
