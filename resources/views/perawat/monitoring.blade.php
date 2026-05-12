<x-app-layout>
<style>
/* CSS Reset and layout */
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
body { background: #EEF3F8; }
.dashboard { display: flex; min-height: 100vh; }
.main { flex: 1; padding: 30px; overflow-x: auto; }

/* ... header styles ... */
.page-header {
    display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;
}

.stats-container { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 24px; }
.stat-box { background: #fff; padding: 20px; border-radius: 16px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); border-left: 5px solid #3b82f6; display: flex; align-items: center; gap: 15px; }
.stat-box.red { border-left-color: #ef4444; }
.stat-box.yellow { border-left-color: #f59e0b; }
.stat-box.green { border-left-color: #10b981; }

.stat-icon { font-size: 24px; width: 50px; height: 50px; border-radius: 12px; display: flex; justify-content: center; align-items: center; }
.stat-box .stat-icon { background: #eff6ff; color: #3b82f6; }
.stat-box.red .stat-icon { background: #fef2f2; color: #ef4444; }
.stat-box.yellow .stat-icon { background: #fffbeb; color: #f59e0b; }
.stat-box.green .stat-icon { background: #ecfdf5; color: #10b981; }

.table-card { background: #fff; border-radius: 16px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
.table-card h2 { font-size: 18px; color: #1e293b; margin-bottom: 20px; font-weight: 700; }
table { width: 100%; border-collapse: collapse; }
th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #f1f5f9; font-size: 14px; }
th { background: #f8fafc; color: #64748b; font-weight: 600; text-transform: uppercase; font-size: 12px; letter-spacing: 0.5px; }
tr:hover { background: #f8fafc; }
.badge { padding: 5px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; color:white; }

.pulse-warning {
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0% { background-color: #fee2e2; }
    50% { background-color: #fca5a5; }
    100% { background-color: #fee2e2; }
}

</style>

<div class="dashboard">
    @include('layouts.sidebar-perawat')
    <div class="main">
        <div class="page-header">
            <div>
                <h1 style="color: #0A3D91; font-size: 24px; font-weight: 800;">📡 Monitoring Response Time Pasien</h1>
                <p style="color: #64748b; font-size: 14px; margin-top: 5px;">Pantau durasi tunggu pasien di IGD berdasarkan kategori Triage.</p>
            </div>
        </div>

        @php
            $merah = $triages->where('kategori', 'merah')->count();
            $kuning = $triages->where('kategori', 'kuning')->count();
            $hijau = $triages->where('kategori', 'hijau')->count();
        @endphp

        <div class="stats-container">
            <div class="stat-box">
                <div class="stat-icon">👥</div>
                <div><h3 style="font-size:24px; font-weight:800; color:#1e293b;">{{ count($triages) }}</h3><p style="font-size:12px; color:#64748b; font-weight:600;">Total Sedang Dipantau</p></div>
            </div>
            <div class="stat-box red">
                <div class="stat-icon">🚨</div>
                <div><h3 style="font-size:24px; font-weight:800; color:#1e293b;">{{ $merah }}</h3><p style="font-size:12px; color:#64748b; font-weight:600;">Kritis (Langsung)</p></div>
            </div>
            <div class="stat-box yellow">
                <div class="stat-icon">⚠️</div>
                <div><h3 style="font-size:24px; font-weight:800; color:#1e293b;">{{ $kuning }}</h3><p style="font-size:12px; color:#64748b; font-weight:600;">Urgensi (Maks 30m)</p></div>
            </div>
            <div class="stat-box green">
                <div class="stat-icon">✅</div>
                <div><h3 style="font-size:24px; font-weight:800; color:#1e293b;">{{ $hijau }}</h3><p style="font-size:12px; color:#64748b; font-weight:600;">Non-Gawat (Maks 60m)</p></div>
            </div>
        </div>

        <div class="table-card">
            <h2>⏱️ Waktu Tunggu Layanan (Live Timer)</h2>
            <table>
                <thead>
                    <tr>
                        <th>Waktu Masuk</th>
                        <th>Kategori</th>
                        <th>Nama Pasien</th>
                        <th>Target Layan</th>
                        <th>Durasi Menunggu</th>
                        <th>Aksi Perawat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($triages as $t)
                    @php
                        $target = 60;
                        if($t->kategori == 'merah') $target = 0;
                        elseif($t->kategori == 'kuning') $target = 30;
                        else $target = 60;
                    @endphp
                    <tr class="patient-row" data-time="{{ $t->created_at->timestamp * 1000 }}" data-target="{{ $target }}" style="transition: 0.3s;">
                        <td style="color:#64748b; font-weight:600;">{{ $t->created_at->format('H:i') }} WIB</td>
                        <td>
                            @if($t->kategori == 'merah') <span class="badge" style="background:#ef4444;">Merah</span>
                            @elseif($t->kategori == 'kuning') <span class="badge" style="background:#f59e0b;">Kuning</span>
                            @else <span class="badge" style="background:#10b981;">Hijau</span>
                            @endif
                        </td>
                        <td style="font-weight:700; color:#1e293b;">{{ $t->nama_pasien }}</td>
                        <td style="color:#64748b; font-weight:600;">
                            @if($target == 0) <span style="color:#ef4444;">Langsung (0m)</span>
                            @else Maks {{ $target }} menit
                            @endif
                        </td>
                        <td class="duration-cell" style="font-size:16px; font-weight:800; font-family:monospace; color:#15803d;">00:00:00</td>
                        <td>
                            <div style="display: flex; gap: 5px;">
                                <form action="{{ route('triage.selesai', $t->id) }}" method="POST" style="margin: 0; display:flex; gap:5px;">
                                    @csrf
                                    <button type="submit" name="tindak_lanjut" value="Pulang" onclick="return confirm('Selesaikan observasi: Pasien Pulang?');" style="padding:6px 10px; background:#f0fdf4; color:#16a34a; border:none; border-radius:6px; font-size:11px; font-weight:700; cursor:pointer; box-shadow: 0 2px 4px rgba(22,163,74,0.1);">🏠 Pulang</button>
                                    
                                    <button type="submit" name="tindak_lanjut" value="Rawat Inap" onclick="return confirm('Selesaikan observasi: Pasien Masuk Rawat Inap?');" style="padding:6px 10px; background:#eff6ff; color:#2563eb; border:none; border-radius:6px; font-size:11px; font-weight:700; cursor:pointer; box-shadow: 0 2px 4px rgba(37,99,235,0.1);">🏥 Rawat Inap</button>
                                    
                                    <button type="submit" name="tindak_lanjut" value="Rujuk" onclick="return confirm('Selesaikan observasi: Pasien Dirujuk ke RS Lain?');" style="padding:6px 10px; background:#fdf4ff; color:#c026d3; border:none; border-radius:6px; font-size:11px; font-weight:700; cursor:pointer; box-shadow: 0 2px 4px rgba(192,38,211,0.1);">🚑 Rujuk</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:30px; color:#94a3b8;">Belum ada pasien yang diobservasi hari ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    setInterval(function() {
        const rows = document.querySelectorAll('.patient-row');
        const now = new Date().getTime();
        
        rows.forEach(row => {
            const timeStr = row.getAttribute('data-time');
            const targetMin = parseInt(row.getAttribute('data-target'));
            
            if(!timeStr) return;
            const entryTime = parseInt(timeStr);
            const diffMs = now - entryTime;
            
            // Format time
            const diffHrs = Math.floor(diffMs / (1000 * 60 * 60));
            const diffMins = Math.floor((diffMs % (1000 * 60 * 60)) / (1000 * 60));
            const diffSecs = Math.floor((diffMs % (1000 * 60)) / 1000);
            
            let display = '';
            if(diffHrs > 0) display += diffHrs + 'j ';
            display += diffMins + 'm ' + diffSecs + 's';
            
            const cell = row.querySelector('.duration-cell');
            cell.innerText = display;
            
            // Warning Logic
            let isWarning = false;
            if(targetMin === 0) {
                // Merah -> should be immediate. If more than 0 mins, it's warning.
                isWarning = (diffMins > 0 || diffHrs > 0);
            } else {
                isWarning = (diffMins >= targetMin || diffHrs > 0);
            }

            if(isWarning) {
                cell.style.color = '#dc2626'; // Red text
                row.classList.add('pulse-warning');
            } else {
                cell.style.color = '#15803d'; // Green text
                row.classList.remove('pulse-warning');
            }
        });
    }, 1000);
</script>

</x-app-layout>
