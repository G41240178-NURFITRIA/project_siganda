<x-app-layout>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
body { background: #EEF3F8; }
.dashboard { display: flex; min-height: 100vh; }
.main { flex: 1; padding: 30px; overflow-x: auto; }

.page-header {
    margin-bottom: 24px;
    display: flex; justify-content: space-between; align-items: center;
}
.page-header h1 { color: #0A3D91; font-size: 24px; font-weight: 800; margin: 0; }
.page-header p { color: #64748b; font-size: 14px; margin-top: 5px; }

.card { background: #fff; border-radius: 16px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }

table { width: 100%; border-collapse: collapse; }
th { background: #f8fafc; padding: 15px 12px; text-align: left; border-bottom: 2px solid #e2e8f0; color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
td { padding: 15px 12px; border-bottom: 1px solid #f1f5f9; font-size: 14px; color: #334155; }
tr:hover td { background-color: #f8fafc; }

.btn-action {
    text-decoration: none; background: #eff6ff; color: #3b82f6; padding: 8px 16px; border-radius: 8px; font-weight: 700; font-size: 13px; display: inline-block; border: none; cursor: pointer; transition: 0.2s;
}
.btn-action:hover { background: #dbeafe; }

.vital-sign { font-size: 12px; color: #64748b; display: flex; flex-direction: column; gap: 3px; }
</style>

<div class="dashboard">
    @include('layouts.sidebar-dokter')
    <div class="main">

        <div class="page-header">
            <div>
                <h1>📋 Hasil Triage Pasien</h1>
                <p>Daftar triage yang telah dilakukan oleh perawat. Tentukan tindakan berdasarkan tingkat urgensi.</p>
            </div>
        </div>

        <div class="card">
            <div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                <input type="text" id="searchInput" placeholder="🔍 Cari nama pasien atau keluhan..." style="width: 100%; max-width: 350px; padding: 12px 15px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; font-size: 14px; transition: border-color 0.2s;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#cbd5e1'">
            </div>

            <table id="riwayatTable">
                <thead>
                    <tr>
                        <th>WAKTU PEMERIKSAAN</th>
                        <th>IDENTITAS PASIEN</th>
                        <th>KELUHAN UTAMA</th>
                        <th>TANDA VITAL</th>
                        <th>KATEGORI</th>
                        <th style="text-align:center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($triages ?? [] as $t)
                    <tr>
                        <td style="color: #64748b; font-weight: 600;">{{ $t->created_at->format('d M Y | H:i') }}</td>
                        <td>
                            <strong style="color: #0f172a; font-size: 15px;">{{ $t->nama_pasien }}</strong><br>
                            <span style="font-size: 13px; color: #64748b;">{{ $t->umur }} th, {{ $t->jenis_kelamin }}</span><br>
                            <span style="font-size: 12px; color: #ef4444; font-weight: 600;">Alergi: {{ $t->alergi ?: '-' }}</span>
                        </td>
                        <td style="max-width: 250px; color: #475569;">{{ \Illuminate\Support\Str::limit($t->keluhan_utama, 50) }}</td>
                        <td class="vital-sign">
                            <span>TD: <strong style="color:#334155;">{{ $t->td }}</strong></span>
                            <span>Suhu: <strong style="color:#334155;">{{ $t->suhu }}°C</strong></span>
                            <span>Nadi: <strong style="color:#334155;">{{ $t->nadi }}x/m</strong></span>
                        </td>
                        <td>
                            @if(strtolower($t->kategori) == 'merah')
                                <span style="background: #fee2e2; color: #ef4444; padding: 6px 12px; border-radius: 20px; font-weight: 700; font-size: 12px;">Merah</span>
                            @elseif(strtolower($t->kategori) == 'kuning')
                                <span style="background: #fef3c7; color: #f59e0b; padding: 6px 12px; border-radius: 20px; font-weight: 700; font-size: 12px;">Kuning</span>
                            @else
                                <span style="background: #dcfce7; color: #10b981; padding: 6px 12px; border-radius: 20px; font-weight: 700; font-size: 12px;">Hijau</span>
                            @endif
                        </td>
                        <td style="text-align:center;">
                            <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
                                <a href="{{ route('triage.cetak', $t->id) }}" target="_blank" style="text-decoration:none; background:#3b82f6; color:white; padding:7px 12px; border-radius:8px; font-size:12px; font-weight:700;">👁️ Detail</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="padding: 40px 20px; text-align: center; color: #94a3b8; font-size: 15px;">Belum ada data triage pasien.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.getElementById('searchInput').addEventListener('keyup', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#riwayatTable tbody tr');
    
    rows.forEach(row => {
        if(row.cells.length === 1) return;
        
        let text = row.innerText.toLowerCase();
        if(text.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>
</x-app-layout>
