<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Siswa;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\BukuTamu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BukuTamuController extends Controller
{
    /**
     * Menampilkan semua data buku tamu.
     */
    public function index(Request $request)
    {
        $query = BukuTamu::with(['siswa', 'pegawai.jabatan']);

        // Logika pencarian server-side
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'like', "%{$searchTerm}%")
                  ->orWhere('keperluan', 'like', "%{$searchTerm}%")
                  ->orWhere('kontak', 'like', "%{$searchTerm}%")
                  ->orWhereHas('siswa', function($q) use ($searchTerm) {
                      $q->where('nama_siswa', 'like', "%{$searchTerm}%"); // sesuaikan field
                  })
                  ->orWhereHas('pegawai', function($q) use ($searchTerm) {
                      $q->where('nama_pegawai', 'like', "%{$searchTerm}%"); // sesuaikan field
                  });
            });
        }

        $perPage = $request->get('rows_per_page', 10);
        $bukutamu = $query->orderBy('created_at', 'desc')->paginate($perPage);

        // Format response
        $formattedData = $bukutamu->getCollection()->map(function ($tamu) {
            return [
                'id' => $tamu->id,
                'nama' => $tamu->nama,
                'role' => $tamu->role,
                'instansi' => $tamu->instansi,
                'alamat' => $tamu->alamat,
                'kontak' => $tamu->kontak,
                'siswa_id' => $tamu->siswa_id,
                'pegawai_id' => $tamu->pegawai_id,
                'keperluan' => $tamu->keperluan,
                'foto_tamu' => $tamu->foto_tamu,
                'created_at' => $tamu->created_at,
                'updated_at' => $tamu->updated_at,
                'siswa' => $tamu->siswa ? [
                    'id' => $tamu->siswa->id,
                    'nama_siswa' => $tamu->siswa->nama_siswa,
                    'nis' => $tamu->siswa->nis,
                    'kelas' => $tamu->siswa->kelas,
                ] : null,
                'pegawai' => $tamu->pegawai ? [
                    'id' => $tamu->pegawai->id,
                    'nama_pegawai' => $tamu->pegawai->nama_pegawai,
                    'nip' => $tamu->pegawai->nip,
                    'kontak' => $tamu->pegawai->kontak,
                    'jabatan' => $tamu->pegawai->jabatan ? [
                        'id' => $tamu->pegawai->jabatan->id,
                        'nama_jabatan' => $tamu->pegawai->jabatan->nama_jabatan,
                    ] : null
                ] : null
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $formattedData,
            'current_page' => $bukutamu->currentPage(),
            'last_page' => $bukutamu->lastPage(),
            'total' => $bukutamu->total(),
            'from' => $bukutamu->firstItem(),
            'to' => $bukutamu->lastItem(),
        ]);
    }

    /**
     * Menyimpan data buku tamu baru.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'role' => 'required|in:ortu,umum',
            'siswa_id' => 'required_if:role,ortu|nullable|exists:siswas,id', // sesuaikan dengan model
            'instansi' => 'required_if:role,umum|nullable|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'required|string|max:20',
            'pegawai_id' => 'required|exists:pegawais,id', // sesuaikan dengan model
            'keperluan' => 'required|string',
            'foto_tamu' => 'nullable|string',
        ], [
            'siswa_id.required_if' => 'Nama siswa wajib dipilih jika role adalah Orang Tua.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $validatedData = $validator->validated();
        $imageName = null;

        // Proses dan simpan foto dari base64
        if ($request->has('foto_tamu') && !empty($request->foto_tamu)) {
            try {
                $image = $request->input('foto_tamu');
                $image = str_replace('data:image/jpeg;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageData = base64_decode($image);
                $imageName = 'tamu_' . time() . '.jpg';

                Storage::disk('public')->put('foto_tamu/' . $imageName, $imageData);
                $validatedData['foto_tamu'] = $imageName;

            } catch (Exception $e) {
                Log::error('Gagal menyimpan foto: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memproses foto.'
                ], 500);
            }
        }

        $bukuTamu = BukuTamu::create($validatedData);
        $bukuTamu->load(['siswa', 'pegawai.jabatan']);

        return response()->json([
            'success' => true,
            'message' => 'Data buku tamu berhasil ditambahkan',
            'data' => $bukuTamu
        ], 201);
    }

    /**
     * Menampilkan detail satu data buku tamu.
     */
    public function show($id)
    {
        $tamu = BukuTamu::with(['siswa', 'pegawai.jabatan'])->find($id);

        if (!$tamu) {
            return response()->json([
                'success' => false,
                'message' => 'Data buku tamu tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $tamu
        ]);
    }

    /**
     * Menghapus data buku tamu.
     */
    public function destroy($id)
    {
        $bukutamu = BukuTamu::find($id);

        if (!$bukutamu) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        if ($bukutamu->foto_tamu) {
            Storage::disk('public')->delete('foto_tamu/' . $bukutamu->foto_tamu);
        }

        $bukutamu->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }

    /**
     * Get grafik data for buku tamu
     */
    public function getGrafikData(Request $request)
    {
        try {
            $filterType = $request->get('filter_type', 'harian');
            $date = $request->get('date', now()->format('Y-m-d'));
            $month = $request->get('month', now()->month);
            $year = $request->get('year', now()->year);

            $data = [];
            $labels = [];

            switch ($filterType) {
                case 'harian':
                    // Data per jam dalam sehari
                    $labels = [
                        '06:00', '07:00', '08:00', '09:00', '10:00',
                        '11:00', '12:00', '13:00', '14:00', '15:00',
                        '16:00', '17:00', '18:00'
                    ];

                    $data = array_fill(0, count($labels), 0);

                    $visits = BukuTamu::whereDate('created_at', $date)
                        ->selectRaw('HOUR(created_at) as hour, COUNT(*) as count')
                        ->groupBy('hour')
                        ->get()
                        ->keyBy('hour');

                    foreach ($labels as $index => $label) {
                        $hour = (int) substr($label, 0, 2);
                        if ($visits->has($hour)) {
                            $data[$index] = $visits->get($hour)->count;
                        }
                    }
                    break;

                case 'mingguan':
                    // Data per hari dalam seminggu
                    $labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                    $data = array_fill(0, 7, 0);

                    $startOfWeek = Carbon::now()->startOfWeek();
                    $endOfWeek = Carbon::now()->endOfWeek();

                    $visits = BukuTamu::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                        ->selectRaw('DAYOFWEEK(created_at) as day, COUNT(*) as count')
                        ->groupBy('day')
                        ->get()
                        ->keyBy('day');

                    // Adjust for Carbon day of week (1=Sunday, 7=Saturday)
                    foreach ($visits as $day => $visit) {
                        $adjustedIndex = ($day - 1) % 7;
                        $data[$adjustedIndex] = $visit->count;
                    }
                    break;

                case 'bulanan':
                    // Data per hari dalam bulan
                    $daysInMonth = Carbon::create($year, $month)->daysInMonth;
                    $labels = range(1, $daysInMonth);
                    $data = array_fill(0, $daysInMonth, 0);

                    $visits = BukuTamu::whereYear('created_at', $year)
                        ->whereMonth('created_at', $month)
                        ->selectRaw('DAY(created_at) as day, COUNT(*) as count')
                        ->groupBy('day')
                        ->get()
                        ->keyBy('day');

                    foreach ($visits as $day => $visit) {
                        $data[$day - 1] = $visit->count;
                    }
                    break;

                case 'tahunan':
                    // Data per bulan dalam tahun
                    $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                    $data = array_fill(0, 12, 0);

                    $visits = BukuTamu::whereYear('created_at', $year)
                        ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                        ->groupBy('month')
                        ->get()
                        ->keyBy('month');

                    foreach ($visits as $month => $visit) {
                        $data[$month - 1] = $visit->count;
                    }
                    break;
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'labels' => $labels,
                    'datasets' => [
                        [
                            'label' => 'Jumlah Tamu',
                            'data' => $data,
                            'borderColor' => 'rgba(59, 130, 246, 0.8)',
                            'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                            'fill' => true,
                            'tension' => 0.4,
                        ]
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data grafik: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get data untuk form input buku tamu
     */
    public function getFormData()
    {
        try {
            // Ambil data siswa
            $siswa = Siswa::select('id', 'nama_siswa', 'nis', 'kelas')
                ->orderBy('nama_siswa')
                ->get();

            // Ambil data pegawai
            $pegawai = Pegawai::select('id', 'nama_pegawai')
                ->orderBy('nama_pegawai')
                ->get();

            // Ambil data jabatan
            $jabatan = Jabatan::select('id', 'nama_jabatan')
                ->orderBy('nama_jabatan')
                ->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'siswa'   => $siswa,
                    'pegawai' => $pegawai,
                    'jabatan' => $jabatan,
                ],
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data form: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store data buku tamu dari React (public)
     */
    public function storeUser(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama' => 'required|string|max:255',
                'role' => 'required|in:ortu,umum',
                'siswa_id' => 'nullable|exists:siswas,id',
                'instansi' => 'nullable|string|max:255',
                'alamat' => 'required|string',
                'kontak' => 'required|string|max:255',
                'pegawai_id' => 'required|exists:pegawais,id',
                'keperluan' => 'required|string',
                'foto_tamu' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $validatedData = $validator->validated();
            $imageName = null;

            // Proses foto
            if (!empty($request->foto_tamu)) {
                $image = str_replace('data:image/jpeg;base64,', '', $request->foto_tamu);
                $image = str_replace(' ', '+', $image);
                $imageData = base64_decode($image);
                $imageName = 'tamu_' . time() . '.jpg';

                Storage::disk('public')->put('foto_tamu/' . $imageName, $imageData);
                $validatedData['foto_tamu'] = $imageName;
            }

            $bukuTamu = BukuTamu::create($validatedData);

            // Kirim WhatsApp notification
            // $this->sendWhatsAppNotification($bukuTamu, $fotoTamuPath);

            return response()->json([
                'success' => true,
                'message' => 'Data buku tamu berhasil disimpan!'
            ]);

        } catch (Exception $e) {
            Log::error('Store guestbook error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send WhatsApp notification
     */
    private function sendWhatsAppNotification($bukuTamu, $fotoTamuPath)
    {
        $apiKey = env('FONNTE_API_KEY');

        $pegawai = Pegawai::find($bukuTamu->idpegawai);

        if ($pegawai && !empty($pegawai->hppegawai)) {
            $nomor = ltrim($pegawai->hppegawai, '0');
            if (!str_starts_with($nomor, '62')) {
                $nomor = '62' . $nomor;
            }

            Log::info('Sending WhatsApp to: ' . $nomor);

            if ($fotoTamuPath && file_exists($fotoTamuPath)) {
                $imageUrl = env('APP_URL') . "/uploads/foto_tamu/{$bukuTamu->foto_tamu}";

                $response = Http::withHeaders(['Authorization' => $apiKey])
                    ->post('https://api.fonnte.com/send', [
                        'target' => $nomor,
                        'url' => $imageUrl,
                        'message' => "Assalamualaikum Bapak/Ibu {$pegawai->namapegawai}, ini adalah foto tamu Anda.",
                    ]);

                Log::info('Foto WhatsApp sent: ' . $response->successful());
            }

            $pesanTeks = $this->formatWhatsAppMessage($bukuTamu, $pegawai);

            $response = Http::withHeaders(['Authorization' => $apiKey])
                ->post('https://api.fonnte.com/send', [
                    'target' => $nomor,
                    'message' => $pesanTeks,
                ]);

            Log::info('Pesan WhatsApp sent: ' . $response->successful());

        } else {
            Log::warning('Pegawai not found or no contact number for ID: ' . $bukuTamu->idpegawai);
        }
    }

    /**
     * Format WhatsApp message
     */
    private function formatWhatsAppMessage($bukuTamu, $pegawai)
    {
        $pesan = "Assalamualaikum Bapak/Ibu {$pegawai->namapegawai},\n\n"
               . "Ini adalah nomor layanan Hotline SMK Negeri 1 Cimahi.\n"
               . "Saat ini ada tamu yang ingin bertemu dengan Anda sedang menunggu di Ruang Resepsionis.\n\n";

        if ($bukuTamu->role == 'ortu') {
            $siswa = Siswa::find($bukuTamu->idsiswa);
            $pesan .= "Nama Tamu: {$bukuTamu->nama}.\n"
                   . "Orang tua dari siswa: {$siswa->namasiswa}.\n"
                   . "Dengan Nomor WA: {$bukuTamu->kontak}.\n";
        } else {
            $pesan .= "Nama Tamu: {$bukuTamu->nama}.\n"
                   . "Asal Instansi: {$bukuTamu->instansi}.\n"
                   . "Dengan Nomor WA: {$bukuTamu->kontak}.\n";
        }

        $pesan .= "\nKeperluan: {$bukuTamu->keperluan}\n"
               . "Waktu: " . now()->format('d F Y, H:i') . " WIB\n\n"
               . "Untuk konfirmasi atau informasi lebih lanjut, silakan hubungi kontak nomor Whatsapp tamu tersebut.\n";

        return $pesan;
    }
}
