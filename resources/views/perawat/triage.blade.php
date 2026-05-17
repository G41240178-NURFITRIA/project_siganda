<x-app-layout>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
body { background: #EEF3F8; }
.dashboard { display: flex; min-height: 100vh; }
.main { flex: 1; padding: 30px; overflow-x: auto; }

.page-header {
    margin-bottom: 24px;
}
.page-header h1 { color: #0A3D91; font-size: 24px; font-weight: 800; }
.page-header p { color: #64748b; font-size: 14px; margin-top: 5px; }

.card { background: #fff; border-radius: 16px; padding: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.03); }
.section-title { font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 15px; margin-top: 25px; padding-bottom: 10px; border-bottom: 2px solid #f1f5f9; }
.section-title:first-of-type { margin-top: 0; }

.form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
.form-grid-5 { display: grid; grid-template-columns: repeat(5, 1fr); gap: 15px; }
.form-group label { display: block; font-size: 13px; font-weight: 600; color: #475569; margin-bottom: 8px; }
.form-group input, .form-group select, .form-group textarea {
    width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; transition: border-color 0.2s;
}
.form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: #3b82f6; }

.triage-options { display: flex; gap: 20px; }
.triage-radio {
    flex: 1; padding: 20px; border-radius: 12px; color: white; font-weight: 700; text-align: center; cursor: pointer; border: 3px solid transparent; transition: transform 0.2s;
}
.triage-radio:hover { transform: translateY(-3px); }
.triage-radio input { display: none; }
.triage-radio:has(input:checked) { border-color: #1e293b; transform: scale(1.02); }

.bg-red { background: #ef4444; }
.bg-yellow { background: #f59e0b; }
.bg-green { background: #10b981; }

.btn { padding: 14px 28px; border: none; border-radius: 10px; font-size: 15px; font-weight: 700; cursor: pointer; transition: 0.2s; }
.btn-primary { background: #2563eb; color: #fff; }
.btn-primary:hover { background: #1d4ed8; }
</style>

<div class="dashboard">
    @include('layouts.sidebar-perawat')
    <div class="main">

        <div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1 style="color: #0A3D91; font-size: 24px; font-weight: 800; margin: 0;">📋 Form Input Triage</h1>
                <p style="color: #64748b; font-size: 14px; margin-top: 5px;">Masukkan data pasien dan evaluasi tingkat urgensi.</p>
            </div>
            <a href="{{ route('triage.riwayat') }}" style="text-decoration: none; background: #0ea5e9; color: white; padding: 12px 20px; border-radius: 10px; font-weight: 700; box-shadow: 0 4px 6px rgba(14,165,233,0.2); display: inline-block;">
                🕒 Riwayat Hasil
            </a>
        </div>

        @if(session('success'))
        <div style="background: #dcfce7; color: #15803d; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px; font-weight: 600; border-left: 5px solid #22c55e;">
            ✅ {{ session('success') }}
        </div>
        @endif
        
        <div class="card">
            <form action="{{ route('triage.store') }}" method="POST">
                @csrf
                <h3 class="section-title">1. Identitas Pasien</h3>
                <div class="form-grid">
                    <div class="form-group"><label>Nama Pasien</label><input type="text" name="nama_pasien" required></div>
                    <div class="form-group"><label>Umur (Tahun)</label><input type="number" name="umur" required></div>
                    <div class="form-group"><label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" required>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group"><label>Alergi</label><input type="text" name="alergi" placeholder="Opsional"></div>
                </div>

                <h3 class="section-title">2. Keluhan Utama</h3>
                <div class="form-group">
                    <textarea name="keluhan_utama" rows="3" required></textarea>
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
                    <button type="submit" class="btn btn-primary">Simpan Triage</button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
