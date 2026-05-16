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
            $rmMenunggu = \App\Models\RekamMedis::where('status_validasi', 'menunggu')->count();
            $rmValid = \App\Models\RekamMedis::where('status_validasi', 'valid')->count();
            $rmDitolak = \App\Models\RekamMedis::where('status_validasi', 'ditolak')->count();
            $pasienDirawat = \App\Models\Triage::where('tindak_lanjut', 'Rawat Inap')->count();
            $tlPulang = \App\Models\Triage::where('tindak_lanjut', 'Pulang')->count();
            $tlRawatInap = \App\Models\Triage::where('tindak_lanjut', 'Rawat Inap')->count();
            $tlRujuk = \App\Models\Triage::where('tindak_lanjut', 'Rujuk')->count();
            return view('pmik.dashboard', compact('rekamMedis', 'totalRm', 'rmMenunggu', 'rmValid', 'rmDitolak', 'pasienDirawat', 'tlPulang', 'tlRawatInap', 'tlRujuk'));
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
            $tindakanTotal = \App\Models\RekamMedis::whereDate('created_at', today())->whereNotNull('tindakan_dokter')->count();
            $diagnosaTotal = \App\Models\RekamMedis::whereDate('created_at', today())->whereNotNull('diagnosa_dokter')->count();

            return view('dokter.dashboard', compact('rekamMedis', 'triages', 'selesaiHariIni', 'stats', 'tindakanTotal', 'diagnosaTotal'));
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
        if ($user->isAdmin()) return view('admin.registrasi');
        if ($user->isPmik()) return view('pmik.registrasi');
        abort(403);
    })->middleware('role:pmik,admin')
      ->name('registrasi');


    Route::resource('rekam-medis', App\Http\Controllers\RekamMedisController::class)
        ->middleware('role:pmik,dokter,admin')
        ->names('rekam.medis');

    Route::patch('/rekam-medis/{id}/validasi', [App\Http\Controllers\RekamMedisController::class, 'validasi'])
        ->middleware('role:pmik,admin')
        ->name('rekam.medis.validasi');

    Route::get('/pmik/pelaporan', function () {
        return view('pmik.pelaporan');
    })->middleware('role:pmik')->name('pmik.pelaporan');


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