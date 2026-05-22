*resources/views/pmik/pelaporan_mortalitas.blade.php*
<x-app-layout>
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI',sans-serif; }
body { background:#EEF2F7; }
.dashboard { display:flex; min-height:100vh; }
.sidebar { width:240px; background:#F7FAFD; padding:20px; border-right:1px solid #E4EAF2; flex-shrink:0; }
.main { flex:1; padding:22px; overflow-x:auto; }

.sensus-header-bar { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; }
.btn-back { display:inline-flex; align-items:center; gap:6px; background:#fff; color:#374151; padding:9px 18px; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none; border:1px solid #E5E7EB; transition:all 0.2s ease; box-shadow:0 1px 3px rgba(0,0,0,0.04); }
.btn-back:hover { background:#F9FAFB; border-color:#D1D5DB; box-shadow:0 2px 6px rgba(0,0,0,0.08); }

.archive-section { margin-bottom:28px; }
.year-header { display:flex; align-items:center; gap:12px; margin-bottom:16px; cursor:pointer; user-select:none; }
.year-badge { background:linear-gradient(135deg, #EF4444, #DC2626); color:#fff; font-size:18px; font-weight:800; padding:8px 20px; border-radius:10px; box-shadow:0 3px 10px rgba(239,68,68,0.3); }
.year-line { flex:1; height:2px; background:linear-gradient(90deg, #FECACA, transparent); border-radius:2px; }
.year-toggle { font-size:18px; color:#EF4444; transition:transform 0.3s ease; }
.year-header.collapsed .year-toggle { transform:rotate(-90deg); }

.folder-grid { display:flex; flex-direction:column; gap:10px; margin-bottom:10px; overflow:hidden; transition:max-height 0.4s ease, opacity 0.3s ease; }
.folder-grid.collapsed { max-height:0 !important; opacity:0; margin-bottom:0; }

.folder-card { background:#fff; border-radius:12px; padding:14px 20px; cursor:pointer; border:1px solid #E5E7EB; transition:all 0.25s ease; box-shadow:0 1px 4px rgba(0,0,0,0.03); text-decoration:none; display:flex; align-items:center; gap:16px; }
.folder-card:hover { border-color:#FECACA; background:#FEF2F2; box-shadow:0 4px 14px rgba(239,68,68,0.1); transform:translateX(4px); }
.folder-card .folder-icon { font-size:28px; flex-shrink:0; }
.folder-card .folder-info { flex:1; display:flex; align-items:center; justify-content:space-between; }
.folder-month { font-size:15px; font-weight:700; color:#111827; }
.folder-count { font-size:13px; color:#6B7280; font-weight:600; display:flex; align-items:center; gap:6px; }
.folder-count .dot { width:6px; height:6px; border-radius:50%; background:#EF4444; }
.folder-arrow { color:#9CA3AF; font-size:16px; transition:color 0.2s ease; }
.folder-card:hover .folder-arrow { color:#EF4444; }

.filter-bar { background:#fff; border-radius:12px; padding:16px 20px; box-shadow:0 2px 8px rgba(0,0,0,0.04); border:1px solid #E5E7EB; margin-bottom:24px; display:flex; align-items:center; gap:16px; flex-wrap:wrap; }
.filter-bar .filter-label { font-size:13px; font-weight:700; color:#374151; display:flex; align-items:center; gap:6px; }
.filter-bar input[type="text"] { padding:8px 14px; border:1px solid #D1D5DB; border-radius:8px; font-size:13px; font-weight:600; color:#374151; background:#F9FAFB; outline:none; width:150px; transition:border-color 0.2s ease; }
.filter-bar input[type="text"]:focus { border-color:#EF4444; box-shadow:0 0 0 3px rgba(239,68,68,0.1); }
.filter-bar input[type="text"]::placeholder { color:#9CA3AF; font-weight:500; }
.btn-filter { background:linear-gradient(135deg, #EF4444, #DC2626); color:#fff; border:none; padding:8px 18px; border-radius:8px; font-size:13px; font-weight:700; cursor:pointer; transition:all 0.2s ease; box-shadow:0 2px 6px rgba(239,68,68,0.25); }
.btn-filter:hover { background:linear-gradient(135deg, #DC2626, #B91C1C); transform:translateY(-1px); }
.btn-reset { background:none; border:1px solid #D1D5DB; color:#6B7280; padding:8px 14px; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer; transition:all 0.2s ease; }
.btn-reset:hover { background:#F3F4F6; color:#374151; }

.empty-panel { background:#fff; border-radius:14px; padding:60px 20px; box-shadow:0 4px 12px rgba(0,0,0,0.06); border:1px solid #E5E7EB; text-align:center; color:#9CA3AF; }
.empty-panel .icon { font-size:48px; margin-bottom:12px; display:block; }
.empty-panel .text { font-size:15px; font-weight:500; }
.archive-section.hidden { display:none; }
.folder-card.hidden { display:none; }
</style>

<div class="dashboard">
    @include('layouts.sidebar-pmik')

    <div class="main">
        <div class="navbar">
            @include('layouts.navbar', [
                'title' => '📂 Arsip 10 Besar Mortalitas',
                'description' => 'Laporan mortalitas tersusun berdasarkan bulan dan tahun.'
            ])
        </div>

        <div class="sensus-header-bar">
            <a href="{{ route('pmik.pelaporan') }}" class="btn-back">← Kembali ke Pelaporan</a>
        </div>

        <div class="filter-bar">
            <span class="filter-label">🔍 Filter:</span>
            <div>
                <label style="font-size:11px; color:#6B7280; display:block; margin-bottom:3px;">Tahun</label>
                <input type="text" id="filterTahun" list="tahunList" placeholder="Ketik tahun..." autocomplete="off">
                <datalist id="tahunList">
                    @for($i=date('Y')+5; $i>=date('Y'); $i--)
                    <option value="{{ $i }}">
                    @endfor
                </datalist>
            </div>
            <div>
                <label style="font-size:11px; color:#6B7280; display:block; margin-bottom:3px;">Bulan</label>
                <input type="text" id="filterBulan" list="bulanList" placeholder="Ketik bulan..." autocomplete="off">
                <datalist id="bulanList">
                    @for($i=1; $i<=12; $i++)
                    <option value="{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}" data-num="{{ $i }}">
                    @endfor
                </datalist>
            </div>
            <div style="margin-top:16px; display:flex; gap:8px;">
                <button type="button" class="btn-filter" onclick="applyFilter()">Terapkan</button>
                <button type="button" class="btn-reset" onclick="resetFilter()">Reset</button>
            </div>
        </div>

        @forelse($arsip as $tahun => $bulanList)
        <div class="archive-section" data-year="{{ $tahun }}">
            <div class="year-header collapsed" onclick="toggleYear(this)">
                <div class="year-badge">📅 {{ $tahun }}</div>
                <div class="year-line"></div>
                <span class="year-toggle">▼</span>
            </div>
            <div class="folder-grid collapsed" id="year-{{ $tahun }}">
                @foreach($bulanList as $item)
                <a href="{{ route('pmik.pelaporan.mortalitas.detail', ['month' => str_pad($item['bulan'], 2, '0', STR_PAD_LEFT), 'year' => $tahun]) }}" class="folder-card" data-month="{{ $item['bulan'] }}">
                    <span class="folder-icon">📁</span>
                    <div class="folder-info">
                        <div class="folder-month">{{ $item['bulan_nama'] }}</div>
                        <div class="folder-count"><span class="dot"></span>{{ $item['total'] }} kasus</div>
                    </div>
                    <span class="folder-arrow">→</span>
                </a>
                @endforeach
            </div>
        </div>
        @empty
        <div class="empty-panel">
            <span class="icon">📭</span>
            <span class="text">Belum ada data mortalitas yang tersedia.</span>
        </div>
        @endforelse
    </div>
</div>

<script>
function toggleYear(header) {
    const section = header.closest('.archive-section');
    const grid = section.querySelector('.folder-grid');
    header.classList.toggle('collapsed');
    grid.classList.toggle('collapsed');
}
function applyFilter() {
    const tahunInput = document.getElementById('filterTahun').value.trim();
    const bulanInput = document.getElementById('filterBulan').value.trim().toLowerCase();
    let bulanNum = '';
    if (bulanInput) {
        document.querySelectorAll('#bulanList option').forEach(opt => {
            if (opt.value.toLowerCase() === bulanInput) bulanNum = opt.getAttribute('data-num');
        });
    }
    document.querySelectorAll('.archive-section').forEach(section => {
        const sectionYear = section.getAttribute('data-year');
        if (tahunInput && sectionYear !== tahunInput) { section.classList.add('hidden'); }
        else {
            section.classList.remove('hidden');
            section.querySelector('.year-header').classList.remove('collapsed');
            section.querySelector('.folder-grid').classList.remove('collapsed');
        }
    });
    if (bulanNum) {
        document.querySelectorAll('.folder-card').forEach(card => {
            if (card.closest('.archive-section').classList.contains('hidden')) return;
            card.classList.toggle('hidden', card.getAttribute('data-month') !== bulanNum);
        });
    }
}
function resetFilter() {
    document.getElementById('filterTahun').value = '';
    document.getElementById('filterBulan').value = '';
    document.querySelectorAll('.archive-section').forEach(s => s.classList.remove('hidden'));
    document.querySelectorAll('.folder-card').forEach(c => c.classList.remove('hidden'));
    document.querySelectorAll('.year-header').forEach(h => h.classList.add('collapsed'));
    document.querySelectorAll('.folder-grid').forEach(g => g.classList.add('collapsed'));
}
</script>
</x-app-layout>