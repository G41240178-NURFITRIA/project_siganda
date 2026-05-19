<x-app-layout>
<style>
* { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI',sans-serif; }
body { background:#EEF2F7; }
.dashboard { display:flex; min-height:100vh; }
.sidebar { width:240px; background:#F7FAFD; padding:20px; border-right:1px solid #E4EAF2; flex-shrink:0; }
.main { flex:1; padding:22px; overflow-x:auto; }
.card { background:#fff; border-radius:18px; padding:20px; box-shadow:0 3px 15px rgba(0,0,0,0.06); }
.top-action { display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; }
.search-bar { display:flex; align-items:center; background:#F3F4F6; padding:8px 15px; border-radius:10px; width:300px; }
.search-bar input { border:none; background:transparent; outline:none; width:100%; margin-left:8px; font-size:14px; }
.btn-primary { background:#6366F1; color:white; padding:10px 20px; border-radius:10px; text-decoration:none; font-weight:600; display:flex; align-items:center; gap:8px; border:none; cursor:pointer; }
.btn-primary:hover { background:#4F46E5; }
.btn-warning { background:#F59E0B; color:white; padding:6px 12px; border-radius:6px; text-decoration:none; font-size:12px; font-weight:600; border:none; cursor:pointer; }
.btn-danger { background:#EF4444; color:white; padding:6px 12px; border-radius:6px; text-decoration:none; font-size:12px; font-weight:600; border:none; cursor:pointer; }
.btn-success { background:#10B981; color:white; padding:6px 12px; border-radius:6px; text-decoration:none; font-size:12px; font-weight:600; border:none; cursor:pointer; }
.btn-info { background:#3B82F6; color:white; padding:6px 12px; border-radius:6px; text-decoration:none; font-size:12px; font-weight:600; border:none; cursor:pointer; }
.table-wrapper { width:100%; overflow-x:auto; }
table { width:100%; border-collapse:collapse; margin-top:10px; }
th { background:#F9FAFB; padding:12px 15px; text-align:left; font-size:12px; font-weight:600; color:#6B7280; text-transform:uppercase; border-bottom:1px solid #E5E7EB; }
td { padding:12px 15px; border-bottom:1px solid #E5E7EB; font-size:14px; color:#374151; }
tr.hoverable:hover { background: #F9FAFB; cursor: pointer; }
.status-badge { padding:4px 10px; border-radius:20px; font-size:12px; font-weight:600; }
.status-menunggu { background:#FEF3C7; color:#D97706; }
.status-valid { background:#D1FAE5; color:#059669; }
.status-ditolak { background:#FEE2E2; color:#DC2626; }
.form-section { border: 2px solid #3B82F6; border-radius: 12px; padding: 20px; background: #fff; margin-bottom: 20px; }
.form-section h3 { margin-bottom: 15px; color: #111827; display: flex; align-items: center; gap: 8px; font-size: 16px; }
.grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px; }
.form-group label { display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 5px; }
.form-control { width: 100%; padding: 10px 15px; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 14px; background: #F9FAFB; }
.form-control:focus { outline: none; border-color: #3B82F6; }
textarea.form-control { resize: vertical; min-height: 80px; }
.btn-secondary { background:#9CA3AF; color:white; padding:10px 20px; border-radius:10px; text-decoration:none; font-weight:600; display:flex; align-items:center; gap:8px; border:none; cursor:pointer; }
.btn-secondary:hover { background:#6B7280; }
.action-buttons { display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px; }
.action-cell { display: flex; gap: 8px; }
.pagination { display: flex; list-style: none; padding: 0; gap: 5px; margin-top: 15px; justify-content: center; }
.pagination li a, .pagination li span { padding: 8px 12px; background: #fff; border: 1px solid #E5E7EB; border-radius: 6px; color: #374151; font-size: 13px; text-decoration: none; }
.pagination li.active span { background: #6366F1; color: white; border-color: #6366F1; }
.pagination li a:hover { background: #F3F4F6; }
</style>

<div class="dashboard" x-data="{ viewMode: 'list', selectedRm: null }">
    @include('layouts.sidebar-pmik')

    <div class="main">
        @include('layouts.navbar', [
            'title' => '📋 Data Rekam Medis (PMIK)',
            'description' => 'Kelola dan validasi data rekam medis seluruh pasien.'
        ])
        @if(session('success'))
        <div style="background: #D1FAE5; color: #059669; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-weight: 600;">
            {{ session('success') }}
        </div>
        @endif

        {{-- LIST VIEW --}}
        <div x-show="viewMode === 'list'" class="card">
            <div class="top-action">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <div style="background: #FEF3C7; padding: 10px; border-radius: 10px; display: flex; align-items: center;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#D97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                    </div>
                    <h2 style="font-size: 18px; font-weight: 700;">Data Rekam Medis</h2>
                </div>
                
                <div style="display: flex; gap: 15px;">
                    <div class="search-bar">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        <input type="text" placeholder="Cari pasien...">
                    </div>
                </div>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>NO. RM</th>
                            <th>NAMA PASIEN</th>
                            <th>KELUHAN UTAMA</th>
                            <th>DIAGNOSA</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $rm)
                        <tr class="hoverable">
                            <td @click="viewMode = 'detail'; selectedRm = {{ $rm->toJson() }};" style="font-weight: 600;">{{ $rm->no_rm }}</td>
                            <td @click="viewMode = 'detail'; selectedRm = {{ $rm->toJson() }};">{{ $rm->nama_pasien }}</td>
                            <td @click="viewMode = 'detail'; selectedRm = {{ $rm->toJson() }};">{{ Str::limit($rm->keluhan_utama, 30) }}</td>
                            <td @click="viewMode = 'detail'; selectedRm = {{ $rm->toJson() }};">{{ Str::limit($rm->diagnosa_dokter, 30) }}</td>
                            <td class="action-cell">
                                <button @click="viewMode = 'detail'; selectedRm = {{ $rm->toJson() }};" class="btn-info" style="background:#E0E7FF; color:#4F46E5; border:none;">👁️ Lihat</button>
                            </td>
                        </tr>
                        @endforeach
                        @if($data->isEmpty())
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 20px; color: #6B7280;">Belum ada data rekam medis.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            <div style="margin-top: 15px; display: flex; justify-content: center;">
                {{ $data->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>

        {{-- DETAIL VIEW --}}
        <div x-show="viewMode === 'detail'" style="display: none;">
            <div class="top-action">
                <h2 style="font-size: 22px; font-weight: 700; color: #111827;">Detail Rekam Medis</h2>
                <button @click="viewMode = 'list'" class="btn-secondary">Kembali</button>
            </div>
            
            <div class="form-section">
                <h3><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Identitas Pasien</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>No. Rekam Medis</label>
                        <div class="form-control" x-text="selectedRm?.no_rm"></div>
                    </div>
                    <div class="form-group">
                        <label>Nama Pasien</label>
                        <div class="form-control" x-text="selectedRm?.nama_pasien"></div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <div class="form-control" x-text="selectedRm?.tanggal_lahir"></div>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <div class="form-control" x-text="selectedRm?.jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'"></div>
                    </div>
                </div>

                <h3 style="margin-top: 20px;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path></svg> Anamnesa</h3>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label>Keluhan Utama</label>
                    <div class="form-control" style="min-height: 80px;" x-text="selectedRm?.keluhan_utama"></div>
                </div>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label>Riwayat Penyakit</label>
                    <div class="form-control" style="min-height: 80px;" x-text="selectedRm?.riwayat_penyakit"></div>
                </div>

                <h3 style="margin-top: 20px;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect></svg> Diagnosa</h3>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label>Diagnosa Dokter</label>
                    <div class="form-control" x-text="selectedRm?.diagnosa_dokter"></div>
                </div>

                <h3 style="margin-top: 20px;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="2"><path d="M12 20h9"></path></svg> Tindakan</h3>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label>Tindakan Dokter</label>
                    <div class="form-control" x-text="selectedRm?.tindakan_dokter"></div>
                </div>
            </div>
        </div>

    </div>
</div>
</x-app-layout>
