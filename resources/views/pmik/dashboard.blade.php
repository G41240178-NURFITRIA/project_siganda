<x-app-layout>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
body { background: #f4f7fb; }

.dashboard { display: flex; min-height: 100vh; }

/* MAIN CONTENT */
.main { flex: 1; padding: 30px 40px; overflow-x: auto; background: #f4f7fb; }

.header-top {
    display: flex; justify-content: space-between; align-items: flex-start;
    margin-bottom: 30px;
}
.header-top .welcome h1 { color: #1a202c; font-size: 26px; font-weight: 800; margin-bottom: 5px; }
.header-top .welcome p { color: #a0aec0; font-size: 14px; }

.header-time {
    display: flex; gap: 20px; color: #2d3748; font-weight: 700; font-size: 13px;
    background: transparent; padding: 5px; border-radius: 8px;
}

/* STATS ROW */
.stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px; }
.stat-card {
    background: #fff; border-radius: 12px; padding: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.02);
    display: flex; align-items: center; gap: 15px;
    position: relative; overflow: hidden;
}
/* Left border colors */
.stat-card:nth-child(1)::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 6px; background: #4299e1; }
.stat-card:nth-child(2)::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 6px; background: #48bb78; }
.stat-card:nth-child(3)::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 6px; background: #ecc94b; }
.stat-card:nth-child(4)::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 6px; background: #ed64a6; }

.stat-icon {
    width: 45px; height: 45px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; flex-shrink: 0;
}
.stat-card:nth-child(1) .stat-icon { background: #ebf8ff; color: #3182ce; }
.stat-card:nth-child(2) .stat-icon { background: #f0fff4; color: #38a169; }
.stat-card:nth-child(3) .stat-icon { background: #fffff0; color: #d69e2e; }
.stat-card:nth-child(4) .stat-icon { background: #fff5f7; color: #d53f8c; }

.stat-info { display: flex; flex-direction: column; }
.stat-info p { font-size: 12px; color: #4a5568; font-weight: 600; margin-bottom: 5px; line-height: 1.2; }
.stat-info h3 { font-size: 24px; font-weight: 800; color: #1a202c; line-height: 1; }

/* MIDDLE SECTION */
.middle-row { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 20px; }
.card {
    background: #fff; border-radius: 12px; padding: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.02);
    position: relative; overflow: hidden;
}
.card::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 6px; background: #4299e1; }
.card-header { font-size: 16px; font-weight: 700; color: #1a202c; margin-bottom: 15px; display: flex; align-items: center; gap: 8px; }

/* TABLE */
table { width: 100%; border-collapse: collapse; }
th, td { padding: 10px; text-align: left; border: 1px solid #e2e8f0; font-size: 12px; }
th { background: #f7fafc; color: #4a5568; font-weight: 700; }
td { color: #2d3748; }
.empty-rows td { height: 35px; }

/* LIST */
.activity-list { list-style: none; }
.activity-list li {
    display: flex; align-items: center; gap: 15px;
    font-size: 12px; font-weight: 600; color: #2d3748;
    padding: 12px 0; border-bottom: 1px solid #e2e8f0;
}
.activity-list li:last-child { border-bottom: none; }
.dot { width: 8px; height: 8px; border-radius: 50%; }
.dot-blue { background: #3182ce; }
.dot-yellow { background: #ecc94b; }
.dot-green { background: #48bb78; }

/* BOTTOM SECTION */
.bottom-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

.chart-placeholder {
    display: flex; justify-content: space-between; align-items: center; margin-top: 20px;
}
.donut-circle {
    width: 150px; height: 150px; border-radius: 50%;
    background: conic-gradient(#48bb78 0% 40%, #0076c8 40% 70%, #d6ffe1 70% 100%);
    position: relative;
}
.donut-circle::after {
    content: ''; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
    width: 80px; height: 80px; background: #fff; border-radius: 50%;
}
.legend { font-size: 12px; font-weight: 600; color: #4a5568; }
.legend div { display: flex; align-items: center; gap: 8px; margin-bottom: 10px; }

.half-donut {
    width: 200px; height: 100px;
    border-radius: 100px 100px 0 0;
    position: relative;
}
</style>

<div class="dashboard">

    {{-- SIDEBAR --}}
    @include('layouts.sidebar-pmik')

    {{-- MAIN CONTENT --}}
    <div class="main">
        <div class="header-top">
            <div class="welcome">
                <h1>Selamat datang, PMIK</h1>
                <p>Berikut ringkasan aktivitas Anda hari ini</p>
            </div>
            <div class="header-time">
                <span>📅 {{ \Carbon\Carbon::now()->isoFormat('dddd, DD MMMM Y') }}</span>
                <span>🕒 {{ \Carbon\Carbon::now()->format('H:i') }} WIB</span>
            </div>
        </div>

        {{-- STATS --}}
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon">📘</div>
                <div class="stat-info">
                    <p>Total Rekam<br>Medis</p>
                    <h3>{{ $totalRm ?? 0 }}</h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📄</div>
                <div class="stat-info">
                    <p>Data Perlu<br>Validasi</p>
                    <h3>{{ $rmMenunggu ?? 0 }}</h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🛏️</div>
                <div class="stat-info">
                    <p>Pasien Dirawat</p>
                    <h3>{{ $pasienDirawat ?? 0 }}</h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-info">
                    <p>Data Valid Hari<br>Ini</p>
                    <h3>{{ $rmValid ?? 0 }}</h3>
                </div>
            </div>
        </div>

        {{-- MIDDLE --}}
        <div class="middle-row">
            <div class="card">
                <div class="card-header">🩺 Rekam Medis Terbaru</div>
                <table>
                    <thead>
                        <tr>
                            <th>No.RM</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Masuk</th>
                            <th>L/P</th>
                            <th>Status Validasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekamMedis ?? [] as $rm)
                        <tr>
                            <td><strong>{{ $rm->no_rm }}</strong></td>
                            <td>{{ $rm->nama_pasien }}</td>
                            <td>{{ $rm->created_at->format('d M Y') }}</td>
                            <td>{{ $rm->jenis_kelamin }}</td>
                            <td>
                                @if($rm->status_validasi == 'valid')
                                    <span style="color: #16a34a; font-weight:bold;">Valid</span>
                                @elseif($rm->status_validasi == 'ditolak')
                                    <span style="color: #dc2626; font-weight:bold;">Ditolak</span>
                                @else
                                    <span style="color: #d97706; font-weight:bold;">Menunggu</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #aaa; padding: 20px;">Belum ada data rekam medis terbaru.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card">
                <div class="card-header">📈 Aktivitas Terakhir</div>
                <ul class="activity-list">
                    @forelse($rekamMedis ?? [] as $rm)
                    <li>
                        <span>{{ $rm->created_at->format('H:i') }}</span>
                        @if($rm->status_validasi == 'valid')
                            <div class="dot dot-green"></div>
                        @elseif($rm->status_validasi == 'ditolak')
                            <div class="dot" style="background: #dc2626;"></div>
                        @else
                            <div class="dot dot-yellow"></div>
                        @endif
                        <span>RM Baru: {{ $rm->nama_pasien }}</span>
                    </li>
                    @empty
                    <li style="color: #aaa; padding: 10px 0;">Belum ada aktivitas.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- BOTTOM --}}
        @php
            $pctValid = $totalRm > 0 ? round(($rmValid / $totalRm) * 100) : 0;
            $pctMenunggu = $totalRm > 0 ? round(($rmMenunggu / $totalRm) * 100) : 0;
            $pctDitolak = $totalRm > 0 ? round(($rmDitolak / $totalRm) * 100) : 0;

            $vStop = $pctValid / 2;
            $mStop = $vStop + ($pctMenunggu / 2);
            $dStop = $mStop + ($pctDitolak / 2);

            $totTindak = $tlRawatInap + $tlPulang + $tlRujuk;
            $totTindakSafe = $totTindak > 0 ? $totTindak : 1;
            
            $pStop1 = ($tlPulang / $totTindakSafe) * 100;
            $pStop2 = $pStop1 + (($tlRawatInap / $totTindakSafe) * 100);
            
            $donutBg = $totTindak == 0 ? '#e2e8f0' : "conic-gradient(#48bb78 0% {$pStop1}%, #3182ce {$pStop1}% {$pStop2}%, #f59e0b {$pStop2}% 100%)";
            $halfDonutBg = $totalRm == 0 ? "conic-gradient(from -90deg at 50% 100%, #e2e8f0 0% 50%, transparent 50%)" : "conic-gradient(from -90deg at 50% 100%, #48bb78 0% {$vStop}%, #ecc94b {$vStop}% {$mStop}%, #dc2626 {$mStop}% 50%, transparent 50%)";
        @endphp
        <div class="bottom-row">
            <div class="card">
                <div class="card-header">Tindak Lanjut Pasien</div>
                <div class="chart-placeholder">
                    <div class="donut-circle" style="background: {{ $donutBg }};"></div>
                    <div class="legend">
                        <div><div class="dot dot-green"></div> Pulang ({{ $tlPulang ?? 0 }})</div>
                        <div><div class="dot dot-blue"></div> Rawat Inap ({{ $tlRawatInap ?? 0 }})</div>
                        <div><div class="dot dot-yellow"></div> Rujuk ({{ $tlRujuk ?? 0 }})</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Ringkasan Validasi Data</div>
                <div class="chart-placeholder">
                    <div class="half-donut" style="background: {{ $halfDonutBg }};">
                        <div style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); width: 120px; height: 60px; background: #fff; border-radius: 60px 60px 0 0; display: flex; align-items: flex-end; justify-content: center; font-size: 32px; font-weight: 800; color: #1a202c; padding-bottom: 10px;">
                            {{ $pctValid }}%
                        </div>
                    </div>
                    <div class="legend" style="margin-left: auto;">
                        <div style="justify-content: space-between; width: 170px;"><span style="display:flex; align-items:center; gap:8px;"><div class="dot dot-green"></div> Tervalidasi</span> <span>{{ $pctValid }}%</span></div>
                        <div style="justify-content: space-between; width: 170px;"><span style="display:flex; align-items:center; gap:8px;"><div class="dot dot-yellow"></div> Menunggu</span> <span>{{ $pctMenunggu }}%</span></div>
                        <div style="justify-content: space-between; width: 170px;"><span style="display:flex; align-items:center; gap:8px;"><div class="dot" style="background:#dc2626;"></div> Ditolak</span> <span>{{ $pctDitolak }}%</span></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

</x-app-layout>
