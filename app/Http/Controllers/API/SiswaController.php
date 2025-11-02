<?php

namespace App\Http\Controllers\API;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

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
                $q->where('nama_siswa', 'like', "%{$searchTerm}%")
                  ->orWhere('nis', 'like', "%{$searchTerm}%")
                  ->orWhere('kelas', 'like', "%{$searchTerm}%");
            });
        }

        // Filter berdasarkan kelas (X, XI, XII) - handle format seperti "xi meka b", "xii rpl a"
        if ($request->has('kelas') && $request->kelas != '') {
            $selectedKelas = $request->kelas;

            // Filter berdasarkan tingkat kelas dengan pattern yang tepat
            if ($selectedKelas === 'X') {
                // Untuk X: harus dimulai dengan X dan panjang minimal 2 karakter (X RPL, X TEK, dll)
                $query->where('kelas', 'like', 'X %')
                    ->orWhere('kelas', 'like', 'X-%')
                    ->orWhere('kelas', 'regexp', '^X[^I]'); // X diikuti bukan I
            } elseif ($selectedKelas === 'XI') {
                // Untuk XI: harus dimulai dengan XI dan bukan XII
                $query->where('kelas', 'like', 'XI %')
                    ->orWhere('kelas', 'like', 'XI-%')
                    ->orWhere('kelas', 'regexp', '^XI[^I]'); // XI diikuti bukan I
            } elseif ($selectedKelas === 'XII') {
                // Untuk XII: harus dimulai dengan XII
                $query->where('kelas', 'like', 'XII%');
            }
        }

        // Ambil rows_per_page dari request, default 10
        $perPage = $request->get('rows_per_page', 10);
        $siswa = $query->orderBy('nama_siswa', 'asc')->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $siswa->items(),
            'current_page' => $siswa->currentPage(),
            'last_page' => $siswa->lastPage(),
            'total' => $siswa->total(),
            'from' => $siswa->firstItem(),
            'to' => $siswa->lastItem(),
        ]);
    }

    /**
     * Endpoint untuk React: Mengambil detail LENGKAP satu siswa untuk modal popup.
     */
    public function show($id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json(['success' => false, 'message' => 'Data siswa tidak ditemukan'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $siswa
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nis' => 'required|string|max:20|unique:siswas,nis',
            'nama_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas' => 'required|string|max:50',
            'alamat' => 'nullable|string',
            'kontak' => 'nullable|string|max:20',
        ], [
            'nis.unique' => 'NIS sudah terdaftar',
            'jenis_kelamin.in' => 'Jenis kelamin harus L atau P',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $siswa = Siswa::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Data siswa berhasil ditambahkan',
                'data' => $siswa
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambah data siswa: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Update data siswa
     */
    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nis' => 'required|string|max:20|unique:siswas,nis,' . $id,
            'nama_siswa' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'kelas' => 'required|string|max:50',
            'alamat' => 'nullable|string',
            'kontak' => 'nullable|string|max:20',
        ], [
            'nis.unique' => 'NIS sudah terdaftar',
            'jenis_kelamin.in' => 'Jenis kelamin harus L atau P',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $siswa->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Data siswa berhasil diupdate',
                'data' => $siswa
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data siswa: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Hapus data siswa
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data siswa tidak ditemukan'
            ], 404);
        }

        try {
            $siswa->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data siswa berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data siswa: ' . $e->getMessage()
            ], 500);
        }
    }
}

