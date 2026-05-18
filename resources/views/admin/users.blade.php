<x-app-layout>
<style>
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
body { background: #EEF3F8; }

.dashboard { display: flex; min-height: 100vh; }

/* SIDEBAR */
.sidebar {
    width: 240px;
    background: #F5F8FC;
    padding: 20px;
    box-shadow: 2px 0 10px rgba(0,0,0,0.05);
    flex-shrink: 0;
}
.logo { text-align: center; margin-bottom: 25px; }
.logo img { width: 80px; margin-bottom: 8px; }
.logo h3 { color: #0A3D91; font-size: 16px; }
.logo .role-badge {
    display: inline-block;
    background: #dc3545;
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 20px;
    margin-top: 5px;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.menu a {
    display: flex; align-items: center; gap: 10px;
    padding: 11px 12px; margin: 6px 0;
    border-radius: 10px; text-decoration: none;
    color: #333; font-weight: 500; font-size: 14px;
    transition: 0.2s;
}
.menu a:hover, .menu a.active { background: #DCE9F9; transform: translateX(4px); color: #0A3D91; }
.menu-label {
    font-size: 10px; font-weight: 700; color: #aaa;
    text-transform: uppercase; letter-spacing: 1px;
    margin: 16px 12px 4px;
}

/* MAIN */
.main { flex: 1; padding: 30px; overflow-x: auto; }

.page-header {
    display: flex; justify-content: space-between; align-items: center;
    margin-bottom: 24px;
}
.page-header h1 { color: #0A3D91; font-size: 22px; }
.page-header p { color: #888; font-size: 13px; margin-top: 3px; }

/* STATS ROW */
.stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 28px; }
.stat-card {
    background: #fff; border-radius: 14px; padding: 18px 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.07);
    display: flex; align-items: center; gap: 14px;
}
.stat-icon {
    width: 48px; height: 48px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; flex-shrink: 0;
}
.stat-info h3 { font-size: 22px; font-weight: 700; color: #0A3D91; }
.stat-info p { font-size: 12px; color: #888; }

.bg-blue   { background: #EAF3FF; }
.bg-green  { background: #E8F5E9; }
.bg-orange { background: #FFF3E0; }
.bg-purple { background: #F3E5F5; }

/* ALERTS */
.alert {
    padding: 12px 16px; border-radius: 10px;
    font-size: 13px; margin-bottom: 20px;
    display: flex; align-items: center; gap: 8px;
}
.alert-success { background: #E8F5E9; color: #2E7D32; border: 1px solid #A5D6A7; }
.alert-error   { background: #FFEBEE; color: #C62828; border: 1px solid #EF9A9A; }

/* TABLE */
.table-card {
    background: #fff; border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.07);
    overflow: hidden;
}
.table-header {
    padding: 18px 24px;
    border-bottom: 1px solid #F0F0F0;
    display: flex; justify-content: space-between; align-items: center;
}
.table-header h2 { font-size: 16px; color: #0A3D91; font-weight: 700; }
.search-box {
    display: flex; align-items: center; gap: 8px;
    background: #F5F5F5; border-radius: 10px;
    padding: 8px 14px;
}
.search-box input {
    border: none; background: transparent;
    font-size: 13px; outline: none; width: 200px;
}

table { width: 100%; border-collapse: collapse; }
thead { background: #F8FAFC; }
thead th {
    padding: 12px 16px; text-align: left;
    font-size: 12px; font-weight: 700;
    color: #888; text-transform: uppercase; letter-spacing: 0.5px;
    border-bottom: 1px solid #F0F0F0;
}
tbody tr { border-bottom: 1px solid #F8F8F8; transition: 0.2s; }
tbody tr:hover { background: #FAFCFF; }
tbody td { padding: 14px 16px; font-size: 13px; color: #333; }

.avatar {
    width: 36px; height: 36px; border-radius: 50%;
    background: linear-gradient(135deg, #5DAEF5, #0A3D91);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 14px; font-weight: 700;
    flex-shrink: 0;
}
.user-info { display: flex; align-items: center; gap: 10px; }
.user-info .name { font-weight: 600; color: #222; }
.user-info .email { font-size: 11px; color: #999; }

.role-badge-table {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.role-admin   { background: #FFEBEE; color: #C62828; }
.role-dokter  { background: #E3F2FD; color: #1565C0; }
.role-perawat { background: #E8F5E9; color: #2E7D32; }
.role-pmik    { background: #F3E5F5; color: #6A1B9A; }
.role-null    { background: #F5F5F5; color: #999; }

.verified-badge {
    display: inline-flex; align-items: center; gap: 4px;
    font-size: 11px; font-weight: 600;
}
.verified-yes { color: #2E7D32; }
.verified-no  { color: #E65100; }

/* FORM INLINE ROLE */
.form-inline { display: flex; align-items: center; gap: 6px; }
.select-role {
    height: 30px; border: 1.5px solid #e0e0e0;
    border-radius: 8px; font-size: 12px; padding: 0 8px;
    background: #fff; color: #333; cursor: pointer; outline: none;
}
.select-role:focus { border-color: #5DAEF5; }
.btn-update {
    height: 30px; padding: 0 12px;
    border: none; border-radius: 8px;
    background: #0A3D91; color: #fff;
    font-size: 11px; font-weight: 600; cursor: pointer;
    transition: 0.2s;
}
.btn-update:hover { background: #5DAEF5; }
.btn-delete {
    height: 30px; padding: 0 12px;
    border: 1.5px solid #dc3545; border-radius: 8px;
    background: transparent; color: #dc3545;
    font-size: 11px; font-weight: 600; cursor: pointer;
    transition: 0.2s;
}
.btn-delete:hover { background: #dc3545; color: #fff; }

.no-data { text-align: center; padding: 40px; color: #aaa; font-size: 14px; }
</style>

<div class="dashboard">

    {{-- SIDEBAR --}}
    @include('layouts.sidebar-admin')

    {{-- MAIN CONTENT --}}
    <div class="main">
        @include('layouts.navbar', [
            'title' => '👥 Manajemen User',
            'description' => 'Kelola semua akun pengguna SIGANDA'
        ])

        {{-- ALERTS --}}
        @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">❌ {{ session('error') }}</div>
        @endif

        {{-- FORM TAMBAH USER --}}
<div style="
    background:#fff;
    padding:20px;
    border-radius:16px;
    margin-bottom:20px;
    box-shadow:0 4px 20px rgba(0,0,0,0.07);
">

    <h2 style="margin-bottom:15px;">➕ Tambah User Baru</h2>

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div style="display:flex; gap:10px; flex-wrap:wrap;">

            <input type="text"
                   name="name"
                   placeholder="Nama"
                   required>

            <input type="email"
                   name="email"
                   placeholder="Email"
                   required>

            <input type="password"
                   name="password"
                   placeholder="Password"
                   required>

            <select name="role" required>
                <option value="">Role</option>
                <option value="admin">Admin</option>
                <option value="dokter">Dokter</option>
                <option value="perawat">Perawat</option>
                <option value="pmik">PMIK</option>
            </select>

            <button type="submit"
                    class="btn-update">
                Simpan
            </button>

        </div>
    </form>

</div>

        {{-- STATS --}}
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon bg-blue">👥</div>
                <div class="stat-info">
                    <h3>{{ $users->count() }}</h3>
                    <p>Total User</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-green">🩺</div>
                <div class="stat-info">
                    <h3>{{ $users->where('role','dokter')->count() }}</h3>
                    <p>Dokter</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-orange">💉</div>
                <div class="stat-info">
                    <h3>{{ $users->where('role','perawat')->count() }}</h3>
                    <p>Perawat</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon bg-purple">📁</div>
                <div class="stat-info">
                    <h3>{{ $users->where('role','pmik')->count() }}</h3>
                    <p>PMIK</p>
                </div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="table-card">
            <div class="table-header">
                <h2>Daftar Pengguna</h2>
                <div class="search-box">
                    🔍 <input type="text" id="searchInput" placeholder="Cari nama / email" onkeyup="filterTable()">
                </div>
            </div>

            <table id="userTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pengguna</th>
                        <th>Role</th>
                        <th>Status Email</th>
                        <th>Terdaftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="user-info">
                                <div class="avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                                <div>
                                    <div class="name">{{ $user->name }}</div>
                                    <div class="email">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($user->role)
                                <span class="role-badge-table role-{{ $user->role }}">
                                    {{ strtoupper($user->role) }}
                                </span>
                            @else
                                <span class="role-badge-table role-null">Belum</span>
                            @endif
                        </td>
                        <td>
                            @if($user->email_verified_at)
                                <span class="verified-badge verified-yes">✅ Terverifikasi</span>
                            @else
                                <span class="verified-badge verified-no">⏳ Belum</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            <div style="display:flex; gap:8px;">
                                <button onclick="openEditModal({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ addslashes($user->email) }}', '{{ $user->role }}')" class="btn-update" style="background:#f59e0b; color:#fff;">✏️ Edit</button>

                                @if($user->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.delete-user', $user) }}"
                                          onsubmit="return confirm('Hapus user {{ addslashes($user->name) }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-delete">🗑 Hapus</button>
                                    </form>
                                @else
                                    <span style="font-size:11px;color:#aaa; align-self:center;">— Anda</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="no-data">😔 Belum ada pengguna terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function filterTable() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#userTable tbody tr');
    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? '' : 'none';
    });
}

function openEditModal(id, name, email, role) {
    document.getElementById('editModal').style.display = 'flex';
    document.getElementById('editName').value = name;
    document.getElementById('editEmail').value = email;
    document.getElementById('editRole').value = role;
    document.getElementById('editForm').action = "/admin/users/" + id;
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}
</script>

<!-- MODAL EDIT -->
<div id="editModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
    <div style="background:#fff; padding:25px; border-radius:16px; width:400px; box-shadow:0 10px 25px rgba(0,0,0,0.2);">
        <h2 style="margin-bottom:15px; color:#0A3D91; font-size: 20px;">✏️ Edit User</h2>
        <form id="editForm" method="POST" action="">
            @csrf @method('PUT')
            
            <div style="margin-bottom:12px;">
                <label style="font-size:12px; font-weight:700; color:#555;">Nama Lengkap</label>
                <input type="text" name="name" id="editName" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd; margin-top:5px; outline:none;">
            </div>

            <div style="margin-bottom:12px;">
                <label style="font-size:12px; font-weight:700; color:#555;">Email</label>
                <input type="email" name="email" id="editEmail" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd; margin-top:5px; outline:none;">
            </div>

            <div style="margin-bottom:12px;">
                <label style="font-size:12px; font-weight:700; color:#555;">Role</label>
                <select name="role" id="editRole" required style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd; margin-top:5px; outline:none; background:#fff;">
                    <option value="admin">Admin</option>
                    <option value="dokter">Dokter</option>
                    <option value="perawat">Perawat</option>
                    <option value="pmik">PMIK</option>
                </select>
            </div>

            <div style="margin-bottom:25px;">
                <label style="font-size:12px; font-weight:700; color:#555;">Password Baru (Opsional)</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin ganti" style="width:100%; padding:10px; border-radius:8px; border:1px solid #ddd; margin-top:5px; outline:none;">
            </div>

            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <button type="button" onclick="closeEditModal()" class="btn-delete" style="padding:10px 15px; height:auto;">Batal</button>
                <button type="submit" class="btn-update" style="padding:10px 15px; height:auto;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>