<x-app-layout>

<style>
html, body {
    margin: 0;
    padding: 0;
    background: #f1f5f9;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    overflow: hidden;
    height: 100%;
}

* {
    box-sizing: border-box;
}

main {
    padding: 0 !important;
    margin: 0 !important;
    width: 100%;
    height: 100vh;
    overflow: hidden;
}

/* DASHBOARD */
.dashboard {
    display: flex;
    height: 100vh;
    width: 100%;
    background: #f1f5f9;
    overflow: hidden;
}

/* SIDEBAR */
.sidebar {
    width: 250px;
    min-width: 250px;
    background: #f8fafc;
    padding: 20px 16px;
    border-right: 1px solid #e2e8f0;
    height: 100vh;
    overflow: hidden;
    flex-shrink: 0;
}

/* MAIN */
.main {
    flex: 1;
    padding: 18px 24px;
    overflow-y: auto;
    overflow-x: hidden;
    height: 100vh;
}

/* HEADER */
.header-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 18px;
}

.welcome h1 {
    font-size: 24px;
    font-weight: 800;
    color: #111827;
    margin-bottom: 5px;
}

.welcome p {
    color: #94a3b8;
    font-size: 14px;
}

.header-time {
    display: flex;
    gap: 15px;
    font-size: 13px;
    font-weight: 700;
    color: #334155;
}

/* CARD */
.card,
.stat-card {
    background: white;
    border-radius: 14px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

/* STATS */
.stats-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    margin-bottom: 15px;
}

.stat-card {
    position: relative;
    padding: 15px;
    display: flex;
    align-items: center;
    gap: 12px;
    overflow: hidden;
    min-height: 90px;
}

.stat-card::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 5px;
    height: 100%;
}

.stat-card:nth-child(1)::before {
    background: #38bdf8;
}

.stat-card:nth-child(2)::before {
    background: #4ade80;
}

.stat-card:nth-child(3)::before {
    background: #fb923c;
}

.stat-card:nth-child(4)::before {
    background: #f472b6;
}

.stat-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.stat-card:nth-child(1) .stat-icon {
    background: #e0f2fe;
}

.stat-card:nth-child(2) .stat-icon {
    background: #dcfce7;
}

.stat-card:nth-child(3) .stat-icon {
    background: #ffedd5;
}

.stat-card:nth-child(4) .stat-icon {
    background: #fce7f3;
}

.stat-info {
    flex: 1;
}

.stat-info p {
    margin: 0;
    font-size: 13px;
    font-weight: 700;
    color: #1e293b;
}

.stat-info h3 {
    margin: 5px 0;
    font-size: 28px;
    font-weight: 800;
    color: #111827;
}

.desc {
    font-size: 10px;
    color: #94a3b8;
}

/* MIDDLE */
.middle-row {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 15px;
    margin-bottom: 15px;
}

.card {
    padding: 15px;
}

.card-header {
    font-size: 15px;
    font-weight: 800;
    margin-bottom: 12px;
    color: #111827;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
}

th {
    background: #f8fafc;
    color: #475569;
    font-size: 10px;
    padding: 10px;
    border: 1px solid #e2e8f0;
    text-transform: uppercase;
}

td {
    border: 1px solid #e2e8f0;
    height: 38px;
    padding: 8px;
    font-size: 11px;
}

/* SCHEDULE */
.schedule-card {
    background: #ecfeff;
    border: 1px solid #a5f3fc;
    border-radius: 14px;
    padding: 20px;
    text-align: center;
}

.schedule-time {
    color: #0891b2;
    font-size: 16px;
    font-weight: 800;
    margin-bottom: 5px;
}

.schedule-desc {
    color: #64748b;
    font-size: 11px;
}

/* ACTION */
.action-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.action-list li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 12px;
    border-radius: 999px;
    background: #f8fafc;
    margin-bottom: 8px;
    font-size: 12px;
    font-weight: 700;
}

.badge {
    background: #dbeafe;
    color: #2563eb;
    border-radius: 999px;
    padding: 3px 10px;
    font-size: 11px;
}

.total {
    background: #dbeafe !important;
    color: #2563eb;
}

/* BOTTOM */
.bottom-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

/* CHART */
.chart-box {
    display: flex;
    align-items: center;
    justify-content: space-around;
    gap: 10px;
}

.donut-chart-1,
.donut-chart-2 {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    position: relative;
    flex-shrink: 0;
}

.donut-chart-1 {
    /* Dynamic via inline style */
}

.donut-chart-2 {
    /* Dynamic via inline style */
}

.donut-chart-1::after,
.donut-chart-2::after {
    content: '';
    position: absolute;
    width: 55px;
    height: 55px;
    background: white;
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.chart-legend-1,
.chart-legend-2 {
    font-size: 10px;
    font-weight: 700;
    width: 100%;
}

.chart-legend-1 div,
.chart-legend-2 div {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
}

.val {
    margin-left: auto;
    color: #94a3b8;
    font-size: 9px;
}

.dot {
    width: 10px;
    height: 10px;
    border-radius: 2px;
}

.dot-red { background: #ef4444; }
.dot-orange { background: #f59e0b; }
.dot-green { background: #22c55e; }
.dot-blue { background: #3b82f6; }
.dot-pink { background: #ec4899; }

/* SUMMARY */
.summary-box {
    margin-top: 15px;
    background: #f8fafc;
    border-radius: 12px;
    padding: 12px 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.val-text {
    color: #94a3b8;
    font-size: 10px;
}

.val-num {
    font-size: 20px;
    font-weight: 800;
}

.growth {
    background: #dcfce7;
    color: #16a34a;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 10px;
    font-weight: 700;
}
</style>

<div class="dashboard">

    @include('layouts.sidebar-dokter')

    <div class="main">

        {{-- HEADER --}}
        @include('layouts.navbar', ['title' => 'Selamat datang, Dokter'])

        {{-- STATS --}}
        <div class="stats-row">

            <div class="stat-card">
                <div class="stat-icon">👥</div>

                <div class="stat-info">
                    <p>Pasien Hari Ini</p>
                    <h3>{{ count($triages ?? []) + count($rekamMedis ?? []) }}</h3>
                    <div class="desc">Total pasien terdata</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">🩺</div>

                <div class="stat-info">
                    <p>Rekam Medis</p>
                    <h3>{{ \App\Models\RekamMedis::count() }}</h3>
                    <div class="desc">Tercatat di sistem</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">⚕️</div>

                <div class="stat-info">
                    <p>Triage Perlu Ditangani</p>
                    <h3>{{ \App\Models\Triage::where('status_observasi', 'aktif')->count() }}</h3>
                    <div class="desc">Pasien menunggu</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">☑️</div>

                <div class="stat-info">
                    <p>Selesai Hari Ini</p>
                    <h3>{{ $selesaiHariIni ?? 0 }}</h3>
                    <div class="desc">Pasien selesai ditangani</div>
                </div>
            </div>

        </div>

        {{-- MIDDLE --}}
        <div class="middle-row">

            <div class="card">

                <div class="card-header">
                    👥 Antrian Pasien Triage
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Usia</th>
                            <th>Kategori</th>
                            <th>Waktu</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($triages ?? [] as $t)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $t->nama_pasien }}</td>
                            <td>{{ $t->umur }} th</td>
                            <td><span class="badge" style="background:#f1f5f9;color:#333;">{{ ucfirst($t->kategori) }}</span></td>
                            <td>{{ $t->created_at->format('H:i') }}</td>
                            <td><span class="badge">Menunggu</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align:center;">
                                Belum ada data triage dari perawat
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

            <div>

                <div class="card" style="margin-bottom:15px;">

                    <div class="card-header">
                        📅 Jadwal Praktek Hari Ini
                    </div>

                    <div class="schedule-card">

                        <div class="schedule-time">
                            🕒 10.00 - 16.00 WIB
                        </div>

                        <div class="schedule-desc">
                            Dokter Penanggung Jawab IGD
                        </div>

                    </div>

                </div>

                <div class="card">

                    <div class="card-header">
                        Ringkasan Tindakan Medis
                    </div>

                    <ul class="action-list">
                        <li>Pemberian Diagnosa <span class="badge">{{ $diagnosaTotal ?? 0 }}</span></li>
                        <li>Tindakan Medis/Terapi <span class="badge">{{ $tindakanTotal ?? 0 }}</span></li>
                        <li class="total">Total Rekam Medis Hari Ini <span class="badge">{{ \App\Models\RekamMedis::whereDate('created_at', today())->count() }}</span></li>
                    </ul>

                </div>

            </div>

        </div>

        {{-- BOTTOM --}}
        @php
            $tot = $stats['total_triage'] > 0 ? $stats['total_triage'] : 1;
            $pm = ($stats['merah'] / $tot) * 100;
            $pk = ($stats['kuning'] / $tot) * 100;
            $ph = ($stats['hijau'] / $tot) * 100;
            $p2 = $pm + $pk;
            
            $tl = $stats['laki'];
            $tp = $stats['perempuan'];
            $totGender = ($tl + $tp) > 0 ? ($tl + $tp) : 1;
            $pl = ($tl / $totGender) * 100;
            $pp = ($tp / $totGender) * 100;
        @endphp
        <div class="bottom-row">

            {{-- CHART 1 --}}
            <div class="card">

                <div class="card-header">
                    Statistik Pasien Hari Ini
                </div>

                <div class="chart-box">

                    <div class="donut-chart-1" style="{{ $stats['total_triage'] == 0 ? 'background:#e2e8f0;' : 'background: conic-gradient(#ef4444 0% '.$pm.'%, #f59e0b '.$pm.'% '.$p2.'%, #22c55e '.$p2.'% 100%)' }}"></div>

                    <div class="chart-legend-1">

                        <div>
                            <div class="dot dot-red"></div>
                            Merah (Gawat Darurat)
                            <span class="val">{{ $stats['merah'] }} ({{ round($pm) }}%)</span>
                        </div>

                        <div>
                            <div class="dot dot-orange"></div>
                            Kuning (Urgensi Tinggi)
                            <span class="val">{{ $stats['kuning'] }} ({{ round($pk) }}%)</span>
                        </div>

                        <div>
                            <div class="dot dot-green"></div>
                            Hijau (Urgensi Rendah)
                            <span class="val">{{ $stats['hijau'] }} ({{ round($ph) }}%)</span>
                        </div>

                    </div>

                </div>

                <div class="summary-box">

                    <div>
                        <div class="val-text">
                            Total Triage Hari Ini
                        </div>

                        <div class="val-num">
                            {{ $stats['total_triage'] }}
                        </div>
                    </div>

                </div>

            </div>

            {{-- CHART 2 --}}
            <div class="card">

                <div class="card-header">
                    Pasien Berdasarkan Jenis Kelamin
                </div>

                <div class="chart-box">

                    <div class="donut-chart-2" style="{{ ($tl + $tp) == 0 ? 'background:#e2e8f0;' : 'background: conic-gradient(#3b82f6 0% '.$pl.'%, #ec4899 '.$pl.'% 100%)' }}"></div>

                    <div class="chart-legend-2">

                        <div>
                            <div class="dot dot-blue"></div>
                            Laki-laki
                            <span class="val">{{ $tl }} ({{ round($pl) }}%)</span>
                        </div>

                        <div>
                            <div class="dot dot-pink"></div>
                            Perempuan
                            <span class="val">{{ $tp }} ({{ round($pp) }}%)</span>
                        </div>

                    </div>

                </div>

                <div class="summary-box">

                    <div class="val-text">
                        Total Pasien
                    </div>

                    <div class="val-num">
                        {{ $tl + $tp }}
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
function updateDateTime() {

    const now = new Date();

    const tanggal = now.toLocaleDateString('id-ID', {
        weekday: 'long',
        day: '2-digit',
        month: 'long',
        year: 'numeric'
    });

    const jam = now.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit'
    });

    document.getElementById('tanggal').innerHTML =
        `📅 ${tanggal}`;

    document.getElementById('jam').innerHTML =
        `🕒 ${jam} WIB`;
}

updateDateTime();

setInterval(updateDateTime, 1000);
</script>

</x-app-layout>