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
.table-wrapper { width:100%; overflow-x:auto; }
table { width:100%; border-collapse:collapse; margin-top:10px; }
th { background:#F9FAFB; padding:12px 15px; text-align:left; font-size:12px; font-weight:600; color:#6B7280; text-transform:uppercase; border-bottom:1px solid #E5E7EB; }
td { padding:12px 15px; border-bottom:1px solid #E5E7EB; font-size:14px; color:#374151; }
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
</style>

<div class="dashboard" x-data="{ showForm: false }">
    @include('layouts.sidebar-dokter')

    <div class="main">
        @include('layouts.navbar', ['title' => 'Rekam Medis'])

        @if(session('success'))
        <div style="background: #D1FAE5; color: #059669; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-weight: 600;">
            {{ session('success') }}
        </div>
        @endif

        {{-- LIST VIEW --}}
        <div x-show="!showForm" class="card">
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
                    <button @click="showForm = true" class="btn-primary">
                        + Tambah
                    </button>
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
                            <th>STATUS VALIDASI PMIK</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $rm)
                        <tr>
                            <td style="font-weight: 600;">{{ $rm->no_rm }}</td>
                            <td>{{ $rm->nama_pasien }}</td>
                            <td>{{ Str::limit($rm->keluhan_utama, 30) }}</td>
                            <td>{{ Str::limit($rm->diagnosa_dokter, 30) }}</td>
                            <td>
                                <span class="status-badge status-{{ $rm->status_validasi }}">
                                    {{ ucfirst($rm->status_validasi) }}
                                </span>
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
        </div>

        {{-- FORM VIEW --}}
        <div x-show="showForm" style="display: none;">
            <h2 style="font-size: 22px; font-weight: 700; margin-bottom: 20px; color: #111827;">Input Rekam Medis</h2>
            
            <form action="{{ route('rekam.medis.store') }}" method="POST" class="form-section">
                @csrf
                
                <h3><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Identitas Pasien</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>No. Rekam Medis</label>
                        <input type="text" name="no_rm" class="form-control" required placeholder="Contoh: RM-001">
                    </div>
                    <div class="form-group">
                        <label>Nama Pasien</label>
                        <input type="text" name="nama_pasien" class="form-control" required placeholder="Nama lengkap pasien">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>

                <h3 style="margin-top: 20px;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Anamnesa</h3>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label>Keluhan Utama</label>
                    <textarea name="keluhan_utama" class="form-control" placeholder="Jelaskan keluhan utama pasien..."></textarea>
                </div>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label>Riwayat Penyakit</label>
                    <textarea name="riwayat_penyakit" class="form-control" placeholder="Riwayat penyakit sebelumnya..."></textarea>
                </div>

                <h3 style="margin-top: 20px;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg> Diagnosa</h3>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label>Diagnosa Dokter</label>
                    <input type="text" name="diagnosa_dokter" class="form-control" placeholder="Diagnosa utama pasien">
                </div>

                <h3 style="margin-top: 20px;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="2"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg> Tindakan</h3>
                <div class="form-group">
                    <label>Tindakan Dokter</label>
                    <input type="text" name="tindakan_dokter" class="form-control" placeholder="Tindakan yang diberikan">
                </div>

                <div class="action-buttons">
                    <button type="button" @click="showForm = false" class="btn-secondary">Batal</button>
                    <button type="submit" class="btn-primary">Simpan Rekam Medis</button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>
