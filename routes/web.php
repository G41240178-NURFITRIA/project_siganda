<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('welcome');
});


// ─── PROTECTED ROUTES (harus login) ─────────────────────────
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
])->group(function () {

    // ── Dashboard (semua role) ─────────────────────────
    Route::get('/dashboard', function () {
        $user = Auth::user();

        if ($user->isAdmin()) {
            // 1. Dapatkan semua sesi aktif (yang sedang login) dari database
            $activeSessions = \Illuminate\Support\Facades\DB::table('sessions')
                ->whereNotNull('user_id')
                ->join('users', 'sessions.user_id', '=', 'users.id')
                ->select('users.name', 'users.role', 'sessions.last_activity')
                ->get();

            // Hitung statistik (Berapa banyak yang SEDANG LOGIN)
            $stats = [
                'total' => $activeSessions->count(),
                'dokter' => $activeSessions->where('role', 'dokter')->count(),
                'perawat' => $activeSessions->where('role', 'perawat')->count(),
                'pmik' => $activeSessions->where('role', 'pmik')->count(),
            ];

            // 2. Tampilkan Aktivitas Terbaru (Menggunakan riwayat login yang permanen)
            $loginLogs = \App\Models\LoginLog::with('user')->latest()->take(5)->get();
            $activities = $loginLogs->map(function($log) {
                return (object)[
                    'time' => $log->created_at,
                    'icon' => '🟢',
                    'color' => 'bg-green',
                    'title' => 'Login / Masuk Sistem',
                    'desc' => strtoupper($log->user->role) . ' - ' . $log->user->name
                ];
            });

            return view('admin.dashboard', compact('activities', 'stats'));
        }
        if ($user->isPmik()) {
            $rekamMedis = \App\Models\RekamMedis::latest()->take(5)->get();
            $totalRm = \App\Models\RekamMedis::count();
            $totalPasienHariIni = \App\Models\RekamMedis::whereDate('created_at', today())->count();
            $pasienDirawat = \App\Models\Triage::where('tindak_lanjut', 'Rawat Inap')->count();
            $tlPulang = \App\Models\Triage::where('tindak_lanjut', 'Pulang')->count();
            $tlRawatInap = \App\Models\Triage::where('tindak_lanjut', 'Rawat Inap')->count();
            $tlRujuk = \App\Models\Triage::where('tindak_lanjut', 'Rujuk')->count();
            $tlMeninggal = \App\Models\Triage::where('tindak_lanjut', 'Meninggal')->count();

            $pendaftaran7Hari = collect();
            for ($i = 6; $i >= 0; $i--) {
                $tanggal = now()->subDays($i)->toDateString();
                $jumlah = \App\Models\RekamMedis::whereDate('created_at', $tanggal)->count();
                $pendaftaran7Hari->push((object) [
                    'label' => \Carbon\Carbon::parse($tanggal)->translatedFormat('d M'),
                    'count' => $jumlah,
                ]);
            }
            $counts = $pendaftaran7Hari->pluck('count')->toArray();
            $maxPendaftaran = !empty($counts) ? max($counts) : 1;

            return view('pmik.dashboard', compact('rekamMedis', 'totalRm', 'totalPasienHariIni', 'pasienDirawat', 'tlPulang', 'tlRawatInap', 'tlRujuk', 'tlMeninggal', 'pendaftaran7Hari', 'maxPendaftaran'));
        }
        if ($user->isDokter()) {
            $rekamMedis = \App\Models\RekamMedis::latest()->take(5)->get();
            $triages = \App\Models\Triage::where('status_observasi', 'aktif')->latest()->take(5)->get();
            $selesaiHariIni = \App\Models\Triage::where('status_observasi', 'selesai')->whereDate('updated_at', today())->count();
            
            $stats = [
                'total_triage' => \App\Models\Triage::whereDate('created_at', today())->count(),
                'merah' => \App\Models\Triage::whereDate('created_at', today())->where('kategori', 'merah')->count(),
                'kuning' => \App\Models\Triage::whereDate('created_at', today())->where('kategori', 'kuning')->count(),
                'hijau' => \App\Models\Triage::whereDate('created_at', today())->where('kategori', 'hijau')->count(),
                'laki' => \App\Models\Triage::whereDate('created_at', today())->where('jenis_kelamin', 'L')->count(),
                'perempuan' => \App\Models\Triage::whereDate('created_at', today())->where('jenis_kelamin', 'P')->count(),
            ];
            return view('dokter.dashboard', compact('rekamMedis', 'triages', 'selesaiHariIni', 'stats'));
        }
        if ($user->isPerawat()) {
            $triages = \App\Models\Triage::latest()->take(5)->get();
            $stats = [
                'total_triage' => \App\Models\Triage::whereDate('created_at', today())->count(),
                'merah' => \App\Models\Triage::whereDate('created_at', today())->where('kategori', 'merah')->count(),
                'kuning' => \App\Models\Triage::whereDate('created_at', today())->where('kategori', 'kuning')->count(),
                'hijau' => \App\Models\Triage::whereDate('created_at', today())->where('kategori', 'hijau')->count(),
                'laki' => \App\Models\Triage::whereDate('created_at', today())->where('jenis_kelamin', 'L')->count(),
                'perempuan' => \App\Models\Triage::whereDate('created_at', today())->where('jenis_kelamin', 'P')->count(),
            ];

            $activities = collect();
            foreach($triages as $t) {
                $activities->push((object)[
                    'time' => $t->created_at,
                    'type' => 'daftar',
                    'nama' => $t->nama_pasien,
                    'kategori' => $t->kategori,
                    'tindak_lanjut' => null
                ]);
                if($t->status_observasi == 'selesai') {
                    $activities->push((object)[
                        'time' => $t->updated_at,
                        'type' => 'selesai',
                        'nama' => $t->nama_pasien,
                        'kategori' => $t->kategori,
                        'tindak_lanjut' => $t->tindak_lanjut
                    ]);
                }
            }
            $activities = $activities->sortByDesc('time')->take(7);

            return view('perawat.dashboard', compact('triages', 'stats', 'activities'));
        }

        return view('dashboard');
    })->name('dashboard');


    Route::get('/triage', function () {
        $user = Auth::user();
        $triages = \App\Models\Triage::latest()->get();
        if ($user->isAdmin()) return view('admin.triage', compact('triages'));
        if ($user->isDokter()) return view('dokter.triage', compact('triages'));
        if ($user->isPerawat()) return view('perawat.triage', compact('triages'));
        abort(403);
    })->middleware('role:dokter,perawat,admin')
      ->name('triage');

    Route::post('/triage/store', function (Illuminate\Http\Request $request) {
        $triage = \App\Models\Triage::create($request->all());
        return redirect()->route('triage')->with('success', 'Triage berhasil disimpan.');
    })->middleware('role:perawat,admin,dokter')->name('triage.store');

    Route::get('/triage/riwayat', function () {
        $triages = \App\Models\Triage::latest()->get();
        return view('perawat.triage_riwayat', compact('triages'));
    })->middleware('role:perawat,admin,dokter')->name('triage.riwayat');



    Route::post('/triage/{id}/selesai', function (Illuminate\Http\Request $request, $id) {
        $triage = \App\Models\Triage::findOrFail($id);
        $triage->status_observasi = 'selesai';
        $triage->tindak_lanjut = $request->input('tindak_lanjut');
        $triage->save();
        return redirect()->back();
    })->middleware('role:perawat,admin,dokter')->name('triage.selesai');

    Route::get('/triage/{id}/cetak', function ($id) {
        $triage = \App\Models\Triage::findOrFail($id);
        return view('perawat.triage_cetak', ['data' => $triage->toArray()]);
    })->middleware('role:perawat,admin,dokter')->name('triage.cetak');


    Route::get('/registrasi', function () {
        $user = Auth::user();
        
        $lastRm = \App\Models\RekamMedis::where('no_rm', 'like', '%-%')->orderBy('id', 'desc')->first();
        
        if ($lastRm) {
            $cleanNumber = str_replace('-', '', $lastRm->no_rm);
            $nextNum = is_numeric($cleanNumber) ? (int)$cleanNumber + 1 : 1;
        } else {
            $nextNum = 1;
        }

        $padded = str_pad($nextNum, 6, '0', STR_PAD_LEFT);
        $nextRm = substr($padded, 0, 2) . '-' . substr($padded, 2, 2) . '-' . substr($padded, 4, 2);

        if ($user->isAdmin()) return view('admin.registrasi', compact('nextRm'));
        if ($user->isPmik()) return view('pmik.registrasi', compact('nextRm'));
        abort(403);
    })->middleware('role:pmik,admin')
      ->name('registrasi');


    Route::resource('rekam-medis', App\Http\Controllers\RekamMedisController::class)
        ->middleware('role:pmik,dokter,admin')
        ->names('rekam.medis');



    Route::get('/pmik/pelaporan', function () {
        // Sensus Bulanan (Semua Pasien)
        $sensusBulanan = \App\Models\RekamMedis::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

        $sensusBulanLalu = \App\Models\RekamMedis::whereMonth('created_at', today()->subMonth()->format('m'))
            ->whereYear('created_at', today()->subMonth()->format('Y'))
            ->count();
            
        $trendSensus = $sensusBulanLalu > 0 ? round((($sensusBulanan - $sensusBulanLalu) / $sensusBulanLalu) * 100) : ($sensusBulanan > 0 ? 100 : 0);
        $trendSensusText = $trendSensus >= 0 ? '▲ ' . $trendSensus . '% naik' : '▼ ' . abs($trendSensus) . '% turun';

        // Morbiditas Bulanan
        $morbiditasBulanan = 0;
        $morbiditasBulanLalu = 0;
            
        $trendMorbiditas = $morbiditasBulanLalu > 0 ? round((($morbiditasBulanan - $morbiditasBulanLalu) / $morbiditasBulanLalu) * 100) : ($morbiditasBulanan > 0 ? 100 : 0);
        $trendMorbiditasText = $trendMorbiditas >= 0 ? '▲ ' . $trendMorbiditas . '% naik' : '▼ ' . abs($trendMorbiditas) . '% turun';

        // Mortalitas Bulanan
        $mortalitasBulanan = \App\Models\Triage::whereMonth('updated_at', date('m'))
            ->whereYear('updated_at', date('Y'))
            ->where('tindak_lanjut', 'Meninggal')
            ->count();

        $kematianBulanLalu = \App\Models\Triage::whereMonth('updated_at', today()->subMonth()->format('m'))
            ->whereYear('updated_at', today()->subMonth()->format('Y'))
            ->where('tindak_lanjut', 'Meninggal')
            ->count();

        $trendKematian = $kematianBulanLalu > 0 ? round((($mortalitasBulanan - $kematianBulanLalu) / $kematianBulanLalu) * 100) : ($mortalitasBulanan > 0 ? 100 : 0);
        $trendKematianText = $trendKematian >= 0 ? '▲ ' . $trendKematian . '% naik' : '▼ ' . abs($trendKematian) . '% turun';

        return view('pmik.pelaporan', compact(
            'sensusBulanan', 'trendSensus', 'trendSensusText',
            'morbiditasBulanan', 'trendMorbiditas', 'trendMorbiditasText',
            'mortalitasBulanan', 'trendKematian', 'trendKematianText'
        ));
    })->middleware('role:pmik')->name('pmik.pelaporan');

    // Arsip Sensus Bulanan - Daftar folder per bulan
    Route::get('/pmik/pelaporan/sensus', function () {
        // Ambil semua data untuk arsip, kelompokkan per tahun-bulan
        $allData = \App\Models\RekamMedis::selectRaw('YEAR(created_at) as tahun, MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('tahun', 'bulan')
            ->orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->get();

        // Susun menjadi arsip: tahun -> [bulan1, bulan2, ...]
        $arsip = [];
        foreach ($allData as $item) {
            $arsip[$item->tahun][] = [
                'bulan' => $item->bulan,
                'bulan_nama' => \Carbon\Carbon::create()->month($item->bulan)->translatedFormat('F'),
                'total' => $item->total,
            ];
        }
            
        return view('pmik.pelaporan_sensus', compact('arsip'));
    })->middleware('role:pmik')->name('pmik.pelaporan.sensus');

    // Detail Sensus per Bulan - Halaman terpisah
    Route::get('/pmik/pelaporan/sensus/detail', function (Illuminate\Http\Request $request) {
        $month = $request->query('month', date('m'));
        $year = $request->query('year', date('Y'));

        $data = \App\Models\RekamMedis::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->latest()
            ->get();

        $bulanNama = \Carbon\Carbon::create()->month((int)$month)->translatedFormat('F');
            
        return view('pmik.pelaporan_sensus_detail', compact('data', 'month', 'year', 'bulanNama'));
    })->middleware('role:pmik')->name('pmik.pelaporan.sensus.detail');


    // Arsip Morbiditas Bulanan
    Route::get('/pmik/pelaporan/morbiditas', function () {
        // Ambil bulan-bulan yang punya data diagnosa dokter
        $allData = \App\Models\RekamMedis::whereNotNull('diagnosa_dokter')
            ->where('diagnosa_dokter', '!=', '')
            ->selectRaw('YEAR(created_at) as tahun, MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('tahun', 'bulan')
            ->orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->get();

        $arsip = [];
        foreach ($allData as $item) {
            $arsip[$item->tahun][] = [
                'bulan' => $item->bulan,
                'bulan_nama' => \Carbon\Carbon::create()->month($item->bulan)->translatedFormat('F'),
                'total' => $item->total,
            ];
        }

        return view('pmik.pelaporan_morbiditas', compact('arsip'));
    })->middleware('role:pmik')->name('pmik.pelaporan.morbiditas');

    // Detail Morbiditas per Bulan — Top 10 diagnosa terbanyak
    Route::get('/pmik/pelaporan/morbiditas/detail', function (Illuminate\Http\Request $request) {
        $month = $request->query('month', date('m'));
        $year = $request->query('year', date('Y'));

        $data = \App\Models\RekamMedis::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->whereNotNull('diagnosa_dokter')
            ->where('diagnosa_dokter', '!=', '')
            ->selectRaw('diagnosa_dokter, COUNT(*) as total')
            ->groupBy('diagnosa_dokter')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        $bulanNama = \Carbon\Carbon::create()->month((int)$month)->translatedFormat('F');

        return view('pmik.pelaporan_morbiditas_detail', compact('data', 'month', 'year', 'bulanNama'));
    })->middleware('role:pmik')->name('pmik.pelaporan.morbiditas.detail');

    // Arsip Mortalitas Bulanan
    Route::get('/pmik/pelaporan/mortalitas', function () {
        $allData = \App\Models\Triage::where('tindak_lanjut', 'Meninggal')
            ->selectRaw('YEAR(updated_at) as tahun, MONTH(updated_at) as bulan, COUNT(*) as total')
            ->groupBy('tahun', 'bulan')
            ->orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->get();

        $arsip = [];
        foreach ($allData as $item) {
            $arsip[$item->tahun][] = [
                'bulan' => $item->bulan,
                'bulan_nama' => \Carbon\Carbon::create()->month($item->bulan)->translatedFormat('F'),
                'total' => $item->total,
            ];
        }

        return view('pmik.pelaporan_mortalitas', compact('arsip'));
    })->middleware('role:pmik')->name('pmik.pelaporan.mortalitas');

    // Detail Mortalitas per Bulan
    Route::get('/pmik/pelaporan/mortalitas/detail', function (Illuminate\Http\Request $request) {
        $month = $request->query('month', date('m'));
        $year = $request->query('year', date('Y'));

        $data = \App\Models\Triage::whereMonth('updated_at', $month)
            ->whereYear('updated_at', $year)
            ->where('tindak_lanjut', 'Meninggal')
            ->latest()
            ->get();

        $bulanNama = \Carbon\Carbon::create()->month((int)$month)->translatedFormat('F');

        return view('pmik.pelaporan_mortalitas_detail', compact('data', 'month', 'year', 'bulanNama'));
    })->middleware('role:pmik')->name('pmik.pelaporan.mortalitas.detail');





    Route::get('/monitoring', function () {
        $user = Auth::user();
        if ($user->isPmik()) {
            $rekamMedis = \App\Models\RekamMedis::latest()->get();
            return view('pmik.monitoring', compact('rekamMedis'));
        }
        if ($user->isDokter()) {
            $rekamMedis = \App\Models\RekamMedis::latest()->get();
            return view('dokter.monitoring', compact('rekamMedis'));
        }
        if ($user->isPerawat()) {
            $triages = \App\Models\Triage::whereDate('created_at', today())->where('status_observasi', 'aktif')->get();
            return view('perawat.monitoring', compact('triages'));
        }

        abort(403);
    })->middleware('role:dokter,perawat,pmik')
      ->name('monitoring');


    // ── Admin Routes ─────────────────────────
    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:admin')
        ->group(function () {

            // manajemen user
            Route::get('/users', [AdminController::class, 'index'])
                ->name('users');

            Route::post('/users', [AdminController::class, 'store'])
                ->name('users.store');

            // fitur lama
            Route::patch('/users/{user}/role', [AdminController::class, 'updateRole'])
                ->name('update-role');

            Route::put('/users/{user}', [AdminController::class, 'update'])
                ->name('update-user');

            Route::delete('/users/{user}', [AdminController::class, 'destroy'])
                ->name('delete-user');

        });

});