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
.btn-primary { background:#2563eb; color:white; padding:10px 20px; border-radius:10px; text-decoration:none; font-weight:600; display:flex; align-items:center; gap:8px; border:none; cursor:pointer; }
.btn-primary:hover { background:#1d4ed8; }
.table-wrapper { width:100%; overflow-x:auto; }
table { width:100%; border-collapse:collapse; margin-top:10px; }
th { background:#F9FAFB; padding:12px 15px; text-align:left; font-size:12px; font-weight:600; color:#6B7280; text-transform:uppercase; border-bottom:1px solid #E5E7EB; }
td { padding:12px 15px; border-bottom:1px solid #E5E7EB; font-size:14px; color:#374151; }

.section-title { font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 15px; margin-top: 25px; padding-bottom: 10px; border-bottom: 2px solid #f1f5f9; }
.section-title:first-of-type { margin-top: 0; }
.form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
.form-grid-5 { display: grid; grid-template-columns: repeat(5, 1fr); gap: 15px; }
.form-group label { display: block; font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 8px; }
.form-group input, .form-group select, .form-group textarea { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: border-color 0.2s; }
.form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: #3b82f6; }
.triage-options { display: flex; gap: 20px; }
.triage-radio { flex: 1; padding: 20px; border-radius: 12px; color: white; font-weight: 700; text-align: center; cursor: pointer; border: 3px solid transparent; transition: transform 0.2s; }
.triage-radio:hover { transform: translateY(-3px); }
.triage-radio input { display: none; }
.triage-radio:has(input:checked) { border-color: #1e293b; transform: scale(1.02); }
.bg-red { background: #ef4444; }
.bg-yellow { background: #f59e0b; }
.bg-green { background: #10b981; }
</style>

<div class="dashboard" x-data="triageApp()">
    @include('layouts.sidebar-perawat')

    <div class="main">
        @include('layouts.navbar', [
            'title' => '📋 Triage Antrian',
            'description' => 'Pilih pasien yang baru mendaftar untuk dilakukan evaluasi Triage.'
        ])

        @if(session('success'))
        <div style="background: #D1FAE5; color: #059669; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-weight: 600;">
            {{ session('success') }}
        </div>
        @endif

        {{-- TABLE VIEW --}}
        <div class="card" x-show="!showForm">
            <div style="font-weight:700; font-size:18px; margin-bottom:15px; color:#1e293b;">Daftar Pendaftaran Hari Ini</div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>NO. RM</th>
                            <th>NAMA PASIEN</th>
                            <th>TANGGAL DAFTAR</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rekamMedisHariIni as $rm)
                        <tr>
                            <td style="font-weight: 600;">{{ $rm->no_rm }}</td>
                            <td>{{ $rm->nama_pasien }}</td>
                            <td>{{ $rm->created_at->format('H:i') }} WIB</td>
                            <td>
                                <button @click="openTriageForm({{ json_encode($rm) }})" style="background:#EEF2FF; color:#4F46E5; border:1px solid #4F46E5; padding:8px 15px; border-radius:8px; cursor:pointer; font-weight:600; font-size:13px; display: inline-block;">
                                    📝 Input Triage
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @if($rekamMedisHariIni->isEmpty())
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 20px; color: #6B7280;">Belum ada antrian pasien hari ini.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        {{-- FORM VIEW --}}
        <div x-show="showForm" style="display: none;">
            <div style="margin-bottom: 15px;">
                <button type="button" @click="showForm = false" style="background: #E5E7EB; color: #374151; padding: 8px 15px; border-radius: 8px; border: none; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; font-size: 14px;">
                    ⬅️ Kembali ke Antrian
                </button>
            </div>
            <div class="card">
                <form action="{{ route('triage.store') }}" method="POST">
                    @csrf
                    <h3 class="section-title">1. Identitas Pasien (Otomatis dari Pendaftaran)</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_pasien" x-model="selectedData.nama_pasien" readonly style="background:#f1f5f9; cursor:not-allowed;" required>
                        </div>
                        <div class="form-group">
                            <label>Umur (Tahun)</label>
                            <input type="number" name="umur" x-model="selectedData.umur" readonly style="background:#f1f5f9; cursor:not-allowed;" required>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input type="text" :value="selectedData.jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'" readonly style="background:#f1f5f9; cursor:not-allowed;" required>
                            <input type="hidden" name="jenis_kelamin" x-model="selectedData.jenis_kelamin">
                        </div>
                        <div class="form-group"><label>Alergi</label><input type="text" name="alergi" placeholder="Isi jika ada alergi (Opsional)"></div>
                    </div>

                    <h3 class="section-title">2. Keluhan Utama</h3>
                    <div class="form-group">
                        <textarea name="keluhan_utama" rows="3" placeholder="Masukkan keluhan utama..." x-model="selectedData.keluhan_utama" required></textarea>
                    </div>

                    <h3 class="section-title">3. Tanda Vital</h3>
                    <div class="form-grid-5">
                        <div class="form-group"><label>Tekanan Darah (mmHg)</label><input type="text" name="td" placeholder="120/80" required></div>
                        <div class="form-group"><label>Suhu (°C)</label><input type="number" step="0.1" name="suhu" required></div>
                        <div class="form-group"><label>Nadi (x/mnt)</label><input type="number" name="nadi" required></div>
                        <div class="form-group"><label>Respirasi (x/mnt)</label><input type="number" name="respirasi" required></div>
                        <div class="form-group"><label>Saturasi (%)</label><input type="number" name="saturasi" required></div>
                    </div>

                    <h3 class="section-title">4. Kategori Triage</h3>

                    <div class="triage-options">
                        <label class="triage-radio bg-red">
                            <input type="radio" name="kategori" value="merah" required> Merah (Gawat Darurat)
                        </label>
                        <label class="triage-radio bg-yellow">
                            <input type="radio" name="kategori" value="kuning"> Kuning (Urgensi Tinggi)
                        </label>
                        <label class="triage-radio bg-green">
                            <input type="radio" name="kategori" value="hijau"> Hijau (Non-Gawat)
                        </label>
                    </div>

                    <div style="margin-top: 40px; text-align: right;">
                        <button type="submit" class="btn-primary" style="font-size:16px; padding: 12px 30px;">Simpan Triage</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('triageApp', () => ({
            showForm: false,
            selectedData: {
                nama_pasien: '',
                umur: '',
                jenis_kelamin: '',
                keluhan_utama: ''
            },
            
            openTriageForm(rm) {
                // Hitung umur dari tanggal lahir
                let age = '';
                if(rm.tanggal_lahir) {
                    const today = new Date();
                    const birthDate = new Date(rm.tanggal_lahir);
                    age = today.getFullYear() - birthDate.getFullYear();
                    const m = today.getMonth() - birthDate.getMonth();
                    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                }
                
                this.selectedData = {
                    nama_pasien: rm.nama_pasien,
                    umur: age,
                    jenis_kelamin: rm.jenis_kelamin,
                    keluhan_utama: rm.keluhan_utama || ''
                };
                
                this.showForm = true;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }));
    });
</script>
</x-app-layout>
