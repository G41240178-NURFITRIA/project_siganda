<x-app-layout>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
body { background: #EEF3F8; }

.dashboard { display: flex; min-height: 100vh; }

/* SIDEBAR */
.sidebar {
    width: 240px;
    background: #F5F8FC;
    padding: 20px;
    box-shadow: 2px 0 10px rgba(0,0,0,0.05);
    flex-shrink: 0;
}
.logo { text-align: center; margin-bottom: 25px; }
.logo img { width: 80px; margin-bottom: 8px; }
.logo h3 { color: #0A3D91; font-size: 16px; }
.logo .role-badge {
    display: inline-block;
    background: #dc3545;
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 20px;
    margin-top: 5px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.menu a {
    display: flex; align-items: center; gap: 10px;
    padding: 11px 12px; margin: 6px 0;
    border-radius: 10px; text-decoration: none;
    color: #333; font-weight: 500; font-size: 14px;
    transition: 0.2s;
}
.menu a:hover, .menu a.active { background: #DCE9F9; transform: translateX(4px); color: #0A3D91; }
.menu-label {
    font-size: 10px; font-weight: 700; color: #aaa;
    text-transform: uppercase; letter-spacing: 1px;
    margin: 16px 12px 4px;
}

/* MAIN CONTENT */
.main { flex: 1; padding: 30px; overflow-x: auto; }

.page-header {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 24px;
    background: #fff;
    padding: 20px 25px;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
}
.page-header h1 { color: #0A3D91; font-size: 24px; font-weight: 800; }
.page-header p { color: #64748b; font-size: 14px; margin-top: 5px; }

/* MONITORING GRID */
.monitoring-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}

.monitoring-card-item {
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    border-top: 4px solid #3b82f6;
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative;
    overflow: hidden;
}
.monitoring-card-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}
.monitoring-card-item::before {
    content: '';
    position: absolute;
    top: 0; right: 0;
    width: 60px; height: 60px;
    background: radial-gradient(circle at top right, rgba(59, 130, 246, 0.1), transparent);
    border-radius: 0 16px 0 100%;
}

.rm-header {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 12px;
}
.rm-number {
    background: #eff6ff; color: #1d4ed8;
    padding: 4px 10px; border-radius: 6px;
    font-size: 12px; font-weight: 700; letter-spacing: 0.5px;
}
.rm-time {
    font-size: 12px; color: #94a3b8; font-weight: 600;
}

.monitoring-card-item h3 {
    font-size: 18px; color: #1e293b; margin-bottom: 10px; font-weight: 700;
}

.patient-info {
    font-size: 13px; color: #475569; margin-bottom: 15px;
    display: flex; flex-direction: column; gap: 6px;
}
.patient-info strong { color: #334155; }

.rm-status {
    display: flex; justify-content: space-between; align-items: center;
    padding-top: 15px; border-top: 1px dashed #e2e8f0;
}
.status-badge {
    padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase;
}
.status-active { background: #dcfce7; color: #166534; }
.status-waiting { background: #fef08a; color: #854d0e; }

.pulse-dot {
    width: 10px; height: 10px; background: #22c55e; border-radius: 50%;
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(34, 197, 94, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
}

.empty-state {
    grid-column: 1 / -1;
    background: #fff; border-radius: 16px; padding: 40px;
    text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.03);
}
.empty-state h2 { font-size: 20px; color: #1e293b; margin-bottom: 10px; }
.empty-state p { color: #64748b; font-size: 14px; }

</style>

<div class="dashboard">

    {{-- SIDEBAR --}}
    @include('layouts.sidebar-' . auth()->user()->role)

    {{-- MAIN CONTENT --}}
    <div class="main">
        <div class="page-header">
            <div>
                <h1>📡 Monitoring Rekam Medis (Real-time)</h1>
                <p>Pantau antrean pasien dan status rekam medis terkini secara langsung.</p>
            </div>
            <div style="display: flex; align-items: center; gap: 10px; background: #f8fafc; padding: 10px 15px; border-radius: 10px; border: 1px solid #e2e8f0;">
                <div class="pulse-dot"></div>
                <span style="font-size: 13px; font-weight: 600; color: #334155;">Sistem Aktif</span>
            </div>
        </div>

        <div class="monitoring-grid">
            @forelse($rekamMedis as $rm)
            <div class="monitoring-card-item">
                <div class="rm-header">
                    <span class="rm-number">NO. RM: {{ $rm->no_rm }}</span>
                    <span class="rm-time">{{ $rm->created_at->diffForHumans() }}</span>
                </div>
                <h3>{{ $rm->nama_pasien }}</h3>
                <div class="patient-info">
                    <div><strong>L/P:</strong> {{ $rm->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                    <div><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($rm->tanggal_lahir)->format('d M Y') }}</div>
                    <div><strong>Keluhan Utama:</strong> {{ Str::limit($rm->keluhan_utama ?? '-', 60) }}</div>
                </div>
                <div class="rm-status">
                    <span class="status-badge status-active">Tercatat</span>
                    <span style="font-size: 11px; font-weight: 600; color: #64748b;">{{ $rm->created_at->format('H:i, d M Y') }}</span>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <h2>Belum ada data rekam medis</h2>
                <p>Data rekam medis yang ditambahkan akan muncul secara otomatis di sini.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

</x-app-layout>
