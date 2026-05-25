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
.pagination { display: flex; list-style: none; padding: 0; gap: 5px; margin-top: 15px; justify-content: center; }
.pagination li a, .pagination li span { padding: 8px 12px; background: #fff; border: 1px solid #E5E7EB; border-radius: 6px; color: #374151; font-size: 13px; text-decoration: none; }
.pagination li.active span { background: #6366F1; color: white; border-color: #6366F1; }
.pagination li a:hover { background: #F3F4F6; }
</style>

<div class="dashboard" x-data="{ showForm: false, showDetail: false, detailData: {}, editData: {} }">
    @include('layouts.sidebar-dokter')

    <div class="main">
        @include('layouts.navbar', [
            'title' => '📋 Rekam Medis',
            'description' => 'Kelola data rekam medis pasien dengan mudah dan cepat.'
        ])

        @if(session('success'))
        <div style="background: #D1FAE5; color: #059669; padding: 15px; border-radius: 10px; margin-bottom: 20px; font-weight: 600;">
            {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div style="background: #FEE2E2; color: #DC2626; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- TABLE VIEW --}}
        <div class="card" x-show="!showForm && !showDetail">
            <div class="card-header">
                Daftar Pasien & Rekam Medis
                <div class="top-action">
                    <form action="{{ route('rekam.medis.index') }}" method="GET" style="display:flex; gap:10px;">
                        <input type="text" name="search" class="form-control" placeholder="Cari nama atau no rekam medis..." value="{{ request('search') }}" style="width: 300px;">
                        <button type="submit" class="btn-primary" style="padding: 10px 15px;">Cari</button>
                    </form>
                </div>
            </div>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>NO. RM</th>
                            <th>NAMA PASIEN</th>
                            <th>KELUHAN UTAMA</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $rm)
                        <tr>
                            <td style="font-weight: 600;">{{ $rm->no_rm }}</td>
                            <td>{{ $rm->nama_pasien }}</td>
                            <td>{{ Str::limit($rm->keluhan_utama, 30) }}</td>
                            <td>
                                @php
                                    $triage = \App\Models\Triage::where('nama_pasien', $rm->nama_pasien)
                                                ->whereDate('created_at', $rm->created_at->format('Y-m-d'))
                                                ->first();
                                    $rmData = $rm->toArray();
                                    $rmData['triage'] = $triage ? $triage->toArray() : null;
                                @endphp
                                <button @click="editData = {{ json_encode($rmData) }}; showForm = true" style="background:#EEF2FF; color:#4F46E5; border:1px solid #4F46E5; padding:6px 12px; border-radius:6px; cursor:pointer; font-weight:600; font-size:12px; margin-bottom: 5px; display: block; width: 100%;">✏️ Edit</button>
                                <button @click="detailData = {{ json_encode($rmData) }}; showDetail = true" style="background:#E0E7FF; color:#4F46E5; border:none; padding:6px 12px; border-radius:6px; cursor:pointer; font-weight:600; font-size:12px; display: block; width: 100%;">👁️ Lihat</button>
                            </td>
                        </tr>
                        @endforeach
                        @if($data->isEmpty())
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 20px; color: #6B7280;">Belum ada data rekam medis.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            <div style="margin-top: 15px; display: flex; justify-content: center;">
                {{ $data->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>

        {{-- FORM VIEW (Pemeriksaan) --}}
        <div x-show="showForm" style="display: none;">
            <div style="margin-bottom: 15px;">
                <button type="button" @click="showForm = false" style="background: #E5E7EB; color: #374151; padding: 8px 15px; border-radius: 8px; border: none; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; font-size: 14px; transition: background 0.2s;">
                    ⬅️ Kembali
                </button>
            </div>
            <div class="card">
                <div class="card-header">
                    Pemeriksaan & Pengisian Rekam Medis
                </div>
                
                <form :action="'{{ url('rekam-medis') }}/' + editData.id" method="POST" class="form-section">
                    @csrf
                    @method('PUT')
                    
                    <h3><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Identitas Pasien (Otomatis dari Pendaftaran)</h3>
                    <div class="grid-2">
                        <div class="form-group">
                            <label>No. Rekam Medis</label>
                            <input type="text" name="no_rm" :value="editData.no_rm" class="form-control" readonly style="background:#E5E7EB; cursor:not-allowed;">
                        </div>
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input type="text" name="nama_pasien" :value="editData.nama_pasien" class="form-control" readonly style="background:#E5E7EB; cursor:not-allowed;">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" :value="editData.tanggal_lahir" class="form-control" readonly style="background:#E5E7EB; cursor:not-allowed;">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input type="hidden" name="jenis_kelamin" :value="editData.jenis_kelamin">
                            <input type="text" :value="editData.jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'" class="form-control" readonly style="background:#E5E7EB; cursor:not-allowed;">
                        </div>
                    </div>

                    {{-- Data Triage (Tanda Vital) --}}
                    <div x-show="editData.triage" style="background: #F9FAFB; border: 1px solid #E5E7EB; border-radius: 8px; padding: 15px; margin-top: 20px;">
                        <h4 style="color: #4B5563; font-size: 14px; margin-bottom: 10px; font-weight: 700;">🩺 Tanda Vital (Hasil Triage Perawat)</h4>
                        <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; font-size: 13px;">
                            <div><span style="color:#6B7280; display:block;">Tekanan Darah</span><strong x-text="editData.triage?.td" style="color:#111827;"></strong></div>
                            <div><span style="color:#6B7280; display:block;">Suhu</span><strong x-text="editData.triage?.suhu + ' °C'" style="color:#111827;"></strong></div>
                            <div><span style="color:#6B7280; display:block;">Nadi</span><strong x-text="editData.triage?.nadi + ' x/mnt'" style="color:#111827;"></strong></div>
                            <div><span style="color:#6B7280; display:block;">Respirasi</span><strong x-text="editData.triage?.respirasi + ' x/mnt'" style="color:#111827;"></strong></div>
                            <div><span style="color:#6B7280; display:block;">Saturasi</span><strong x-text="editData.triage?.saturasi + ' %'" style="color:#111827;"></strong></div>
                        </div>
                    </div>

                    <h3 style="margin-top: 20px;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366F1" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path></svg> Anamnesa</h3>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Keluhan Utama</label>
                        <textarea name="keluhan_utama" class="form-control" placeholder="Jelaskan keluhan utama pasien..." x-text="editData.keluhan_utama" style="min-height:60px;"></textarea>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Riwayat Penyakit</label>
                        <textarea name="riwayat_penyakit" class="form-control" placeholder="Riwayat penyakit sebelumnya..." x-text="editData.riwayat_penyakit" style="min-height:60px;"></textarea>
                    </div>


                    <h3 style="margin-top: 20px;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg> Diagnosa & Tindakan Dokter</h3>
                    <div class="form-group" style="margin-bottom: 15px; position: relative;" x-data="diagnosaSuggest()" x-init="initDiagnosa()">
                        <label>Diagnosa Dokter <span style="color: #EF4444;">*</span></label>
                        
                        <textarea 
                            name="diagnosa_dokter"
                            class="form-control" 
                            x-model="finalValue" 
                            x-ref="textarea"
                            @input.debounce.300ms="handleInput()"
                            @focus="showDropdown = suggestions.length > 0"
                            @click.away="showDropdown = false"
                            style="min-height:80px;" 
                            placeholder="Ketik diagnosa penyakit... (tekan Enter untuk baris baru)"></textarea>

                        {{-- Dropdown Autocomplete --}}
                        <div x-show="showDropdown && suggestions.length > 0" 
                             x-cloak
                             style="position: absolute; top: 100%; left: 0; right: 0; background: #fff; border: 1px solid #D1D5DB; border-radius: 8px; box-shadow: 0 8px 25px rgba(0,0,0,0.15); max-height: 250px; overflow-y: auto; z-index: 999; margin-top: 4px;">
                            <template x-for="(item, index) in suggestions" :key="index">
                                <div @click="selectSuggestion(item)" 
                                     style="padding: 10px 15px; cursor: pointer; border-bottom: 1px solid #F3F4F6; display: flex; align-items: center; gap: 10px; transition: background 0.15s;"
                                     onmouseover="this.style.background='#EEF2FF'" 
                                     onmouseout="this.style.background='#fff'">
                                    <span style="background: #DBEAFE; color: #1D4ED8; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: 700; white-space: nowrap;" x-text="item.code"></span>
                                    <span style="font-size: 14px; color: #374151;" x-text="item.name"></span>
                                </div>
                            </template>
                        </div>

                        {{-- Loading indicator --}}
                        <div x-show="isLoading" style="position: absolute; right: 12px; top: 12px;">
                            <svg style="animation: spin 1s linear infinite; width: 18px; height: 18px;" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2"><path d="M12 2v4m0 12v4m-7.07-3.93l2.83-2.83m8.48-8.48l2.83-2.83M2 12h4m12 0h4m-3.93 7.07l-2.83-2.83M7.76 7.76L4.93 4.93"/></svg>
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px; position: relative;" x-data="tindakanSuggest()" x-init="initTindakan()">
                        <label>Tindakan Dokter</label>
                        
                        <textarea 
                            name="tindakan_dokter"
                            class="form-control" 
                            x-model="finalValue" 
                            x-ref="textarea"
                            @input.debounce.300ms="handleInput()"
                            @focus="showDropdown = suggestions.length > 0"
                            @click.away="showDropdown = false"
                            style="min-height:80px;" 
                            placeholder="Ketik tindakan medis... (tekan Enter untuk baris baru)"></textarea>

                        {{-- Dropdown Autocomplete Tindakan --}}
                        <div x-show="showDropdown && suggestions.length > 0" 
                             x-cloak
                             style="position: absolute; top: 100%; left: 0; right: 0; background: #fff; border: 1px solid #D1D5DB; border-radius: 8px; box-shadow: 0 8px 25px rgba(0,0,0,0.15); max-height: 250px; overflow-y: auto; z-index: 998; margin-top: 4px;">
                            <template x-for="(item, index) in suggestions" :key="index">
                                <div @click="selectSuggestion(item)" 
                                     style="padding: 10px 15px; cursor: pointer; border-bottom: 1px solid #F3F4F6; display: flex; align-items: center; gap: 10px; transition: background 0.15s;"
                                     onmouseover="this.style.background='#EEF2FF'" 
                                     onmouseout="this.style.background='#fff'">
                                    <span style="background: #E0E7FF; color: #4338CA; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: 700; white-space: nowrap;" x-text="item.code"></span>
                                    <span style="font-size: 14px; color: #374151;" x-text="item.name"></span>
                                </div>
                            </template>
                        </div>

                        {{-- Loading indicator --}}
                        <div x-show="isLoading" style="position: absolute; right: 12px; top: 12px;">
                            <svg style="animation: spin 1s linear infinite; width: 18px; height: 18px;" viewBox="0 0 24 24" fill="none" stroke="#4F46E5" stroke-width="2"><path d="M12 2v4m0 12v4m-7.07-3.93l2.83-2.83m8.48-8.48l2.83-2.83M2 12h4m12 0h4m-3.93 7.07l-2.83-2.83M7.76 7.76L4.93 4.93"/></svg>
                        </div>
                    </div>

                    <div class="action-buttons">
                        <button type="button" @click="showForm = false" class="btn-secondary">Batal</button>
                        <button type="submit" class="btn-primary">Simpan Pemeriksaan</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- DETAIL VIEW --}}
        <div x-show="showDetail" style="display: none;">
            <div style="margin-bottom: 15px;">
                <button type="button" @click="showDetail = false" style="background: #E5E7EB; color: #374151; padding: 8px 15px; border-radius: 8px; border: none; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; font-size: 14px; transition: background 0.2s;">
                    ⬅️ Kembali
                </button>
            </div>
            <div class="card">
                <div class="card-header">
                    Detail Lengkap Rekam Medis Pasien
                </div>
                
                <div class="form-section" style="border-color: #6B7280; margin-bottom: 0;">
                    <h3><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Identitas Pasien</h3>
                    <div class="grid-2">
                        <div class="form-group">
                            <label>No. Rekam Medis</label>
                            <input type="text" :value="detailData.no_rm" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Pasien</label>
                            <input type="text" :value="detailData.nama_pasien" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" :value="detailData.tanggal_lahir" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input type="text" :value="detailData.jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'" class="form-control" readonly>
                        </div>
                    </div>

                    {{-- Data Triage (Tanda Vital) di Detail --}}
                    <div x-show="detailData.triage" style="background: #F9FAFB; border: 1px solid #E5E7EB; border-radius: 8px; padding: 15px; margin-top: 20px;">
                        <h4 style="color: #4B5563; font-size: 14px; margin-bottom: 10px; font-weight: 700;">🩺 Tanda Vital (Hasil Triage Perawat)</h4>
                        <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; font-size: 13px;">
                            <div><span style="color:#6B7280; display:block;">Tekanan Darah</span><strong x-text="detailData.triage?.td" style="color:#111827;"></strong></div>
                            <div><span style="color:#6B7280; display:block;">Suhu</span><strong x-text="detailData.triage?.suhu + ' °C'" style="color:#111827;"></strong></div>
                            <div><span style="color:#6B7280; display:block;">Nadi</span><strong x-text="detailData.triage?.nadi + ' x/mnt'" style="color:#111827;"></strong></div>
                            <div><span style="color:#6B7280; display:block;">Respirasi</span><strong x-text="detailData.triage?.respirasi + ' x/mnt'" style="color:#111827;"></strong></div>
                            <div><span style="color:#6B7280; display:block;">Saturasi</span><strong x-text="detailData.triage?.saturasi + ' %'" style="color:#111827;"></strong></div>
                        </div>
                    </div>

                    <h3 style="margin-top: 20px;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#4B5563" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path></svg> Anamnesa</h3>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Keluhan Utama</label>
                        <textarea class="form-control" readonly x-text="detailData.keluhan_utama" style="min-height:60px;"></textarea>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Riwayat Penyakit</label>
                        <textarea class="form-control" readonly x-text="detailData.riwayat_penyakit" style="min-height:60px;"></textarea>
                    </div>

                    <h3 style="margin-top: 20px;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"></path></svg> Diagnosa & Tindakan Dokter</h3>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Diagnosa Dokter</label>
                        <textarea class="form-control" readonly x-text="detailData.diagnosa_dokter" style="min-height:60px;"></textarea>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>Tindakan Dokter</label>
                        <textarea class="form-control" readonly x-text="detailData.tindakan_dokter" style="min-height:60px;"></textarea>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('diagnosaSuggest', () => ({
                searchQuery: '',
                finalValue: '',
                suggestions: [],
                isLoading: false,
                showDropdown: false,

                initDiagnosa() {
                    this.$watch('editData', (value) => {
                        if (value && value.diagnosa_dokter) {
                            this.finalValue = value.diagnosa_dokter;
                        } else {
                            this.finalValue = '';
                        }
                        this.searchQuery = '';
                    });
                },

                handleInput() {
                    const lines = this.finalValue.split('\n');
                    this.searchQuery = lines[lines.length - 1].trim();
                    this.fetchSuggestions();
                },

                async fetchSuggestions() {
                    if (this.searchQuery.length < 3) {
                        this.suggestions = [];
                        this.showDropdown = false;
                        return;
                    }
                    
                    this.isLoading = true;
                    try {
                        const response = await fetch(`https://clinicaltables.nlm.nih.gov/api/icd10cm/v3/search?terms=${encodeURIComponent(this.searchQuery)}&sf=code,name&df=code,name&maxList=10`);
                        const data = await response.json();
                        
                        if (data && data[3]) {
                            this.suggestions = data[3].map(item => ({
                                code: item[0],
                                name: item[1]
                            }));
                            this.showDropdown = this.suggestions.length > 0;
                        } else {
                            this.suggestions = [];
                            this.showDropdown = false;
                        }
                    } catch (error) {
                        console.error('Error fetching ICD-10 data:', error);
                        this.suggestions = [];
                        this.showDropdown = false;
                    } finally {
                        this.isLoading = false;
                    }
                },

                selectSuggestion(item) {
                    const lines = this.finalValue.split('\n');
                    lines[lines.length - 1] = `[${item.code}] ${item.name}`;
                    this.finalValue = lines.join('\n');
                    
                    this.searchQuery = '';
                    this.showDropdown = false;
                    this.$refs.textarea.focus();
                }
            }));

            Alpine.data('tindakanSuggest', () => ({
                searchQuery: '',
                finalValue: '',
                suggestions: [],
                isLoading: false,
                showDropdown: false,

                initTindakan() {
                    this.$watch('editData', (value) => {
                        if (value && value.tindakan_dokter) {
                            this.finalValue = value.tindakan_dokter;
                        } else {
                            this.finalValue = '';
                        }
                        this.searchQuery = '';
                    });
                },

                handleInput() {
                    const lines = this.finalValue.split('\n');
                    this.searchQuery = lines[lines.length - 1].trim();
                    this.fetchSuggestions();
                },

                async fetchSuggestions() {
                    if (this.searchQuery.length < 3) {
                        this.suggestions = [];
                        this.showDropdown = false;
                        return;
                    }
                    
                    this.isLoading = true;
                    try {
                        const response = await fetch(`https://clinicaltables.nlm.nih.gov/api/icd10pcs/v3/search?terms=${encodeURIComponent(this.searchQuery)}&sf=code,name&df=code,name&maxList=10`);
                        const data = await response.json();
                        
                        if (data && data[3]) {
                            this.suggestions = data[3].map(item => ({
                                code: item[0],
                                name: item[1]
                            }));
                            this.showDropdown = this.suggestions.length > 0;
                        } else {
                            this.suggestions = [];
                            this.showDropdown = false;
                        }
                    } catch (error) {
                        console.error('Error fetching ICD-10-PCS data:', error);
                        this.suggestions = [];
                        this.showDropdown = false;
                    } finally {
                        this.isLoading = false;
                    }
                },

                selectSuggestion(item) {
                    const lines = this.finalValue.split('\n');
                    lines[lines.length - 1] = `[${item.code}] ${item.name}`;
                    this.finalValue = lines.join('\n');
                    
                    this.searchQuery = '';
                    this.showDropdown = false;
                    this.$refs.textarea.focus();
                }
            }));
        });
    </script>
</x-app-layout>