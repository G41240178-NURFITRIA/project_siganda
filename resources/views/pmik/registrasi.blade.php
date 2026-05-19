<x-app-layout>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', sans-serif;
}

body {
    background: #EEF2F7;
}

.dashboard {
    display: flex;
    min-height: 100vh;
}

.main {
    flex: 1;
    padding: 18px;
    overflow-x: auto;
    background: #EEF2F7;
}

/* CARD LAYOUT */
.card {
    background: #fff;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    margin-bottom: 20px;
    max-width: 800px;
    margin: 0 auto;
}

.card-header {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 18px;
    font-weight: 800;
    color: #1F2937;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid #E5E7EB;
}

/* FORM STYLES */
.form-group {
    margin-bottom: 16px;
}

.form-label {
    display: block;
    font-size: 13px;
    font-weight: 700;
    color: #4B5563;
    margin-bottom: 6px;
}

.form-control {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid #D1D5DB;
    border-radius: 10px;
    font-size: 14px;
    color: #1F2937;
    background: #F9FAFB;
    transition: all 0.2s;
}

.form-control:focus {
    border-color: #3B82F6;
    background: #FFF;
    outline: none;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-control[readonly] {
    background: #E5E7EB;
    cursor: not-allowed;
    font-weight: 700;
    color: #111827;
}

textarea.form-control {
    min-height: 100px;
    resize: vertical;
}

.btn-submit {
    background: #2563EB;
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    transition: background 0.2s;
    width: 100%;
    margin-top: 10px;
}

.btn-submit:hover {
    background: #1D4ED8;
}

.alert {
    padding: 12px 16px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-size: 14px;
    font-weight: 600;
}

.alert-success {
    background: #DCFCE7;
    color: #16A34A;
    border: 1px solid #BBF7D0;
}

.row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

@media(max-width: 600px) {
    .row {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="dashboard">
    @include('layouts.sidebar-pmik')

    <div class="main">
        @include('layouts.navbar', [
            'title' => '📝 Pendaftaran Pasien',
            'description' => 'Unit Pendaftaran - Masukkan data pasien baru'
        ])

        <div class="card">
            <div class="card-header">
                🏥 Form Registrasi Pasien 
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('rekam.medis.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="form-group">
                        <label class="form-label">No Rekam Medis</label>
                        <input type="text" name="no_rm" class="form-control" value="{{ $nextRm }}" readonly required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nama Lengkap Pasien</label>
                        <input type="text" name="nama_pasien" class="form-control" placeholder="Masukkan nama pasien" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-Laki (L)</option>
                            <option value="P">Perempuan (P)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">No. Telepon (Opsional)</label>
                        <input type="text" name="no_telepon" class="form-control" placeholder="Contoh: 08123456789">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Alamat Lengkap</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Masukkan alamat lengkap pasien...">
                    </div>
                </div>

                <button type="submit" class="btn-submit">Simpan Data Pendaftaran</button>
            </form>
        </div>
    </div>
</div>

</x-app-layout>
