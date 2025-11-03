<?php

namespace App\Http\Controllers\API;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    /**
     * Menampilkan semua data jabatan.
     */
    public function index(Request $request)
    {
        try {
            $query = Jabatan::query();

            // Logika pencarian server-side
            if ($request->has('search') && $request->search != '') {
                $searchTerm = $request->search;
                $query->where('nama_jabatan', 'like', "%{$searchTerm}%");
            }

            $perPage = $request->get('rows_per_page', 10);
            $jabatan = $query->orderBy('id', 'asc')->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $jabatan->items(),
                'current_page' => $jabatan->currentPage(),
                'last_page' => $jabatan->lastPage(),
                'total' => $jabatan->total(),
                'from' => $jabatan->firstItem(),
                'to' => $jabatan->lastItem(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data jabatan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menyimpan data jabatan baru.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jabatan' => 'required|string|max:255|unique:jabatans,nama_jabatan',
        ], [
            'nama_jabatan.required' => 'Nama jabatan wajib diisi',
            'nama_jabatan.unique' => 'Nama jabatan sudah terdaftar',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $jabatan = Jabatan::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Data jabatan berhasil ditambahkan',
                'data' => $jabatan
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambah data jabatan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menampilkan detail satu data jabatan.
     */
    public function show($id)
    {
        try {
            $jabatan = Jabatan::find($id);

            if (!$jabatan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data jabatan tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $jabatan
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil detail jabatan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Memperbarui data jabatan.
     */
    public function update(Request $request, $id)
    {
        $jabatan = Jabatan::find($id);

        if (!$jabatan) {
            return response()->json([
                'success' => false,
                'message' => 'Data jabatan tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama_jabatan' => 'required|string|max:255|unique:jabatans,nama_jabatan,' . $id,
        ], [
            'nama_jabatan.required' => 'Nama jabatan wajib diisi',
            'nama_jabatan.unique' => 'Nama jabatan sudah terdaftar',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $jabatan->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Data jabatan berhasil diperbarui',
                'data' => $jabatan
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data jabatan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menghapus data jabatan.
     */
    public function destroy($id)
    {
        $jabatan = Jabatan::find($id);

        if (!$jabatan) {
            return response()->json([
                'success' => false,
                'message' => 'Data jabatan tidak ditemukan'
            ], 404);
        }

        try {
            // Cek apakah jabatan masih digunakan oleh pegawai
            if ($jabatan->pegawai()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat menghapus jabatan karena masih digunakan oleh pegawai'
                ], 422);
            }

            $jabatan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data jabatan berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data jabatan: ' . $e->getMessage()
            ], 500);
        }
    }
}
