<x-app-layout>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
body { background: #EEF3F8; }
.dashboard { display: flex; min-height: 100vh; }
.main { flex: 1; padding: 30px; overflow-x: auto; }



.card { background: #fff; border-radius: 16px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }

table { width: 100%; border-collapse: collapse; }
th { background: #f8fafc; padding: 15px 12px; text-align: left; border-bottom: 2px solid #e2e8f0; color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
td { padding: 15px 12px; border-bottom: 1px solid #f1f5f9; font-size: 14px; color: #334155; }
tr:hover td { background-color: #f8fafc; }

.btn-back {
    text-decoration: none; background: #f1f5f9; color: #475569; padding: 10px 20px; border-radius: 10px; font-weight: 700; transition: 0.2s;
}
.btn-back:hover { background: #e2e8f0; color: #1e293b; }
</style>

<div class="dashboard">
    @include('layouts.sidebar-perawat')
    <div class="main">
        @include('layouts.navbar', [
            'title' => '🕒 Riwayat Triage',
            'description' => 'Daftar riwayat pasien yang telah selesai melalui tahap triage'
        ])

        <a href="{{ route('triage') }}" class="btn-back" style="display:inline-block; margin-bottom: 20px;">⬅️ Kembali ke Triage Utama</a>

        <div class="card">
            <div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
                <input type="text" id="searchInput" placeholder="🔍 Cari nama pasien atau keluhan..." style="width: 100%; max-width: 350px; padding: 12px 15px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; font-size: 14px; transition: border-color 0.2s;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#cbd5e1'">
            </div>

            <table id="riwayatTable">
                <thead>
                    <tr>
                        <th>WAKTU MASUK</th>
                        <th>NAMA PASIEN</th>
                        <th>USIA</th>
                        <th>KELUHAN UTAMA</th>
                        <th>KATEGORI</th>
                        <th>TINDAK LANJUT</th>
                        <th style="text-align:center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($triages as $t)
                    <tr>
                        <td style="color: #64748b; font-weight: 600;">{{ $t->created_at->format('d M Y | H:i') }}</td>
                        <td style="font-weight: 700; color: #0f172a;">{{ $t->nama_pasien }}</td>
                        <td>{{ $t->umur }} thn</td>
                        <td style="color: #64748b;">{{ \Illuminate\Support\Str::limit($t->keluhan_utama, 50) }}</td>
                        <td>
                            @if($t->kategori == 'merah')
                                <span style="background: #fee2e2; color: #ef4444; padding: 6px 12px; border-radius: 20px; font-weight: 700; font-size: 12px;">Merah</span>
                            @elseif($t->kategori == 'kuning')
                                <span style="background: #fef3c7; color: #f59e0b; padding: 6px 12px; border-radius: 20px; font-weight: 700; font-size: 12px;">Kuning</span>
                            @else
                                <span style="background: #dcfce7; color: #10b981; padding: 6px 12px; border-radius: 20px; font-weight: 700; font-size: 12px;">Hijau</span>
                            @endif
                        </td>
                        <td style="font-size: 13px; font-weight: 700; color: #475569;">
                            @if($t->tindak_lanjut)
                                @if($t->tindak_lanjut == 'Pulang') <span style="color:#16a34a;">🏠 Pulang</span>
                                @elseif($t->tindak_lanjut == 'Rawat Inap') <span style="color:#2563eb;">🏥 Rawat Inap</span>
                                @else <span style="color:#c026d3;">🚑 Rujuk</span>
                                @endif
                            @else
                                <span style="color:#94a3b8; font-weight: 500;">-</span>
                            @endif
                        </td>
                        <td style="text-align:center;">
                            <a href="{{ route('triage.cetak', $t->id) }}" target="_blank" style="text-decoration:none; background:#2563eb; color:white; padding:8px 16px; border-radius:8px; font-size:13px; font-weight:700; display: inline-block;">🖨️ Cetak</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="padding: 40px 20px; text-align: center; color: #94a3b8; font-size: 15px;">Belum ada riwayat triage yang tersimpan.</td>
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
        // Skip the 'empty' message row if it exists
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