<x-app-layout>
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI',sans-serif; }
body { background:#EEF2F7; }
.dashboard { display:flex; min-height:100vh; }
.sidebar { width:240px; background:#F7FAFD; padding:20px; border-right:1px solid #E4EAF2; flex-shrink:0; }
.main { flex:1; padding:22px; overflow-x:auto; }

.sensus-detail-bar { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; }
.btn-back { display:inline-flex; align-items:center; gap:6px; background:#fff; color:#374151; padding:9px 18px; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; border:1px solid #E5E7EB; transition:all 0.2s ease; box-shadow:0 1px 3px rgba(0,0,0,0.04); }
.btn-back:hover { background:#F9FAFB; border-color:#D1D5DB; box-shadow:0 2px 6px rgba(0,0,0,0.08); }
.btn-print { display:inline-flex; align-items:center; gap:6px; background:linear-gradient(135deg, #EF4444, #DC2626); color:#fff; border:none; padding:9px 18px; border-radius:8px; cursor:pointer; font-weight:600; font-size:13px; transition:all 0.2s ease; box-shadow:0 2px 8px rgba(239,68,68,0.3); }
.btn-print:hover { background:linear-gradient(135deg, #DC2626, #B91C1C); transform:translateY(-1px); }

.detail-panel { background:#fff; border-radius:14px; padding:24px; box-shadow:0 4px 12px rgba(0,0,0,0.06); border:1px solid #E5E7EB; }
.detail-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:18px; padding-bottom:14px; border-bottom:2px solid #F3F4F6; }
.detail-title { font-size:17px; font-weight:700; color:#111827; display:flex; align-items:center; gap:8px; }
.detail-title .badge { background:#FEF2F2; color:#DC2626; font-size:12px; font-weight:700; padding:3px 10px; border-radius:20px; }

.data-table { width:100%; border-collapse:collapse; }
.data-table th, .data-table td { padding:12px 14px; text-align:left; font-size:13px; }
.data-table th { background:#F9FAFB; font-weight:700; color:#374151; border-bottom:2px solid #E5E7EB; position:sticky; top:0; }
.data-table tbody tr { border-bottom:1px solid #F3F4F6; transition:background 0.15s ease; }
.data-table tbody tr:hover { background:#FEF2F2; }
.data-table tbody tr:last-child { border-bottom:none; }

.filter-bar { background:#fff; border-radius:12px; padding:16px 20px; box-shadow:0 2px 8px rgba(0,0,0,0.04); border:1px solid #E5E7EB; margin-bottom:24px; display:flex; align-items:center; gap:16px; flex-wrap:wrap; }
.filter-bar .filter-label { font-size:13px; font-weight:700; color:#374151; display:flex; align-items:center; gap:6px; }
.filter-bar input[type="text"] { padding:8px 14px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; font-weight:600; color:#374151; background:#F9FAFB; outline:none; width:150px; transition:border-color 0.2s ease; }
.filter-bar input[type="text"]:focus { border-color:#EF4444; box-shadow:0 0 0 3px rgba(239,68,68,0.1); }
.filter-bar input[type="text"]::placeholder { color:#9CA3AF; font-weight:500; }
.btn-filter { background:linear-gradient(135deg, #EF4444, #DC2626); color:#fff; border:none; padding:8px 18px; border-radius:8px; font-size:13px; font-weight:700; cursor:pointer; transition:all 0.2s ease; box-shadow:0 2px 6px rgba(239,68,68,0.25); }
.btn-filter:hover { background:linear-gradient(135deg, #DC2626, #B91C1C); transform:translateY(-1px); }

.empty-state { text-align:center; padding:40px 20px; color:#9CA3AF; }
.empty-state .icon { font-size:48px; margin-bottom:12px; display:block; }
.empty-state .text { font-size:15px; font-weight:500; }

@media print {
    .sidebar, .sensus-detail-bar, .filter-bar, .navbar, .btn-print { display:none !important; }
    .main { padding:0; }
    .detail-panel { box-shadow:none; border:none; margin:0; padding:0; }
}
</style>

<div class="dashboard">
    @include('layouts.sidebar-pmik')

    <div class="main">
        <div class="navbar">
            @include('layouts.navbar', [
                'title' => '💀 Detail Mortalitas — ' . $bulanNama . ' ' . $year,
                'description' => 'Data kematian pasien bulan ' . $bulanNama . ' ' . $year . '.'
            ])
        </div>

        <div class="sensus-detail-bar">
            <a href="{{ route('pmik.pelaporan.mortalitas') }}" class="btn-back">← Kembali ke Arsip</a>
            <button onclick="window.print()" class="btn-print">🖨️ Cetak Rekap</button>
        </div>

        <form action="{{ route('pmik.pelaporan.mortalitas.detail') }}" method="GET" class="filter-bar" id="filterForm">
            <input type="hidden" name="year" id="hiddenYear" value="{{ $year }}">
            <input type="hidden" name="month" id="hiddenMonth" value="{{ $month }}">
            <span class="filter-label">🔍 Filter:</span>
            <div>
                <label style="font-size:11px; color:#6B7280; display:block; margin-bottom:3px;">Tahun</label>
                <input type="text" id="inputYear" list="yearList" placeholder="Ketik tahun..." value="{{ $year }}" autocomplete="off">
                <datalist id="yearList">
                    @for($i=date('Y')+5; $i>=date('Y'); $i--)
                    <option value="{{ $i }}">
                    @endfor
                </datalist>
            </div>
            <div>
                <label style="font-size:11px; color:#6B7280; display:block; margin-bottom:3px;">Bulan</label>
                <input type="text" id="inputMonth" list="monthList" placeholder="Ketik bulan..." value="{{ $bulanNama }}" autocomplete="off">
                <datalist id="monthList">
                    @for($i=1; $i<=12; $i++)
                    <option data-value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                    @endfor
                </datalist>
            </div>
            <div style="margin-top:16px;">
                <button type="submit" class="btn-filter">Tampilkan</button>
            </div>
        </form>

        <script>
        document.getElementById('filterForm').addEventListener('submit', function(e) {
            document.getElementById('hiddenYear').value = document.getElementById('inputYear').value;
            const monthInput = document.getElementById('inputMonth').value.trim();
            document.querySelectorAll('#monthList option').forEach(opt => {
                if (opt.textContent.trim().toLowerCase() === monthInput.toLowerCase()) {
                    document.getElementById('hiddenMonth').value = opt.getAttribute('data-value');
                }
            });
        });
        </script>

        <div class="detail-panel">
            <div class="detail-header">
                <div class="detail-title">
                    💀 Data Mortalitas — {{ $bulanNama }} {{ $year }}
                    <span class="badge">{{ $data->count() }} data</span>
                </div>
            </div>

            @if($data->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Waktu Meninggal</th>
                        <th>Nama Pasien</th>
                        <th>Umur</th>
                        <th>Jenis Kelamin</th>
                        <th>Keluhan Utama</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $index => $row)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $row->updated_at->format('d M Y H:i') }}</td>
                        <td>{{ $row->nama_pasien }}</td>
                        <td>{{ $row->umur }} Tahun</td>
                        <td>{{ $row->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td>{{ $row->keluhan_utama }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <span class="icon">📭</span>
                <span class="text">Tidak ada data mortalitas di bulan ini.</span>
            </div>
            @endif
        </div>
    </div>
</div>
</x-app-layout>
